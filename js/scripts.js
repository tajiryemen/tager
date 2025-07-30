document.addEventListener('DOMContentLoaded', () => {
    // Simple form validation for required fields
    const forms = document.querySelectorAll('form.needs-validation');

    forms.forEach(form => {
        form.addEventListener('submit', event => {
            let valid = true;
            form.querySelectorAll('[required]').forEach(input => {
                if (!input.value.trim()) {
                    valid = false;
                    input.classList.add('input-error');
                } else {
                    input.classList.remove('input-error');
                }
            });
            if (!valid) {
                event.preventDefault();
            }
        });
    });

    // Dynamic filtering for listing pages
    const filterControls = document.querySelectorAll('.filter');

    filterControls.forEach(control => {
        control.addEventListener('change', applyFilters);
    });

    function applyFilters() {
        const filters = {};
        filterControls.forEach(control => {
            if (control.value) {
                filters[control.name] = control.value;
            }
        });

        document.querySelectorAll('.ad-item').forEach(item => {
            let show = true;
            for (const key in filters) {
                if (item.dataset[key] !== filters[key]) {
                    show = false;
                    break;
                }
            }
            item.style.display = show ? '' : 'none';
        });
    }
});
