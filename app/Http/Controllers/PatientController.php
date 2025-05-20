<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatientController extends Controller
{
    public function index()
    {
        $patients = Auth::user()->patients()->latest()->get();
        return view('patients.index', compact('patients'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'nullable|integer|min:0',
            'gender' => 'required|in:male,female,other',
            'status' => 'nullable|in:married,single,widowed',
        ]);

        $patient = Auth::user()->patients()->create($validated);

        if ($request->ajax()) {
            return response()->json([
                'message' => 'تمت إضافة المريض بنجاح.',
                'patient' => $patient
            ]);
        }

    }

    public function show(Patient $patient)
    {
        $this->authorizePatient($patient);

        return response()->json($patient);
    }

    public function update(Request $request, Patient $patient)
    {
        $this->authorizePatient($patient);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'nullable|integer|min:0',
            'gender' => 'required|in:male,female',
            'status' => 'nullable|in:married,single,widowed',
        ]);

        $patient->update($validated);

        if ($request->ajax()) {
            return response()->json([
                'message' => 'تم تعديل بيانات المريض بنجاح.',
                'patient' => $patient
            ]);
        }
    }

    public function destroy($id)
    {
        return response()->json(['error' => 'لا يمكن حذف المريض بسبب وجود سجلات طبية مرتبطة.'], 403);
    }

    protected function authorizePatient(Patient $patient)
    {
        if ($patient->user_id !== Auth::id()) {
            abort(403, 'غير مصرح لك بعرض هذا المريض.');
        }
    }
}
