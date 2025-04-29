<x-public.layout>
    <x-slot name="appointment_confirm_css">
        <link rel="stylesheet" href="{{ asset('css/appointment_confirm.css') }}">
    </x-slot name="appointment_confirm_css">


    <div class="container">
        <div class="confirmation-card">
            <!-- Header -->
            <div class="confirmation-header">
                <div class="check-circle">
                    <i class="fa-solid fa-check"></i>
                </div>
                <h3>تم تأكيد موعدك بنجاح!</h3>
                <p class="mb-0">سنراك قريباً</p>
            </div>

            <!-- Body -->
            <div class="confirmation-body">
                <!-- Confirmation Number -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="me-auto confirmation-id">
                        <p class="text-muted mb-0">رقم التأكيد:</p>
                        <h5>APT-2025-0123#</h5>
                    </div>
                    <button class="btn btn-sm outline-btn">
                        <i class="fa-solid fa-print"></i>
                        طباعة تذكرتي
                    </button>
                </div>

                <!-- Doctor Info -->
                <div class="doctor-info">
                    <div class="text-end">
                        <p class="doctor-name">د. أحمد محمد</p>
                        <p class="doctor-specialty">أخصائي طب القلب</p>
                    </div>
                    <img src="https://placehold.co/100" class="doctor-image" alt="صورة الطبيب">
                </div>

                <!-- Appointment Details -->
                <div class="info-grid">
                    <div class="text-end">
                        <p class="info-label">التاريخ</p>
                        <p class="info-value">15 مارس 2025</p>
                    </div>
                    <div class="text-end">
                        <p class="info-label">الوقت</p>
                        <p class="info-value">02:30 مساءً</p>
                    </div>
                </div>

                <!-- Location -->
                <div class="location-block">
                    <p class="info-label">العنوان</p>
                    <p class="info-value">مركز الصحة الطبي، شارع الشهيد، الرياض</p>
                </div>

                <!-- Action Buttons -->
                <div class="action-buttons d-grid gap-2">
                    <button class="btn primary-btn">
                        <i class="fa-solid fa-calendar-plus me-2"></i>
                        إضافة إلى التقويم
                    </button>
                    <button class="btn outline-btn">
                        <i class="fa-solid fa-location-dot me-2"></i>
                        الاتجاهات
                    </button>
                </div>

                <!-- Preparation Instructions -->
                <div class="preparation-list">
                    <h5>تعليمات الحضور</h5>
                    <ul class="list-unstyled">
                        <li>
                            <i class="fa-solid fa-circle-info"></i>
                            يرجى الوصول قبل 15 دقيقة من موعدك
                        </li>
                        <li>
                            <i class="fa-solid fa-circle-info"></i>
                            إحضار بطاقة الهوية والتأمين الطبي
                        </li>
                        <li>
                            <i class="fa-solid fa-circle-info"></i>
                            تجنب وضع المكملات الغذائية قبل يومين
                        </li>
                    </ul>
                </div>

                <!-- Footer Actions -->
                <div class="footer-actions">
                    <a href="#">
                        <i class="fa-solid fa-phone"></i>
                        اتصل بنا
                    </a>
                    <a href="#">
                        <i class="fa-solid fa-pen-to-square"></i>
                        تعديل الموعد
                    </a>
                </div>
            </div>
        </div>
    </div>

</x-public.layout>
