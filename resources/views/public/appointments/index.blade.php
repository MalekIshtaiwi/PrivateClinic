<x-public.layout>
    <x-slot name="appointment_css">
        <link rel="stylesheet" href="{{ asset('css/appointment.css') }}">
    </x-slot name="appointment_css">

    <!-- Header -->
    <header class="header">
        <div class="container">
            <div class="header-content">
                <i class="fas fa-calendar-check header-icon"></i>
                <h3 class="header-title">حجز موعد</h3>
                <p class="header-subtitle">اختر الموعد المناسب لك</p>
            </div>
        </div>
    </header>

    <!-- Alert Messages -->
    @if (session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i>
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-circle"></i>
            {{ session('error') }}
        </div>
    @endif

    <div class="booking-container">
        <div class="row">
            <!-- Calendar Column -->
            <div class="col-lg-8 col-md-7">
                <div class="booking-card calendar-card">
                    <div class="card-header">
                        <div class="calendar-header">
                            <i class="fas fa-calendar-alt calendar-icon"></i>
                            <h4 class="calendar-title">{{ now()->locale('ar')->translatedFormat('F Y') }}</h4>
                        </div>
                    </div>

                    <div class="card-body">
                        <!-- Days Grid -->
                        <div class="calendar-section">
                            <h6 class="section-title">
                                <i class="fas fa-clock"></i>
                                اختر اليوم
                            </h6>
                            <div class="calendar-grid">
                                @foreach ($daysFromToday as $index => $dayKey)
                                    <div class="calendar-day {{ $index === 0 ? 'today selected' : '' }}"
                                        data-day="{{ $dayKey }}">
                                        <span class="day-name">{{ $arabicDays[$dayKey] }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Time Slots Section -->
                        <div class="time-section">
                            <h6 class="section-title">
                                <i class="fas fa-hourglass-half"></i>
                                الأوقات المتاحة
                            </h6>
                            <div class="time-slots" id="time-slots-container">
                                @php
                                    $slots = [];
                                    if ($selectedDay && isset($schedule[$selectedDay])) {
                                        $start = \Carbon\Carbon::parse($schedule[$selectedDay]->start_time);
                                        $end = \Carbon\Carbon::parse($schedule[$selectedDay]->end_time);
                                        $now = \Carbon\Carbon::now();

                                        while ($start < $end) {
                                            if ($selectedDay !== $today || $start->greaterThan($now)) {
                                                $slots[] = $start->format('H:i');
                                            }
                                            $start->addMinutes(30);
                                        }
                                    }
                                @endphp
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Booking Details Column -->
            <div class="col-lg-4 col-md-5">
                <div class="booking-card details-card">
                    <div class="card-header">
                        <div class="booking-heading">
                            <i class="fas fa-clipboard-list"></i>
                            <h5>تفاصيل الحجز</h5>
                        </div>
                    </div>

                    <div class="card-body">
                        <form action="/appointments" method="POST" id="booking-form" class="booking-form">
                            @csrf
                            <input type="hidden" name="selected_day" id="selected_day_input">
                            <input type="hidden" name="selected_time" id="selected_time_input">

                            <!-- Patient Selection -->
                            <div class="form-section">
                                <label class="form-label">
                                    <i class="fas fa-user"></i>
                                    اختر المريض
                                </label>
                                <div class="patient-list">
                                    @forelse ($patients as $patient)
                                        <div class="patient-option">
                                            <label class="patient-label">
                                                <input type="radio" name="patient_id" value="{{ $patient->id }}" required>
                                                <span class="checkmark"></span>
                                                <span class="patient-name">{{ $patient->name }}</span>
                                            </label>
                                        </div>
                                    @empty
                                        <div class="empty-state">
                                            <i class="fas fa-user-slash"></i>
                                            <p>يرجى تسجيل الدخول لحجز موعد</p>
                                        </div>
                                    @endforelse
                                </div>
                            </div>

                            <!-- Visit Type -->
                            <div class="form-section">
                                <label class="form-label">
                                    <i class="fas fa-stethoscope"></i>
                                    نوع الزيارة
                                </label>
                                <div class="select-wrapper">
                                    <select name="visitType" class="form-select">
                                        <option value="first">زيارة أولى</option>
                                        <option value="return">زيارة مكررة</option>
                                    </select>
                                    <i class="fas fa-chevron-down select-arrow"></i>
                                </div>
                            </div>

                            <!-- Duration Display -->
                            <div class="form-section">
                                <label class="form-label">
                                    <i class="fas fa-clock"></i>
                                    المدة المتوقعة
                                </label>
                                <div class="duration-display">
                                    <span class="duration-text">30 دقيقة</span>
                                    <div class="duration-icon">
                                        <i class="fas fa-hourglass-half"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Booking Summary -->
                            <div class="booking-summary" id="booking-summary" style="display: none;">
                                <h6 class="summary-title">
                                    <i class="fas fa-check-circle"></i>
                                    ملخص الحجز
                                </h6>
                                <div class="summary-item">
                                    <span class="summary-label">التاريخ:</span>
                                    <span class="summary-value" id="summary-date">-</span>
                                </div>
                                <div class="summary-item">
                                    <span class="summary-label">الوقت:</span>
                                    <span class="summary-value" id="summary-time">-</span>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-confirm">
                                <i class="fas fa-calendar-check"></i>
                                تأكيد الحجز
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const scheduleData = @json($schedule);
        const bookedSlotsData = @json($bookedSlots);
        const todayKey = '{{ $today }}';
        const arabicDays = @json($arabicDays);

        function getTodayMinutes() {
            const now = new Date();
            return now.getHours() * 60 + now.getMinutes();
        }

        function pad(n) {
            return n.toString().padStart(2, '0');
        }

        function get30MinuteIntervals(start, end, isToday = false) {
            let [startHour, startMin] = start.split(':').map(Number);
            let [endHour, endMin] = end.split(':').map(Number);
            const currentMinutes = getTodayMinutes();
            const result = [];

            while (startHour < endHour || (startHour === endHour && startMin < endMin)) {
                const totalMinutes = startHour * 60 + startMin;
                const endMinTotal = totalMinutes + 30;
                const intervalEndHour = Math.floor(endMinTotal / 60);
                const intervalEndMin = endMinTotal % 60;

                if (isToday && totalMinutes <= currentMinutes) {
                    startHour = intervalEndHour;
                    startMin = intervalEndMin;
                    continue;
                }

                if (
                    intervalEndHour > endHour ||
                    (intervalEndHour === endHour && intervalEndMin > endMin)
                ) break;

                result.push({
                    start: `${pad(startHour)}:${pad(startMin)}`
                });

                startHour = intervalEndHour;
                startMin = intervalEndMin;
            }

            return result;
        }

        function updateBookingSummary() {
            const selectedDay = document.getElementById('selected_day_input').value;
            const selectedTime = document.getElementById('selected_time_input').value;
            const summaryEl = document.getElementById('booking-summary');

            if (selectedDay && selectedTime) {
                document.getElementById('summary-date').textContent = arabicDays[selectedDay] || selectedDay;
                document.getElementById('summary-time').textContent = selectedTime;
                summaryEl.style.display = 'block';
            } else {
                summaryEl.style.display = 'none';
            }
        }

        function renderSlots(dayKey) {
            const slotsContainer = document.getElementById('time-slots-container');
            slotsContainer.innerHTML = '';

            const schedule = scheduleData[dayKey];
            if (!schedule) {
                slotsContainer.innerHTML = `
                    <div class="empty-slots">
                        <i class="fas fa-calendar-times"></i>
                        <p>لا توجد مواعيد متاحة في هذا اليوم</p>
                    </div>`;
                return;
            }

            const isToday = dayKey === todayKey;
            const intervals = get30MinuteIntervals(schedule.start_time, schedule.end_time, isToday);
            const booked = bookedSlotsData[dayKey] || [];

            if (intervals.length === 0) {
                slotsContainer.innerHTML = `
                    <div class="empty-slots">
                        <i class="fas fa-clock"></i>
                        <p>لا توجد أوقات متاحة لبقية هذا اليوم</p>
                    </div>`;
                return;
            }

            intervals.forEach(interval => {
                const btn = document.createElement('button');
                btn.type = 'button';
                btn.classList.add('time-slot');
                btn.innerHTML = `<span>${interval.start}</span>`;

                if (booked.includes(interval.start)) {
                    btn.disabled = true;
                    btn.classList.add('disabled-slot');
                    btn.innerHTML += '<i class="fas fa-times slot-status"></i>';
                } else {
                    btn.innerHTML += '<i class="fas fa-check slot-status"></i>';
                    btn.addEventListener('click', () => {
                        document.querySelectorAll('.time-slot').forEach(b => b.classList.remove('selected'));
                        btn.classList.add('selected');
                        document.getElementById('selected_time_input').value = interval.start;
                        document.getElementById('selected_day_input').value = dayKey;
                        updateBookingSummary();
                    });
                }

                slotsContainer.appendChild(btn);
            });
        }

        document.addEventListener('DOMContentLoaded', () => {
            const defaultDay = '{{ $selectedDay }}';
            renderSlots(defaultDay);

            document.querySelectorAll('.calendar-day').forEach(dayBtn => {
                dayBtn.addEventListener('click', () => {
                    document.querySelectorAll('.calendar-day').forEach(el => el.classList.remove('selected'));
                    dayBtn.classList.add('selected');
                    const dayKey = dayBtn.dataset.day;
                    renderSlots(dayKey);
                    updateBookingSummary();
                });
            });

            // Update summary when patient is selected
            document.querySelectorAll('input[name="patient_id"]').forEach(radio => {
                radio.addEventListener('change', updateBookingSummary);
            });
        });
    </script>
</x-public.layout>
