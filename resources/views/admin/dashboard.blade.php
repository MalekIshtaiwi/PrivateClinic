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
                        <div class="stats-icon patients me-3">
                            <i class="fas fa-user-friends"></i>
                        </div>
                        <div>
                            <div class="card-title">سجل المرضى</div>
                            <div class="card-value">1,247</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="stats-card p-3">
                    <div class="d-flex align-items-center">
                        <div class="stats-icon appointments me-3">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div>
                            <div class="card-title">المواعيد القادمة</div>
                            <div class="card-value">156</div>
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
                            <div class="card-value">24</div>
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
                    <div class="col">
                        <div class="action-card p-3">
                            <div class="action-icon">
                                <i class="fas fa-user-plus"></i>
                            </div>
                            <div class="action-text">مريض جديد</div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="action-card p-3">
                            <div class="action-icon">
                                <i class="fas fa-prescription-bottle-alt"></i>
                            </div>
                            <div class="action-text">وصفة طبية</div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="action-card p-3">
                            <div class="action-icon">
                                <i class="fas fa-file-medical"></i>
                            </div>
                            <div class="action-text">تقرير طبي</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Schedule Column -->
            <div class="col-md-8">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5>جدول اليوم</h5>
                    <button class="btn add-appointment-btn btn-sm">
                        <i class="fas fa-plus me-1"></i> موعد جديد
                    </button>
                </div>
                <div class="schedule-card p-3">
                    <!-- Appointment Item 1 -->
                    <div class="appointment-item appointment-confirmed">
                        <div class="row align-items-center">
                            <div class="col-md-2 col-3">
                                <div class="appointment-time">09:00</div>
                            </div>
                            <div class="col-md-7 col-6">
                                <div class="d-flex align-items-center">
                                    <img src="/api/placeholder/36/36" class="avatar me-2" alt="صورة المريض">
                                    <div>
                                        <div class="appointment-name">فاطمة أحمد</div>
                                        <div class="appointment-type">فحص دوري</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-3 text-end">
                                <span class="badge badge-confirmed rounded-pill">مؤكد</span>
                            </div>
                        </div>
                    </div>

                    <!-- Appointment Item 2 -->
                    <div class="appointment-item appointment-waiting">
                        <div class="row align-items-center">
                            <div class="col-md-2 col-3">
                                <div class="appointment-time">10:30</div>
                            </div>
                            <div class="col-md-7 col-6">
                                <div class="d-flex align-items-center">
                                    <img src="/api/placeholder/36/36" class="avatar me-2" alt="صورة المريض">
                                    <div>
                                        <div class="appointment-name">محمد خالد</div>
                                        <div class="appointment-type">استشارة</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-3 text-end">
                                <span class="badge badge-waiting rounded-pill">في الانتظار</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin.layout>
