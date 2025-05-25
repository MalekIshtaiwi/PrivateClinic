<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MedicalRecord;
use App\Models\Patient;
use Illuminate\Http\Request;

class MedicalRecordsController extends Controller
{
public function create(Patient $patient)
    {
        return view('admin.records.create', compact('patient'));
    }

    public function store(Request $request, Patient $patient)
    {
        $validated = $request->validate([
            'complain' => 'required|string',
            'examination' => 'required|string',
            'diagnosis' => 'required|string',
            'lab_test' => 'nullable|string',
            'lab_test_path' => 'nullable|file|mimes:pdf',
            'rad_test' => 'nullable|string',
            'rad_test_path' => 'nullable|file|mimes:pdf',
            'treatment' => 'required|string',
        ]);

        if ($request->hasFile('lab_test_path')) {
            $validated['lab_test_path'] = $request->file('lab_test_path')->store('lab_tests', 'public');
        }

        if ($request->hasFile('rad_test_path')) {
            $validated['rad_test_path'] = $request->file('rad_test_path')->store('rad_tests', 'public');
        }

        $patient->medicalRecord()->create($validated);

        return redirect()->route('admin.patients.show', $patient)->with('success', 'تم إضافة السجل الطبي بنجاح');
    }
}
