@include('fragments/head', ['title' => 'Управление не одобренными отзывами'])
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css">
<body class="body">
@include('fragments.header_admin')
<main>
  <section class="admin__bottom">
    <div class="container">
      <h1 class="admin__title">Управление не одобренными отзывами</h1>
      <a class="admin-reviews__control green" href="{{route('admin.reviews.approved')}}">
        Управлять одобренными отзывами
      </a>
      @if($unapprovedReviews->isEmpty())
        <p class="admin-reviews__empty">Не одобренных отзывов на данный момент нет :(</p>
      @endif
      <ul class="admin-reviews__list">
        @foreach($unapprovedReviews as $unapprovedReview)
          <li class="admin-reviews__item">
            <div class="admin-reviews__left">
              <div class="admin-reviews__top">
                @if ($unapprovedReview->user->avatar)
                  <img class="" src="{{ asset('storage/avatars/' . $unapprovedReview->user->avatar) }}"
                       width="60" height="60" alt="аватар пользователя"
                  >
                @else
                  <img class="" src="{{ asset('static/images/avatar.svg') }}"
                       width="60" height="60" alt="стандартный аватар"
                  >
                @endif
                <p>{{$unapprovedReview->name}}</p>
              </div>
              <p class="admin-reviews__date">Дата создания:
                {{\Carbon\Carbon::parse($unapprovedReview->created_at)->locale('ru')->isoFormat('D MMMM YYYY')}}
              </p>
              <p class="admin-reviews__phone">Телефон:
                <a class="admin-reviews__link" href="tel:{{$unapprovedReview->phone}}">{{$unapprovedReview->phone}}</a>
              </p>
              <p class="admin-reviews__content">{{$unapprovedReview->content}}</p>
              <div class="admin-reviews__actions">
                <button class="admin-reviews__action admin-reviews__delete"
                        type="button" data-id="{{$unapprovedReview->id}}"
                >
                  Отклонить отзыв
                </button>
                <button class="admin-reviews__action admin-reviews__complete"
                        type="button" data-id="{{$unapprovedReview->id}}"
                >
                  Одобрить отзыв
                </button>
              </div>
            </div>
            <a class="admin-reviews__photo" href="{{asset('storage/' . $unapprovedReview->photo)}}"
               data-fancybox="gallery">
              <img src="{{asset('storage/' . $unapprovedReview->photo)}}"
                   alt="фотография отзыва" width="320" height="420"
              >
            </a>
          </li>
        @endforeach
      </ul>
    </div>
  </section>
</main>
</body>
<script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
<script>
  Fancybox.bind("[data-fancybox]", {});
</script>
<script>
  document.addEventListener('DOMContentLoaded', () => {
    const deleteButtons = document.querySelectorAll('.admin-reviews__delete');

    deleteButtons.forEach(button => {
      button.addEventListener('click', async () => {
        const id = button.dataset.id;
        const confirmed = confirm('Вы уверены, что хотите отклонить отзыв? Отклонением является удаление отзыва из БД. Отменить действие будет невозможно');

        if (!confirmed) {
          return;
        }

        try {
          const response = await fetch(`/admin/reviews/approved/${id}`, {
            method: 'DELETE',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': '{{ csrf_token() }}',
            }
          });

          if (response.ok) {
            const data = await response.json();
            console.log(data.message);
            button.closest('.admin-reviews__item').remove();
            Toastify({
              text: data.message,
              duration: 4500,
              position: 'left',
              gravity: 'bottom',
              backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
              stopOnFocus: true
            }).showToast();
          } else {
            throw new Error('Ошибка при удалении заявки');
          }
        } catch (error) {
          console.error(error.message);
          alert(error.message);
        }
      });
    });
  });
</script>
<script>
  document.addEventListener('DOMContentLoaded', () => {
    const deleteButtons = document.querySelectorAll('.admin-reviews__complete');

    deleteButtons.forEach(button => {
      button.addEventListener('click', async () => {
        const id = button.dataset.id;
        const confirmed = confirm('Вы уверены, что хотите одобрить отзыв? В дальнейшем отзыв будет виден для обычных пользователей, и имеется возможность только удалить отзыв');

        if (!confirmed) {
          return;
        }

        try {
          const response = await fetch(`/admin/reviews/approved/${id}/approve`, {
            method: 'PUT',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': '{{ csrf_token() }}',
            }
          });

          if (response.ok) {
            const data = await response.json();
            console.log(data.message);
            button.closest('.admin-reviews__item').remove();
            Toastify({
              text: data.message,
              duration: 4500,
              position: 'left',
              gravity: 'bottom',
              backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
              stopOnFocus: true
            }).showToast();
          } else {
            throw new Error('Ошибка при удалении заявки');
          }
        } catch (error) {
          console.error(error.message);
          alert(error.message);
        }
      });
    });
  });
</script>