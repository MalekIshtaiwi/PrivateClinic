<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentsController extends Controller
{
    public function index()
    {
        // Days in custom order: Saturday to Thursday (Friday is excluded)
        $weekDays = ['saturday', 'sunday', 'monday', 'tuesday', 'wednesday', 'thursday'];

        // Today’s name (lowercase)
        $today = strtolower(Carbon::now()->format('l'));

        // If today is Friday, skip to Saturday
        $startDayIndex = $today === 'friday' ? 0 : array_search($today, $weekDays);

        // Rotate week from today (or Saturday if Friday)
        $rotatedWeek = array_merge(
            array_slice($weekDays, $startDayIndex),
            array_slice($weekDays, 0, $startDayIndex)
        );

        // Load active schedule from DB
        $activeSchedules = Schedule::where('is_active', true)->get()->keyBy('day_of_week');

        // Filter only active days
        $daysFromToday = array_values(array_filter(
            $rotatedWeek,
            fn($day) => $activeSchedules->has($day)
        ));

        // Arabic translation
        $arabicDays = [
            'saturday' => 'السبت',
            'sunday' => 'الأحد',
            'monday' => 'الإثنين',
            'tuesday' => 'الثلاثاء',
            'wednesday' => 'الأربعاء',
            'thursday' => 'الخميس',
        ];
        /* current user's patients*/
        $user = Auth::user();
        $patients = $user ? $user->patients : [];


        return view('public.appointments.index', [
            'daysFromToday' => $daysFromToday,
            'arabicDays' => $arabicDays,
            'schedule' => $activeSchedules,
            'selectedDay' => $daysFromToday[0] ?? null, // default selection
            'currentTime' => Carbon::now()->format('H:i'),
            'today' => $today,
            'patients' => $patients,
        ]);
    }


    public function show()
    {

    }

    public function store()
    {

    }
}
