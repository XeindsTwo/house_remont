@include('fragments/head', ['title' => 'Создание работы'])
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
<body class="body">
@include('fragments.header_admin')
<main>
  <section class="admin__bottom">
    <div class="container">
      <h1 class="admin__title">Создание новой работы</h1>
      <form action="{{route('admin.works.create')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <ul class="admin-works__list">
          <li class="admin-works__list-item">
            <label class="label" for="title">Название:</label>
            <input class="admin-works__input input" type="text"
                   name="title" id="title" required
                   minlength="7"
                   maxlength="255"
                   placeholder="Введите название"
            >
          </li>
          <li class="admin-works__list-item">
            <label class="label" for="year">Год:</label>
            <input class="admin-works__input input" type="number"
                   name="year" id="year" required
                   min="2014"
                   max="2025"
                   placeholder="Введите год"
            >
          </li>
          <li class="admin-works__list-item">
            <label class="label" for="cost">Стоимость ремонта в ₽ (необязательно):</label>
            <input class="admin-works__input input" type="text"
                   name="cost" id="cost" data-mask="price"
                   placeholder="Введите стоимость"
            >
          </li>
          <li class="admin-works__list-item long">
            <label for="description">Главное описание (необязательно):</label>
            <textarea class="admin-works__input textarea input" name="description" id="description" maxlength="2000"
                      placeholder="Введите описание"></textarea>
          </li>
          <li class="admin-works__list-item long">
            <label class="custom-file-upload" for="photo">
              <svg width="17" height="18" viewBox="0 0 17 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M16.0556 11.3304C16.5772 11.3304 17 11.757 17 12.2832V16.0944C17 17.1469 16.1543 18 15.1111 18H1.88889C0.845684 18 0 17.1469 0 16.0944V12.2832C0 11.757 0.422847 11.3304 0.944444 11.3304C1.46604 11.3304 1.88889 11.757 1.88889 12.2832V16.0944H15.1111V12.2832C15.1111 11.757 15.5339 11.3304 16.0556 11.3304ZM9.33479 0.348831L13.1747 4.22279C13.5436 4.59487 13.5436 5.19816 13.1747 5.57024C12.8059 5.94233 12.208 5.94233 11.8391 5.57024L9.44444 3.15439V12.2832C9.44444 12.8094 9.02162 13.236 8.5 13.236C7.97838 13.236 7.55556 12.8094 7.55556 12.2832V3.15439L5.16089 5.57024C4.79205 5.94233 4.19407 5.94233 3.82524 5.57024C3.45641 5.19816 3.45641 4.59487 3.82524 4.22279L7.66521 0.348831C8.12628 -0.116277 8.87372 -0.116277 9.33479 0.348831Z"
                    fill="#2A2A2A"/>
              </svg>
              Загрузить фотографии
              <input type="file" name="photo[]" id="photo" accept="image/png, image/jpeg, image/webp" multiple>
            </label>
            <ul id="file-list"></ul>
          </li>
        </ul>
        <button class="admin-works__submit btn btn-primary" type="submit">Создать работу</button>
      </form>
    </div>
  </section>
</main>
</body>
<script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
@vite(['resources/js/components/price-mask.js'])
@vite(['resources/js/work/create.js'])