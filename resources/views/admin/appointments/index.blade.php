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
                                    <button class="btn btn-icon">
                                        <i class="fas fa-check"></i>
                                    </button>
                                    <button class="btn btn-icon delete">
                                        <i class="fas fa-times"></i>
                                    </button>
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
                    عرض {{ $appointments->firstItem() }}-{{ $appointments->lastItem() }} من {{ $appointments->total() }}
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
