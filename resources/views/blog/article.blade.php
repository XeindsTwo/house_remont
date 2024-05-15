@include('fragments.head', ['title' => $article->title])
<body class="body">
@include('fragments.header')
<main>
  <section class="article indent indent--breadcrumbs">
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
          <a class="breadcrumbs__link breadcrumbs__link--nav" href="{{route('blog')}}">Статьи</a>
        </li>
        <li class="breadcrumbs__item">
          <span class="breadcrumbs__link active">{{$article->title}}</span>
        </li>
      </ul>
      <div class="article__content">
        <img class="article__img" src="{{ asset('/storage/' . $article->image) }}" height="440" alt="">
        <h1 class="article__title">{{$article->title}}</h1>
        <div class="article__content">
          {!! htmlspecialchars_decode($article->content) !!}
        </div>
      </div>
    </div>
  </section>
</main>
@include('fragments/footer')
</body>