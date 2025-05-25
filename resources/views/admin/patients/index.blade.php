<x-admin.layout>
    <x-slot name="patient_css">
        <link rel="stylesheet" href="{{ asset('css/admin/patients.css') }}">
    </x-slot>

    <div class="patients-container">
        <div class="page-header">
            <div class="header-content">
                <h1 class="page-title">
                    <i class="fas fa-users"></i>
                    إدارة المرضى
                </h1>
                <p class="page-subtitle">عرض وإدارة بيانات جميع المرضى</p>
            </div>
            <div class="header-actions">
                <a href="{{ route('admin.patients.create') }}" class="btn btn-primary add-patient-btn">
                    <i class="fas fa-plus"></i>
                    إضافة مريض جديد
                </a>
            </div>
        </div>

        <div class="patients-stats">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-content">
                    <h3>{{ $patients->count() }}</h3>
                    <p>إجمالي المرضى</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon male">
                    <i class="fas fa-male"></i>
                </div>
                <div class="stat-content">
                    <h3>{{ $patients->where('gender', 'male')->count() }}</h3>
                    <p>ذكور</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon female">
                    <i class="fas fa-female"></i>
                </div>
                <div class="stat-content">
                    <h3>{{ $patients->where('gender', 'female')->count() }}</h3>
                    <p>إناث</p>
                </div>
            </div>
        </div>

        <div class="patients-table-container">
            <div class="table-header">
                <div class="table-title">
                    <h3>قائمة المرضى</h3>
                </div>
                <div class="table-filters">
                    <div class="filter-group">
                        <select class="form-select filter-select" id="genderFilter">
                            <option value="">جميع الأجناس</option>
                            <option value="male">ذكر</option>
                            <option value="female">أنثى</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <select class="form-select filter-select" id="statusFilter">
                            <option value="">جميع الحالات</option>
                            <option value="married">متزوج</option>
                            <option value="single">أعزب</option>
                            <option value="other">أخرى</option>
                        </select>
                    </div>
                </div>
            </div>

            @if($patients->count() > 0)
                <div class="table-responsive">
                    <table class="table patients-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>اسم المريض</th>
                                <th>العمر</th>
                                <th>الجنس</th>
                                <th>الحالة الاجتماعية</th>
                                <th>تاريخ التسجيل</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($patients as $index => $patient)
                                <tr class="patient-row" data-gender="{{ $patient->gender }}" data-status="{{ $patient->status }}">
                                    <td class="patient-id">{{ $index + 1 }}</td>
                                    <td class="patient-name">
                                        <a href="{{ route('admin.patients.show', $patient->id) }}" class="name-link">
                                            <div class="patient-avatar">
                                                <i class="fas fa-user"></i>
                                            </div>
                                            <span>{{ $patient->name }}</span>
                                        </a>
                                    </td>
                                    <td class="patient-age">
                                        @if($patient->age)
                                            <span class="age-badge">{{ $patient->age }} سنة</span>
                                        @else
                                            <span class="no-data">غير محدد</span>
                                        @endif
                                    </td>
                                    <td class="patient-gender">
                                        <span class="gender-badge {{ $patient->gender }}">
                                            <i class="fas fa-{{ $patient->gender == 'male' ? 'male' : 'female' }}"></i>
                                            {{ $patient->gender == 'male' ? 'ذكر' : 'أنثى' }}
                                        </span>
                                    </td>
                                    <td class="patient-status">
                                        @if($patient->status)
                                            <span class="status-badge {{ $patient->status }}">
                                                @switch($patient->status)
                                                    @case('married')
                                                        متزوج
                                                        @break
                                                    @case('single')
                                                        أعزب
                                                        @break
                                                    @case('other')
                                                        أخرى
                                                        @break
                                                @endswitch
                                            </span>
                                        @else
                                            <span class="no-data">غير محدد</span>
                                        @endif
                                    </td>
                                    <td class="patient-date">
                                        <span class="date-text">{{ $patient->created_at->format('Y/m/d') }}</span>
                                        <small class="time-text">{{ $patient->created_at->format('H:i') }}</small>
                                    </td>
                                    <td class="patient-actions">
                                        <div class="action-buttons">
                                            <a href="{{ route('admin.patients.show', $patient->id) }}"
                                               class="btn btn-sm btn-outline-primary"
                                               title="عرض التفاصيل">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.patients.edit',$patient->id) }}" class="btn btn-sm btn-outline-secondary"
                                                    title="تعديل">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button class="btn btn-sm btn-outline-danger"
                                                    title="حذف">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="fas fa-user-slash"></i>
                    </div>
                    <h3>لا يوجد مرضى مسجلين</h3>
                    <p>لم يتم تسجيل أي مرضى في النظام بعد</p>
                    <button class="btn btn-primary">
                        <i class="fas fa-plus"></i>
                        إضافة أول مريض
                    </button>
                </div>
            @endif
        </div>
    </div>

    <x-slot name="patients_script">
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Filter functionality
                const genderFilter = document.getElementById('genderFilter');
                const statusFilter = document.getElementById('statusFilter');
                const patientRows = document.querySelectorAll('.patient-row');

                function filterPatients() {
                    const selectedGender = genderFilter.value;
                    const selectedStatus = statusFilter.value;

                    patientRows.forEach(row => {
                        const patientGender = row.dataset.gender;
                        const patientStatus = row.dataset.status;

                        const genderMatch = !selectedGender || patientGender === selectedGender;
                        const statusMatch = !selectedStatus || patientStatus === selectedStatus;

                        if (genderMatch && statusMatch) {
                            row.style.display = '';
                        } else {
                            row.style.display = 'none';
                        }
                    });
                }

                genderFilter.addEventListener('change', filterPatients);
                statusFilter.addEventListener('change', filterPatients);

                // Add hover effects and animations
                patientRows.forEach(row => {
                    row.addEventListener('mouseenter', function() {
                        this.style.transform = 'translateY(-2px)';
                    });

                    row.addEventListener('mouseleave', function() {
                        this.style.transform = 'translateY(0)';
                    });
                });

                // Animate stats cards on load
                const statCards = document.querySelectorAll('.stat-card');
                statCards.forEach((card, index) => {
                    setTimeout(() => {
                        card.style.opacity = '1';
                        card.style.transform = 'translateY(0)';
                    }, index * 100);
                });
            });
        </script>
    </x-slot>
</x-admin.layout>
