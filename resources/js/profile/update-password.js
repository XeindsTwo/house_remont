const passwordForm = document.querySelector('.password__form');
const currentPasswordInput = document.getElementById('current_password');
const newPasswordInput = document.getElementById('new_password');
const confirmPasswordInput = document.getElementById('confirm_password');
const currentError = document.getElementById('current_error');
const newErrorOne = document.getElementById('new_error-one');
const newErrorTwo = document.getElementById('new_error-two');

passwordForm.addEventListener('submit', function (event) {
  event.preventDefault();

  if (newPasswordInput.value === currentPasswordInput.value) {
    showError('Новый пароль должен отличаться от текущего');
    setTimeout(() => {
      hideError(newErrorOne);
    }, 3500);
    return;
  }

  if (newPasswordInput.value !== confirmPasswordInput.value) {
    showError('Новый пароль должен совпадать с повторяющимся паролем');
    setTimeout(() => {
      hideError(newErrorTwo);
    }, 3500);
    return;
  }

  const formData = new FormData();
  formData.append('current_password', currentPasswordInput.value);
  formData.append('new_password', newPasswordInput.value);
  formData.append('confirm_password', confirmPasswordInput.value);

  fetch('/profile/update-password', {
    method: 'POST',
    body: formData,
    headers: {
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
    },
  })
    .then(response => {
      if (!response.ok) {
        if (response.status === 401) {
          return response.json().then(data => {
            currentError.textContent = data.error;
            currentError.classList.add('error--active');
            setTimeout(() => {
              currentError.textContent = '';
              currentError.classList.remove('error--active');
            }, 3500);
            throw new Error(data.error || 'Текущий пароль неверный');
          });
        } else {
          showError('Ошибка при обновлении пароля');
          setTimeout(() => {
            hideError();
          }, 3500);
        }
        throw new Error('Ошибка при обновлении пароля');
      }
      return response.json();
    })
    .then(data => {
      passwordForm.reset();
      Toastify({
        text: data.message,
        duration: 4000,
        gravity: 'bottom',
        position: 'left'
      }).showToast();
    })
    .catch(error => {
      console.error(error);
    });
});

function showError(message) {
  currentError.textContent = message;
  currentError.classList.add('error--active');
}

function hideError(element) {
  if (element) {
    element.textContent = '';
    element.classList.remove('error--active');
  } else {
    currentError.textContent = '';
    currentError.classList.remove('error--active');
  }
}

currentPasswordInput.addEventListener('input', () => {
  hideError();
  hideError(newErrorOne);
});

newPasswordInput.addEventListener('input', () => {
  hideError();
  hideError(newErrorOne);
});

confirmPasswordInput.addEventListener('input', () => {
  hideError();
  hideError(newErrorTwo);
});