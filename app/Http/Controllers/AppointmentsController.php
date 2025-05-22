<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AppointmentsController extends Controller
{
    public function index()
    {

        // Step 1: Your custom ordered week (Saturday to Thursday)
        $weekDays = ['saturday', 'sunday', 'monday', 'tuesday', 'wednesday', 'thursday'];

        // Step 2: Get today's name in lowercase
        $today = strtolower(Carbon::now()->format('l')); // e.g., 'monday'

        // Step 3: Find today's index
        $todayIndex = array_search($today, $weekDays);

        // Step 4: Slice the array from today (including it)
        $daysFromToday = array_slice($weekDays, $todayIndex);

        // Step 5: Query the DB for active schedules on those days
        $schedule = Schedule::whereIn('day_of_week', $daysFromToday)
            ->where('is_active', true)
            ->get();

        return view('public.appointments.index', $schedule);
    }

    public function show()
    {

    }

    public function store()
    {

    }
}
