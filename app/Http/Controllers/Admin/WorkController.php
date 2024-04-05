<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Work;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class WorkController extends Controller
{
  public function index()
  {
    $works = Work::all();
    $firstPhotos = [];
    foreach ($works as $work) {
      $firstPhoto = $work->photos()->first();
      $firstPhotos[$work->id] = $firstPhoto;
    }

    return view('admin.works', compact('works', 'firstPhotos'));
  }

  public function createWork()
  {
    return view('admin.works_create');
  }

  public function store(Request $request)
  {
    try {
      $validator = Validator::make($request->all(), [
        'title' => 'required|string|max:255|min:15',
        'year' => 'required|digits:4',
        'cost' => [
          'nullable',
          'string',
          'max:12',
        ],
        'description' => 'nullable|string|max:2000',
        'photo' => [
          'required',
          'array',
          'min:5',
          'max:15',
        ],
        'photo.*' => 'required|image|mimes:jpeg,png,jpg,webp|max:5000',
      ]);

      if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
      }

      $work = Work::create([
        'title' => $request->title,
        'year' => $request->year,
        'cost' => $request->cost,
        'description' => $request->description,
      ]);

      // сохранение фотографий
      if ($request->hasFile('photo')) {
        foreach ($request->file('photo') as $photo) {
          $fileName = uniqid() . '.' . $photo->getClientOriginalExtension();
          $photo->storeAs('public/works', $fileName);
          $work->photos()->create([
            'photo_path' => $fileName,
          ]);
        }
      }

      return response()->json(['message' => 'Работа была успешно создана!']);
    } catch (Exception) {
      return response()->json(['error' => 'Произошла ошибка при создании работы'], 500);
    }
  }

  public function destroy($id)
  {
    try {
      $work = Work::findOrFail($id);
      foreach ($work->photos as $photo) {
        Storage::delete('public/works/' . $photo->photo_path);
      }

      $work->delete();
      return response()->json(['message' => 'Работа была успешно удалена!']);
    } catch (Exception) {
      return response()->json(['error' => 'Произошла ошибка при удалении работы'], 500);
    }
  }

  public function edit($id)
  {
    $work = Work::findOrFail($id);
    return view('admin.works_edit', compact('work'));
  }

  public function update(Request $request, $id)
  {
    try {
      $work = Work::findOrFail($id);

      $validator = Validator::make($request->all(), [
        'title' => 'required|string|max:255|min:15',
        'year' => 'required|digits:4',
        'cost' => [
          'nullable',
          'string',
          'max:12',
        ],
        'description' => 'nullable|string|max:2000',
        'photo.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5000',
      ]);

      if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
      }

      $work->update([
        'title' => $request->title,
        'year' => $request->year,
        'cost' => $request->cost,
        'description' => $request->description,
      ]);

      if ($request->hasFile('photo')) {
        foreach ($request->file('photo') as $photo) {
          $fileName = uniqid() . '.' . $photo->getClientOriginalExtension();
          $photo->storeAs('public/works', $fileName);
          $work->photos()->create([
            'photo_path' => $fileName,
          ]);
        }
      }

      return response()->json(['message' => 'Работа была успешно обновлена!']);
    } catch (Exception) {
      return response()->json(['error' => 'Произошла ошибка при обновлении работы'], 500);
    }
  }
}