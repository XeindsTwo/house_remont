const editAvatarBtn = document.querySelector('.profile__edit-avatar');
const avatarInput = document.createElement('input');
avatarInput.type = 'file';
avatarInput.accept = 'image/webp,image/png,image/jpeg';
avatarInput.hidden = true;
document.body.appendChild(avatarInput);

editAvatarBtn.addEventListener('click', function () {
  avatarInput.click();
});

avatarInput.addEventListener('change', function () {
  const file = avatarInput.files[0];
  if (!file) return;

  const allowedTypes = ['image/webp', 'image/png', 'image/jpeg'];
  if (!allowedTypes.includes(file.type)) {
    alert('Допустимые типы файлов: webp, png, jpg, jpeg');
    return;
  }

  const maxSize = 3 * 1024 * 1024; // 3 MB
  if (file.size > maxSize) {
    alert('Максимальный размер файла: 3MB');
    return;
  }

  const formData = new FormData();
  formData.append('avatar', file);

  fetch('/profile/update-avatar', {
    method: 'POST',
    body: formData,
    headers: {
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
    },
  })
    .then(response => {
      if (!response.ok) {
        throw new Error('Ошибка при обновлении аватара');
      }
      return response.json();
    })
    .then(data => {
      console.log(data);
      const profileImg = document.querySelector('.profile__img');
      profileImg.src = URL.createObjectURL(file);
      Toastify({
        text: 'Ваш аватар успешно обновлен!',
        duration: 4000,
        gravity: 'bottom',
        position: 'left'
      }).showToast();
    })
    .catch(error => {
      console.error(error);
      alert('Ошибка при обновлении аватара');
    });
});