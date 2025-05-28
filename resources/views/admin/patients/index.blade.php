<x-admin.layout>
    <x-slot name="patient_css">
        <link rel="stylesheet" href="{{ asset('css/admin/patients.css') }}">
    </x-slot>
    @if (session('success'))
        <div id="successAlert" class="alert alert-success w-100 mb-3" role="alert"
            style="border-radius: 8px; border-left: 4px solid #28a745; background-color: #d4edda; color: #155724; padding: 15px; font-weight: 500; transition: opacity 0.5s ease-out;">
            <div style="display: flex; align-items: center; justify-content: space-between;">
                <div style="display: flex; align-items: center;">
                    <svg style="width: 20px; height: 20px; margin-right: 10px; fill: #28a745;" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd"></path>
                    </svg>
                    {{ session('success') }}
                </div>
                <button type="button" onclick="this.parentElement.parentElement.style.display='none'"
                    style="background: none; border: none; font-size: 20px; font-weight: bold; color: #155724; cursor: pointer;">&times;</button>
            </div>
        </div>
        <script>
            setTimeout(() => {
                const alert = document.getElementById('successAlert');
                if (alert) {
                    alert.style.opacity = '0';
                    setTimeout(() => alert.style.display = 'none', 500);
                }
            }, 5000);
        </script>
    @endif

    @if (session('error'))
        <div id="errorAlert" class="alert alert-danger w-100 mb-3" role="alert"
            style="border-radius: 8px; border-left: 4px solid #dc3545; background-color: #f8d7da; color: #721c24; padding: 15px; font-weight: 500; transition: opacity 0.5s ease-out;">
            <div style="display: flex; align-items: center; justify-content: space-between;">
                <div style="display: flex; align-items: center;">
                    <svg style="width: 20px; height: 20px; margin-right: 10px; fill: #dc3545;" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                    {{ session('error') }}
                </div>
                <button type="button" onclick="this.parentElement.parentElement.style.display='none'"
                    style="background: none; border: none; font-size: 20px; font-weight: bold; color: #721c24; cursor: pointer;">&times;</button>
            </div>
        </div>
        <script>
            setTimeout(() => {
                const alert = document.getElementById('errorAlert');
                if (alert) {
                    alert.style.opacity = '0';
                    setTimeout(() => alert.style.display = 'none', 500);
                }
            }, 5000);
        </script>
    @endif
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
                </div>
            </div>

            @if ($patients->count() > 0)
                <div class="table-responsive">
                    <table class="table patients-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>اسم المريض</th>
                                <th>العمر</th>
                                <th>الجنس</th>
                                <th>تاريخ التسجيل</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($patients as $index => $patient)
                                <tr class="patient-row" data-gender="{{ $patient->gender }}">
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
                                        @if ($patient->age)
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
                                    <td class="patient-date">
                                        <span class="date-text">{{ $patient->created_at->format('Y/m/d') }}</span>
                                        <small class="time-text">{{ $patient->created_at->format('H:i') }}</small>
                                    </td>
                                    <td class="patient-actions">
                                        <div class="action-buttons">
                                            <a href="{{ route('admin.patients.show', $patient->id) }}"
                                                class="btn btn-sm btn-outline-primary" title="عرض التفاصيل">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.patients.edit', $patient->id) }}"
                                                class="btn btn-sm btn-outline-secondary" title="تعديل">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button class="btn btn-sm btn-outline-danger delete-patient-btn"
                                                data-delete-url="{{ route('admin.patients.destroy', $patient->id) }}"
                                                data-patient-name="{{ $patient->name }}" title="حذف">
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

    <!-- Custom Delete Confirmation Modal -->
    <div id="deleteModal" class="delete-modal">
        <div class="delete-modal-content">
            <div class="delete-modal-header">
                <i class="fas fa-exclamation-triangle"></i>
                <h3>تأكيد الحذف</h3>
            </div>
            <div class="delete-modal-body">
                <p>هل أنت متأكد من حذف المريض <strong id="patientNameToDelete"></strong>؟</p>
                <small>لا يمكن التراجع عن هذا الإجراء</small>
            </div>
            <div class="delete-modal-footer">
                <button id="confirmDelete" class="btn-confirm-delete">
                    <i class="fas fa-trash"></i>
                    نعم، احذف
                </button>
                <button id="cancelDelete" class="btn-cancel-delete">
                    <i class="fas fa-times"></i>
                    إلغاء
                </button>
            </div>
        </div>
    </div>

    <!-- Hidden form for deletion -->
    <form id="delete-patient-form" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>

    <x-slot name="patients_script">
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Filter functionality
                const genderFilter = document.getElementById('genderFilter');
                const patientRows = document.querySelectorAll('.patient-row');

                function filterPatients() {
                    const selectedGender = genderFilter.value;

                    patientRows.forEach(row => {
                        const patientGender = row.dataset.gender;
                        const genderMatch = !selectedGender || patientGender === selectedGender;

                        if (genderMatch) {
                            row.style.display = '';
                        } else {
                            row.style.display = 'none';
                        }
                    });
                }

                genderFilter.addEventListener('change', filterPatients);

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

                // Delete patient functionality
                const deleteButtons = document.querySelectorAll('.delete-patient-btn');
                const deleteForm = document.getElementById('delete-patient-form');
                const deleteModal = document.getElementById('deleteModal');
                const patientNameSpan = document.getElementById('patientNameToDelete');
                const confirmBtn = document.getElementById('confirmDelete');
                const cancelBtn = document.getElementById('cancelDelete');

                let currentDeleteUrl = '';

                deleteButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        const deleteUrl = this.getAttribute('data-delete-url');
                        const patientName = this.getAttribute('data-patient-name');

                        currentDeleteUrl = deleteUrl;
                        patientNameSpan.textContent = patientName;
                        deleteModal.style.display = 'flex';

                        // Add show animation
                        setTimeout(() => {
                            deleteModal.classList.add('show');
                        }, 10);
                    });
                });

                // Confirm delete
                confirmBtn.addEventListener('click', function() {
                    deleteForm.action = currentDeleteUrl;
                    deleteForm.submit();
                });

                // Cancel delete
                function closeModal() {
                    deleteModal.classList.remove('show');
                    setTimeout(() => {
                        deleteModal.style.display = 'none';
                    }, 300);
                }

                cancelBtn.addEventListener('click', closeModal);

                // Close on overlay click
                deleteModal.addEventListener('click', function(e) {
                    if (e.target === deleteModal) {
                        closeModal();
                    }
                });

                // Close on Escape key
                document.addEventListener('keydown', function(e) {
                    if (e.key === 'Escape' && deleteModal.style.display === 'flex') {
                        closeModal();
                    }
                });
            });
        </script>

        <style>
            /* Custom alert styling for better appearance */
            .delete-patient-btn {
                transition: all 0.3s ease;
            }

            .delete-patient-btn:hover {
                background-color: #dc3545 !important;
                color: white !important;
                border-color: #dc3545 !important;
                transform: translateY(-1px);
                box-shadow: 0 4px 8px rgba(220, 53, 69, 0.3);
            }

            /* Custom Delete Modal */
            .delete-modal {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.5);
                backdrop-filter: blur(5px);
                z-index: 1000;
                justify-content: center;
                align-items: center;
                opacity: 0;
                transition: all 0.3s ease;
            }

            .delete-modal.show {
                opacity: 1;
            }

            .delete-modal-content {
                background: white;
                border-radius: 15px;
                box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
                max-width: 400px;
                width: 90%;
                transform: scale(0.8) translateY(-50px);
                transition: all 0.3s ease;
                overflow: hidden;
                direction: rtl;
                text-align: right;
            }

            .delete-modal.show .delete-modal-content {
                transform: scale(1) translateY(0);
            }

            .delete-modal-header {
                background: linear-gradient(135deg, #ff6b6b, #ff5252);
                color: white;
                padding: 1.5rem;
                text-align: center;
                position: relative;
            }

            .delete-modal-header i {
                font-size: 2.5rem;
                margin-bottom: 0.5rem;
                display: block;
                animation: shake 0.8s ease-in-out;
            }

            .delete-modal-header h3 {
                margin: 0;
                font-size: 1.3rem;
                font-weight: 600;
            }

            .delete-modal-body {
                padding: 2rem 1.5rem;
                text-align: center;
            }

            .delete-modal-body p {
                font-size: 1.1rem;
                color: #333;
                margin-bottom: 0.5rem;
                line-height: 1.5;
            }

            .delete-modal-body strong {
                color: #dc3545;
            }

            .delete-modal-body small {
                color: #6c757d;
                font-size: 0.9rem;
            }

            .delete-modal-footer {
                padding: 1rem 1.5rem 1.5rem;
                display: flex;
                gap: 0.8rem;
                justify-content: center;
            }

            .btn-confirm-delete,
            .btn-cancel-delete {
                padding: 0.8rem 1.5rem;
                border: none;
                border-radius: 8px;
                font-weight: 600;
                cursor: pointer;
                transition: all 0.3s ease;
                display: flex;
                align-items: center;
                gap: 0.5rem;
                font-size: 0.95rem;
            }

            .btn-confirm-delete {
                background: linear-gradient(135deg, #dc3545, #c82333);
                color: white;
                box-shadow: 0 4px 15px rgba(220, 53, 69, 0.3);
            }

            .btn-confirm-delete:hover {
                transform: translateY(-2px);
                box-shadow: 0 6px 20px rgba(220, 53, 69, 0.4);
            }

            .btn-cancel-delete {
                background: #6c757d;
                color: white;
            }

            .btn-cancel-delete:hover {
                background: #5a6268;
                transform: translateY(-1px);
            }

            @keyframes shake {

                0%,
                100% {
                    transform: translateX(0);
                }

                25% {
                    transform: translateX(-5px);
                }

                75% {
                    transform: translateX(5px);
                }
            }

            /* Responsive */
            @media (max-width: 480px) {
                .delete-modal-content {
                    margin: 1rem;
                    width: auto;
                }

                .delete-modal-footer {
                    flex-direction: column;
                }

                .btn-confirm-delete,
                .btn-cancel-delete {
                    justify-content: center;
                }
            }
        </style>
    </x-slot>
</x-admin.layout>
