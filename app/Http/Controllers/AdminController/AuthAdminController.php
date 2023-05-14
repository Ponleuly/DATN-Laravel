<?php

namespace App\Http\Controllers\AdminController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthAdminController extends Controller
{
    public function adminLogin()
    {
        return view('adminfrontend.auth.login');
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
