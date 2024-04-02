@include('fragments/head', ['title' => 'Просто Ремонт'])
<body class="body">
@include('fragments.header')
<main>
  @include('home/start')
  @include('home/works')
  @include('home/steps')
  @include('home/care')
  @include('home/services')
  @include('home/reviews')
  @include('home/faq')
  @include('home/feedback')
</main>
@include('fragments/footer')
@vite(['resources/js/app.js'])
@vite(['resources/js/components/accordion.js'])
@vite(['resources/js/components/phone-mask.js'])
</body>