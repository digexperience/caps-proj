<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Traits\HasRoles;

class Profile extends Controller
{
    public function index()
    {
        return view('user.profile')->with(['user' => Auth()->user()]);
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'fname' => 'required|string|min:3|max:255|regex:/^[\pL\s\-\.]+$/u',
                'mi' => 'required|string|max:2|regex:/^[\pL\s\-\.]+$/u',
                'lname' => 'required|string|min:2|max:255|regex:/^[\pL\s\-\.]+$/u',
                'phone' => 'required|numeric|regex:/(09)[0-9]{9}/|digits:11',
                'email' => 'required|string|email|max:255',
            ]);
            $user = User::findOrFail($id);
            $imageName = '';

            if ($request->filled('password')) {
                $request->validate([
                    'password' => 'string|min:8|regex:/^\S*$/u'
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
            $user->email = $request->email;

            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }

            $user->save();

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
}
