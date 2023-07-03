<?php

namespace App\Http\Controllers\UserController;

use App\Models\User;
use App\Models\Settings;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Propaganistas\LaravelPhone\Rules\Phone;

class AuthUserController extends Controller
{
    public function register()
    {
        return view('frontend.auth.register');
    }
    public function userRegister(Request $request)
    {
        //return dd($request->toArray());
        $input = $this->validate($request, [
            'name' => ['required', 'string', 'max:50'],
            'phone' => ['required', 'string', 'max:15', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'phone:VN,BE', 'unique:users'], /*'regex:/(01)[0-9]{9}'*/ // verify only number is acceptable
            'email' => ['required', 'string', 'email', 'max:50', 'unique:users'],
            'address' => ['required', 'string', 'max:100'],
            'city' => ['required', 'string', 'max:50'],
            'district' => ['required', 'string', 'max:50'],
            'ward' => ['required', 'string', 'max:50'],
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
        $setting = Settings::all()->first();
        return view('frontend.auth.login', compact('setting'));
    }
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => ['required', 'string', 'email', 'max:50'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        $arr = [
            'email' => $request->email,
            'password' => $request->password
        ];
        if (Auth::attempt($arr) && Auth::user()->role == 1) {
            return redirect('home')
                ->with('success', 'You are loged in.');
        } else {
            return redirect('login')
                ->with('error', 'Login failed ! Invalid email or password.');
        }
    }
    public function userLogout()
    {
        Auth::logout();
        return redirect('home')->with('success', 'You are loged out.');;
    }
}
