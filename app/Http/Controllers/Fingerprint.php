<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;

class Fingerprint extends Controller
{
    public function index() {
        return view('admin.fingerprint')->with(['users' => User::all(), 'roles' => Role::all()]);
    }
}