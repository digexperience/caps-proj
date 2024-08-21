<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Role;

class Records extends Controller
{
    public function index() {
        if (auth()->user()->roles[0]['role'] == '1') {
            $users = User::whereHas('roles', function($query) {
                $query->where('role', '0');
            })->get();

            return view('admin.records')->with(['users' => $users, 'roles' => Role::all()]);
        }
    }

    public function calendar(Request $request, $id)
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
        $user = User::whereId($id)->first();

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

        return view('admin.records_calendar', compact('calendar', 'month', 'year', 'current', 'user'));
    }

    public function changeMonth(Request $request, $direction, $id)
    {
        $currentMonth = $request->input('month', Carbon::now()->format('m'));
        $currentYear = $request->input('year', Carbon::now()->format('Y'));
        $user = User::whereId($id)->first();

        $date = Carbon::createFromDate($currentYear, $currentMonth, 1);

        if ($direction == 'next') {
            $date->addMonth();
        } else {
            $date->subMonth();
        }

        $isCurrentMonth = $date->isSameMonth(Carbon::now());

        return redirect()->route('records', [
            'month' => $date->format('m'),
            'year' => $date->format('Y'),
            'user' => $user,
            'current' => $isCurrentMonth ? 1 : 0,
        ]);
    }

    public function report(Request $request, $day, $month, $year)
    {
        $date = Carbon::createFromDate($year, $month, $day);
        $records = User::whereDate('created_at', $date)->get();

        return view('admin.records_calendar', compact('records', 'day', 'month', 'year', 'user'));
    }
}