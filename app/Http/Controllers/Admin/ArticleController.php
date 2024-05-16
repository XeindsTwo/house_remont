<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
  // Метод для отображения списка статей
  public function index()
  {
    // Выбираем необходимые поля из базы данных для вывода списка статей
    $articles = Article::select('id', 'title', 'image', 'created_at', 'updated_at')->get();
    // Передаем данные в представление и отображаем страницу управления статьями
    return view('admin.blog.manage_articles', compact('articles'));
  }

  // Метод для отображения формы создания новой статьи
  public function create()
  {
    // Отображаем форму создания статьи
    return view('admin.blog.create');
  }

  // Метод для сохранения новой статьи в базу данных
  public function store(Request $request)
  {
    // Проверяем входные данные на соответствие правилам валидации
    $request->validate([
      'title' => 'required|string|max:255',
      'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
      'content' => 'required',
    ]);

    // Создаем новый экземпляр статьи
    $article = new Article;
    $article->title = $request->input('title');
    $article->content = $request->input('content');

    // Проверяем наличие загруженного изображения и сохраняем его, если оно есть
    if ($request->hasFile('image')) {
      $image = $request->file('image');
      $imageName = time() . '_' . $image->getClientOriginalName(); // Добавляем уникальность к имени файла
      $imagePath = $image->storeAs('public/articles', $imageName); // Сохраняем изображение на сервере
      $article->image = 'articles/' . $imageName;
    }

    // Сохраняем статью в базу данных
    $article->save();

    // Перенаправляем пользователя на страницу со списком статей с сообщением об успешном создании статьи
    return redirect()->route('admin.articles.index')->with('success', 'Статья была успешно создана');
  }

  // Метод для отображения формы редактирования статьи
  public function edit(Article $article)
  {
    // Отображаем форму редактирования статьи с передачей данных о редактируемой статье
    return view('admin.blog.edit', compact('article'));
  }

  // Метод для обновления информации о статье в базе данных
  public function update(Request $request, Article $article)
  {
    // Проверяем входные данные на соответствие правилам валидации
    $request->validate([
      'title' => 'required|string|max:255',
      'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
      'content' => 'required',
    ]);

    // Обновляем информацию о статье
    $article->title = $request->input('title');
    $article->content = $request->input('content');

    // Проверяем, было ли загружено новое изображение
    if ($request->hasFile('image')) {
      // Удаляем предыдущее изображение, если оно существует
      if ($article->image !== null) {
        Storage::delete('public/' . $article->image);
      }

      // Сохраняем новое изображение
      $image = $request->file('image');
      $imageName = time() . '_' . $image->getClientOriginalName();
      $imagePath = $image->storeAs('public/articles', $imageName);
      $article->image = 'articles/' . $imageName;
    }

    // Сохраняем обновленную информацию о статье в базе данных
    $article->save();

    // Перенаправляем пользователя на страницу со списком статей с сообщением об успешном обновлении статьи
    return redirect()->route('admin.articles.index')->with('success', 'Статья была успешно обновлена');
  }

  // Метод для удаления статьи
  public function destroy(Article $article)
  {
    try {
      // Проверяем, есть ли у статьи изображение и удаляем его, если оно существует
      if ($article->image !== null) {
        Storage::delete('public/' . $article->image);
      }

      // Удаляем статью из базы данных
      $article->delete();

      // Возвращаем JSON-ответ с сообщением об успешном удалении статьи
      return response()->json(['success' => true, 'message' => 'Статья была успешно удалена']);
    } catch (Exception $e) {
      // Возвращаем JSON-ответ с сообщением об ошибке в случае неудачного удаления статьи
      return response()->json(['success' => false, 'message' => 'Ошибка удаления статьи: ' . $e->getMessage()], 500);
    }
  }
}