<?php

namespace App\Http\Controllers;

use App\Models\Work;
use Illuminate\View\View;

class PortfolioController extends Controller
{
  /**
   * Отображает список всех работ в портфолио.
   *
   * @return View
   */
  public function index()
  {
    // Получаем все работы из базы данных
    $works = Work::all();

    // Инициализируем массив для первых фотографий каждой работы
    $firstPhotos = [];

    // Перебираем каждую работу
    foreach ($works as $work) {
      // Получаем первую фотографию для текущей работы
      $firstPhoto = $work->photos()->first();

      // Сохраняем первую фотографию в массиве с ключом, соответствующим ID работы
      $firstPhotos[$work->id] = $firstPhoto;
    }

    // Возвращаем представление портфолио, передавая список работ и первые фотографии
    return view('portfolio.portfolio', compact('works', 'firstPhotos'));
  }

  /**
   * Отображает детали конкретной работы из портфолио.
   *
   * @param int $id Идентификатор работы
   * @return View
   */
  public function show(int $id)
  {
    // Находим работу по указанному идентификатору или выбрасываем исключение, если работа не найдена
    $work = Work::findOrFail($id);

    // Получаем все фотографии для текущей работы
    $photos = $work->photos()->get();

    // Получаем первую фотографию для текущей работы
    $firstPhoto = $work->photos()->first();

    // Возвращаем представление с деталями работы, передавая информацию о работе, фотографии и первую фотографию
    return view('portfolio.portfolio_show', compact('work', 'photos', 'firstPhoto'));
  }
}