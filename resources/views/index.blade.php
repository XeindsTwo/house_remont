@include('fragments/head', ['title' => 'Уютный дом'])
<body class="body">
@include('fragments.header')
@include('fragments.cost_calculation')
<main>
  @include('home/start')
  @include('home/works')
  @include('home/steps')
  @include('home/care')
  @include('home/reviews')
  @include('home/faq')
  @include('home/feedback')
</main>
@include('fragments/footer')
@vite(['resources/js/app.js'])
@vite(['resources/js/cost.js'])
@vite(['resources/js/components/accordion.js'])
@vite(['resources/js/components/phone-mask.js'])
</body>