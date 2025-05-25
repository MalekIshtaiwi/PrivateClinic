<x-admin.layout>

    <x-slot name="schedule_css">
        <link rel="stylesheet" href="{{ asset('css/admin/schedule.css') }}">
    </x-slot name="schedule_css">

    <div class="container main-container">
        @if (session('success'))
            <div class="alert alert-success mt-3">{{ session('success') }}</div>
        @endif
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-4 col-lg-3 mb-4">
                <div class="stats-card">
                    <div class="d-flex align-items-center mb-3 gap-2">
                        <i class="far fa-calendar ms-2" style="color: var(--header);"></i>
                        <h5 class="mb-0">نظرة عامة على الأسبوع</h5>
                    </div>

                    <div class="date-navigation">
                        <i class="fas fa-chevron-right nav-arrow"></i>
                        <span class="date-range">٥-١١ مايو، ٢٠٢٥</span>
                        <i class="fas fa-chevron-left nav-arrow"></i>
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="stats-label">الأيام النشطة</span>
                        <span class="stats-value">٥/٧</span>
                    </div>

                    <div class="d-flex justify-content-between align-items-center">
                        <span class="stats-label">إجمالي الساعات</span>
                        <span class="stats-value">٤٠</span>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-md-8 col-lg-9">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="dashboard-header mb-0">الجدول الأسبوعي</h4>
                </div>

                <form action="{{ route('admin.schedule.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row g-3">
                        @php
                            $dayNames = [
                                'saturday' => 'السبت',
                                'sunday' => 'الأحد',
                                'monday' => 'الإثنين',
                                'tuesday' => 'الثلاثاء',
                                'wednesday' => 'الأربعاء',
                                'thursday' => 'الخميس',
                            ];
                            $scheduleMap = $days->keyBy('day_of_week');
                        @endphp

                        @foreach ($dayNames as $dayKey => $dayName)
                            @php
                                $day = $scheduleMap->get($dayKey);
                                $isActive = $day ? $day->is_active : false;
                            @endphp

                            <div class="col-12">
                                <div class="day-card {{ $isActive ? '' : 'disabled-day' }}">
                                    <div class="day-header">
                                        <h5 class="day-name">{{ $dayName }}</h5>
                                        <div class="form-check form-switch day-toggle">
                                            <input type="checkbox" class="form-check-input day-toggle-checkbox"
                                                id="toggle_{{ $dayKey }}"
                                                name="days[{{ $dayKey }}][is_active]" value="1"
                                                {{ $isActive ? 'checked' : '' }}>
                                        </div>
                                    </div>

                                    <div class="day-body">
                                        <div class="time-slot">
                                            <div class="row time-input-row">
                                                <div class="col-md-6">
                                                    <label class="time-label">وقت البدء</label>
                                                    <input type="time" class="form-control"
                                                        name="days[{{ $dayKey }}][start_time]"
                                                        value="{{ $day->start_time ?? '' }}"
                                                        {{ $isActive ? '' : 'disabled' }}>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="time-label">وقت الانتهاء</label>
                                                    <input type="time" class="form-control"
                                                        name="days[{{ $dayKey }}][end_time]"
                                                        value="{{ $day->end_time ?? '' }}"
                                                        {{ $isActive ? '' : 'disabled' }}>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="d-flex justify-content-between gap-3 p-3">
                        <button type="submit" class="add-time-btn" style="position: fixed; bottom: 5%; right: 25%;">
                            <i class="fas fa-plus ms-2"></i>حفظ الجدول
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <x-slot name="schedule_script">
        <script>
            document.querySelectorAll('.day-toggle-checkbox').forEach(toggle => {
                toggle.addEventListener('change', function() {
                    const card = this.closest('.day-card');
                    const timeInputs = card.querySelectorAll('input[type="time"]');

                    if (this.checked) {
                        card.classList.remove('disabled-day');
                        timeInputs.forEach(input => input.disabled = false);
                        this.value = 1;
                        this.name = `days[${this.id.replace('toggle_', '')}][is_active]`;
                        // Remove hidden input if exists
                        const hidden = card.querySelector('input[type="hidden"]');
                        if (hidden) hidden.remove();
                    } else {
                        card.classList.add('disabled-day');
                        timeInputs.forEach(input => input.disabled = true);
                        // Append hidden input for false value
                        const hidden = document.createElement('input');
                        hidden.type = 'hidden';
                        hidden.name = `days[${this.id.replace('toggle_', '')}][is_active]`;
                        hidden.value = 0;
                        card.appendChild(hidden);
                        this.removeAttribute('name'); // prevent duplicate key
                    }
                });
            });
        </script>
    </x-slot name="schedule_script">

</x-admin.layout>
