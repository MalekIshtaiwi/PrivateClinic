<x-public.layout>
    <link rel="stylesheet" href="{{ asset('css/appointments.css') }}">

        <!-- Header -->
        <header class="header">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center">
                    <h2 class="page-title">سجل المواعيد</h2>
                </div>
            </div>
        </header>

        <div class="container">
            <!-- Filters and Search -->
            <div class="search-filter-container d-flex gap-3 align-items-center">

                <div class="dropdown">
                    <button class="filter-select dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        اسم المريض                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">الكل</a></li>
                        <li><a class="dropdown-item" href="#">د. سارة خالد</a></li>
                        <li><a class="dropdown-item" href="#">د. أحمد محمد</a></li>
                        <li><a class="dropdown-item" href="#">د. ليلى عمر</a></li>
                    </ul>
                </div>
            </div>

            <!-- Appointments List -->
            <div class="appointments-list">
                <!-- Appointment 1 -->
                <div class="appointment-card">
                    <div class="d-flex">
                        <div class="calendar-icon-container blue-calendar">
                            <i class="fa-solid fa-calendar-day"></i>
                        </div>

                        <div class="flex-grow-1">
                            <div class="appointment-header">
                                <div>
                                    <h5 class="doctor-name">د. سارة خالد - طب عام</h5>
                                    <div class="doctor-specialty">15 مارس 2025 - 10:30 صباحاً</div>
                                </div>

                                <div class="d-flex align-items-center">
                                    <span class="status-pill status-upcoming">قادم</span>
                                    <div class="appointment-actions ms-2">
                                        <button class="action-btn">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                        <button class="action-btn">
                                            <i class="fa-solid fa-xmark"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <button class="view-details-btn">
                                <i class="fa-solid fa-chevron-down"></i>
                                عرض التفاصيل
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Appointment 2 -->
                <div class="appointment-card">
                    <div class="d-flex">
                        <div class="calendar-icon-container green-calendar">
                            <i class="fa-solid fa-calendar-day"></i>
                        </div>

                        <div class="flex-grow-1">
                            <div class="appointment-header">
                                <div>
                                    <h5 class="doctor-name">د. أحمد محمد - أسنان</h5>
                                    <div class="doctor-specialty">10 مارس 2025 - 2:00 مساءً</div>
                                </div>

                                <div class="d-flex align-items-center">
                                    <span class="status-pill status-completed">مكتمل</span>
                                    <div class="appointment-actions ms-2">
                                        <button class="action-btn">
                                            <i class="fa-solid fa-eye"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <a href="#" class="view-prescription-btn">
                                عرض الوصفة الطبية
                                <i class="fa-solid fa-file-prescription"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Appointment 3 -->
                <div class="appointment-card">
                    <div class="d-flex">
                        <div class="calendar-icon-container red-calendar">
                            <i class="fa-solid fa-calendar-day"></i>
                        </div>

                        <div class="flex-grow-1">
                            <div class="appointment-header">
                                <div>
                                    <h5 class="doctor-name">د. ليلى عمر - جلدية</h5>
                                    <div class="doctor-specialty">5 مارس 2025 - 11:15 صباحاً</div>
                                </div>

                                <div class="d-flex align-items-center">
                                    <span class="status-pill status-cancelled">ملغي</span>
                                    <div class="appointment-actions ms-2">
                                        <button class="action-btn">
                                            <i class="fa-solid fa-rotate"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</x-public.layout>
