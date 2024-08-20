<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Http\Requests\UserAdd;
use App\Http\Requests\UserUp;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Traits\HasRoles;

class Instructors extends Controller
{
    public function index() {
        if (auth()->user()->roles[0]['role'] == '1') {
            $users = User::whereHas('roles', function($query) {
                $query->where('role', '0');
            })->get();

            return view('admin.instructor')->with(['users' => $users, 'roles' => Role::all()]);
        }
    }

    protected function store(UserAdd $request)
    {
        $request->validated();
        $imageName = '';
        $fingerprint = '0';
        $usertype = "0";

        if (isset($request->image)) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move( public_path('assets/images'), $imageName);
        }

            $user= User::create([
                'fname' => $request->fname,
                'lname' => $request->lname,
                'mi' => $request->mi,
                'fingerprint' => $fingerprint,
                'status' => $request->status,
                'phone' => $request->phone,
                'image' => $imageName,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            $role = Role::create([
                'role' => $usertype,
                'name' => $user->fname,
            ]);
            $user->roles()->sync($role->id);

        flash()->success('Success','Instructor is created successfully!');
        return redirect()->route('instructors.index')->with('success');
    }
 
    public function update(Request $request, $id)
    {
        $fingerprint = '0';
        $usertype = "0";

        try {
            $request->validate([
                'fname' => 'required|string|min:3|max:255|regex:/^[\pL\s\-\.]+$/u',
                'mi' => 'required|string|max:2|regex:/^[\pL\s\-\.]+$/u',
                'lname' => 'required|string|min:2|max:255|regex:/^[\pL\s\-\.]+$/u',
                'phone' => 'required|numeric|regex:/(09)[0-9]{9}/|digits:11',
                'status' => 'required|string|max:1',
                'email' => 'required|string|email|max:255',
            ]);

            $user = User::findOrFail($id);
            $role = Role::findOrFail($id);
            $imageName = '';

            if ($request->filled('password')) {
                $request->validate([
                    'password' => 'string|min:8'
                ]);
            }

            if ($request->hasFile('image')) {
                $request->validate([
                    'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
                ]);

                if ($user->image) {
                    $path = public_path('/assets/images/');
                    $image_old = $path . $user->image;

                    if (file_exists($image_old)) {
                        unlink($image_old);
                    }
                }

                $imageName = time() . '.' . $request->image->extension();
                $request->image->move(public_path('assets/images'), $imageName);
                $user->image = $imageName;
            }

            $user->fname = $request->fname;
            $user->lname = $request->lname;
            $user->mi = $request->mi;
            $user->fingerprint = $fingerprint;
            $user->status = $request->status;
            $user->email = $request->email;

            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }

            $user->save();
            $role->role = $usertype;
            $role->save();

            flash()->success('Success', 'The account has been updated successfully!');
            return back()->with('success');

        } catch (\Illuminate\Validation\ValidationException $e) {
            flash()->error('Error', 'Validation failed. Please check your input.');
            return back()->withInput()->withErrors($e->validator);
        } catch (\Exception $e) {
            flash()->error('Error', 'An unexpected error occurred. Please try again.');
            return back()->withInput();
        }
    }

        


    public function destroy($request)
    {   
        
        $user = User::whereId($request)->get();
        if($user[0]['image'] != ''  && $user[0]['image'] != null){
            $path = public_path().'/assets/images/';

            $image_old = $path.$user[0]['image'];
            unlink($image_old);
        }
        User::whereId($request)->delete();
        Role::whereId($request)->delete();
        flash()->success('Success', 'Instructor Account has been Deleted successfully !');
        return back()->with('success');
    }
}
