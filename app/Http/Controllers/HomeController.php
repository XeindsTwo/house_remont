<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Work;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class HomeController extends Controller
{
  /**
   * Отображает главную страницу.
   *
   * @return View|Factory|Application|\Illuminate\View\View
   */
  public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
  {
    // Получаем последние пять активных отзывов, отсортированных по дате создания
    $reviews = Review::where('status', 1)
      ->orderBy('created_at')
      ->take(5)
      ->get();

    // Получаем количество работ в портфолио
    $worksCount = Work::count();

    // Получаем четыре самые последние работы, отсортированные по дате создания
    $latestWorks = Work::orderBy('created_at', 'desc')
      ->take(4)
      ->get();

    // Инициализируем массив для первых фотографий каждой последней работы
    $firstPhotos = [];

    // Перебираем каждую последнюю работу
    foreach ($latestWorks as $work) {
      // Получаем первую фотографию для текущей работы
      $firstPhoto = $work->photos()->first();

      // Сохраняем первую фотографию в массиве с ключом, соответствующим ID работы
      $firstPhotos[$work->id] = $firstPhoto;
    }

    // Возвращаем представление главной страницы, передавая данные об отзывах, количестве работ, последних работах и первых фотографиях
    return view('index', compact('reviews', 'worksCount', 'latestWorks', 'firstPhotos'));
  }
}
