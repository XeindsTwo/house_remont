@include('fragments.head', ['title' => 'Технические шоколадки'])
<body class="body">
@include('fragments.header')
<section class="error-page">
  <div class="container">
    <div class="error-page__content">
      <img src="{{asset('static/images/errors/503.svg')}}" width="370" height="236" alt="декоратив">
      <h1 class="error-page__title">Время ожидания истекло</h1>
      <p class="error-page__text">
        Что-то пошло не так в нашей базе! Наши специалисты уже разбираются с этим
      </p>
      <a class="btn" href="{{asset(route('index'))}}">Вернуться на главную</a>
    </div>
  </div>
</section>
@vite(['resources/js/app.js'])
</body>
