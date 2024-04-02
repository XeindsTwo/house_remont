<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class HomeController extends Controller
{
  public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
  {
    $reviews = Review::where('status', 1)
      ->orderBy('created_at')
      ->take(7)
      ->get();

    return view('index', compact('reviews'));
  }
}
