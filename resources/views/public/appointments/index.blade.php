<x-public.layout>
    <x-slot name="appointment_css">
        <link rel="stylesheet" href="{{ asset('css/appointment.css') }}">
    </x-slot name="appointment_css">


    <!-- Header -->
    <header class="header">
        <div class="container">
            <h3 class="text-center">حجز موعد</h3>
        </div>
    </header>

    <div class="booking-container">
        <div class="row">
            <!-- Calendar Column -->
            <div class="col-md-8">
                <div class="booking-card">
                    <div class="calendar-header">
                        <h4>{{ now()->format('F Y') }}</h4>
                    </div>

                    <!-- Calendar Days Header -->
                    <div class="calendar-grid">
                        @forelse ($daysFromTodayArabic as $index => $day)
                            <div class="calendar-day {{ $index === 0 ? 'today selected' : '' }}"
                                id="day-{{ $daysFromToday[$index] }}"
                                onclick="selectDay('{{ $daysFromToday[$index] }}')">
                                {{ $day }}
                            </div>
                        @empty
                            <div class="text-center text-red-500">
                                لا توجد مواعيد متاحة ({{ $todayArabic }})
                            </div>
                        @endforelse
                    </div>

                    <!-- Time Slots -->
                    <h6 class="time-header">الأوقات المتاحة:</h6>
                    <div class="time-slots" id="time-slots">
                        <!-- Time slots will be rendered here via JS -->
                    </div>
                </div>
            </div>

            <!-- Booking Details Column -->
            <div class="col-md-4">
                <div class="booking-card">
                    <div class="booking-heading">
                        <h5>تفاصيل الحجز</h5>
                    </div>

                    <div class="booking-form">
                        <div class="dropdown">
                            <button class="filter-select dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                اسم المريض </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">الكل</a></li>
                                <li><a class="dropdown-item" href="#">د. سارة خالد</a></li>
                                <li><a class="dropdown-item" href="#">د. أحمد محمد</a></li>
                                <li><a class="dropdown-item" href="#">د. ليلى عمر</a></li>
                            </ul>
                        </div>
                        <div class="form-group">
                            <label class="form-label">سبب الزيارة:</label>
                            <textarea class="form-control"></textarea>
                        </div>

                        <div class="form-group">
                            <label class="form-label">المدة المتوقعة:</label>
                            <div class="duration-display">
                                <div>30 دقيقة</div>
                                <i class="fa-regular fa-clock"></i>
                            </div>
                        </div>



                        <button class="btn btn-confirm">تأكيد الحجز</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const scheduleData = @json($schedule);

        function selectDay(dayKey) {
            document.querySelectorAll('.calendar-day').forEach(el => el.classList.remove('selected'));
            document.getElementById('day-' + dayKey).classList.add('selected');

            const slotsContainer = document.getElementById('time-slots');
            slotsContainer.innerHTML = '';

            const slots = scheduleData[dayKey];

            if (!slots || slots.length === 0) {
                slotsContainer.innerHTML = '<div class="text-red-500">لا توجد مواعيد متاحة.</div>';
                return;
            }

            const todayKey = "{{ $daysFromToday[0] }}"; // first day is today
            const now = new Date();
            const currentMinutes = now.getHours() * 60 + now.getMinutes();

            let hasSlots = false;

            slots.forEach(slot => {
                const intervals = get30MinuteIntervals(
                    slot.start_time,
                    slot.end_time,
                    dayKey === todayKey,
                    currentMinutes
                );

                intervals.forEach(interval => {
                    hasSlots = true;
                    const btn = document.createElement('button');
                    btn.classList.add('time-slot');
                    btn.innerText = `${interval.start} - ${interval.end}`;
                    slotsContainer.appendChild(btn);
                });
            });

            if (!hasSlots) {
                slotsContainer.innerHTML = '<div class="text-red">لا توجد أوقات متاحة لبقية هذا اليوم.</div>';
            }
        }

        function get30MinuteIntervals(start, end, isToday = false, currentMinutes = 0) {
            const result = [];

            let [startHour, startMin] = start.split(':').map(Number);
            let [endHour, endMin] = end.split(':').map(Number);

            const pad = n => n.toString().padStart(2, '0');

            while (startHour < endHour || (startHour === endHour && startMin < endMin)) {
                const endIntervalMin = startMin + 30;
                let intervalEndHour = startHour;
                let intervalEndMin = endIntervalMin;

                if (endIntervalMin >= 60) {
                    intervalEndHour += 1;
                    intervalEndMin -= 60;
                }

                const intervalStartMinutes = startHour * 60 + startMin;

                if (
                    intervalEndHour > endHour ||
                    (intervalEndHour === endHour && intervalEndMin > endMin)
                ) break;

                // Skip past intervals only for today
                if (isToday && intervalStartMinutes <= currentMinutes) {
                    startHour = intervalEndHour;
                    startMin = intervalEndMin;
                    continue;
                }

                result.push({
                    start: `${pad(startHour)}:${pad(startMin)}`,
                    end: `${pad(intervalEndHour)}:${pad(intervalEndMin)}`
                });

                startHour = intervalEndHour;
                startMin = intervalEndMin;
            }

            return result;
        }

        // Auto-load first day (today)
        window.addEventListener('DOMContentLoaded', () => {
            selectDay('{{ $daysFromToday[0] }}');
        });
    </script>

</x-public.layout>
