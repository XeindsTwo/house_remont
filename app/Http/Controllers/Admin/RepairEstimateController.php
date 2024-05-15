<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Exception;
use App\Models\RepairEstimate;

class RepairEstimateController extends Controller
{
  public function index()
  {
    // Получаем все уникальные значения поля "object"
    $uniqueObjects = RepairEstimate::distinct()->pluck('object');
    $estimates = RepairEstimate::all();
    return view('admin.manage_repair_estimates', compact('uniqueObjects', 'estimates'));
  }

  public function destroy($id)
  {
    try {
      $feedbackRequest = RepairEstimate::findOrFail($id);
      $feedbackRequest->delete();
      return response()->json(['message' => 'Заявка успешно удалена']);
    } catch (Exception) {
      return response()->json(['error' => 'Ошибка при удалении заявки'], 500);
    }
  }
}