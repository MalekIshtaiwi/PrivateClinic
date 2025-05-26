<x-admin.layout>
    <div class="container py-4">

        <!-- Patient Info Card -->
        <div class="card shadow-sm border-0 mb-4" style="background-color: var(--color-lightest)">
            <div class="card-body">
                <h4 class="mb-4" style="color: var(--color-dark)">معلومات المريض</h4>
                <p><strong>الاسم:</strong> {{ $patient->name }}</p>
                <p><strong>العمر:</strong> {{ $patient->age ?? 'غير محدد' }}</p>
                <p><strong>الجنس:</strong> {{ $patient->gender === 'male' ? 'ذكر' : 'أنثى' }}</p>

                <!-- Actions -->
                <button class="btn mt-3 mb-3" id="toggleRecordsBtn"
                    style="background-color: var(--color-dark); color: white; border: none; display: block;">
                    عرض السجل الطبي
                </button>
                <a href="{{ route('admin.medical_records.create', $patient) }}" class="btn  mb-3"
                    style="background-color: var(--color-dark); color: white; border: none; ;">
                    إنشاء سجل جديد
                </a>
            </div>
        </div>

        <!-- Medical Records Section -->
        <div class="card shadow-sm border-0 {{ $records->isNotEmpty() ? '' : 'd-none' }}" id="recordsSection"
            style="background-color: #fff;">

            <div class="card-body">
                <h5 class="mb-3" style="color: var(--color-dark)">السجل الطبي</h5>

                @if ($records->isEmpty())
                    <p class="text-muted">لا توجد سجلات طبية لهذا المريض.</p>
                @else
                    @foreach ($records as $record)
                        <div class="mb-4 p-3 rounded" style="background-color: var(--color-lightest)">
                            <p><strong>الشكوى:</strong> {{ $record->complain }}</p>
                            <p><strong>الفحص:</strong> {{ $record->examination }}</p>
                            <p><strong>التشخيص:</strong> {{ $record->diagnosis }}</p>

                            @if ($record->lab_test)
                                <p><strong>فحوصات مخبرية:</strong> {{ $record->lab_test }}</p>
                                @if ($record->lab_test_path)
                                    <a href="{{ asset('storage/' . $record->lab_test_path) }}" target="_blank"
                                        class="btn btn-sm mb-2"
                                        style="background-color: var(--color-medium); color: white;">
                                        تحميل نتائج الفحوصات المخبرية
                                    </a>
                                @endif
                            @endif

                            @if ($record->rad_test)
                                <p><strong>فحوصات شعاعية:</strong> {{ $record->rad_test }}</p>
                                @if ($record->rad_test_path)
                                    <a href="{{ asset('storage/' . $record->rad_test_path) }}" target="_blank"
                                        class="btn btn-sm mb-2"
                                        style="background-color: var(--color-medium); color: white;">
                                        تحميل نتائج الفحوصات الشعاعية
                                    </a>
                                @endif
                            @endif

                            <p><strong>العلاج والمتابعة:</strong> {{ $record->treatment }}</p>
                            <div class="form-group">
                                <p><strong>تاريخ المراجعة:</strong>
                                    {{ $record->created_at->translatedFormat('l d F Y') }}
                                </p>
                            </div>
                        </div>
                    @endforeach

                    <!-- Pagination Links -->
                    <div class="mt-3">
                        {{ $records->links('vendor.pagination.bootstrap-5') }}
                    </div>
                @endif
            </div>
        </div>

    </div>

    <script>
        const section = document.getElementById('recordsSection');
        const toggleBtn = document.getElementById('toggleRecordsBtn');

        toggleBtn.addEventListener('click', function() {
            section.classList.toggle('d-none');
            this.textContent = section.classList.contains('d-none') ? 'عرض السجل الطبي' : 'إخفاء السجل الطبي';
        });

        // Automatically update the toggle button text on page load
        window.addEventListener('DOMContentLoaded', function() {
            toggleBtn.textContent = section.classList.contains('d-none') ? 'عرض السجل الطبي' : 'إخفاء السجل الطبي';
        });
    </script>

</x-admin.layout>
