<?php

namespace App\Http\Controllers;

use App\Models\Work;

class PortfolioController extends Controller
{
  public function index()
  {
    $works = Work::all();
    $firstPhotos = [];
    foreach ($works as $work) {
      $firstPhoto = $work->photos()->first();
      $firstPhotos[$work->id] = $firstPhoto;
    }

    return view('portfolio.portfolio', compact('works', 'firstPhotos'));
  }

  public function show($id)
  {
    $work = Work::findOrFail($id);
    $photos = $work->photos()->get();
    $firstPhoto = $work->photos()->first();

    return view('portfolio.portfolio_show', compact('work', 'photos', 'firstPhoto'));
  }
}