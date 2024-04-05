document.getElementById('photo').addEventListener('change', function (event) {
  handleFiles(event.target.files);
});

let validFiles = [];

function handleFiles(files) {
  const fileList = document.getElementById('file-list');
  const maxSize = 5 * 1024 * 1024;
  const allowedTypes = ['image/png', 'image/jpg', 'image/jpeg', 'image/webp'];

  for (let i = 0; i < files.length; i++) {
    const file = files[i];

    if (!allowedTypes.includes(file.type)) {
      showToast('Недопустимый тип файла. Допустимые типы: PNG, JPG, JPEG, WEBP');
      continue;
    }

    if (file.size > maxSize) {
      showToast('Превышен максимальный размер файла (5 МБ)');
      continue;
    }

    if (validFiles.length >= 15) {
      showToast('Максимальное количество загружаемых файлов - 15');
      break;
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
      const index = validFiles.indexOf(file);
      if (index !== -1) {
        validFiles.splice(index, 1);
      }
    });

    li.appendChild(img);
    li.appendChild(deleteButton);
    fileList.appendChild(li);
    validFiles.push(file);
  }

  console.log('Количество допустимых файлов:', validFiles.length);
}

document.querySelector('form').addEventListener('submit', function (event) {
  event.preventDefault();
  const formData = new FormData();

  if (validFiles.length < 5) {
    showToast('Количество загружаемых файлов должно быть не менее 5');
    return;
  }

  for (let i = 0; i < validFiles.length; i++) {
    formData.append('photo[]', validFiles[i]);
  }

  const formElements = this.elements;
  for (let i = 0; i < formElements.length; i++) {
    const element = formElements[i];
    if (element.tagName === 'INPUT' || element.tagName === 'TEXTAREA') {
      formData.append(element.name, element.value);
    }
  }

  fetch('/admin/works/create', {
    method: 'POST',
    body: formData
  })
    .then(response => {
      if (!response.ok) {
        throw new Error('Network response was not ok');
      }
      return response.json();
    })
    .then(data => {
      console.log(data);
    })
    .catch(error => {
      console.error('There has been a problem with your fetch operation:', error);
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