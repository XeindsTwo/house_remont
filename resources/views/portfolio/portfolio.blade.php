@include('fragments.head', ['title' => 'Уютный дом | Портфолио работ'])
<body class="body">
@include('fragments.header')
<main>
  <section class="indent indent--breadcrumbs">
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
          <span class="breadcrumbs__link active">Портфолио</span>
        </li>
      </ul>
      <h1 class="portfolio__title">
        Портфолио работ
      </h1>
      @if($works->isEmpty())
        <p class="portfolio__empty">На данный момент работ в портфолио компании нет :(</p>
      @endif
      <ul class="portfolio__list">
        @foreach($works as $work)
          <li>
            @if($work->cost)
              <span class="portfolio__cost">₽ {{$work->cost}}</span>
            @endif
              <a class="portfolio__link" href="{{route('portfolio.show', ['id' => $work->id])}}">
                <img class="portfolio__img" src="{{asset('storage/works/' . $firstPhotos[$work->id]->photo_path)}}" height="340">
              </a>
              <h3 class="portfolio__name">{{$work->title}}</h3>
          </li>
        @endforeach
      </ul>
    </div>
  </section>
</main>
@if(!$works->isEmpty())
  @include('fragments.footer')
@endif
</body>