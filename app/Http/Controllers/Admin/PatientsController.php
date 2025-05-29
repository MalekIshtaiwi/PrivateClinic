<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Http\Request;

class PatientsController extends Controller
{
    public function index()
    {
        // Get all patients with their related user data, ordered by most recent first
        $patients = Patient::with('user')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.patients.index', compact('patients'));
    }

    public function create()
    {
        return view('admin.patients.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'nullable|integer|min:0|max:120',
            'gender' => 'required|in:male,female',
        ]);

        // Assuming you have the user_id available (from auth or session)
        $validated['user_id'] = auth()->id() ?? 1; // Replace with appropriate logic

        Patient::create($validated);

        return redirect()->route('admin.patients.index')
            ->with('success', 'تم إضافة المريض بنجاح');
    }

    public function show(Patient $patient)
    {
        $records = $patient->medicalRecord()->latest()->paginate(3);

        return view('admin.patients.show', compact('patient', 'records'));
    }

    public function edit(Patient $patient)
    {
        return view('admin.patients.edit', compact('patient'));
    }

    public function update(Request $request, Patient $patient)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'nullable|integer|min:0|max:120',
            'gender' => 'required|in:male,female',
        ]);

        $patient->update($validated);

        return redirect()->route('admin.patients.index', $patient)
            ->with('success', 'تم تحديث بيانات المريض بنجاح');
    }

    /**
     * Remove the specified patient from storage.
     */
    public function destroy(Patient $patient)
    {
        
        $patient->delete();

        return redirect()->route('admin.patients.index')
            ->with('success', 'تم حذف المريض بنجاح');
    }

    /**
     * Search patients by name (for AJAX requests or search functionality)
     */
    public function search(Request $request)
    {
        $query = $request->get('query');

        $patients = Patient::with('user')
            ->where('name', 'LIKE', "%{$query}%")
            ->orderBy('name')
            ->limit(10)
            ->get();

        return response()->json($patients);
    }

    /**
     * Filter patients by gender (for AJAX requests)
     */
    public function filter(Request $request)
    {
        $query = Patient::with('user');

        if ($request->has('gender') && $request->gender !== '') {
            $query->where('gender', $request->gender);
        }


        $patients = $query->orderBy('created_at', 'desc')->get();

        return response()->json($patients);
    }


}
