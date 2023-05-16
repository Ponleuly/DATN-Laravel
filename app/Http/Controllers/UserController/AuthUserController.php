<?php

namespace App\Http\Controllers\UserController;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthUserController extends Controller
{
    public function register()
    {
        return view('frontend.auth.register');
    }
    public function userRegister(Request $request)
    {
        $input = $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:20', /*'regex:/(01)[0-9]{9}'*/], // verify only number is acceptable
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'address' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($input) {
            $input['password'] = bcrypt($request->password);
            User::create($input);
            /*
            //==== Auto Sign in after register ===//
            $arr = [
                'email' => $request->email,
                'password' => $request->password
            ];
            Auth::attempt($arr);
            */
            //=====================================//

        } else {
            return redirect()->back();
        }
        return redirect('login')
            ->with('success', 'You are signed up successfully !');
        //return dd($request->toArray());
    }

    //================= Login  ===========================//
    public function userLogin()
    {
        return view('frontend.auth.login');
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
        if (Auth::attempt($arr) && Auth::user()->role == 1) {
            return redirect('home');
        } else {
            return redirect('login')
                ->with('error', 'Login failed ! Invalid email or password.');
        }
    }
    public function userLogout()
    {
        Auth::logout();
        return redirect('home');
    }
}
