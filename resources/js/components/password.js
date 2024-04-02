const togglePasswordBtns = document.querySelectorAll('.password-field__btn');
togglePasswordBtns.forEach(btn => {
  let timeoutId;

  btn.addEventListener('click', function () {
    const targetId = this.getAttribute('data-target');
    const passwordInput = document.getElementById(targetId);
    clearTimeout(timeoutId);
    if (passwordInput.type === 'password') {
      passwordInput.type = 'text';
      this.classList.add('active');
    } else {
      passwordInput.type = 'password';
      this.classList.remove('active');
    }

    timeoutId = setTimeout(() => {
      if (passwordInput.type === 'text') {
        passwordInput.type = 'password';
        this.classList.remove('active');
      }
    }, 2000);
  });
});