<?php

namespace App\Http\Controllers\AdminController;

use App\Models\Settings;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthAdminController extends Controller
{
    public function adminLogin()
    {
        $setting = Settings::all()->first();
        return view('adminfrontend.auth.login', compact('setting'));
    }
    public function login(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:8'
        ]);

        $arr = [
            'email' => $request->email,
            'password' => $request->password
        ];
        if (Auth::attempt($arr)) {
            return redirect('admin/dashboard');
        } else {
            return redirect('admin')
                ->with('alert', 'Login failed ! Invalid email or password.');
        }
    }
    public function adminLogout()
    {
        Auth::logout();
        return redirect('admin');
    }
}
