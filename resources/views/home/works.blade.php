<section class="works indent">
  <div class="container">
    <div class="works__top">
      <h2 class="title">
        Выполненные работы по дизайну и ремонту
      </h2>
      <div class="works__statistics">
        <span class="works__digital">{{ $worksCount }}</span>
        <p class="works__subtext">Работ <br> в портфолио</p>
      </div>
    </div>
    <ul class="works__list">
      @foreach ($latestWorks as $work)
        <li class="works__item">
          @if($work->cost)
            <span class="works__price">₽ {{$work->cost}}</span>
          @endif
          <a class="works__link" href="{{ route('portfolio.show', $work->id) }}">
            <img class="portfolio__img" src="{{asset('storage/works/' . $firstPhotos[$work->id]->photo_path)}}"
                 height="340">
          </a>
          <p class="works__name">{{ $work->title }}</p>
        </li>
      @endforeach
    </ul>
    <a class="works__more btn" href="{{ route('page.works') }}">Посмотреть ещё работы</a>
  </div>
</section>