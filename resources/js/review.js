document.getElementById('photo').addEventListener('change', function () {
  const file = this.files[0];
  const reader = new FileReader();
  const formatError = document.getElementById('formatError');
  const sizeError = document.getElementById('sizeError');

  formatError.classList.remove('error--active');
  sizeError.classList.remove('error--active');

  if (!['image/jpeg', 'image/jpg', 'image/png', 'image/webp'].includes(file.type)) {
    formatError.classList.add('error--active');
    return;
  }

  if (file.size > 3145728) {
    sizeError.classList.add('error--active');
    return;
  }

  reader.onload = function (e) {
    const loader = document.querySelector('.reviews-form__loader');
    loader.style.backgroundImage = "url('" + e.target.result + "')";
    document.getElementById('uploadText').style.display = 'none';
  }

  reader.readAsDataURL(file);
});

document.querySelector('.reviews-form__form').addEventListener('submit', function (event) {
  event.preventDefault();

  const formData = new FormData(this);
  const photoInput = document.getElementById('photo');
  const photoError = document.getElementById('photoError');

  if (!photoInput.files.length) {
    photoError.classList.add('error--active');
    setTimeout(function () {
      photoError.classList.remove('error--active');
    }, 3500);

    return;
  }

  fetch('/reviews/reviews-form', {
    method: 'POST',
    body: formData,
    headers: {
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
    },
  })
    .then(response => {
      if (response.status === 429) {
        Toastify({
          text: "Превышено макс. количество запросов. Пожалуйста, попробуйте позже",
          duration: 4500,
          gravity: 'bottom',
          position: 'left',
          backgroundColor: "#ff6363",
        }).showToast();
        throw new Error('Too many requests');
      } else if (!response.ok) {
        throw new Error('Network error');
      }
      return response.json();
    })
    .then(() => {
      alert("Поздравляем, ваш отзыв был успешно отправлен на проверку. В скором времени он будет проверен администраторами.");
      window.location.href = '/reviews';
    })
    .catch(error => {
      console.error('Form submission error:', error.message);
    });
});