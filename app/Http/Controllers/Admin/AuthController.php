<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginAdminRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
//    public function __construct()
//    {
//        // Protecting the routes with the admin middleware
//        $this->middleware('admin')->except(['landing', 'loginView', 'login', 'registerView', 'register']);
//    }

    public function landing()
    {
        return view('landing',[
            'title' => 'RUSCare Admin',
        ]);
    }

    public function loginView()
    {
        return view('login',[
            'title' => 'Login',
        ]);
    }

    public function login(LoginAdminRequest $request)
    {
        $credentials = $request->validated();

        if (Auth::attempt(['email' => $credentials['nis'], 'password' => $credentials['password']]) ||
            Auth::attempt(['name' => $credentials['nis'], 'password' => $credentials['password']])) {

            $user = Auth::user();

            if ($user->role_id != 1) {
                Auth::logout();
                return redirect('auth/unauthorized')->with('error', 'Login failed!');
            } else {
                $request->session()->regenerate();
                return redirect('/admin/dashboard')->with('success', 'Login successful!');
            }
        } else {
            return redirect('auth/unauthorized')->with('error', 'Login failed!');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/auth/login')->with('success', 'Logout successful!');
    }

    public function registerView()
    {
        return view('register.index',[
            'title' => 'Register',
        ]);
    }

    public function register(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $validator['password'] = Hash::make($validator['password']);
        User::create($validator);

        return redirect('/admin/dashboard/{id}')->with('success', 'Register Success!');
    }

    public function unauthorized()
    {
        return view('warning',[
            'title' => 'Unauthorized',
        ]);
    }
}
