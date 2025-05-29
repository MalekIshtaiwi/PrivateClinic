<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Get today's date
        $today = Carbon::today();

        // Get next week's date (7 days from today)
        $nextWeek = Carbon::today()->addDays(7);

        // Count upcoming appointments for the next week (today included)
        $upcomingAppointments = Appointment::whereBetween('date', [$today, $nextWeek])
            ->whereIn('status', ['booked']) // Only count booked appointments
            ->count();

        // Count today's appointments
        $todayAppointments = Appointment::whereDate('date', $today)
            ->whereIn('status', ['booked']) // Only count booked appointments
            ->count();

        // Get today's appointment details for the schedule
        $todaySchedule = Appointment::with('patient')
            ->whereDate('date', $today)
            ->whereIn('status', ['booked'])
            ->orderBy('time', 'asc')
            ->get();

        return view('admin.dashboard', compact(
            'upcomingAppointments',
            'todayAppointments',
            'todaySchedule'
        ));
    }
}
