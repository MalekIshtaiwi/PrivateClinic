<x-admin.layout>

    <x-slot name="schedule_css">
        <link rel="stylesheet" href="{{ asset('css/admin/schedule.css') }}">
    </x-slot name="schedule_css">
        <!-- Main Content -->
        <div class="container main-container">
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
                    <div class="d-flex justify-content-between gap-3 p-3">
                        <button type="button" class="btn btn-appointment" data-bs-toggle="modal"
                            data-bs-target="#appointmentModal">
                            إضافة يوم
                        </button>
                        <button type="button" class="btn btn-appointment">
                            حفظ الجدول
                        </button>
                    </div>

                </div>

                <!-- Main Content -->
                <div class="col-md-8 col-lg-9">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="dashboard-header mb-0">الجدول الأسبوعي</h4>
                        <button class="add-time-btn">
                            <i class="fas fa-plus ms-2"></i>إضافة مناوبة
                        </button>
                    </div>

                    <div class="row g-3">
                        <!-- Monday -->
                        <div class="col-12">
                            <div class="day-card">
                                <div class="day-header">
                                    <h5 class="day-name">الإثنين</h5>
                                    <div class="form-check form-switch day-toggle">
                                        <input class="form-check-input" type="checkbox" id="monday-toggle" checked>
                                    </div>
                                </div>
                                <div class="day-body">
                                    <div class="time-slot">
                                        <i class="fas fa-edit edit-time"></i>
                                        <div class="row time-input-row">
                                            <div class="col-md-6 time-input-col">
                                                <label class="time-label">وقت البدء</label>
                                                <input type="time" class="form-control" value="09:00">
                                            </div>
                                            <div class="col-md-6 time-input-col">
                                                <label class="time-label">وقت الانتهاء</label>
                                                <input type="time" class="form-control" value="12:00">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="time-slot">
                                        <i class="fas fa-edit edit-time"></i>
                                        <div class="row time-input-row">
                                            <div class="col-md-6 time-input-col">
                                                <label class="time-label">Start Time</label>
                                                <input type="time" class="form-control" value="14:00">
                                            </div>
                                            <div class="col-md-6 time-input-col">
                                                <label class="time-label">End Time</label>
                                                <input type="time" class="form-control" value="17:00">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Modal-->
        <div class="modal fade" id="appointmentModal" tabindex="-1" aria-labelledby="appointmentModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="appointmentModalLabel">حدد موعدًا</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="month-navigation">
                            <button class="nav-arrow">&#10094;</button>
                            <div class="month-title">مايو 2025</div>
                            <button class="nav-arrow">&#10095;</button>
                        </div>

                        <div class="days-container">
                            <div class="day-names">
                                <div class="day-name">أحد</div>
                                <div class="day-name">إثنين</div>
                                <div class="day-name">ثلاثاء</div>
                                <div class="day-name">أربعاء</div>
                                <div class="day-name">خميس</div>
                                <div class="day-name">جمعة</div>
                                <div class="day-name">سبت</div>
                            </div>

                            <div class="day-box">
                                <div>أحد</div>
                                <div class="day-number">4</div>
                            </div>
                            <div class="day-box selected">
                                <div>إثنين</div>
                                <div class="day-number">5</div>
                            </div>
                            <div class="day-box">
                                <div>ثلاثاء</div>
                                <div class="day-number">6</div>
                            </div>
                            <div class="day-box">
                                <div>أربعاء</div>
                                <div class="day-number">7</div>
                            </div>
                            <div class="day-box">
                                <div>خميس</div>
                                <div class="day-number">8</div>
                            </div>
                            <div class="day-box">
                                <div>جمعة</div>
                                <div class="day-number">9</div>
                            </div>
                            <div class="day-box">
                                <div>سبت</div>
                                <div class="day-number">10</div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-confirm">تأكيد الموعد</button>
                        <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">إلغاء</button>
                    </div>
                </div>
            </div>
        </div>

        <x-slot name="schedule_script">
            <link rel="stylesheet" href="{{ asset('js/admin/schedule.js') }}">
        </x-slot name="schedule_script">
</x-admin.layout>
