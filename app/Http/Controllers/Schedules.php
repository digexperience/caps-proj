<?php

namespace App\Http\Controllers;

use App\Models\User;

class Schedules extends Controller
{
    public function index()
    {
        $request->validate([
            'scheduleFile' => 'required|file|mimes:xlsx,xls',
        ]);

        $file = $request->file('scheduleFile');
        $instructorId = $id;

        // Process the uploaded file and save schedule data
        // Example: Parse Excel and save to DB

        return redirect()->back()->with('success', 'Schedule uploaded successfully.');
    }

}
