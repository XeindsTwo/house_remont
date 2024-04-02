@include('fragments/head', ['title' => 'Управление онлайн-заявками'])
<body class="body">
@include('fragments.header_admin')
<main>
  <section class="admin-feedback">
    <div class="container">
      <h1 class="admin__title">Управление онлайн-заявками</h1>
      @if($feedbackRequests->isEmpty())
        <p class="admin-feedback__empty">Онлайн-заявок на данный момент нет :(</p>
      @endif
      <ul class="admin-feedback__list">
        @foreach($feedbackRequests as $feedback)
          <li class="admin-feedback__item">
            <button class="admin-feedback__delete" type="button" data-id="{{$feedback->id}}">
              Удалить заявку
            </button>
            <p>Время создания: {{ \Carbon\Carbon::parse($feedback->created_at)->locale('ru')->isoFormat('D MMMM YYYY') }}</p>
            <p>Имя: {{ $feedback->name_feedback }}</p>
            <p>Телефон:
              <a class="admin-feedback__link" href="tel:{{ $feedback->phone_feedback }}">{{ $feedback->phone_feedback }}</a>
            </p>
            @if($feedback->comment_feedback)
              <p>Комментарий: {{ $feedback->comment_feedback }}</p>
            @endif
            @if($feedback->file_path)
              <p>
                Файл:
                <a class="admin-feedback__link"
                   href="{{ asset('storage/' . $feedback->file_path) }}"
                   target="_blank"
                >
                  скачать документ
                </a>
              </p>
            @endif
          </li>
        @endforeach
      </ul>
    </div>
  </section>
</main>
</body>
<script>
  document.addEventListener('DOMContentLoaded', () => {
    const deleteButtons = document.querySelectorAll('.admin-feedback__delete');

    deleteButtons.forEach(button => {
      button.addEventListener('click', async () => {
        const id = button.dataset.id;
        const confirmed = confirm('Вы уверены, что хотите удалить эту заявку? Удаление отменить будет невозможно');

        if (!confirmed) {
          return;
        }

        try {
          const response = await fetch(`/admin/feedback-requests/${id}`, {
            method: 'DELETE',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': '{{ csrf_token() }}',
            }
          });

          if (response.ok) {
            const data = await response.json();
            console.log(data.message);
            button.closest('.admin-feedback__item').remove();
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