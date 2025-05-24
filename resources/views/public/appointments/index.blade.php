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
                        <h4>{{ now()->locale('ar')->translatedFormat('F Y') }}</h4>
                    </div>

                    <!-- Days Grid -->
                    <div class="calendar-grid">
                        @foreach ($daysFromToday as $index => $dayKey)
                            <div class="calendar-day {{ $index === 0 ? 'today selected' : '' }}"
                                data-day="{{ $dayKey }}">
                                {{ $arabicDays[$dayKey] }}
                            </div>
                        @endforeach
                    </div>

                    <!-- Time Slots for Selected Day -->
                    <h6 class="time-header">الأوقات المتاحة:</h6>
                    <div class="time-slots" id="time-slots-container">
                        @php
                            $slots = [];

                            if ($selectedDay && isset($schedule[$selectedDay])) {
                                $start = \Carbon\Carbon::parse($schedule[$selectedDay]->start_time);
                                $end = \Carbon\Carbon::parse($schedule[$selectedDay]->end_time);
                                $now = \Carbon\Carbon::now();

                                while ($start < $end) {
                                    // Skip past times if the selected day is today
                                    if ($selectedDay !== $today || $start->greaterThan($now)) {
                                        $slots[] = $start->format('H:i');
                                    }
                                    $start->addMinutes(30);
                                }
                            }
                        @endphp

                        @forelse ($slots as $slot)
                            <button class="time-slot" onclick="selectedTime()">{{ $slot }}</button>
                        @empty
                            <div class="text-red-500">لا توجد أوقات متاحة لليوم</div>
                        @endforelse
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

                        <ul class="list-group">
                            @forelse ($patients as $index => $patient)
                                <li><a class="list-group-item active" href="#">{{ $patient->name }}</a></li>
                        </ul>
                    @empty
                        يرجى تسجيل الدخول لحجز موعد
                        @endforelse

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
        function getTodayDayKey() {
            const jsDayIndex = new Date().getDay(); // 0=Sunday, ..., 6=Saturday
            const mapping = ['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];
            return mapping[jsDayIndex];
        }
        const scheduleData = @json($schedule);

        function selectDay(dayKey) {
            document.querySelectorAll('.calendar-day').forEach(el => el.classList.remove('selected'));
            const selectedElement = [...document.querySelectorAll('.calendar-day')]
                .find(el => el.dataset.day === dayKey);
            if (selectedElement) selectedElement.classList.add('selected');

            const slotsContainer = document.getElementById('time-slots-container');
            slotsContainer.innerHTML = '';

            const slot = scheduleData[dayKey];

            if (!slot) {
                slotsContainer.innerHTML = '<div class="text-red-500">لا توجد مواعيد متاحة.</div>';
                return;
            }

            const intervals = get30MinuteIntervals(
                slot.start_time,
                slot.end_time,
                dayKey === getTodayDayKey(),
                new Date().getHours() * 60 + new Date().getMinutes()
            );

            if (intervals.length === 0) {
                slotsContainer.innerHTML = '<div class="text-red-500">لا توجد أوقات متاحة لبقية هذا اليوم.</div>';
                return;
            }

            intervals.forEach(interval => {
                const btn = document.createElement('button');
                btn.classList.add('time-slot');
                btn.value = interval.start;
                btn.innerText = `${interval.start}`;
                slotsContainer.appendChild(btn);
            });
        }

        function get30MinuteIntervals(start, end, isToday = false, currentMinutes = 0) {
            const result = [];

            let [startHour, startMin] = start.split(':').map(Number);
            let [endHour, endMin] = end.split(':').map(Number);

            const pad = n => n.toString().padStart(2, '0');

            while (startHour < endHour || (startHour === endHour && startMin < endMin)) {
                const intervalStartMinutes = startHour * 60 + startMin;

                const endIntervalMin = startMin + 30;
                let intervalEndHour = startHour;
                let intervalEndMin = endIntervalMin;

                if (endIntervalMin >= 60) {
                    intervalEndHour += 1;
                    intervalEndMin -= 60;
                }

                // Skip past intervals only for today
                if (isToday && intervalStartMinutes <= currentMinutes) {
                    startHour = intervalEndHour;
                    startMin = intervalEndMin;
                    continue;
                }

                if (
                    intervalEndHour > endHour ||
                    (intervalEndHour === endHour && intervalEndMin > endMin)
                ) break;

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

        // Add click listeners for all days
        document.querySelectorAll('.calendar-day').forEach(el => {
            el.addEventListener('click', () => {
                selectDay(el.dataset.day);
            });
        });


    </script>

</x-public.layout>
