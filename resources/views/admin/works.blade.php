@include('fragments/head', ['title' => 'Управление работами портфолио'])
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
<body class="body">
@include('fragments.header_admin')
<main>
  <section class="admin__bottom">
    <div class="container">
      <h1 class="admin__title">Управление работами портфолио</h1>
      <a class="admin-works__create btn" href="{{route('admin.works.create')}}">Создать новую работу</a>
      @if($works->isEmpty())
        <p class="admin-works__empty">На данный момент работ в портфолио компании нет :(</p>
      @endif
      <ul class="admin-works__list">
        @foreach($works as $work)
          <li class="admin-works__item">
            <a class="admin-works__content" href="{{route('portfolio.show', ['id' => $work->id])}}">
              @if($work->cost)
                <span class="admin-works__cost">₽ {{$work->cost}}</span>
              @endif
              <img class="admin-works__img" src="{{asset('storage/works/' . $firstPhotos[$work->id]->photo_path)}}"
                   height="340">
            </a>
            <h3 class="admin-works__name">{{$work->title}}</h3>
            <div class="admin-works__actions">
              <button class="admin-works__action delete"
                      type="button" data-id="{{$work->id}}"
              >
                Удалить
              </button>
              <a class="admin-works__action edit" href="{{route('admin.works.edit', ['id' => $work->id])}}">
                Редактировать
              </a>
            </div>
          </li>
        @endforeach
      </ul>
    </div>
  </section>
</main>
</body>
<script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script>
  document.addEventListener('DOMContentLoaded', () => {
    const deleteButtons = document.querySelectorAll('.delete');

    deleteButtons.forEach(button => {
      button.addEventListener('click', async () => {
        const id = button.dataset.id;
        const confirmed = confirm('Вы уверены, что хотите удалить эту работу? Удаление отменить будет невозможно');

        if (!confirmed) {
          return;
        }

        try {
          const response = await fetch(`/admin/works/${id}`, {
            method: 'DELETE',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': '{{ csrf_token() }}',
            }
          });

          if (response.ok) {
            const data = await response.json();
            console.log(data.message);
            button.closest('.admin-works__item').remove();
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
        }
      });
    });
  });
</script>