@include('fragments/head', ['title' => 'Контакты компании'])
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
          <span class="breadcrumbs__link active">Контакты</span>
        </li>
      </ul>
      <h1 class="contacts__title">Контакты</h1>
      <div class="contacts__text">
        <p>
          <b>Поддержка:</b>
          с 10-00 до 22-00 - ежедневно, по телефону, соц. сетях, мессенджерах и по email
        </p>
        <p>
          Телефон в Белореченске: 8 (777) 777-7777, +7 (342) 212-2121
        </p>
        <p>
          Бесплатная линия для абонентов России: 8 (278) 777-3717
        </p>
        <p>
          Вопросы по заказам: <a href="mailto:main@prosto.ru">main@prosto.ru</a>
        </p>
        <p>
          Для корпоративных клиентов: <a href="mailto:business@prosto.ru">business@prosto.ru</a>
        </p>
        <br>
        <p>
          <b>Реквизиты:</b>
        </p>
        <p>
          Индивидуальный предприниматель «ПРОСТОРЕМОНТ»
        </p>
        <p>
          Местонахождение: г. Белореченск, ул. Ленина, дом 84, помещение 3
        </p>
        <p>
          Почтовый адрес (главный офис): 197110 Россия, Белореченск, ул. Ленина, дом 76
        </p>
        <p>
          ИНН 7839424535, КПП 785401221, ОГРН 1267877098673, ОКПО 34852094
        </p>
        <p>
          Расчётный счёт 42702 310 2100 0020 2517 в АО "Тинькофф Банк", БИК 044525974, Корр счёт 30101 810 1452 5000 0974
        </p>
      </div>
    </div>
  </section>
</main>
@include('fragments/footer')
</body>