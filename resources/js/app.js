import {openModal, closeModal, handleModalClose} from './components/modal-functions.js';
import Swiper from "https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.esm.browser.min.js";

new Swiper('.reviews__swiper', {
  slidesPerView: 'auto',
  speed: 1200,
  spaceBetween: 70,
  centeredSlides: true,
  initialSlide: 2,
  keyboard: {
    enabled: true,
  },
  navigation: {
    prevEl: ".reviews__btn--prev",
    nextEl: ".reviews__btn--next"
  },
});

const fileInput = document.getElementById('file');
const maxSize = 2 * 1024 * 14000; // 2 MB
const maxSizeError = document.getElementById('max-size-error');

fileInput.addEventListener('change', () => {
  const file = fileInput.files[0];
  if (file.size > maxSize) {
    maxSizeError.classList.add('error--active');
    setTimeout(() => {
      maxSizeError.classList.remove('error--active');
    }, 2000);
    fileInput.value = '';
  }
});

const form = document.getElementById('feedback-form');
form.addEventListener('submit', async (event) => {
  event.preventDefault();

  if (maxSizeError.classList.contains('error--active')) {
    return;
  }

  const formData = new FormData(form);

  try {
    const response = await fetch('/feedback-request', {
      method: 'POST',
      body: formData
    });

    if (response.ok) {
      const data = await response.json();
      console.log(data);
      openModal(document.getElementById('complete-modal'));
      handleModalClose(document.getElementById('complete-modal'));
      form.reset();

      const closeCompleteButton = document.getElementById('close-complete');
      const closeCompleteButton2 = document.getElementById('close-complete-btn');
      closeCompleteButton.addEventListener('click', () => {
        closeModal(document.getElementById('complete-modal'));
      });
      closeCompleteButton2.addEventListener('click', () => {
        closeModal(document.getElementById('complete-modal'));
      });
    } else if (response.status === 429) {
      throw new Error('Вы отправили много заявок за последнее время. Попробуйте позже.');
    } else {
      throw new Error('Ошибка при отправке запроса. Пожалуйста, попробуйте позже');
    }
  } catch (error) {
    console.error(error);
    alert(error.message);
  }
});