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

    public function resechedule(Appointment $appointment){
        //option 1 is move to edit page and there display the available slots for that day

        /*option 2 (harder) add event listener for the edit buttons then check for 3 cases
                if the status is either cancelled or done redirect back with error message
                if the date is in the past display an error message otherwise

                    option 1 change the time input into a dropdown list with available slots that day

                    option 2 (harder) change both the date and the time to dropdown lists
                    display available upcoming days with the slots for each day being rendered
                    when that day is selected

        */
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
