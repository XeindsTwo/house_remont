@include('fragments/head', ['title' => 'Авторизация'])
<body class="body">
<div class="container">
  <div class="auth__wrapper">
    <a class="auth__logo logo" href="{{route('index')}}">
      <img src="{{asset('static/images/icons/logo-dark.svg')}}" alt="">
    </a>
    <div class="auth__inner">
      <div class="auth__content">
        <h1 class="auth__title">Вход</h1>
        <p class="auth__text">
          Используйте аккаунт с весельем на будущее!
        </p>
      </div>
      <form class="auth__form" id="formAuth" method="POST" action="{{ route('login') }}">
        @csrf
        <span class="error @if($errors->has('login')) error--active @endif" id="authError">
                    {{ $errors->first('login') ?? 'Неверно введен логин или пароль' }}
                </span>
        <ul class="auth__list">
          <li class="auth__item">
            <input class="auth__input input" name="login" id="login" type="text" placeholder="Введите логин"
                   value="{{ old('login') }}" required>
          </li>
          <li class="auth__item">
            <div class="password-field">
              <input class="auth__input auth__input--password input" id="password" type="password" placeholder="Введите пароль" name="password"
                     value="{{ old('password') }}" required
              >
              <button class="password-field__btn" data-target="password" type="button"></button>
            </div>
          </li>
        </ul>
        <div class="auth__buttons">
          <a class="auth__btn auth__btn-dop" id="loginBtn" href="{{route('register')}}">Создать аккаунт</a>
          <button class="auth__btn" id="loginBtn" type="submit">Войти</button>
        </div>
      </form>
    </div>
  </div>
</div>
@vite(['resources/js/components/password.js'])
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>