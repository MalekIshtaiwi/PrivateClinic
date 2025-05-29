<x-admin.layout>
    <x-slot name="dashboard_css">
        <link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
    </x-slot name="dashboard_css">

    <div class="container-fluid py-4">
        <!-- Stats Cards -->
        <div class="row mb-4">
            <div class="col-md-4 mb-3">
                <div class="stats-card p-3">
                    <div class="d-flex align-items-center">
                        <div class="stats-icon appointments me-3">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div>
                            <div class="card-title">المواعيد القادمة</div>
                            <div class="card-value">{{ $upcomingAppointments }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="stats-card p-3">
                    <div class="d-flex align-items-center">
                        <div class="stats-icon today me-3">
                            <i class="fas fa-calendar-day"></i>
                        </div>
                        <div>
                            <div class="card-title">مواعيد اليوم</div>
                            <div class="card-value">{{ $todayAppointments }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons and Schedule -->
        <div class="row mb-4">
            <!-- Quick Actions Column -->
            <div class="col-md-4 mb-3">
                <h5 class="mb-3">إجراءات سريعة</h5>
                <div class="row row-cols-2 g-3">
                    <div class="col">
                        <div class="action-card p-3">
                            <div class="action-icon">
                                <i class="fas fa-calendar-plus"></i>
                            </div>
                            <div class="action-text">موعد جديد</div>
                        </div>
                    </div>
                    <a href="{{ route('admin.patients.create') }}" style="text-decoration: none; color: inherit;">
                        <div class="col">
                            <div class="action-card p-3" style="cursor: pointer;">
                                <div class="action-icon">
                                    <i class="fas fa-user-plus"></i>
                                </div>
                                <div class="action-text">مريض جديد</div>
                            </div>
                        </div>
                    </a>

                </div>
            </div>

            <!-- Schedule Column -->
            <div class="col-md-8">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5>جدول اليوم</h5>
                </div>
                <div class="schedule-card p-3">
                    @forelse($todaySchedule as $appointment)
                        <form action="{{ route('admin.patients.show', $appointment->patient->id) }}" method="GET"
                            class="appointment-form">
                            <div class="appointment-item appointment-{{ $appointment->status }} appointment-clickable"
                                onclick="this.closest('form').submit();" style="cursor: pointer;">
                                <div class="row align-items-center">
                                    <div class="col-md-2 col-3">
                                        <div class="appointment-time">
                                            {{ \Carbon\Carbon::parse($appointment->time)->format('H:i') }}</div>
                                    </div>
                                    <div class="col-md-7 col-6">
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <div class="appointment-name">{{ $appointment->patient->name }}</div>
                                                <div class="appointment-type">
                                                    {{ $appointment->visit_type == 'first' ? 'زيارة أولى' : 'زيارة متابعة' }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-3 text-end">
                                        <span class="badge badge-{{ $appointment->status }} rounded-pill">
                                            @if ($appointment->status == 'booked')
                                                محجوز
                                            @elseif($appointment->status == 'cancelled')
                                                ملغي
                                            @else
                                                منتهي
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </form>
                    @empty
                        <div class="text-center text-muted py-4">
                            <i class="fas fa-calendar-times fa-2x mb-2"></i>
                            <p>لا توجد مواعيد لهذا اليوم</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-admin.layout>
