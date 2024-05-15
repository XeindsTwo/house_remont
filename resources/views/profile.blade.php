@include('fragments/head', ['title' => 'Профиль'])
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
<body class="body">
@include('fragments.header')
<main>
  <section class="profile">
    <div class="container container--profile">
      <a class="profile__back" href="{{route('index')}}">
        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M16.5833 9.00001H1.41663M1.41663 9.00001L8.99996 16.5833M1.41663 9.00001L8.99996 1.41667"
                stroke="#83888F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        Вернуться на главную
      </a>
      @if($user->role === 'ADMIN')
        <div class="profile__admin">
          Вы имеете доступ к админ-панели
          <a href="{{route('admin.feedback-request')}}">Перейти в админ-панель</a>
        </div>
      @endif
      <div class="profile__info">
        <div class="profile__avatar">
          @if ($user->avatar)
            <img class="profile__img" src="{{ asset('storage/avatars/' . $user->avatar) }}" width="160" height="160"
                 alt="Avatar">
          @else
            <img class="profile__img" src="{{ asset('static/images/avatar.png') }}" width="160" height="160"
                 alt="Default Avatar">
          @endif
          <button class="profile__edit-avatar" type="button">
            <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <g clip-path="url(#clip0_11401_4262)">
                <path
                    d="M23.5 4V10M23.5 10H17.5M23.5 10L18.87 5.64C17.4906 4.25974 15.7 3.36518 13.768 3.09114C11.8359 2.8171 9.86717 3.17841 8.15836 4.12064C6.44954 5.06286 5.09325 6.53495 4.29386 8.31507C3.49448 10.0952 3.29531 12.0869 3.72637 13.9901C4.15743 15.8932 5.19536 17.6047 6.68376 18.8667C8.17216 20.1286 10.0304 20.8726 11.9784 20.9866C13.9265 21.1006 15.8588 20.5783 17.4842 19.4985C19.1096 18.4187 20.34 16.8399 20.99 15"
                    stroke="#83888F" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
              </g>
              <defs>
                <clipPath id="clip0_11401_4262">
                  <rect width="24" height="24" fill="white" transform="translate(0.5)"/>
                </clipPath>
              </defs>
            </svg>
            Изменить
          </button>
        </div>
        <div>
          <h1 class="profile__name" id="profile-name">{{$user->name}}</h1>
          <div class="profile__list">
            <a class="profile__logout" href="{{route('logout')}}">Выйти из аккаунта</a>
            <span id="profile-email">{{$user->email}}</span>
            <span>{{$user->login}}</span>
          </div>
        </div>
        <button class="profile__edit-data" type="button">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M11 4H4C3.46957 4 2.96086 4.21072 2.58579 4.58579C2.21071 4.96086 2 5.46957 2 6V20C2 20.5304 2.21071 21.0391 2.58579 21.4142C2.96086 21.7893 3.46957 22 4 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V13M18.5 2.5C18.8978 2.10218 19.4374 1.87868 20 1.87868C20.5626 1.87868 21.1022 2.10218 21.5 2.5C21.8978 2.89783 22.1213 3.43739 22.1213 4C22.1213 4.56261 21.8978 5.10218 21.5 5.5L12 15L8 16L9 12L18.5 2.5Z"
                stroke="#83888F" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
          Изменить данные профиля
        </button>
      </div>
    </div>
  </section>
  <section class="password">
    <div class="container container--profile">
      <div class="password__inner">
        <h2 class="password__title">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M21 2L19 4M19 4L22 7L18.5 10.5L15.5 7.5M19 4L15.5 7.5M11.39 11.61C11.9063 12.1195 12.3168 12.726 12.5978 13.3948C12.8787 14.0635 13.0246 14.7813 13.027 15.5066C13.0295 16.232 12.8884 16.9507 12.6119 17.6213C12.3354 18.2919 11.9291 18.9012 11.4161 19.4141C10.9032 19.9271 10.2939 20.3334 9.6233 20.6099C8.95268 20.8864 8.234 21.0275 7.50863 21.025C6.78327 21.0226 6.06554 20.8767 5.39679 20.5958C4.72804 20.3148 4.12147 19.9043 3.612 19.388C2.61013 18.3507 2.05576 16.9614 2.06829 15.5193C2.08082 14.0772 2.65925 12.6977 3.679 11.678C4.69874 10.6583 6.07821 10.0798 7.52029 10.0673C8.96238 10.0548 10.3517 10.6091 11.389 11.611L11.39 11.61ZM11.39 11.61L15.5 7.5"
                stroke="#111111" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
          Смена пароля
        </h2>
        <form class="password__form" method="post">
          @csrf
          <ul class="password__list">
            <li class="password__item">
              <label class="label" for="current_password">Ваш текущий пароль</label>
              <span class="error" id="current_error">Текущий пароль неверный</span>
              <div class="password-field">
                <input class="password__input input" id="current_password" name="current_password"
                       required type="password" placeholder="Введите пароль"
                >
                <button class="password-field__btn" data-target="current_password" type="button"></button>
              </div>
            </li>
            <li class="password__item">
              <label class="label" for="new_password">Новый пароль</label>
              <span class="error" id="new_error-one">Новый пароль должен отличаться от текущего</span>
              <span class="error" id="new_error-two">Новый пароль должен совпадать с повторяющимся паролем</span>
              <div class="password-field">
                <input class="password__input input"
                       id="new_password"
                       name="new_password"
                       required
                       type="password"
                       placeholder="Придумайте пароль"
                       pattern="^[a-zA-Z0-9_]{8,60}$"
                       title="Пароль может содержать только латиницу, цифры и символ подчеркивания, и должен быть от 8 до 60 символов в длину"
                       maxlength="60"
                >
                <button class="password-field__btn" data-target="new_password" type="button"></button>
              </div>
            </li>
            <li class="password__item">
              <label class="label" for="confirm_password">Повторите пароль, чтобы не ошибиться</label>
              <div class="password-field">
                <input class="password__input input" id="confirm_password" name="confirm_password"
                       required type="password" placeholder="Повторите пароль"
                >
                <button class="password-field__btn" data-target="confirm_password" type="button"></button>
              </div>
            </li>
          </ul>
          <p class="password__info">
            После смены пароля произойдёт выход из аккаунта на всех устройствах
          </p>
          <button class="password__btn btn" type="submit">Сохранить</button>
        </form>
      </div>
    </div>
  </section>
