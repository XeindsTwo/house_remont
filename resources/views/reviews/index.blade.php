@include('fragments/head', ['title' => 'Просто Ремонт | Отзывы компании'])
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css">
<body class="body">
@include('fragments.header')
<main>
  <section class="reviews-page indent--big indent--breadcrumbs">
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
          <span class="breadcrumbs__link active">Отзывы компании</span>
        </li>
      </ul>
      @if($reviews->isEmpty())
        <div class="reviews-page__empty">
          <img src="{{asset('static/images/icons/not-items.png')}}" width="48" height="48" alt="декор иконка">
          <p class="reviews-page__subtext">Люди ещё не написали отзывов</p>
          @auth
            <p class="reviews-page__info">
              Пожалуйста, <a href="{{route('reviews.form')}}">напишите</a> хотя бы один отзыв.
            </p>
          @endauth
          @guest
            <p class="reviews-page__info">
              Чтобы написать отзыв, вам нужно <a href="{{route('login')}}">авторизоваться</a>
            </p>
          @endguest
        </div>
      @else
        @if (Auth::check())
          <a class="reviews-page__link" href="{{ route('reviews.form') }}">
            <img src="{{asset('static/images/icons/hello.png')}}" width="28" height="28" alt="">
            Хочу оставить отзыв
          </a>
        @else
          <p class="reviews-page__noauth">
            Чтобы оставлять отзыв вам нужно <a href="{{ route('login') }}">авторизоваться</a>
          </p>
        @endif
        <ul class="reviews-page__list">
          @foreach($reviews as $review)
            <li class="reviews-page__item">
              <div class="reviews-page__content">
                <div class="reviews-page__top">
                  @if ($review->user->avatar)
                    <img class="reviews-page__avatar" src="{{ asset('storage/avatars/' . $review->user->avatar) }}"
                         width="60" height="60" alt="аватар пользователя"
                    >
                  @else
                    <img class="reviews-page__avatar" src="{{ asset('static/images/avatar.svg') }}"
                         width="60" height="60" alt="Стандартный аватар"
                    >
                  @endif
                  <span class="reviews-page__name">{{$review->name}}</span>
                </div>
                <p class="reviews-page__comment">{{ $review->content }}</p>
              </div>
              <a href="{{asset('storage/' . $review->photo)}}" data-fancybox="gallery">
                <img class="reviews-page__photo"
                     src="{{asset('storage/' . $review->photo)}}"
                     alt="ремонт квартир Белореченск" width="520" height="620"
                >
              </a>
            </li>
          @endforeach
        </ul>
      @endif
    </div>
  </section>
</main>
@if(!$reviews->isEmpty())
  @include('fragments.footer')
@endif
</body>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
<script>
  Fancybox.bind("[data-fancybox]", {});
</script>