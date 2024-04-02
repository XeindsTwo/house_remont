<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
  public function handle(Request $request, Closure $next)
  {
    if (!$request->user() || $request->user()->role !== 'ADMIN') {
      return redirect('/403_error');
    }
    return $next($request);
  }
}