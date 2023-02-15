<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function auth(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required',],
            'password' => ['required'],
        ]);

        //BUat cek si user udah login 
        if (Auth::attempt($credentials)) {
            //Buat cek status active apa engga
            if (Auth::user()->status != 'active') 
            {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                Session::flash('status', 'failed');
                Session::flash('message', 'Your Account is not Active nyet. Please contact admin!');
                return redirect('login');
            }

            $request->session()->regenerate();
            //cek apakah dia admin
            if (Auth::user()->roles_id == 1) 
            {
                return redirect('dashboard');
            }

            //cek apakah dia client
            if (Auth::user()->roles_id == 2) 
            {
                return redirect('profile');
            }
        }

        //kalo gagal login
        Session::flash('status', 'failed');
        Session::flash('message', 'NU BENER ATUH BRAY');
        return redirect('login');
    }

    public function logout(Request $request)
    {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('login');
    }

    public function register()
    {
        return view('register');
    }

    public function regis(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|unique:users',
            'password' => 'required|min:5',
            'phone' => 'required|max:13',
            'address' => 'required|max:225',
        ]);

        $request['password'] = Hash::make($request->Password);
        $user = User::create($request->all());

        Session::flash('status', 'success');
        Session::flash('message', 'Regist Success! Please, wait admin to approve');
        return redirect('register');
    }
}
