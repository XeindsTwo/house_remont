const btn = document.querySelector('.start__btn');
const btnCostModalClose = document.querySelectorAll('.cost-modal__close');
const costModal = document.querySelector('.cost-modal');
const body = document.querySelector('body');
const steps = document.querySelectorAll('.cost-modal__content');
const progressText = document.querySelector('.cost-modal__bottom p');
const progressBar = document.querySelector('.cost-modal__progress');
const form = document.querySelector('.cost-modal__form');

let currentStep = 1;
const totalSteps = steps.length;
const formData = {};

const closeModal = () => {
  costModal.classList.remove('cost-modal--active');
  body.classList.remove('body--active');
  currentStep = 1;
  updateProgress();
  steps.forEach((step, index) => {
    step.style.display = index === 0 ? 'block' : 'none';
  });
};

const updateProgress = () => {
  const progress = (currentStep - 1) / (totalSteps - 1) * 100;
  progressText.textContent = `Готово ${progress.toFixed(0)}%`;
  progressBar.style.width = `${progress}%`;
};

btn.addEventListener('click', () => {
  costModal.classList.toggle('cost-modal--active');
  body.classList.toggle('body--active');
  updateProgress();
});

btnCostModalClose.forEach((btn) => {
  btn.addEventListener('click', closeModal);
});

document.addEventListener('keydown', (event) => {
  if (event.key === 'Escape' && costModal.classList.contains('cost-modal--active')) {
    closeModal();
  }
});

document.addEventListener('click', (event) => {
  if (costModal.classList.contains('cost-modal--active') && !costModal.contains(event.target) && !btn.contains(event.target)) {
    closeModal();
  }
});

const handleStepButtonClick = (event) => {
  const btn = event.currentTarget;
  const step = btn.closest('.cost-modal__content');
  const stepNumber = parseInt(step.getAttribute('data-step'));

  if (stepNumber === 1) {
    formData.object = btn.getAttribute('data-info');
  } else if (stepNumber === 2) {
    formData.material = btn.getAttribute('data-info-material');
  } else if (stepNumber === 3) {
    formData.area = btn.getAttribute('data-info-material');
  } else if (stepNumber === 4) {
    formData.timing = btn.getAttribute('data-info-material');
  }

  if (stepNumber < totalSteps) {
    steps[stepNumber - 1].style.display = 'none';
    steps[stepNumber].style.display = 'block';
    currentStep = stepNumber + 1;
    updateProgress();
  }
};

document.querySelectorAll('.cost-modal__step-btn').forEach((btn) => {
  btn.addEventListener('click', handleStepButtonClick);
});

const submitForm = async () => {
  try {
    const response = await fetch('/repair-estimate', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
      },
      body: JSON.stringify(formData),
    });

    if (!response.ok) {
      throw new Error('Network response was not ok');
    }

    const data = await response.json();
    console.log(data); // вывод ответа в консоль для отладки
  } catch (error) {
    console.error('There was an error!', error);
  }
};

form.addEventListener('submit', async (event) => {
  event.preventDefault();
  formData.phone = document.getElementById('phone_cost').value;
  await submitForm();
  form.reset();
  showSixthStep();
});

const showSixthStep = () => {
  steps[currentStep - 1].style.display = 'none';
  steps[totalSteps - 1].style.display = 'block';
  currentStep = totalSteps;
  updateProgress();
};