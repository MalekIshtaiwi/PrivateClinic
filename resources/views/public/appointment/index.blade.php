<x-public.layout>
    <x-slot name="appointments_css">
        <link rel="stylesheet" href="{{ asset('css/appointments.css') }}">
    </x-slot name="appointments_css">


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
                        <div class="calendar-nav">
                            <button type="button"><i class="fa-solid fa-chevron-right"></i></button>
                        </div>
                        <h4>فبراير 2025</h4>
                        <div class="calendar-nav">
                            <button type="button"><i class="fa-solid fa-chevron-left"></i></button>
                        </div>
                    </div>

                    <!-- Calendar Days Header -->
                    <div class="calendar-grid">
                        <div class="calendar-day-header">س</div>
                        <div class="calendar-day-header">ج</div>
                        <div class="calendar-day-header">خ</div>
                        <div class="calendar-day-header">ر</div>
                        <div class="calendar-day-header">ث</div>
                        <div class="calendar-day-header">ن</div>
                        <div class="calendar-day-header">ح</div>

                        <!-- Previous Month -->
                        <div class="calendar-day other-month">30</div>
                        <div class="calendar-day other-month">31</div>

                        <!-- Current Month -->
                        <div class="calendar-day today">1</div>
                        <div class="calendar-day">2</div>
                        <div class="calendar-day">3</div>
                        <div class="calendar-day selected">4</div>
                        <div class="calendar-day">5</div>
                    </div>

                    <!-- Time Slots -->
                    <h6 class="time-header">الأوقات المتاحة:</h6>
                    <div class="time-slots">
                        <button class="time-slot">9:00</button>
                        <button class="time-slot">9:30</button>
                        <button class="time-slot">10:00</button>
                        <button class="time-slot">10:30</button>
                        <button class="time-slot">11:00</button>
                        <button class="time-slot">11:30</button>
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

                        <div class="form-group">
                            <label class="form-label">طريقة الدفع:</label>

                            <div class="payment-option selected">
                                <div class="locked-icon">
                                    <i class="fa-solid fa-lock"></i>
                                </div>
                                <div>بطاقة الائتمان</div>
                                <div class="payment-icon">
                                    <i class="fa-solid fa-credit-card"></i>
                                </div>
                            </div>

                            <div class="payment-option">
                                <div class="locked-icon">
                                    <i class="fa-solid fa-lock"></i>
                                </div>
                                <div>Apple Pay</div>
                                <div class="payment-icon">
                                    <i class="fa-brands fa-apple-pay"></i>
                                </div>
                            </div>
                        </div>

                        <button class="btn btn-confirm">تأكيد الحجز</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-public.layout>
