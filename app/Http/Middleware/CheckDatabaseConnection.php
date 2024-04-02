<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckDatabaseConnection
{
  public function handle(Request $request, Closure $next)
  {
    try {
      DB::connection()->getPdo();
    } catch (Exception) {
      return redirect()->route('error503');
    }

    return $next($request);
  }
}