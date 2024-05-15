<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RepairEstimate;

class RepairEstimateController extends Controller
{
  public function store(Request $request)
  {
    $validatedData = $request->validate([
      'object' => 'required|string',
      'material' => 'required|string',
      'area' => 'required|string',
      'timing' => 'required|string',
      'phone' => 'required|string',
    ]);

    RepairEstimate::create($validatedData);

    return response()->json(['message' => 'Заявление успешно было создано']);
  }
}