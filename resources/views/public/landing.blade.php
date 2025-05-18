<x-public.layout>
    <x-slot name="landing_css">
        <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
    </x-slot name="landing_css">

    <!-- Hero Section -->
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
                        <img src="https://scontent.famm10-1.fna.fbcdn.net/v/t39.30808-6/481056437_3760030710884220_3804395651611651775_n.jpg?_nc_cat=107&ccb=1-7&_nc_sid=127cfc&_nc_eui2=AeG07mvtZI7yyp20fUT8gqBEyNYHdk45CBvI1gd2TjkIG8WMcdNexTfyEjwCbECWcuSDSBkJfX-RDV-byhUoglUR&_nc_ohc=1e7KGfKHOCQQ7kNvwGJB6Uz&_nc_oc=AdkgudqXki0JacJHddZ9dWzXseVnjcWgGKsVi1DXbV57i8UF1O9zBDPd7wbMUF2VxGg&_nc_zt=23&_nc_ht=scontent.famm10-1.fna&_nc_gid=L6yvHXuse0UXs-JxM1FwBg&oh=00_AfGOwxKfoEydNgzvwKZuoUFTiXfCIaL0MAlm22Feq72m9Q&oe=68095069"
                            alt="صورة الدكتور">
                    </div>
                    <form action="" method="GET">
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
    <section class="feature-section">
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
    <!-- Contact Section (Optional) -->
    <div class="contact-container">
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
                            <div>+966 123 456 789</div>
                            <div class="text-muted">من الأحد إلى الخميس • الساعة 9 - 6 مساءً</div>
                        </div>
                        <div class="icon">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="contact-info-item">
                        <div class="contact-info-text">
                            <div>info@yourclinic.com</div>
                        </div>
                        <div class="icon">
                            <i class="fa-solid fa-envelope"></i>
                        </div>
                    </div>

                    <!-- Address -->
                    <div class="contact-info-item">
                        <div class="contact-info-text">
                            <div>شارع الشهيد، الرياض، المملكة العربية السعودية</div>
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

</x-public.layout>
