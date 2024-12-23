<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AuthController extends Controller{

    // Form Login
    public function showLoginForm()
    {
        return view('auth.login');
    }

     // Proses Login
     public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->route('home'); // Arahkan ke route 'home'
    }

    return back()->withErrors([
        'email' => 'Email atau password salah.',
    ]);
}
 
     // Form Register
     public function showRegisterForm()
     {
         return view('auth.register');
     }
 
     // Proses Register
     public function register(Request $request)
     {
         $request->validate([
             'name' => 'required|string|max:255',
             'email' => 'required|email|unique:users',
             'password' => 'required|min:8|confirmed',
         ]);
 
         User::create([
             'name' => $request->name,
             'email' => $request->email,
             'password' => Hash::make($request->password),
         ]);
 
         return redirect()->route('login')->with('success', 'Registrasi berhasil. Silakan login.');
     }
 
     // Logout
     public function logout(Request $request)
     {
         Auth::logout();
         $request->session()->invalidate();
         $request->session()->regenerateToken();
         return redirect('/login');
     }
}