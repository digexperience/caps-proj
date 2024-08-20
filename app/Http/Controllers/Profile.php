<?php

namespace App\Http\Controllers;

use App\Models\User;

class Dashboard extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

}
