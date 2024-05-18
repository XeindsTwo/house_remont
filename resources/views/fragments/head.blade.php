<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta
      name="description"
      content="Уютный дом - предлагаем вам свой уникальный дизайн и ремонт квартир в Белореченске"
  >
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ $title ?? 'Уютный дом | Ремонт квартир в Белореченске' }}</title>
  <link rel="icon" href="{{asset('static/images/icons/favicon.svg')}}" type="images/x-icon">
  <link rel="shortcut icon" href="{{asset('static/images/icons/favicon.svg')}}" type="images/x-icon">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&amp;display=swap"
        rel="stylesheet">
  @stack('head')
  @vite(['resources/css/style.css'])
</head>