<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        $days = Schedule::all();
        return view('admin.schedule.index', compact('days'));
    }

    public function update(Request $request)
    {
        $days = $request->input('days', []);

        $allDays = ['saturday', 'sunday', 'monday', 'tuesday', 'wednesday', 'thursday'];

        foreach ($allDays as $dayName) {
            $dayData = $days[$dayName] ?? null;

            Schedule::updateOrCreate(
                ['day_of_week' => $dayName],
                [
                    'is_active' => $dayData['is_active'] ?? 0,
                    'start_time' => $dayData['start_time'] ?? null,
                    'end_time' => $dayData['end_time'] ?? null,
                ]
            );
        }

        return redirect()->back()->with('success', 'تم تحديث الجدول بنجاح');
    }



}
