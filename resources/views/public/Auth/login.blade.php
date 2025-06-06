<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول - منصة الرعاية الصحية</title>
    <!-- Bootstrap RTL CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --color-lightest: #deebec;
            --color-light: #bed9dd;
            --color-medium: #aecfd0;
            --color-dark: #73b3b2;
            --color-darkest: #3c979f;
        }

        body {
            background-color: var(--color-lightest);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-container {
            width: 100%;
            max-width: 900px;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            background-color: white;
            display: flex;
        }

        .login-form {
            flex: 1;
            padding: 2.5rem;
            position: relative;
        }

        .login-sidebar {
            flex: 0.8;
            background-color: var(--color-medium);
            padding: 2.5rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .steps {
            display: flex;
            justify-content: center;
            margin-bottom: 2.5rem;
        }

        .step {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: var(--color-light);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            margin: 0 0.75rem;
            position: relative;
        }

        .step.active {
            background-color: var(--color-darkest);
        }

        .step-label {
            position: absolute;
            top: 45px;
            font-size: 0.85rem;
            white-space: nowrap;
            color: #6c757d;
        }

        .step::after {
            content: '';
            position: absolute;
            right: 40px;
            width: 40px;
            height: 2px;
            background-color: var(--color-light);
        }

        .step:first-child::after {
            display: none;
        }

        .login-heading {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .login-heading h3 {
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .login-heading p {
            color: #6c757d;
        }

        .form-label {
            font-weight: 600;
            color: #495057;
        }

        .form-control {
            padding: 0.75rem 1rem;
            border-radius: 8px;
        }

        .form-control:focus {
            border-color: var(--color-dark);
            box-shadow: 0 0 0 0.2rem rgba(60, 151, 159, 0.25);
        }

        .btn-primary {
            background-color: var(--color-darkest);
            border-color: var(--color-darkest);
            padding: 0.75rem 1rem;
            font-weight: 600;
            border-radius: 8px;
        }

        .btn-primary:hover {
            background-color: #34868d;
            border-color: #34868d;
        }

        .security-note {
            background-color: var(--color-lightest);
            border-radius: 8px;
            padding: 1rem;
            margin-top: 1.5rem;
            display: flex;
            align-items: center;
        }

        .security-note i {
            color: var(--color-darkest);
            font-size: 1.2rem;
            margin-left: 0.75rem;
        }

        .help-text {
            text-align: center;
            margin-top: 2rem;
            color: #6c757d;
        }

        .help-link {
            color: var(--color-darkest);
            text-decoration: none;
            font-weight: 500;
        }

        .help-link:hover {
            text-decoration: underline;
        }

        .feature-item {
            display: flex;
            align-items: center;
            margin-bottom: 1.5rem;
            color: white;
            text-align: right;
        }

        .feature-item i {
            background-color: rgba(255, 255, 255, 0.2);
            color: white;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-left: 1rem;
            font-size: 1rem;
        }

        .feature-item h5 {
            margin-bottom: 0;
            font-size: 1rem;
            font-weight: 600;
            color: #fff;
        }

        .sidebar-logo {
            margin-bottom: 2.5rem;
            color: white;
        }

        .sidebar-logo i {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .sidebar-logo h3 {
            font-weight: 600;
        }

        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
            }

            .login-sidebar {
                padding: 2rem 1rem;
            }

            .steps {
                margin-top: 0.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <!-- Login Form Side -->
        <div class="login-form">

            <!-- Login Form Heading -->
            <div class="login-heading">
                <h3>تسجيل الدخول</h3>
                <p>أدخل رقم هاتفك للمتابعة</p>
            </div>

            <!-- Phone Number Form -->
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="email" class="form-label">الإيميل</label>
                    <input name="email" type="email" class="form-control" id="email" placeholder="example@gmail.com" dir="ltr" value="{{ old('email') }}">
                </div>
                <div class="mb-4">
                    <label for="password" class="form-label">كلمة المرور</label>
                    <input name="password" type="password" class="form-control" id="password" placeholder="********"  dir="ltr" value="{{ old('password') }}">
                </div>
                <div>
                    <p style="color: red;"> @error('error')
                        {{ $message }}

                    @enderror</p>
                </div>
                <button type="submit" class="btn btn-primary w-100">تسجيل الدخول</button>
            </form>

            <!-- Security Note -->
            <div class="security-note">
                <div>نحن نحافظ على خصوصية بياناتك وأمنها وفقاً لأعلى معايير الأمان العالمية</div>
                <i class="fa-solid fa-shield-halved"></i>
            </div>

            <!-- Help Text -->
            <div class="help-text">
                <p>لا تملك حساب ؟<a href="{{ route('register') }}" class="help-link">التسجيل</a></p>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="login-sidebar">
            <!-- Logo -->
            <div class="sidebar-logo">
                <i class="fa-solid fa-hospital"></i>
                <h3>عيادة د. اشتيوي</h3>
            </div>

            <!-- Features -->
            <div class="features">
                <div class="feature-item">
                    <div>
                        <h5>حجز المواعيد الطبية بسهولة وسرعة</h5>
                    </div>
                    <i class="fa-solid fa-calendar-check"></i>
                </div>


                <div class="feature-item">
                    <div>
                        <h5>سجلك الطبي في مكان واحد</h5>
                    </div>
                    <i class="fa-solid fa-notes-medical"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
