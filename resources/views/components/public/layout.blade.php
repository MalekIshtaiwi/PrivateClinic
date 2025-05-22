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
                <div class="btn-group" style="background-color: #aecfd0; border-radius: 50%; height: 3rem;">
                    <button class="btn " type="button" data-bs-toggle="dropdown" aria-expanded="false" style="display: flex; justify-content: center; align-items: center;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="white"
                            class="bi bi-person" viewBox="0 0 16 16">
                            <path
                                d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z" />
                        </svg>
                    </button>
                    <ul class="dropdown-menu" style="height: 10rem; width: 5rem;">
                        <li><a class="dropdown-item" href="#">Menu item</a></li>
                        <li><a class="dropdown-item" href="#">Menu item</a></li>
                        <li><a class="dropdown-item" href="#">Menu item</a></li>
                    </ul>
                </div>
                <a class="navbar-brand" href="/appointments">الملف الشخصي</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <i class="fa-solid fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link active" href="/">الرئيسية</a>
                        </li>
                        <li class="nav-item">
                            @auth
                                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button class="nav-link btn btn-link" type="submit">تسجيل الخروج</button>
                                </form>
                            @endauth

                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        {{ $slot }}
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>

    </html>
