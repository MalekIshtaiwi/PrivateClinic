<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentsController extends Controller
{
    public function index()
    {
        $appointments = Appointment::with('patient')
            ->orderBy('date', 'asc')
            ->orderBy('time', 'asc')
            ->paginate(15);
        return view('admin.appointments.index', compact('appointments'));
    }

    public function approve(Appointment $appointment)
    {
        // Check if appointment can be approved
        if ($appointment->status === 'cancelled') {
            return redirect()->back()->with('error', 'لا يمكن الموافقة على موعدي ملغي');
        }

        $appointment->update([
            'status' => 'done',
        ]);

        return redirect()->back()->with('success', 'تم إنهاء الموعد بنجاح');
    }

    public function cancel(Appointment $appointment)
    {
        // Check if appointment can be cancelled
        if ($appointment->status === 'done') {
            return redirect()->back()->with('error', 'لا يمكن إلغاء موعد منتهي');
        }

        $appointment->update([
            'status' => 'cancelled',
        ]);

        return redirect()->back()->with('success', 'تم إلغاء الموعد بنجاح');
    }
}
