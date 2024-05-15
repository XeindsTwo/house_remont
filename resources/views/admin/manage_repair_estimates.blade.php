@include('fragments/head', ['title' => 'Управление одобренными отзывами'])
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css">
<body class="body">
@include('fragments.header_admin')
<main>
  <section class="admin__bottom">
    <div class="container">
      <h1 class="admin__title">Управление заявлениями расчета стоимости</h1>
      @if($estimates->isEmpty())
        <p class="admin-estimates__empty">Заявлений на данный момент ещё не существует :(</p>
      @else
        <div class="admin-estimates__sort">
          Сортировать по объекту:
          <select class="select" id="object-filter">
            <option value="">Все объекты</option>
            @foreach($uniqueObjects as $object)
              <option value="{{$object}}">{{$object}}</option>
            @endforeach
          </select>
        </div>
        <ul class="admin-estimates__list">
          @foreach($estimates as $estimate)
            <li class="admin-estimates__item" data-estimate="{{$estimate->id}}">
              <button class="admin-estimates__control red" data-estimate="{{$estimate->id}}">Удалить заявку</button>
              <p class="admin-estimates__date">Дата создания:
                {{\Carbon\Carbon::parse($estimate->created_at)->locale('ru')->isoFormat('D MMMM YYYY')}}
              </p>
              <div class="admin-estimates__main">
                <p>Объект - {{$estimate->object}}</p>
                <p>Материал - {{$estimate->material}}</p>
                <p>Площадь - {{$estimate->area}}</p>
                <p>Ремонт потребуется: {{$estimate->timing}}</p>
                <p>
                  Телефон:<a class="admin-estimates__link" href="tel:{{$estimate->phone}}">{{$estimate->phone}}</a>
                </p>
              </div>
            </li>
          @endforeach
        </ul>
      @endif
    </div>
  </section>
</main>
</body>
<script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script>
  document.getElementById('object-filter').addEventListener('change', function(event) {
    const selectedObject = event.target.value;

    // Отображаем или скрываем заявки в зависимости от выбранного объекта
    document.querySelectorAll('.admin-estimates__item').forEach(function(item) {
      const itemObject = item.querySelector('.admin-estimates__main p:first-child').textContent.split('-')[1].trim();
      if (selectedObject === '' || selectedObject === itemObject) {
        item.style.display = 'flex';
      } else {
        item.style.display = 'none';
      }
    });
  });
  // Обработчик кнопок удаления
  document.querySelectorAll('.admin-estimates__control').forEach(function(button) {
    button.addEventListener('click', function(event) {
      const id = event.currentTarget.getAttribute('data-estimate');
      const confirmDelete = confirm('Вы уверены, что хотите удалить эту заявку?');

      if (confirmDelete) {
        fetch(`/admin/estimates/${id}`, {
          method: 'DELETE',
          headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
          }
        })
          .then(response => response.json())
          .then(data => {
            // Выводим сообщение Toastify в зависимости от успешности удаления
            if (data.message) {
              Toastify({
                text: data.message,
                duration: 4500,
                position: 'left',
                gravity: 'bottom',
                backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
                stopOnFocus: true
              }).showToast();
              const cardToRemove = document.querySelector(`.admin-estimates__item[data-estimate="${id}"]`);
              cardToRemove.remove();
            } else if (data.error) {
              Toastify({
                text: data.error,
                duration: 4500,
                position: 'left',
                gravity: 'bottom',
                backgroundColor: "linear-gradient(to right, #ff0000, #ff6c6c)",
                stopOnFocus: true
              }).showToast();
            }
          })
          .catch(error => {
            console.error('Error:', error);
            Toastify({
              text: 'Ошибка удаления заявки',
              duration: 4500,
              position: 'left',
              gravity: 'bottom',
              backgroundColor: "linear-gradient(to right, #ff0000, #ff6c6c)",
              stopOnFocus: true
            }).showToast();
          });
      }
    });
  });
</script>