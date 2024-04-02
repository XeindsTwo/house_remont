<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\ServiceUnavailableHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
  protected $dontFlash = [
    'current_password',
    'password',
    'password_confirmation',
  ];

  public function register(): void
  {
    $this->reportable(function (Throwable $e) {

    });
  }

  public function render($request, Throwable $e): Response|JsonResponse|RedirectResponse|\Symfony\Component\HttpFoundation\Response
  {
    if ($e instanceof ServiceUnavailableHttpException) {
      return response()->view('errors.503_error', [], 503);
    }

    return parent::render($request, $e);
  }
}