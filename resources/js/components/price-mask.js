const priceInputs = document.querySelectorAll('[data-mask="price"]');
priceInputs.forEach(function(input) {
  input.addEventListener('input', function(event) {
    let value = event.target.value;
    value = value.replace(/\D/g, '');
    value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ' ');
    value = value.trim();
    value = value.slice(0, 11);
    event.target.value = value;
  });
});