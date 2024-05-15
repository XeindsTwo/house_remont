@include('fragments/head', ['title' => 'Регистрация'])
<body class="body">
<div class="container">
  <div class="auth__wrapper">
    <a class="auth__logo logo" href="{{route('index')}}">
      <img src="{{asset('static/images/icons/logo-dark.svg')}}" alt="">
    </a>
    <div class="auth__inner">
      <div class="auth__content">
        <h1 class="auth__title">Регистрация</h1>
        <p class="auth__text">
          Вы будете иметь возможность оставлять отзывы, комментировать статьи блога и т.д.
        </p>
      </div>
      <form class="auth__form" id="formAuth" method="POST" action="{{route('register')}}">
        @csrf
        <div id="responseMessage"></div>
        <ul class="auth__list">
          <li class="auth__item">
            <span class="error" id="loginError">Логин не должен иметь запрещенные символы</span>
            <span class="error" id="loginCheckError">Логин уже используется</span>
            <span class="error" id="loginLengthError">Минимальное количество символов - 5</span>
            <input class="auth__input input" id="login" type="text" name="login" maxlength="60" placeholder="Введите ваш логин">
          </li>
          <li class="auth__item">
            <span class="error" id="nameMinError">Мин. количество символов - 2</span>
            <span class="error" id="nameError">Имя не должно содержать запрещенные символы</span>
            <input class="auth__input input" id="name" type="text" name="name" maxlength="50" placeholder="Введите ваше имя"
                   value="{{ old('name') }}">
          </li>
          <li class="auth__item">
            <span class="error" id="emailError">Почта уже используется</span>
            <span class="error" id="emailErrorParameters">Почта не соответствует параметрам</span>
            <input class="auth__input input" id="email" type="email" name="email" maxlength="80" placeholder="Введите ваш email"
                   value="{{ old('email') }}">
          </li>
          <li class="auth__item">
            <span class="error" id="passwordError">
              Пароль может содержать латиницу, спец. символы и цифры
            </span>
            <span class="error" id="passwordLengthError">Минимальное количество символов - 8</span>
            <div class="password-field">
              <input class="auth__input auth__input--password input" id="password" autocomplete="new-password" type="password"
                     placeholder="Введите пароль" maxlength="60" name="password"
              >
              <button class="password-field__btn" data-target="password" type="button"></button>
            </div>
          </li>
        </ul>
        <div class="auth__buttons">
          <a class="auth__btn auth__btn-dop" href="{{route('login')}}">Войти в аккаунт</a>
          <button class="auth__btn" id="registration-btn" type="submit">Зарегистрироваться</button>
        </div>
      </form>
    </div>
  </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@vite(['resources/js/register.js'])
@vite(['resources/js/components/password.js'])
</body>