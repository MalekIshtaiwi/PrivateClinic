<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentsController extends Controller
{
    public function index()
    {
        $weekDays = ['saturday', 'sunday', 'monday', 'tuesday', 'wednesday', 'thursday'];
        $today = strtolower(Carbon::now()->format('l'));
        $startDayIndex = $today === 'friday' ? 0 : array_search($today, $weekDays);
        $rotatedWeek = array_merge(array_slice($weekDays, $startDayIndex), array_slice($weekDays, 0, $startDayIndex));

        $activeSchedules = Schedule::where('is_active', true)->get()->keyBy('day_of_week');
        $daysFromToday = array_values(array_filter(
            $rotatedWeek,
            fn($day) => $activeSchedules->has($day)
        ));

        $arabicDays = [
            'saturday' => 'السبت',
            'sunday' => 'الأحد',
            'monday' => 'الإثنين',
            'tuesday' => 'الثلاثاء',
            'wednesday' => 'الأربعاء',
            'thursday' => 'الخميس',
        ];

        $user = Auth::user();
        $patients = $user ? $user->patients : [];

        // Fetch booked slots for the coming week
        $bookedSlots = [];
        foreach ($daysFromToday as $dayKey) {
            // Calculate the correct date for each day
            $targetDate = Carbon::now();

            if ($dayKey === $today) {
                // If it's today, use today's date
                $targetDate = Carbon::now();
            } else {
                // Find the next occurrence of this day
                $targetDate = Carbon::now()->next($dayKey);
            }

            // Fetch booked appointments for this specific date
            $booked = Appointment::whereDate('date', $targetDate->toDateString())
                ->pluck('time')
                ->map(function($time) {
                    // Ensure time format consistency (H:i)
                    return Carbon::parse($time)->format('H:i');
                })
                ->toArray();

            $bookedSlots[$dayKey] = $booked;
        }

        return view('public.appointments.index', [
            'daysFromToday' => $daysFromToday,
            'arabicDays' => $arabicDays,
            'schedule' => $activeSchedules,
            'selectedDay' => $daysFromToday[0] ?? null,
            'currentTime' => Carbon::now()->format('H:i'),
            'today' => $today,
            'patients' => $patients,
            'bookedSlots' => $bookedSlots,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'selected_day' => 'required|in:saturday,sunday,monday,tuesday,wednesday,thursday',
            'selected_time' => 'required|date_format:H:i',
            'notes' => 'nullable|string|max:1000',
        ]);

        $dayName = $request->selected_day;
        $time = $request->selected_time;
        $patientId = $request->patient_id;

        // Calculate target date more accurately
        $today = Carbon::now();
        $todayDayName = strtolower($today->format('l'));

        if ($dayName === $todayDayName) {
            $targetDate = $today;
        } else {
            $targetDate = $today->next($dayName);
        }

        // Check if patient already has appointment on this date
        if (Appointment::where('patient_id', $patientId)
            ->whereDate('date', $targetDate->toDateString())
            ->exists()) {
            return back()->with('error', 'هذا المريض لديه موعد بالفعل في هذا اليوم');
        }

        // Check if time slot is already booked
        if (Appointment::whereDate('date', $targetDate->toDateString())
            ->where('time', $time)
            ->exists()) {
            return back()->with('error', 'هذا الموعد محجوز بالفعل');
        }

        // Create the appointment
        Appointment::create([
            'user_id' => Auth::id(),
            'patient_id' => $patientId,
            'date' => $targetDate->toDateString(),
            'time' => $time,
            'status' => 'booked',
            'notes' => $request->notes,
        ]);

        return redirect()->back()->with('success', 'تم حجز الموعد بنجاح');
    }
}
