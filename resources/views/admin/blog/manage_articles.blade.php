@include('fragments/head', ['title' => 'Управление статьями'])
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
<body class="body">
@include('fragments.header_admin')
<main>
  <section class="admin__bottom">
    <div class="container">
      <h1 class="admin__title">Управление статьями сайта</h1>
      <a class="btn" href="{{route('admin.articles.create')}}">Создать статью</a>
      @if($articles->isEmpty())
        <p class="admin-articles__empty">В блоге ещё не были созданы статьи</p>
      @endif
      <ul class="admin-articles__list">
        @foreach($articles as $article)
          <li class="admin-articles__item" data-articles="{{$article->id}}">
            <p class="admin-articles__date">Дата создания:
              {{ \Carbon\Carbon::parse($article->created_at)->locale('ru')->isoFormat('D MMMM YYYY') }}
            </p>
            <a class="admin-articles__name"
               href="{{ route('blog.article', $article->id) }}">{{ $article->title }}</a>
            <div class="admin-articles__actions">
              <a class="admin-articles__action admin-articles__edit"
                 href="{{ route('admin.articles.edit', $article->id) }}">Редактировать статью</a>
              <button class="admin-articles__action admin-articles__delete" data-articles="{{ $article->id }}"
                      type="button">
                Удалить статью
              </button>
            </div>
            <img class="admin-articles__img" src="{{ asset('/storage/' . $article->image) }}" height="320" alt="">
          </li>
        @endforeach
      </ul>
    </div>
  </section>
</main>
</body>
<script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const deleteButtons = document.querySelectorAll('.admin-articles__delete');

    deleteButtons.forEach(button => {
      button.addEventListener('click', function () {
        const articleId = this.getAttribute('data-articles');

        if (confirm('Вы уверены, что хотите удалить эту статью? Отменить действие будет невозможно')) {
          fetch(`/admin/articles/${articleId}`, {
            method: 'DELETE',
            headers: {
              'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
          })
            .then(response => response.json())
            .then(data => {
              if (data.success) {
                Toastify({
                  text: data.message,
                  duration: 3000,
                  gravity: 'bottom',
                  position: 'left',
                  backgroundColor: 'linear-gradient(to right, #00b09b, #96c93d)'
                }).showToast();

                // Удаляем карточку статьи из списка
                const articleItem = document.querySelector(`.admin-articles__item[data-articles='${articleId}']`);
                if (articleItem) {
                  articleItem.remove();
                }
              } else {
                Toastify({
                  text: data.message,
                  duration: 3000,
                  gravity: 'bottom',
                  position: 'left',
                  backgroundColor: 'linear-gradient(to right, #ff6e7f, #bfe9ff)'
                }).showToast();
              }
            })
            .catch(error => {
              console.error('Ошибка удаления статьи:', error);
              Toastify({
                text: 'Произошла ошибка при удалении статьи',
                duration: 3000,
                gravity: 'bottom',
                position: 'left',
                backgroundColor: 'linear-gradient(to right, #ff6e7f, #bfe9ff)'
              }).showToast();
            });
        }
      });
    });
  });
</script>