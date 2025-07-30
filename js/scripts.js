// Core JavaScript functionality

function validateForm(form) {
  const requiredFields = form.querySelectorAll('[required]');
  let valid = true;

  requiredFields.forEach(field => {
    const errorMessage = field.nextElementSibling;
    if (!field.value.trim()) {
      valid = false;
      field.classList.add('error');
      if (!errorMessage || !errorMessage.classList.contains('error-message')) {
        const msg = document.createElement('span');
        msg.className = 'error-message';
        msg.textContent = 'This field is required.';
        field.parentNode.insertBefore(msg, field.nextSibling);
      }
    } else {
      field.classList.remove('error');
      if (errorMessage && errorMessage.classList.contains('error-message')) {
        errorMessage.remove();
      }
    }
  });

  return valid;
}

function filterList(input, list) {
  const query = input.value.toLowerCase();
  list.querySelectorAll('[data-filter-item]').forEach(item => {
    const text = item.textContent.toLowerCase();
    item.style.display = text.includes(query) ? '' : 'none';
  });
}

// Attach global event listeners

document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('form.validate').forEach(form => {
    form.addEventListener('submit', evt => {
      if (!validateForm(form)) {
        evt.preventDefault();
      }
    });
  });

  document.querySelectorAll('[data-filter]').forEach(input => {
    const targetSelector = input.dataset.filter;
    const targetList = document.querySelector(targetSelector);
    if (targetList) {
      input.addEventListener('input', () => filterList(input, targetList));
    }
  });
});

