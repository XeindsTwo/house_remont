@include('fragments.head', ['title' => 'Уютный дом | Наш блог'])
<body class="body">
@include('fragments.header')
<main>
  <section class="blog indent indent--breadcrumbs">
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
          <span class="breadcrumbs__link active">Блог новостей</span>
        </li>
      </ul>
      <h1 class="blog__title">
        Блог о дизайне и ремонте интерьеров
      </h1>
      <p class="blog__text">
        Здесь вы найдете идеи для оформления вашего пространства, информацию о дизайне,
        материалах и полезные советы по выбору мебели.
      </p>
      @if($articles->isEmpty())
        <p class="blog__empty">На данный момент новостей не существует :(</p>
      @endif
      <ul class="blog__list">
        @foreach($articles as $article)
          <li class="blog__item" data-articles="{{$article->id}}">
            <img class="blog__img" src="{{ asset('/storage/' . $article->image) }}" height="320" alt="">
            <a class="blog__name" href="{{ route('blog.article', $article->id) }}">{{ $article->title }}</a>
            <p class="blog__date">Дата создания:
              {{ \Carbon\Carbon::parse($article->created_at)->locale('ru')->isoFormat('D MMMM YYYY') }}
            </p>
          </li>
        @endforeach
      </ul>
    </div>
  </section>
</main>
</body>