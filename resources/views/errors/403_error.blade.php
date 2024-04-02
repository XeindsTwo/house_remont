@include('fragments.head', ['title' => 'Ошибка доступа'])
<body class="body">
@include('fragments.header')
<section class="error-page">
  <div class="container">
    <div class="error-page__content">
      <img src="{{asset('static/images/errors/403.svg')}}" width="370" height="236" alt="декоратив">
      <h1 class="error-page__title">Доступ запрещен</h1>
      <p class="error-page__text">
        У вас нет необходимых прав для доступа к этому ресурсу.
      </p>
      <a class="btn" href="{{asset(route('index'))}}">Вернуться на главную</a>
    </div>
  </div>
</section>
</body>