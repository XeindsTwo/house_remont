@include('fragments.head', ['title' => 'Редактирование статьи'])
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
<body class="body">
@include('fragments.header_admin')
<main>
  <section class="articles indent--big indent--breadcrumbs">
    <div class="container">
      <ul class="breadcrumbs">
        <li class="breadcrumbs__item">
          <a class="breadcrumbs__link breadcrumbs__link--nav" href="{{ route('index') }}">
            <span>
              Главная
            </span>
          </a>
        </li>
        <li class="breadcrumbs__item">
          <a class="breadcrumbs__link breadcrumbs__link--nav" href="{{ route('admin.articles.index') }}">Статьи</a>
        </li>
        <li class="breadcrumbs__item">
          <span class="breadcrumbs__link active">Редактирование статьи</span>
        </li>
      </ul>
      <h1 class="articles__title title">Редактирование статьи</h1>
      <form action="{{ route('admin.articles.update', $article->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="articles__step">
          <label for="title">Заголовок</label>
          <input class="articles__input" placeholder="Введите название статьи" required type="text" name="title"
                 id="title" value="{{ $article->title }}">
        </div>
        <div class="articles__step">
          <label for="image" class="custom-file-label">Выберите изображение</label>
          <input class="custom-file-input" type="file" name="image" id="image">
          <div class="articles__inner">
            <img class="articles__img" id="image-preview_edit" src="{{ asset('storage/' . $article->image) }}" alt="">
          </div>
        </div>
        <div class="articles__step">
          <label for="content">Контент для статьи</label>
          <textarea name="content" id="content">{{ $article->content }}</textarea>
        </div>
        <div>
          <button class="articles__create btn" type="submit">Сохранить изменения</button>
        </div>
      </form>
    </div>
  </section>
</main>
</body>
<script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script src="https://cdn.tiny.cloud/1/opgc1pqgi2d2ivwi25r6sdp5r69xhy4m6k261nngjzodzvdv/tinymce/7/tinymce.min.js"
        referrerpolicy="origin"></script>
<script>
  // Заполнение формы данными при загрузке страницы
  window.addEventListener('DOMContentLoaded', function () {
    const imageInput = document.getElementById('image');
    const imagePreview = document.getElementById('image-preview_edit');

    // Получаем URL изображения из атрибута src
    const imageUrl = imagePreview.getAttribute('src');

    // Если URL изображения существует и не является пустым значением или решеткой
    if (imageUrl && imageUrl !== '#' && imageUrl !== '') {
      // Создаем объект File из URL изображения
      fetch(imageUrl)
        .then(response => response.blob())
        .then(blob => {
          const file = new File([blob], 'image.jpg', { type: 'image/jpeg' });

          // Создаем объект DataTransfer, чтобы сформировать массив файлов
          const fileList = new DataTransfer();
          fileList.items.add(file);

          // Устанавливаем массив файлов в поле ввода изображения
          imageInput.files = fileList.files;
        });
    }
  });

  document.getElementById('image').addEventListener('change', function (event) {
    const input = event.target;
    const file = input.files[0];
    const img = document.getElementById('image-preview_edit');

    // Проверяем тип файла
    const allowedTypes = ['image/png', 'image/jpeg', 'image/jpg', 'image/webp'];
    if (!allowedTypes.includes(file.type)) {
      Toastify({
        text: 'Допустимы изображения только в формате PNG, JPEG или WEBP.',
        duration: 5000,
        gravity: 'bottom',
        position: 'left',
      }).showToast();
      input.value = ''; // Очищаем поле ввода файла
      img.style.opacity = 0; // Устанавливаем непрозрачность изображения
      return;
    }

    // Проверяем размер файла
    const maxSizeInBytes = 2 * 1024 * 1024; // 2MB
    if (file.size > maxSizeInBytes) {
      Toastify({
        text: 'Максимально допустимый размер: 2MB.',
        duration: 5000,
        gravity: 'bottom',
        position: 'left',
      }).showToast();
      input.value = ''; // Очищаем поле ввода файла
      img.style.opacity = 0; // Устанавливаем непрозрачность изображения
      return;
    }

    const reader = new FileReader();
    reader.onload = function () {
      img.src = reader.result;
      img.style.opacity = 1; // Восстанавливаем непрозрачность изображения
    };
    reader.readAsDataURL(file);
  });

  // Дополнительно устанавливаем непрозрачность изображения, если изображение не загружено при загрузке страницы
  window.addEventListener('DOMContentLoaded', function () {
    const img = document.getElementById('image-preview_edit');
    if (!img.src || img.src === '#') {
      img.style.opacity = 0;
    }
  });

  document.querySelector('form').addEventListener('submit', function (event) {
    const content = tinymce.get('content').getContent();
    const imageInput = document.getElementById('image');
    const imagePreview = document.getElementById('image-preview_edit');

    // Проверяем, было ли загружено изображение
    if (imageInput.files.length === 0 || !imagePreview.getAttribute('src')) {
      Toastify({
        text: 'Пожалуйста, загрузите изображение',
        duration: 5000,
        gravity: 'bottom',
        position: 'left',
      }).showToast();
      event.preventDefault(); // Останавливаем отправку формы
      return;
    }

    // Проверяем, заполнено ли поле контента
    if (!content.trim()) {
      Toastify({
        text: 'Пожалуйста, заполните контент для статьи',
        duration: 5000,
        gravity: 'bottom',
        position: 'left',
      }).showToast();
      event.preventDefault(); // Останавливаем отправку формы
    }
  });
</script>
<script>
  tinymce.init({
    selector: 'textarea#content',
    plugins: 'link image code',
    toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | link image | code',
    height: '700px',
    language: 'ru'
  });
</script>