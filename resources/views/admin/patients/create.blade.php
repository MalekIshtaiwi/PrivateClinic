<x-admin.layout>
    <x-slot name="create_patient_css">
        <link rel="stylesheet" href="{{ asset('css/admin/create_patient.css') }}">
    </x-slot>

    <div class="container-fluid">
        <div class="page-header">
            <h2>إضافة مريض جديد</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">الرئيسية</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.patients.index') }}">المرضى</a></li>
                    <li class="breadcrumb-item active">إضافة مريض</li>
                </ol>
            </nav>
        </div>

        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="form-container">
                    <form action="{{ route('admin.patients.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="name">اسم المريض *</label>
                            <input type="text"
                                   id="name"
                                   name="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name') }}"
                                   required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="age">العمر</label>
                            <input type="number"
                                   id="age"
                                   name="age"
                                   class="form-control @error('age') is-invalid @enderror"
                                   value="{{ old('age') }}"
                                   min="1"
                                   max="120">
                            @error('age')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>الجنس *</label>
                            <div class="radio-group">
                                <label class="radio-option">
                                    <input type="radio" name="gender" value="male" {{ old('gender') == 'male' ? 'checked' : '' }} required>
                                    ذكر
                                </label>
                                <label class="radio-option">
                                    <input type="radio" name="gender" value="female" {{ old('gender') == 'female' ? 'checked' : '' }} required>
                                    أنثى
                                </label>
                            </div>
                            @error('gender')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="status">الحالة الاجتماعية</label>
                            <select id="status" name="status" class="form-control @error('status') is-invalid @enderror">
                                <option value="">اختر الحالة</option>
                                <option value="single" {{ old('status') == 'single' ? 'selected' : '' }}>أعزب</option>
                                <option value="married" {{ old('status') == 'married' ? 'selected' : '' }}>متزوج</option>
                                <option value="other" {{ old('status') == 'other' ? 'selected' : '' }}>أخرى</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <input type="hidden" name="user_id" value="1">

                        <div class="form-actions">
                            <a href="{{ route('admin.patients.index') }}" class="btn btn-secondary">إلغاء</a>
                            <button type="submit" class="btn btn-primary">حفظ المريض</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <x-slot name="create_patient_script">
    </x-slot>
</x-admin.layout>
