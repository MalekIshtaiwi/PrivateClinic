        // Simple toggle functionality for the day cards
        document.querySelectorAll('.form-check-input').forEach(toggle => {
            toggle.addEventListener('change', function () {
                const dayCard = this.closest('.day-card');
                if (this.checked) {
                    dayCard.classList.remove('disabled-day');
                    dayCard.querySelectorAll('input[type="time"]').forEach(input => {
                        input.disabled = false;
                    });
                } else {
                    dayCard.classList.add('disabled-day');
                    dayCard.querySelectorAll('input[type="time"]').forEach(input => {
                        input.disabled = true;
                    });
                }
            });
        });

        // Add Time Slot button functionality
        document.querySelector('.add-time-btn').addEventListener('click', function () {
            // Find first enabled day
            const firstEnabledDay = document.querySelector('.day-card:not(.disabled-day)');
            if (firstEnabledDay) {
                const dayBody = firstEnabledDay.querySelector('.day-body');
                const newTimeSlot = document.createElement('div');
                newTimeSlot.className = 'time-slot';
                newTimeSlot.innerHTML = `
                    <i class="fas fa-edit edit-time"></i>
                    <div class="row time-input-row">
                        <div class="col-md-6 time-input-col">
                            <label class="time-label">Start Time</label>
                            <input type="time" class="form-control">
                        </div>
                        <div class="col-md-6 time-input-col">
                            <label class="time-label">End Time</label>
                            <input type="time" class="form-control">
                        </div>
                    </div>
                `;
                dayBody.appendChild(newTimeSlot);

                // Scroll to the new time slot
                newTimeSlot.scrollIntoView({ behavior: 'smooth' });
            }
        });

        //modal script
        document.addEventListener('DOMContentLoaded', function () {
            const dayBoxes = document.querySelectorAll('.day-box');

            dayBoxes.forEach(box => {
                box.addEventListener('click', function () {
                    // Remove selected class from all boxes
                    dayBoxes.forEach(b => b.classList.remove('selected'));

                    // Add selected class to clicked box
                    this.classList.add('selected');
                });
            });
        });
