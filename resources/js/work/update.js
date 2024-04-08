document.addEventListener('DOMContentLoaded', function () {
  let validFiles = []; // объявление переменной validFiles в верхней область видимости

  function loadImagesFromServer() {
    const existingPhotos = document.querySelectorAll('#file-list li');
    existingPhotos.forEach((photo, index) => {
      const fileName = photo.querySelector('img').src;
      const fileExtension = fileName.split('.').pop();
      fetch(fileName)
        .then(response => response.blob())
        .then(blob => {
          const file = new File([blob], `file-${index}.${fileExtension}`, {type: blob.type});
          validFiles.push(file);
        })
        .catch(error => {
          console.error('Error loading image:', error);
        });
    });
  }

  loadImagesFromServer();

  function removeFromValidFiles(index) {
    if (index !== -1) {
      validFiles.splice(index, 1);
    }
  }

  function updateDataIndexes() {
    const fileList = document.getElementById('file-list');
    const listItems = fileList.querySelectorAll('li');
    listItems.forEach((item, index) => {
      item.setAttribute('data-index', index);
    });
  }

  const existingPhotos = document.querySelectorAll('#file-list li');
  existingPhotos.forEach((photo, index) => {
    const deleteButton = photo.querySelector('.custom-file-upload__delete');
    deleteButton.addEventListener('click', function () {
      photo.parentNode.removeChild(photo);
      const indexToRemove = parseInt(photo.getAttribute('data-index'));
      removeFromValidFiles(indexToRemove);
      updateDataIndexes();
    });
    photo.setAttribute('data-index', index);
  });

  document.getElementById('photo').addEventListener('change', function (event) {
    handleFiles(event.target.files);
  });

  function handleFiles(files) {
    const fileList = document.getElementById('file-list');
    const maxSize = 5 * 1024 * 1024;
    const allowedTypes = ['image/png', 'image/jpg', 'image/jpeg', 'image/webp'];
    const maxTotalFiles = 15;
    const remainingSlots = maxTotalFiles - validFiles.length;

    for (let i = 0; i < files.length && i < remainingSlots; i++) {
      const file = files[i];
      if (!allowedTypes.includes(file.type)) {
        showToast('Недопустимый тип файла. Допустимые типы: PNG, JPG, JPEG, WEBP');
        continue;
      }

      if (file.size > maxSize) {
        showToast('Превышен максимальный размер файла (5 МБ)');
        continue;
      }

      const li = document.createElement('li');
      const img = document.createElement('img');
      img.src = URL.createObjectURL(file);
      img.width = 400;
      img.height = 500;

      const deleteButton = document.createElement('button');
      deleteButton.textContent = 'Удалить';
      deleteButton.className = 'custom-file-upload__delete';
      deleteButton.addEventListener('click', function () {
        fileList.removeChild(li);
        const indexToRemove = validFiles.indexOf(file);
        removeFromValidFiles(indexToRemove);
        updateDataIndexes();
      });

      li.appendChild(img);
      li.appendChild(deleteButton);
      fileList.appendChild(li);
      validFiles.push(file);
    }

    if (files.length > remainingSlots) {
      showToast(`Превышено максимальное количество загружаемых файлов - ${maxTotalFiles}`);
    }

    console.log('Количество допустимых файлов:', validFiles.length);
  }

  document.querySelector('form').addEventListener('submit', function (event) {
    event.preventDefault();
    const url = window.location.href;
    const id = url.match(/\d+(?=\/edit)/)[0];
    const formData = new FormData();

    if (validFiles.length < 5) {
      showToast('Количество загружаемых файлов должно быть не менее 5');
      return;
    }

    for (let i = 0; i < validFiles.length; i++) {
      formData.append('photo[]', validFiles[i]);
    }

    formData.append('id', id);
    const formElements = this.elements;
    for (let i = 0; i < formElements.length; i++) {
      const element = formElements[i];
      if ((element.tagName === 'INPUT' || element.tagName === 'TEXTAREA') && element.name !== 'photo[]') {
        formData.append(element.name, element.value);
      }
    }

    console.log('Отправляемые файлы:', validFiles);

    fetch(`/admin/works/${id}/edit`, {
      method: 'POST',
      body: formData,
      headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
      },
    })
      .then(response => {
        if (!response.ok) {
          throw new Error('Ошибка сервера при выполнении запроса');
        }
        return response.json();
      })
      .then(data => {
        alert('Работа портфолио успешно обновлена!');
        window.location.href = '/admin/works';
      })
      .catch(error => {
        console.error('Проблема с сервером', error);
      });
  });

  function showToast(message) {
    Toastify({
      text: message,
      duration: 4000,
      gravity: 'bottom',
      position: 'right',
      backgroundColor: '#ff6347',
    }).showToast();
  }
});