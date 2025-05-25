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
            ->orderBy('time','asc')
            ->paginate(15);
        return view('admin.appointments.index',compact('appointments'));
    }
}
