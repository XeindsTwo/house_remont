$(document).ready(function () {
  function validateName() {
    const nameValue = $("#name").val();
    const nameError = $("#nameError");
    const regex = /^[A-Za-zА-я\-]+$/;

    if (nameValue.trim() === "") {
      nameError.removeClass("error--active");
      return false;
    }

    if (!regex.test(nameValue)) {
      nameError.addClass("error--active");
      return false;
    } else {
      nameError.removeClass("error--active");
    }

    return true;
  }

  function validateEmail() {
    const emailValue = $("#email").val();
    const emailError = $("#emailError");
    const emailErrorParameters = $("#emailErrorParameters");
    const regex = /^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/;

    let valid = true;

    if (emailValue.trim() === '') {
      emailErrorParameters.removeClass("error--active");
      return false;
    }

    if (!regex.test(emailValue)) {
      emailErrorParameters.addClass("error--active");
      return false;
    } else {
      emailErrorParameters.removeClass("error--active");
    }

    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      type: 'POST',
      url: '/check-email',
      data: {
        email: emailValue
      },
      success: function (response) {
        if (response.exists) {
          emailError.addClass('error--active');
        } else {
          emailError.removeClass('error--active');
        }
      },
      error: function (xhr, status, error) {
        console.error(error);
      }
    });

    return valid;
  }

  function validateLogin() {
    const loginValue = $("#login").val();
    const loginError = $("#loginError");
    const loginCheckError = $("#loginCheckError");
    const loginLengthError = $("#loginLengthError");

    if (loginValue.trim() === "") {
      loginError.removeClass("error--active");
      loginLengthError.removeClass("error--active");
      return false;
    }

    let valid = true;

    if (/[А-я]/.test(loginValue) || !/^[a-zA-Z0-9_]+$/.test(loginValue)) {
      loginError.addClass("error--active");
      valid = false;
    } else {
      loginError.removeClass("error--active");
    }

    if (loginValue.length < 5) {
      loginLengthError.addClass("error--active");
      valid = false;
    } else {
      loginLengthError.removeClass("error--active");
    }

    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      type: 'POST',
      url: '/check-login',
      data: {
        login: loginValue
      },
      success: function (response) {
        if (response.exists) {
          loginCheckError.addClass('error--active');
          updateSubmitButtonState();
        } else {
          loginCheckError.removeClass('error--active');
          updateSubmitButtonState();
        }
      },
      error: function (xhr, status, error) {
        console.error(error);
      }
    });

    return valid;
  }

  function validatePassword() {
    const passwordValue = $("#password").val();
    const passwordError = $("#passwordError");
    const passwordLengthError = $("#passwordLengthError");

    if (passwordValue.trim() === "") {
      passwordError.removeClass("error--active");
      passwordLengthError.removeClass("error--active");
      return false;
    }

    let valid = true;

    const regex = /^[a-zA-Z0-9_]+$/;
    if (!regex.test(passwordValue)) {
      passwordError.addClass("error--active");
      valid = false;
    } else {
      passwordError.removeClass("error--active");
    }

    if (passwordValue.length < 8) {
      passwordLengthError.addClass("error--active");
      valid = false;
    } else {
      passwordLengthError.removeClass("error--active");
    }

    return valid;
  }

  function updateSubmitButtonState() {
    const nameValid = validateName();
    const emailValid = validateEmail();
    const loginValid = validateLogin();
    const passwordValid = validatePassword();
    const submitButton = $("#registration-btn");
    const hasErrors = $(".error--active").length > 0;

    if (nameValid && emailValid && loginValid && passwordValid && !hasErrors) {
      submitButton.prop("disabled", false);
      submitButton.css("opacity", "1");
      submitButton.css("pointer-events", "auto");
    } else {
      submitButton.prop("disabled", true);
      submitButton.css("opacity", "0.6");
      submitButton.css("pointer-events", "none");
    }
  }

  $("#name").on("input", updateSubmitButtonState);
  $("#email").on("input", updateSubmitButtonState);
  $("#password").on("input", updateSubmitButtonState);
  $("#login").on("blur", validateLogin);
  updateSubmitButtonState();
});