</main>
<div class="modal" id="edit-modal">
  <button class="modal__close" type="button" id="close-edit">
    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M18 6L6 18M6 6L18 18" stroke="#545860" stroke-width="2" stroke-linecap="round"
            stroke-linejoin="round"/>
    </svg>
  </button>
  <h2 class="modal__title">
    Редактирование профиля
  </h2>
  <form class="modal__form" id="formUpdateProfile" method="post">
    <ul class="modal__list modal__list--top">
      <li class="modal__item">
        <label class="label" for="name">Имя</label>
        <input class="input password__input" id="name" required
               minlength="2" maxlength="50"
               type="text" name="name"
               placeholder="Введите ваше имя"
               pattern="[A-Za-zА-Яа-яЁё\s\-]+"
               value="{{ Auth::user()->name }}"
               title="Разрешены только буквы, пробелы и дефисы"
        >
      </li>
      <li class="modal__item">
        <label class="label" for="email">Электронная почта</label>
        <span class="error error--not-bottom" id="email-error">Почта уже используется другим пользователем</span>
        <input class="input password__input" type="email" required
               maxlength="50"
               id="email" name="email"
               placeholder="Введите вашу почту"
               value="{{ Auth::user()->email }}"
        >
      </li>
    </ul>
    <div class="modal__actions">
      <button class="modal__cancel btn" type="button" id="close-edit-btn">Отменить изменения</button>
      <button class="modal__complete btn" type="submit" id="complete-edit-btn">Сохранить</button>
    </div>
  </form>
</div>
</body>
@vite(['resources/js/components/password.js'])
@vite(['resources/js/profile/update-data.js'])
@vite(['resources/js/profile/update-avatar.js'])
@vite(['resources/js/profile/update-password.js'])
<script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
