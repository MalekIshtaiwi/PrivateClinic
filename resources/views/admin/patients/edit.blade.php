<x-admin.layout>
    <x-slot name="edit_patient_css">
        <link rel="stylesheet" href="{{ asset('css/admin/edit_patient.css') }}">
    </x-slot>

    <div class="edit-patient-container">
        {{-- Success/Error Messages --}}
        @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle me-2"></i>
                <strong>يرجى تصحيح الأخطاء التالية:</strong>
                <ul class="mb-0 mt-2">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Page Header --}}
        <div class="page-header">
            <h1>
                <i class="fas fa-user-edit me-2"></i>
                تعديل بيانات المريض
            </h1>
            <p class="subtitle">قم بتحديث معلومات المريض أدناه</p>
        </div>

        <div class="form-container">
            {{-- Patient Info Card --}}
            <div class="form-content">
                <div class="patient-info-card">
                    <div class="patient-id">
                        <i class="fas fa-id-badge me-1"></i>
                        رقم المريض: #{{ $patient->id ?? '001' }}
                    </div>
                    <h3 class="patient-name">{{ $patient->name ?? 'أحمد محمد علي' }}</h3>
                </div>

                {{-- Edit Form --}}
                <form action="{{ route('admin.patients.update', $patient->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Name Field --}}
                    <div class="form-group">
                        <label for="name" class="form-label">
                            <i class="fas fa-user me-1"></i>
                            الاسم الكامل
                        </label>
                        <input type="text"
                               class="form-control @error('name') is-invalid @enderror"
                               id="name"
                               name="name"
                               value="{{ old('name', $patient->name ?? 'أحمد محمد علي') }}"
                               required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Age and Gender Row --}}
                    <div class="form-row">
                        <div class="form-group">
                            <label for="age" class="form-label">
                                <i class="fas fa-calendar-alt me-1"></i>
                                العمر
                            </label>
                            <input type="number"
                                   class="form-control @error('age') is-invalid @enderror"
                                   id="age"
                                   name="age"
                                   value="{{ old('age', $patient->age ?? 35) }}"
                                   min="1"
                                   max="120">
                            @error('age')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-venus-mars me-1"></i>
                                الجنس
                            </label>
                            <div class="gender-options">
                                <div class="radio-option">
                                    <input type="radio"
                                           class="radio-input"
                                           id="male"
                                           name="gender"
                                           value="male"
                                           {{ old('gender', $patient->gender ?? 'male') == 'male' ? 'checked' : '' }}>
                                    <label for="male" class="radio-label">
                                        <i class="fas fa-mars me-1"></i>
                                        ذكر
                                    </label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio"
                                           class="radio-input"
                                           id="female"
                                           name="gender"
                                           value="female"
                                           {{ old('gender', $patient->gender ?? '') == 'female' ? 'checked' : '' }}>
                                    <label for="female" class="radio-label">
                                        <i class="fas fa-venus me-1"></i>
                                        أنثى
                                    </label>
                                </div>
                            </div>
                            @error('gender')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>



                    {{-- Form Actions --}}
                    <div class="btn-group">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i>
                            حفظ التغييرات
                        </button>
                        <a href="{{ route('admin.patients.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-1"></i>
                            إلغاء
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <x-slot name="edit_patient_script">
        <script>
            // Form validation enhancement
            document.addEventListener('DOMContentLoaded', function() {
                const form = document.querySelector('form');
                const nameInput = document.getElementById('name');
                const ageInput = document.getElementById('age');

                // Real-time validation for name
                nameInput.addEventListener('input', function() {
                    if (this.value.trim().length < 2) {
                        this.classList.add('is-invalid');
                    } else {
                        this.classList.remove('is-invalid');
                    }
                });

                // Real-time validation for age
                ageInput.addEventListener('input', function() {
                    const age = parseInt(this.value);
                    if (age < 1 || age > 120 || isNaN(age)) {
                        this.classList.add('is-invalid');
                    } else {
                        this.classList.remove('is-invalid');
                    }
                });

                // Smooth scroll to errors
                const firstError = document.querySelector('.is-invalid, .alert-danger');
                if (firstError) {
                    firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            });
        </script>
    </x-slot>
</x-admin.layout>
