<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
  public function index()
  {
    $articles = Article::select('id', 'title', 'image', 'created_at', 'updated_at')->get();
    return view('admin.blog.manage_articles', compact('articles'));
  }

  public function create()
  {
    return view('admin.blog.create');
  }

  public function store(Request $request)
  {
    $request->validate([
      'title' => 'required|string|max:255',
      'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
      'content' => 'required',
    ]);

    $article = new Article;
    $article->title = $request->input('title');
    $article->content = $request->input('content');

    if ($request->hasFile('image')) {
      $image = $request->file('image');
      $imageName = time() . '_' . $image->getClientOriginalName(); // Добавляем уникальность к имени файла
      $imagePath = $image->storeAs('public/articles', $imageName);
      $article->image = 'articles/' . $imageName;
    }

    $article->save();

    return redirect()->route('admin.articles.index')->with('success', 'Статья была успешно создана');
  }

  public function edit(Article $article)
  {
    return view('admin.blog.edit', compact('article'));
  }

  public function update(Request $request, Article $article)
  {
    $request->validate([
      'title' => 'required|string|max:255',
      'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
      'content' => 'required',
    ]);

    $article->title = $request->input('title');
    $article->content = $request->input('content');

    // Проверяем, было ли загружено новое изображение
    if ($request->hasFile('image')) {
      // Удаляем предыдущее изображение, если оно существует
      if ($article->image !== null) {
        Storage::delete('public/' . $article->image);
      }

      $image = $request->file('image');
      $imageName = time() . '_' . $image->getClientOriginalName();
      $imagePath = $image->storeAs('public/articles', $imageName);
      $article->image = 'articles/' . $imageName;
    }

    $article->save();

    return redirect()->route('admin.articles.index')->with('success', 'Статья была успешно обновлена');
  }

  public function destroy(Article $article)
  {
    try {
      if ($article->image !== null) {
        Storage::delete('public/' . $article->image);
      }

      $article->delete();

      return response()->json(['success' => true, 'message' => 'Статья была успешно удалена']);
    } catch (Exception $e) {
      return response()->json(['success' => false, 'message' => 'Ошибка удаления статьи: ' . $e->getMessage()], 500);
    }
  }
}