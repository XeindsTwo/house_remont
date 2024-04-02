<section class="feedback indent">
  <div class="container">
    <h2 class="feedback__title title">Остались вопросы?</h2>
    <p class="feedback__text">
      Оставьте нам свои данные, и мы обязательно свяжемся с вами в течение суток
    </p>
    <form class="feedback__form" id="feedback-form" enctype="multipart/form-data" action="{{route('feedback-request.store')}}">
      @csrf
      <ul class="feedback__list">
        <li>
          <label class="label" for="name_feedback">Имя:</label>
          <input class="input" id="name_feedback" name="name_feedback"
                 maxlength="70" type="text" placeholder="Введите имя"
                 pattern="[А-Яа-яЁё\s\-]+" required
                 title="Имя может содержать только кириллицу, пробелы и дефисы"
          >
        </li>
        <li>
          <label class="label" for="phone_feedback">Номер телефона:</label>
          <input class="input" id="phone_feedback" name="phone_feedback" type="text"
                 placeholder="+7 (___) ___-__-__" required data-tel-input
          >
        </li>
        <li>
          <label class="label" for="comment_feedback">Комментарий (необязательно):</label>
          <textarea class="input input--textarea" placeholder="Введите текст" id="comment_feedback"
                    name="comment_feedback" maxlength="2000"></textarea>
        </li>
        <li>
          <label class="label" for="file">Необходимые документы (необязательно):</label>
          <span class="error" id="max-size-error">
            Файл не может весить более 14мб
          </span>
          <input class="input" id="file" name="file" type="file">
        </li>
      </ul>
      <button class="feedback__btn btn" type="submit">Отправить заявку</button>
      <p class="feedback__privacy">
        Отправляя данные через эту форму, Вы автоматически соглашаетесь на
        <a href="">политику конфиденциальности</a>
      </p>
    </form>
  </div>
  <img class="feedback__img" src="{{asset('static/images/feedback.jpg')}}" alt="">
</section>

<div class="modal modal--bottom" id="complete-modal">
  <button class="modal__close" type="button" id="close-complete">
    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M18 6L6 18M6 6L18 18" stroke="#545860" stroke-width="2" stroke-linecap="round"
            stroke-linejoin="round"/>
    </svg>
  </button>
  <h2 class="modal__title">
    Поздравляем! Заявка была успешно отправлена
  </h2>
  <ul class="modal__list modal__list--bottom">
    <p class="modal__text">
      В ближайшее время с вами свяжется наш менеджер по указанному номеру телефона
    </p>
  </ul>
  <button class="modal__complete btn" type="button" id="close-complete-btn">Закрыть окно</button>
</div>