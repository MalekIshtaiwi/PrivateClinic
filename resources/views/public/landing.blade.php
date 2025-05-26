<x-public.layout>
    <x-slot name="landing_css">
        <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
    </x-slot name="landing_css">

    <!-- Hero Section -->
    @if (session('message'))
        <div id="flash-message"
            style="
            position: fixed;
            bottom: 10%;
            right: 10%;
            background-color: #FEE2E2; /* light red */
            color: #B91C1C;           /* red text */
            padding: 12px 24px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(185, 28, 28, 0.3);
            z-index: 9999;
            opacity: 1;
            transition: opacity 0.5s ease;
            font-weight: 600;
            font-family: Arial, sans-serif;
        ">
            {{ session('message') }}
        </div>
    @endif

    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 hero-content">
                    <div class="doctor-info ">
                        <h2> د.اشتيوي أبو زايد</h2>
                        <h4>استشاري الطب العام والباطنة</h4>
                        <p>خبرة تزيد عن 15 عاماً في مجال الطب العام والباطنة. يعمل في عيادات عالمية من أجل خدمات الصحية
                            المثلى.</p>
                    </div>
                    <div class="doctor-image">
                        <img  src="{{ asset('images/doctor.jpeg') }}"
                            alt="صورة الدكتور">
                    </div>
                    <form action="/appointments" method="GET">
                        <button class="cta-btn" type="submit">
                            حجز موعد
                        </button>
                    </form>
                </div>
                <div class="col-lg-6">
                    <div class="clinic-image">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d211.7740250704349!2d35.928474775587624!3d31.86896288234947!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sjo!4v1745043635692!5m2!1sen!2sjo"
                            width="650" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section (Optional) -->
    <section class="feature-section" id="services">
        <div class="container">
            <div class="section-title">
                <h2>خدمات العيادة</h2>
            </div>

            <div class="row">
                <div class="col-md-6 mb-6">
                    <div class="card border-0 h-100 p-4 text-center" style="background-color: var(--color-lightest);">
                        <div class="text-center mb-3">
                            <i class="fa-solid fa-stethoscope fa-3x" style="color: var(--color-darkest);"></i>
                        </div>
                        <h4 class="card-title mb-3">فحوصات شاملة</h4>
                        <p class="card-text">نقدم فحوصات طبية شاملة باستخدام أحدث التقنيات والأجهزة الطبية</p>
                    </div>
                </div>

                <div class="col-md-6 mb-6">
                    <div class="card border-0 h-100 p-4 text-center" style="background-color: var(--color-lightest);">
                        <div class="text-center mb-3">
                            <i class="fa-solid fa-calendar-check fa-3x" style="color: var(--color-darkest);"></i>
                        </div>
                        <h4 class="card-title mb-3">حجز مواعيد سهل</h4>
                        <p class="card-text">يمكنك حجز موعدك بسهولة عبر الموقع الإلكتروني أو تطبيق الهاتف</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <div class="contact-container" id="contact">
        <header class="page-header">
            <h2>تواصل معنا</h2>
        </header>
        <div class="row">
            <!-- Contact Form Column -->
            <div class="col-md-6">
                <div class="contact-form-card">
                    <form>
                        <div class="mb-3">
                            <label for="fullName" class="form-label">الاسم الكامل</label>
                            <input type="text" class="form-control" id="fullName">
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">البريد الإلكتروني</label>
                            <input type="email" class="form-control" id="email">
                        </div>

                        <div class="mb-3">
                            <label for="subject" class="form-label">الموضوع</label>
                            <input type="text" class="form-control" id="subject">
                        </div>

                        <div class="mb-3">
                            <label for="message" class="form-label">الرسالة</label>
                            <textarea class="form-control" id="message"></textarea>
                        </div>

                        <button type="submit" class="btn btn-submit">إرسال الرسالة</button>
                    </form>
                </div>
            </div>

            <!-- Contact Info Column -->
            <div class="col-md-6">
                <div class="contact-info-card">
                    <h4 class="contact-info-title">معلومات الاتصال</h4>

                    <!-- Phone -->
                    <div class="contact-info-item">
                        <div class="contact-info-text">
                            <div>07 9600 8297</div>
                            <div class="text-muted">من السبت إلى الخميس • الساعة 9 - 3 مساءً</div>
                        </div>
                        <div class="icon">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="contact-info-item">
                        <div class="contact-info-text">
                            <div>ishtaiweabuzayed@gmail.com</div>
                        </div>
                        <div class="icon">
                            <i class="fa-solid fa-envelope"></i>
                        </div>
                    </div>

                    <!-- Address -->
                    <div class="contact-info-item">
                        <div class="contact-info-text">
                            <div>شارع مادبا، مجمع حبيبة ط.2، عمان</div>
                        </div>
                        <div class="icon">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                    </div>

                    <!-- Social Media Section -->
                    <h5 class="social-title">تابعنا على</h5>
                    <div class="social-icons">
                        <a href="#" class="social-icon"><i class="fa-brands fa-facebook"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        setTimeout(() => {
            const msg = document.getElementById('flash-message');
            if (msg) {
                msg.style.opacity = '0';
                setTimeout(() => msg.remove(), 500); // Clean up after fade
            }
        }, 3000); // Fade out after 3 seconds
    </script>

</x-public.layout>
