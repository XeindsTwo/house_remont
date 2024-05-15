@include('fragments/head', ['title' => 'Уютный дом | Оставить отзыв'])
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
<body class="body">
@include('fragments.header')
<main>
  <section class="reviews-form indent--big indent--breadcrumbs">
    <div class="container">
      <ul class="breadcrumbs">
        <li class="breadcrumbs__item">
          <a class="breadcrumbs__link breadcrumbs__link--nav" href="{{route('index')}}">
            <span>
              Главная
            </span>
          </a>
        </li>
        <li class="breadcrumbs__item">
          <a class="breadcrumbs__link breadcrumbs__link--nav" href="{{route('reviews')}}">
            <span>
              Отзывы компании
            </span>
          </a>
        </li>
        <li class="breadcrumbs__item">
          <span class="breadcrumbs__link active">Написание отзыва</span>
        </li>
      </ul>
      <form class="reviews-form__form" enctype="multipart/form-data" method="post" action="{{route('reviews.store')}}">
        @csrf
        <div class="reviews-form__content">
          <div class="reviews-form__left">
            <div class="reviews-form__item">
              <label class="label" for="name">Ваше имя</label>
              <input class="reviews-form__input input" type="text"
                     minlength="2" maxlength="50" id="name" name="name"
                     required placeholder="Введите имя"
                     pattern="[А-Яа-яЁё\s\-]+"
                     title="Имя может содержать только кириллицу, пробелы и дефисы"
              >
            </div>
            <div class="reviews-form__item">
              <label class="label" for="phone">Ваш номер телефона</label>
              <p>
                Ваш телефон будет использоваться для дальнейшей связи с администрацией компании
              </p>
              <input class="reviews-form__input input" type="text" data-tel-input
                     id="phone" name="phone" required
                     placeholder="+7 (___) ___-__-__"
              >
            </div>
            <div class="reviews-form__item">
              <label class="label" for="content">Комментарий</label>
              <textarea class="reviews-form__input textarea input" id="content" required minlength="100" maxlength="2400"
                        name="content"
                        placeholder="Введите комментарий"></textarea>
            </div>
            <button class="reviews-form__btn btn" type="submit">Отправить</button>
          </div>
          <div class="reviews-form__photo">
            <label class="label" for="photo">Фотография для отзыва</label>
            <span class="error error--not-bottom" id="photoError">Фотография обязательно должна присутствовать!</span>
            <span class="error error--not-bottom" id="formatError">Разрешен только формат jpg, jpeg png, и webp</span>
            <span class="error error--not-bottom" id="sizeError">Макс. вес изображения - 3мб</span>
            <input class="reviews-form__file" type="file" name="photo" id="photo">
            <div class="reviews-form__loader" onclick="document.getElementById('photo').click();">
              <span id="uploadText">Загрузите фото</span>
            </div>
          </div>
        </div>
      </form>
    </div>
  </section>
</main>
</body>
<script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
@vite(['resources/js/components/phone-mask.js'])
@vite(['resources/js/review.js'])
