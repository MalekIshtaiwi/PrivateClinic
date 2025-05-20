document.querySelectorAll('.day-toggle-checkbox').forEach(toggle => {
    toggle.addEventListener('change', function () {
        const dayCard = this.closest('.day-card');
        const timeInputs = dayCard.querySelectorAll('input[type="time"]');

        if (this.checked) {
            dayCard.classList.remove('disabled-day');
            timeInputs.forEach(input => input.disabled = false);
            this.value = 1;
        } else {
            dayCard.classList.add('disabled-day');
            timeInputs.forEach(input => input.disabled = true);
            // When unchecked, still submit a value
            const hidden = document.createElement('input');
            hidden.type = 'hidden';
            hidden.name = this.name;
            hidden.value = 0;
            dayCard.appendChild(hidden);
            // Remove checkbox name to avoid duplicate key
            this.removeAttribute('name');
        }
    });
});
