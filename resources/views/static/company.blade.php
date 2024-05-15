@include('fragments/head', ['title' => 'О компании'])
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css">
<body class="body">
@include('fragments.header')
<main>
  <section class="company indent--big indent--breadcrumbs">
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
          <span class="breadcrumbs__link active">О компании</span>
        </li>
      </ul>
      <h1 class="company__title">
        <span>Уютный дом</span> – дизайн-студия и <br> ремонтно-отделочная компания <br> в Белореченске
      </h1>
      <div class="company__text">
        <p>
          Компания «Уютный дом» основана в 2013 году. Мы строим ремонтируем и создаем
          грандиозные проекты с продуманными планировками.
        </p>
        <p>
          Огромный опыт наших специалистов, постоянное обучение, отточенные технологии строительства и собственные
          наработки позволяют нам создавать проекты для всех людей.
        </p>
        <p>
          Мы работаем только по договору с четко прописанными пунктами и ценой, которая не изменится в ходе
          процесса. На всех этапах ремонта ведётся строгий контроль специалистов отдела контроля качества и
          собственной службы технадзора. Всем выполненным заказам предоставляется гарантийное обслуживание в течение 5
          лет
        </p>
      </div>
      <img class="company__photo" src="{{asset('static/images/company.jpg')}}" height="470" alt="">
    </div>
  </section>
  @include('static.company.specialists')
  @include('static.company.info')
  @include('static.company.education')
  @include('static.company.letters')
</main>
@include('fragments/footer')
@vite(['resources/js/company.js'])
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
<script>
  Fancybox.bind("[data-fancybox]", {});
</script>
</body>