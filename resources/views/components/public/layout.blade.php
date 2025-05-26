<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">

    {{-- landing styling --}}
    {{ $landing_css ?? '' }}

    {{-- book appointment styling --}}
    {{ $appointment_css ?? '' }}
    {{ $appointment_confirm_css ?? '' }}
    {{-- profile styling --}}
    {{ $profile_css ?? '' }}
    {{ $appointment_css ?? '' }}
</head>

<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <!-- User Dropdown -->
            <div class="dropdown">
                <button class="user-dropdown-btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="white"
                        class="bi bi-person" viewBox="0 0 16 16">
                        <path
                            d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z" />
                    </svg>
                </button>

                @guest
                <!-- Guest Mode Dropdown -->
                <ul class="dropdown-menu">
                    <li>
                        <a class="dropdown-item" href="{{ route('login') }}">
                            <i class="fas fa-sign-in-alt"></i>
                            تسجيل الدخول
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('register') }}">
                            <i class="fas fa-user-plus"></i>
                            إنشاء حساب
                        </a>
                    </li>
                </ul>
                @else
                <!-- Authenticated Mode Dropdown -->
                <ul class="dropdown-menu">
                    <li>
                        <a class="dropdown-item" href="{{ route('profile.show') }}">
                            <i class="fas fa-user"></i>
                            الملف الشخصي
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('appointments.index') }}">
                            <i class="fas fa-calendar-alt"></i>
                            المواعيد
                        </a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST" class="d-inline w-100">
                            @csrf
                            <button class="dropdown-item btn-link w-100 text-start" type="submit">
                                <i class="fas fa-sign-out-alt"></i>
                                تسجيل الخروج
                            </button>
                        </form>
                    </li>
                </ul>
                @endguest
            </div>

            <!-- Brand -->
            <a class="navbar-brand" href="{{ route('home') }}">عيادة د. اشتيوي </a>

            <!-- Mobile Toggle -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <i class="fa-solid fa-bars"></i>
            </button>

            <!-- Navigation Menu -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">الرئيسية</a>
                    </li>
                    @auth
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('appointments.*') ? 'active' : '' }}" href="{{ route('appointments.index') }}">المواعيد</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('profile.*') ? 'active' : '' }}" href="{{ route('profile.show') }}">الملف الشخصي</a>
                    </li>
                    @endauth
                    <li class="nav-item">
                        <a class="nav-link" href="#services">الخدمات</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">اتصل بنا</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    {{ $slot }}

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
