<x-admin.layout>
    <x-slot name="appointments_css">
        <link rel="stylesheet" href="{{ asset('css/admin/appointments.css') }}">
    </x-slot name="appointments_css">
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
                        <th>ملاحظات</th>
                        <th>حالة الزيارة</th>
                        <th class="actions-column">الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($appointments as $appointment)
                        <tr>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="">
                                </div>
                            </td>
                            <td class="clickable-td"
                                data-href="{{ route('admin.patients.show', $appointment->patient->id) }}">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <p class="patient-name mb-0">{{ $appointment->patient->name }}</p>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $appointment->date->translatedFormat('d F Y') }}</td>
                            <td>{{ $appointment->time }}</td>
                            <td>{{ $appointment->note }}</td>
                            <td>
                                @if ($appointment->status === 'done')
                                    <span class="badge-confirmed">مؤكد</span>
                                @elseif($appointment->status === 'booked')
                                    <span class="badge-waiting">في الانتظار</span>
                                @else
                                    <span class="badge-cancelled">ملغي</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex">
                                    <button class="btn btn-icon edit me-1">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form action="{{ route('admin.appointments.approve', $appointment) }}"
                                        method="post">
                                        @csrf
                                        @method('patch')
                                        <button type="submit" class="btn btn-icon">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.appointments.cancel', $appointment) }}" method="post">
                                        @csrf
                                        @method('patch')
                                        <button type="submit" class="btn btn-icon delete">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </form>


                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">لا توجد مواعيد</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="row">
            <div class="col-md-6">
                <p class="page-info">
                    عرض {{ $appointments->firstItem() }}-{{ $appointments->lastItem() }} من
                    {{ $appointments->total() }}
                    موعد
                </p>
            </div>
            <div class="col-md-6">
                {{ $appointments->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.clickable-td').forEach(function(td) {
                td.addEventListener('click', function() {
                    window.location.href = td.dataset.href;
                });
            });
        });
    </script>
</x-admin.layout>
