<section class="reviews indent">
  <div class="container">
    <h2 class="reviews__title title">Отзывы наших клиентов</h2>
    <div class="reviews__top">
      <a class="reviews__link" href="{{route('reviews')}}">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path
              d="M14.5 24H13.5C12.673 24 12 23.327 12 22.5V17.5C12 16.673 12.673 16 13.5 16H14.5C15.327 16 16 16.673 16 17.5V22.5C16 23.327 15.327 24 14.5 24ZM13.5 17C13.225 17 13 17.224 13 17.5V22.5C13 22.776 13.225 23 13.5 23H14.5C14.775 23 15 22.776 15 22.5V17.5C15 17.224 14.775 17 14.5 17H13.5Z"
              fill="#2a2a2a"/>
          <path
              d="M21 24H20.24C17.537 24 15.955 23.326 15.252 22.924C15.012 22.787 14.929 22.482 15.065 22.242C15.203 22 15.509 21.919 15.748 22.056C16.245 22.34 17.677 23 20.24 23H21C21.703 23 22.339 22.481 22.447 21.819C22.449 21.804 22.452 21.789 22.456 21.775C22.518 21.475 22.986 18.688 23 18.401C23 17.633 22.367 17 21.59 17H18.84C18.655 17 18.486 16.898 18.399 16.735C18.312 16.572 18.322 16.375 18.425 16.221C18.427 16.218 18.81 15.616 18.81 14.629C18.81 13.631 18.41 13.269 18.14 13.269C18.047 13.281 17.941 13.424 17.941 14.169C17.941 15.72 16.398 16.85 15.735 17.263C15.504 17.408 15.193 17.338 15.047 17.103C14.901 16.869 14.972 16.56 15.206 16.414C15.613 16.16 16.941 15.248 16.941 14.168C16.941 13.551 16.941 12.268 18.14 12.268C18.945 12.268 19.81 13.006 19.81 14.628C19.81 15.181 19.715 15.645 19.603 15.998H21.59C22.919 15.998 24 17.079 24 18.408C24 18.44 23.876 20.949 23.39 21.971L23.434 21.978C23.246 23.132 22.199 24 21 24ZM16.5 9.75C16.224 9.75 16 9.526 16 9.25V5H2.5C1.121 5 0 3.878 0 2.5C0 1.122 1.121 0 2.5 0H14.5C14.776 0 15 0.224 15 0.5V4H16.5C16.776 4 17 4.224 17 4.5V9.25C17 9.527 16.776 9.75 16.5 9.75ZM2.5 1C1.673 1 1 1.673 1 2.5C1 3.327 1.673 4 2.5 4H14V1H2.5Z"
              fill="#2a2a2a"/>
          <path
              d="M9.5 22H2.5C1.121 22 0 20.878 0 19.5V2.5C0 2.224 0.224 2 0.5 2C0.776 2 1 2.224 1 2.5V19.5C1 20.327 1.673 21 2.5 21H9.5C9.776 21 10 21.224 10 21.5C10 21.776 9.776 22 9.5 22Z"
              fill="#2a2a2a"/>
        </svg>
        Смотреть все отзывы
      </a>
      <div class="reviews__control">
        <button class="reviews__btn reviews__btn--prev" tabindex="0" aria-label="Previous slide"
                aria-controls="swiper-wrapper-7157c9bf102c5ef51">
          <svg width="10" height="17" viewBox="0 0 10 17" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M1 0.75L8.5 8.25L1 15.75" stroke="#131300" stroke-width="1.7" stroke-linecap="round"
                  stroke-linejoin="round"></path>
          </svg>
        </button>
        <button class="reviews__btn reviews__btn--next" tabindex="0" aria-label="Next slide"
                aria-controls="swiper-wrapper-7157c9bf102c5ef51">
          <svg width="10" height="17" viewBox="0 0 10 17" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M1 0.75L8.5 8.25L1 15.75" stroke="#131300" stroke-width="1.7" stroke-linecap="round"
                  stroke-linejoin="round"></path>
          </svg>
        </button>
      </div>
    </div>
  </div>
  <div class="reviews__swiper swiper">
    <div class="swiper-wrapper">
      @foreach($reviews as $review)
        <div class="swiper-slide">
          <div class="reviews__slide">
            <img class="reviews__img" src="{{asset('storage/' . $review->photo)}}" width="520" height="620"
                 alt="Отзывы ремонт квартир">
            <div class="reviews__content">
              <div class="reviews__user">
                @if($review->user->avatar)
                  <img class="reviews__avatar" src="{{ asset('storage/avatars/' . $review->user->avatar) }}"
                       width="58" height="58" alt="аватар пользователя"
                  >
                @else
                  <img class="reviews__avatar" src="{{asset('static/images/avatar.svg')}}"
                       width="58" height="58" alt="аватар пользователя"
                  >
                @endif
                <div class="reviews__info">
                  <span class="reviews__name">{{ $review->name }}</span>
                </div>
              </div>
              <p>{{ $review->content }}</p>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>