@include('fragments.head', ['title' => $work->title])
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css">
<body class="body">
@include('fragments.header')
<main>
  <section>
    <div class="container">
      <div class="portfolio-show__top">
        <div class="portfolio-show__left">
          <h1 class="portfolio-show__title">{{$work->title}}</h1>
          <ul class="portfolio-show__list">
            <li class="portfolio-show__item">
              <span class="portfolio-show__subtext">Год реализации</span>
              <span class="portfolio-show__value">{{$work->year}}</span>
            </li>
            @if($work->cost)
              <li class="portfolio-show__item">
                <span class="portfolio-show__subtext">Стоимость ремонта</span>
                <span class="portfolio-show__value">{{$work->cost}}₽</span>
              </li>
            @endif
          </ul>
        </div>
        <img class="portfolio-show__img" src="{{asset('storage/works/' . $firstPhoto->photo_path)}}"
             height="340">
      </div>
      @if($work->description)
        <p class="portfolio-show__description">{{$work->description}}</p>
      @endif
    </div>
  </section>
  <section class="portfolio-show__gallery">
    <div class="container">
      <h2 class="portfolio-show__subtitle">Галерея работы</h2>
      <div class="portfolio-show__photos">
        @foreach($photos as $photo)
          <a class="portfolio-show__link" href="{{asset('storage/works/' . $photo->photo_path)}}" data-fancybox="gallery">
            <img
                class="portfolio-show__photo"
                src="{{asset('storage/works/' . $photo->photo_path)}}"
                height="450"
            >
          </a>
        @endforeach
      </div>
    </div>
  </section>
</main>
@include('fragments.footer')
</body>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
<script>
  Fancybox.bind("[data-fancybox]", {});
</script>