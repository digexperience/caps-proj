<?php

namespace App\Http\Controllers;

use App\Imports\ScheduleImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Models\Schedule;

class Schedules extends Controller
{
    public function import(Request $request, $userId)
    {
        $request->validate([
            'scheduleFile' => 'required|mimes:xls,xlsx',
            'sheetName' => 'required|string',
        ]);

        $existingSchedule = Schedule::where('user_sched_id', $userId)->exists();

        try {
            
            if ($existingSchedule) {
                Schedule::where('user_sched_id', $userId)->delete();
            }
            $file = $request->file('scheduleFile');
            $sheetName = $request->input('sheetName');

            $spreadsheet = IOFactory::load($file->getPathname());
            Excel::import(new ScheduleImport($sheetName, $spreadsheet, $userId), $file);

            flash()->success('Success', 'Schedules imported successfully.');
            return back()->with('success');
        } catch (\Exception $e) {
            flash()->error('Error', 'Failed to import schedules. ' . $e->getMessage());
            return back()->with('error');
        }

    }

        public function scheddelete(Request $request, $userId)
    {
        try {
            Schedule::where('user_sched_id', $userId)->delete();

            $file = $request->file('scheduleFile');
            $sheetName = $request->input('sheetName');

            $spreadsheet = IOFactory::load($file->getPathname());
            Excel::import(new ScheduleImport($sheetName, $spreadsheet, $userId), $file);

            flash()->success('Success', 'Schedules imported successfully.');
            return back()->with('success');
        } catch (\Exception $e) {
            flash()->success('Error', 'Failed to import schedules. ' . $e->getMessage());
            return back()->with('error');
        }
    }

    public function destroy($id)
    {
        try {
            Schedule::where('user_sched_id', $id)->delete();

            return redirect()->back()->with('success', 'Schedule deleted successfully.');
        
        } catch (\Exception $e) {
            flash()->success('Error', 'Failed to import schedules. ' . $e->getMessage());
            return back()->with('error');
        }
    }



    public function getSheets(Request $request)
    {
        try {
            $file = $request->file('scheduleFile');
            $spreadsheet = IOFactory::load($file->getPathname());
            $sheetNames = $spreadsheet->getSheetNames();

            return response()->json(['sheets' => $sheetNames]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong!'], 500);
        }
    }

    public function view($userId)
    {
        $schedules = Schedule::where('user_sched_id', $userId)->get();
        $timeSlots = $schedules->pluck('time_slot')->unique();
        return view('admin.schedule', compact('schedules', 'timeSlots'));
    }
}
