<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin/layout.css') }}">

    {{ $dashboard_css ?? '' }}
    {{ $appointments_css ?? '' }}
    {{ $schedule_css ?? '' }}
    {{ $patient_css ?? '' }}
    {{ $edit_patient_css ?? '' }}
    {{ $create_patient_css ?? '' }}

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                عيادة د.اشتيوي
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('admin.dashboard') }}">الرئيسية</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.patients.index') }}">المرضى</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.appointments') }}">المواعيد</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.schedule') }}">الجدول الإسبوعي</a>
                    </li>
                </ul>
                <form action="{{ route('admin.logout') }}" method="POST" class="d-flex">
                    @csrf
                    <div class="position-relative">
                        <input class="form-control search-box" type="search" placeholder="بحث عن المريض..."
                            aria-label="Search">
                        <button type="submit" class="nav-link">تسجيل الخروج</button>

                    </div>
                </form>
            </div>
        </div>
    </nav>
    {{ $slot }}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    {{ $schedule_script ?? '' }}
    {{ $patients_script ?? '' }}
    {{ $edit_patient_script ?? '' }}
    {{ $create_patient_script ?? '' }}
</body>

</html>
