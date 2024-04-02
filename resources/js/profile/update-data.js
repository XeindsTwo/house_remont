import {openModal, closeModal, handleModalClose} from "../components/modal-functions.js";

const editBtn = document.querySelector('.profile__edit-data');
const modal = document.getElementById('edit-modal');
const modalForm = document.getElementById('formUpdateProfile');
const closeModalBtn = document.getElementById('close-edit');
const cancelModalBtn = document.getElementById('close-edit-btn');
const nameSpan = document.getElementById('profile-name');
const emailSpan = document.getElementById('profile-email');

editBtn.addEventListener('click', () => {
  openModal(modal);
});

closeModalBtn.addEventListener('click', () => {
  closeModal(modal);
});

cancelModalBtn.addEventListener('click', () => {
  closeModal(modal);
});

handleModalClose(modal);

modalForm.addEventListener('submit', function (event) {
  event.preventDefault();

  const formData = new FormData(this);

  fetch('/profile/update-profile', {
    method: 'POST',
    body: formData,
    headers: {
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
    },
  })
    .then(response => {
      if (response.ok) {
        closeModal(modal);
        return response.json();
      } else if (response.status === 422) {
        const emailErrorSpan = document.getElementById('email-error');
        emailErrorSpan.classList.add('error--active');
        setTimeout(() => {
          emailErrorSpan.classList.remove('error--active');
        }, 3500);
        throw new Error('Почта уже используется другим пользователем');
      } else {
        throw new Error('Ошибка при отправке данных формы');
      }
    })
    .then(data => {
      nameSpan.textContent = data.user.name;
      emailSpan.textContent = data.user.email;
      Toastify({
        text: data.message,
        duration: 4000,
        gravity: 'bottom',
        position: 'left'
      }).showToast();
    })
    .catch(error => {
      console.error('Ошибка при отправке данных формы:', error);
    });
});