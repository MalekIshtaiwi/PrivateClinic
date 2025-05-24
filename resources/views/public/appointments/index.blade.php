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
    @if (session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger text-center">{{ session('error') }}</div>
    @endif

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
                        <div class="time-slots" id="time-slots-container"></div>
                    </div>
                </div>
            </div>

            <!-- Booking Details Column -->
            <div class="col-md-4">
                <div class="booking-card">
                    <div class="booking-heading">
                        <h5>تفاصيل الحجز</h5>
                    </div>

                    <form action="/appointments" method="POST" id="booking-form" class="booking-form">
                        @csrf
                        <input type="hidden" name="selected_day" id="selected_day_input">
                        <input type="hidden" name="selected_time" id="selected_time_input">

                        <ul class="list-group">
                            @forelse ($patients as $patient)
                                <li>
                                    <label>
                                        <input type="radio" name="patient_id" value="{{ $patient->id }}" required>
                                        {{ $patient->name }}
                                    </label>
                                </li>
                            @empty
                                يرجى تسجيل الدخول لحجز موعد
                            @endforelse
                        </ul>

                        <div class="form-group mt-2">
                            <label class="form-label">سبب الزيارة:</label>
                            <textarea class="form-control" name="notes"></textarea>
                        </div>

                        <div class="form-group mt-2">
                            <label class="form-label">المدة المتوقعة:</label>
                            <div class="duration-display">
                                <div>30 دقيقة</div>
                                <i class="fa-regular fa-clock"></i>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-confirm mt-2">تأكيد الحجز</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        const scheduleData = @json($schedule);
        const bookedSlotsData = @json($bookedSlots);
        const todayKey = '{{ $today }}';

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

        function renderSlots(dayKey) {
            const slotsContainer = document.getElementById('time-slots-container');
            slotsContainer.innerHTML = '';

            const schedule = scheduleData[dayKey];
            if (!schedule) {
                slotsContainer.innerHTML = '<div class="text-red-500">لا توجد مواعيد متاحة.</div>';
                return;
            }

            const isToday = dayKey === todayKey;
            const intervals = get30MinuteIntervals(schedule.start_time, schedule.end_time, isToday);
            const booked = bookedSlotsData[dayKey] || [];

            if (intervals.length === 0) {
                slotsContainer.innerHTML = '<div class="text-red-500">لا توجد أوقات متاحة لبقية هذا اليوم.</div>';
                return;
            }

            intervals.forEach(interval => {
                const btn = document.createElement('button');
                btn.type = 'button';
                btn.classList.add('time-slot');
                btn.textContent = interval.start;

                if (booked.includes(interval.start)) {
                    btn.disabled = true;
                    btn.classList.add('disabled-slot');
                } else {
                    btn.addEventListener('click', () => {
                        document.querySelectorAll('.time-slot').forEach(b => b.classList.remove(
                            'selected'));
                        btn.classList.add('selected');
                        document.getElementById('selected_time_input').value = interval.start;
                        document.getElementById('selected_day_input').value = dayKey;
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
                    document.querySelectorAll('.calendar-day').forEach(el => el.classList.remove(
                        'selected'));
                    dayBtn.classList.add('selected');
                    const dayKey = dayBtn.dataset.day;
                    renderSlots(dayKey);
                });
            });
        });
    </script>

</x-public.layout>
