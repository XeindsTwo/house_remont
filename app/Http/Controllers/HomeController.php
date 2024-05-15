<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Work;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class HomeController extends Controller
{
  public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
  {
    $reviews = Review::where('status', 1)
      ->orderBy('created_at')
      ->take(5)
      ->get();

    $worksCount = Work::count();
    $latestWorks = Work::orderBy('created_at', 'desc')
      ->take(4)
      ->get();

    $firstPhotos = [];
    foreach ($latestWorks as $work) {
      $firstPhoto = $work->photos()->first();
      $firstPhotos[$work->id] = $firstPhoto;
    }

    return view('index', compact('reviews', 'worksCount', 'latestWorks', 'firstPhotos'));
  }
}