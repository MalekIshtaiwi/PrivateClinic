<x-public.layout>

    <x-slot name="profile_css">
        <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    </x-slot name="profile_css">


    <header class="header">
        <h4 class="page-title">الملف الشخصي</h4>
    </header>

    <div class="profile-container">
        <!-- Personal Information Card -->
        <div class="card">
            <div class="card-body">
                <div class="profile-header">
                    <div class="profile-avatar">
                        <img src="https://placehold.co/150x150/aecfd0/fff?text=أحمد" alt="صورة الملف الشخصي">
                    </div>
                    <div>
                        <h5 class="profile-name">أحمد محمد</h5>
                        <div class="profile-id">ID: 123456</div>
                    </div>
                </div>

                <form>
                    <div class="form-group">
                        <label class="form-label">الاسم الكامل</label>
                        <input type="text" class="form-control" value="أحمد محمد" readonly>
                    </div>

                    <div class="form-group">
                        <label class="form-label">البريد الإلكتروني</label>
                        <input type="email" class="form-control" value="ahmed@example.com" readonly>
                    </div>

                    <div class="form-group">
                        <label class="form-label">رقم الهاتف</label>
                        <div class="input-with-button">
                            <input type="tel" class="form-control" value="+966 50 123 4567" readonly>
                            <button class="verify-button">تحقق</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>





        <!-- Medical Records Card -->
        <div class="card">
            <div class="expandable-item">
                <div class="d-flex align-items-center">
                    <i class="fa-regular fa-clipboard expandable-item-icon"></i>
                    <span class="expandable-item-title">سجل الزيارات</span>
                </div>
                <i class="fa-solid fa-chevron-left chevron-icon"></i>
            </div>

            <div class="expandable-item">
                <div class="d-flex align-items-center">
                    <i class="fa-regular fa-file-lines expandable-item-icon"></i>
                    <span class="expandable-item-title">التقارير الطبية</span>
                </div>
                <i class="fa-solid fa-chevron-left chevron-icon"></i>
            </div>
        </div>
    </div>

</x-public.layout>
