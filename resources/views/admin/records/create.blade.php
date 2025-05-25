<x-admin.layout>
    <div class="container py-4">
        <h2 class="mb-4 text-center" style="color: var(--color-dark);">إضافة سجل طبي للمريض: {{ $patient->name }}</h2>

        <form action="{{ route('admin.medical_records.store', $patient) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="complain" class="form-label">الشكوى</label>
                <textarea name="complain" id="complain" class="form-control" required>{{ old('complain') }}</textarea>
            </div>

            <div class="mb-3">
                <label for="examination" class="form-label">الفحص</label>
                <textarea name="examination" id="examination" class="form-control" required>{{ old('examination') }}</textarea>
            </div>

            <div class="mb-3">
                <label for="diagnosis" class="form-label">التشخيص</label>
                <textarea name="diagnosis" id="diagnosis" class="form-control" required>{{ old('diagnosis') }}</textarea>
            </div>

            <div class="mb-3">
                <label for="lab_test" class="form-label">فحوصات مخبرية</label>
                <textarea name="lab_test" id="lab_test" class="form-control">{{ old('lab_test') }}</textarea>
            </div>

            <div class="mb-3">
                <label for="lab_test_path" class="form-label">ملف فحوصات مخبرية (PDF)</label>
                <input type="file" name="lab_test_path" class="form-control" accept="application/pdf">
            </div>

            <div class="mb-3">
                <label for="rad_test" class="form-label">فحوصات شعاعية</label>
                <textarea name="rad_test" id="rad_test" class="form-control">{{ old('rad_test') }}</textarea>
            </div>

            <div class="mb-3">
                <label for="rad_test_path" class="form-label">ملف فحوصات شعاعية (PDF)</label>
                <input type="file" name="rad_test_path" class="form-control" accept="application/pdf">
            </div>

            <div class="mb-3">
                <label for="treatment" class="form-label">العلاج والمتابعة</label>
                <textarea name="treatment" id="treatment" class="form-control" required>{{ old('treatment') }}</textarea>
            </div>

            <div class="text-center">
                <button class="btn btn-primary" style="background-color: var(--color-dark); border: none;">حفظ السجل الطبي</button>
            </div>
        </form>
    </div>
</x-admin.layout>
