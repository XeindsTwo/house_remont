@include('fragments/head', ['title' => 'Страница не найдена'])
<body class="body">
@include('fragments.header')
<section class="error-page">
  <div class="container">
    <div class="error-page__content">
      <img src="{{asset('static/images/errors/404.svg')}}" width="370" height="236" alt="декоратив">
      <h1 class="error-page__title">Страница не найдена</h1>
      <p class="error-page__text">
        Возможно, она удалена или был введен неправильный адрес
      </p>
      <a class="btn" href="{{asset(route('index'))}}">Вернуться на главную</a>
    </div>
  </div>
</section>
</body>