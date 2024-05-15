<div class="cost-modal">
  <div class="cost-modal__top">
    <h3 class="cost-modal__main">
      <svg viewBox="0 0 24 24" class="cost-modal__icon"><title>mdi-file-document-box-check-outline</title>
        <path
            d="M17,21L14.25,18L15.41,16.84L17,18.43L20.59,14.84L21.75,16.25M12.8,21H5C3.89,21 3,20.11 3,19V5C3,3.89 3.89,3 5,3H19C20.11,3 21,3.89 21,5V12.8C20.39,12.45 19.72,12.2 19,12.08V5H5V19H12.08C12.2,19.72 12.45,20.39 12.8,21M12,17H7V15H12M14.68,13H7V11H17V12.08C16.15,12.22 15.37,12.54 14.68,13M17,9H7V7H17"
            stroke-width="0" fill-rule="nonzero"></path>
      </svg>
      Рассчитайте стоимость ремонта с точностью 80%, ответив на 4 вопроса
    </h3>
    <button class="cost-modal__close modal__close" type="button">
      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M18 6L6 18M6 6L18 18" stroke="#545860" stroke-width="2" stroke-linecap="round"
              stroke-linejoin="round"/>
      </svg>
    </button>
  </div>
  <div class="cost-modal__content" data-step="1">
    <h3 class="cost-modal__title">Что ремонтируем?</h3>
    <div class="cost-modal__list">
      <button class="cost-modal__step-btn" type="button" data-info="Квартира в новостройке">
        <img src="{{asset('static/images/icons/zdanie.png')}}" width="48" height="48" alt="иконка">
        Квартира в новостройке
      </button>
      <button class="cost-modal__step-btn" type="button" data-info="Вторичка">
        <img src="{{asset('static/images/icons/vtor.png')}}" width="48" height="48" alt="иконка">
        Вторичка
      </button>
      <button class="cost-modal__step-btn" type="button" data-info="Дом">
        <img src="{{asset('static/images/icons/dom.png')}}" width="48" height="48" alt="иконка">
        Дом
      </button>
    </div>
  </div>
  <div class="cost-modal__content" data-step="2" style="display: none;">
    <h3 class="cost-modal__title">Какие материалы используем?</h3>
    <div class="cost-modal__list">
      <button class="cost-modal__step-btn" type="button" data-info-material="Демократичные: обои и ламинат">
        <img src="{{asset('static/images/icons/palec.png')}}" width="48" height="48" alt="иконка">
        Демократичные: обои и ламинат
      </button>
      <button class="cost-modal__step-btn" type="button" data-info-material="Красивые: цена / качество">
        <img src="{{asset('static/images/icons/beau.png')}}" width="48" height="48" alt="иконка">
        Красивые: цена / качество
      </button>
      <button class="cost-modal__step-btn" type="button" data-info-material="Роскошные: дерево и камень">
        <img src="{{asset('static/images/icons/diamond.png')}}" width="48" height="48" alt="иконка">
        Роскошные: дерево и камень
      </button>
    </div>
  </div>
  <div class="cost-modal__content" data-step="3" style="display: none;">
    <h3 class="cost-modal__title">Какая площадь?</h3>
    <div class="cost-modal__list">
      <button class="cost-modal__step-btn" type="button" data-info-material="До 30 м2">
        До 30 м2
      </button>
      <button class="cost-modal__step-btn" type="button" data-info-material="От 30 до 80 м2">
        От 30 до 80 м2
      </button>
      <button class="cost-modal__step-btn" type="button" data-info-material="Больше 80 м2">
        Больше 80 м2
      </button>
    </div>
  </div>
  <div class="cost-modal__content" data-step="4" style="display: none;">
    <h3 class="cost-modal__title">Когда начинается ремонт?</h3>
    <div class="cost-modal__list">
      <button class="cost-modal__step-btn" type="button" data-info-material="Месяц">
        В ближайший месяц
      </button>
      <button class="cost-modal__step-btn" type="button" data-info-material="Через месяц">
        Через месяц
      </button>
      <button class="cost-modal__step-btn" type="button" data-info-material="Через несколько месяцев">
        Попозже, месяцев через 6
      </button>
    </div>
  </div>
  <div class="cost-modal__content middle" data-step="5" style="display: none;">
    <h3 class="cost-modal__title center">Отлично, остался последний шаг</h3>
    <form class="cost-modal__form" method="post" action="">
      <p>Оставьте ваш 📲 номер телефона, и мы сообщим вам стоимость и сроки ремонта</p>
      <label for="phone_cost">
        <input class="cost-modal__field" id="phone_cost" name="phone_cost" data-tel-input required
               placeholder="Введите телефон" type="text">
      </label>
      <button class="cost-modal__submit btn" type="submit">Получить результаты</button>
    </form>
  </div>
  <div class="cost-modal__content middle" data-step="6" style="display: none;">
    <h3 class="cost-modal__title center">Спасибо за заявку!</h3>
    <p class="cost-modal__complete">
      В ближайшее время с вами свяжется наш менеджер для дальнейшего обсуждения проекта
    </p>
  </div>
  <div class="cost-modal__bottom">
    <p>Готово 0%</p>
    <div class="cost-modal__progress"></div>
  </div>
</div>