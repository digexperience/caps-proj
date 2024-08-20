<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;

class Fingerprint extends Controller
{
    public function index() {
        if (auth()->user()->roles[0]['role'] == '1') {
            $users = User::whereHas('roles', function($query) {
                $query->where('role', '0');
            })->get();

            return view('admin.fingerprint')->with(['users' => $users, 'roles' => Role::all()]);
        }
    }
}
