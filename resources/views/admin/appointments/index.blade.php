<x-admin.layout>
    <x-slot name="appointments_css">
        <link rel="stylesheet" href="{{ asset('css/admin/appointments.css') }}">
    </x-slot name="appointments_css">

    <div class="container-fluid py-3">
        <!-- Appointments Table -->
        <div class="table-container mb-3">
            <table class="table appointments-table mb-0">
                <thead>
                    <tr>
                        <th class="checkbox-column">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="selectAll">
                            </div>
                        </th>
                        <th>المريض</th>
                        <th>التاريخ</th>
                        <th>الوقت</th>
                        <th>نوع الزيارة</th>
                        <th>الحالة</th>
                        <th class="actions-column">الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Row 1 -->
                    <tr>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="">
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="/api/placeholder/40/40" class="avatar me-2" alt="صورة المريض">
                                <div>
                                    <p class="patient-name">سارة أحمد</p>
                                    <p class="patient-id">PAT-2025-001#</p>
                                </div>
                            </div>
                        </td>
                        <td>17 أبريل 2025</td>
                        <td>09:30 ص</td>
                        <td>فحص عام</td>
                        <td>
                            <span class="badge-confirmed">مؤكد</span>
                        </td>
                        <td>
                            <div class="d-flex">
                                <button class="btn btn-icon edit me-1">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-icon">
                                    <i class="fas fa-check"></i>
                                </button>
                                <button class="btn btn-icon delete">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <!-- Row 2 -->
                    <tr>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="">
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="/api/placeholder/40/40" class="avatar me-2" alt="صورة المريض">
                                <div>
                                    <p class="patient-name">محمد خالد</p>
                                    <p class="patient-id">PAT-2025-002#</p>
                                </div>
                            </div>
                        </td>
                        <td>17 أبريل 2025</td>
                        <td>10:00 ص</td>
                        <td>متابعة</td>
                        <td>
                            <span class="badge-waiting">في الانتظار</span>
                        </td>
                        <td>
                            <div class="d-flex">
                                <button class="btn btn-icon edit me-1">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-icon">
                                    <i class="fas fa-check"></i>
                                </button>
                                <button class="btn btn-icon delete">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="row">
            <div class="col-md-6">
                <p class="page-info">عرض 1-10 من 45 موعد</p>
            </div>
            <div class="col-md-6">
                <nav aria-label="Page navigation" class="float-md-end">
                    <ul class="pagination">
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo; السابق</span>
                            </a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item active"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Next">
                                <span aria-hidden="true">التالي &raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

</x-admin.layout>
