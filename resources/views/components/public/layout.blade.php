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
