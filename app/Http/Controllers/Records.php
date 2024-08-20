<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;

class Records extends Controller
{
    public function index(Request $request)
    {
        $month = $request->input('month', Carbon::now()->format('m'));
        $year = $request->input('year', Carbon::now()->format('Y'));
        $date = Carbon::createFromDate($year, $month, 1);
        $daysInMonth = $date->daysInMonth;
        $startDay = $date->dayOfWeek;
        $currentDay = Carbon::now()->day;
        $currentMonth = Carbon::now()->month;
        $calendar = [];
        $current = 0;

        for ($i = 0; $i < $startDay; $i++) {
            $calendar[] = null;
        }

        for ($day = 1; $day <= $daysInMonth; $day++) {
            if ($month == $currentMonth && $day > $currentDay) {
                $current = 1;
                break;
            }
            $calendar[] = $day;
        }

        return view('admin.records', compact('calendar', 'month', 'year', 'current'));
    }

    public function changeMonth(Request $request, $direction)
    {
        $currentMonth = $request->input('month', Carbon::now()->format('m'));
        $currentYear = $request->input('year', Carbon::now()->format('Y'));

        $date = Carbon::createFromDate($currentYear, $currentMonth, 1);

        if ($direction == 'next') {
            $date->addMonth();
        } else {
            $date->subMonth();
        }

        return redirect()->route('records', [
            'month' => $date->format('m'),
            'year' => $date->format('Y')
        ]);
    }
    public function report(Request $request, $day, $month, $year)
    {
        $date = Carbon::createFromDate($year, $month, $day);
        $records = User::whereDate('created_at', $date)->get();

        return view('admin.report', compact('records', 'day', 'month', 'year'));
    }
}