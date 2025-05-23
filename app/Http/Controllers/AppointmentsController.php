<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AppointmentsController extends Controller
{
    public function index()
    {
        $weekDays = ['saturday', 'sunday', 'monday', 'tuesday', 'wednesday', 'thursday'];

        $today = strtolower(Carbon::now()->format('l'));
        $todayIndex = array_search($today, $weekDays);

        // Handle case if today is 'friday' (not in the DB)
        $daysFromToday = $todayIndex !== false
            ? array_slice($weekDays, $todayIndex)
            : $weekDays;

        $schedule = Schedule::whereIn('day_of_week', $daysFromToday)
            ->where('is_active', true)
            ->get()
            ->groupBy('day_of_week');

        // Arabic day mapping
        $arabicDays = [
            'saturday' => 'السبت',
            'sunday' => 'الأحد',
            'monday' => 'الإثنين',
            'tuesday' => 'الثلاثاء',
            'wednesday' => 'الأربعاء',
            'thursday' => 'الخميس',
        ];

        $daysFromTodayArabic = collect($daysFromToday)->map(fn($day) => $arabicDays[$day] ?? $day);
        $todayArabic = $arabicDays[$today] ?? 'اليوم';

        return view('public.appointments.index', [
            'daysFromToday' => $daysFromToday,
            'daysFromTodayArabic' => $daysFromTodayArabic,
            'todayArabic' => $todayArabic,
            'schedule' => $schedule,
        ]);
    }


    public function show()
    {

    }

    public function store()
    {

    }
}
