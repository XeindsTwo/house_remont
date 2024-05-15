<?php

namespace App\Http\Controllers;

use App\Models\Article;

class BlogController extends Controller
{
  public function index()
  {
    $articles = Article::select('id', 'title', 'image', 'created_at', 'updated_at')->get();
    return view('blog.index', compact('articles'));
  }

  public function show(Article $article)
  {
    return view('blog.article', compact('article'));
  }
}