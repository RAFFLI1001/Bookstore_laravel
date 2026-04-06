<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller {

    public function registerForm() { return view('auth.register'); }

    public function register(Request $request) {
    $request->validate([
        'name'     => 'required|string|max:100',
        'email'    => 'required|email|unique:users',
        'phone'    => 'required|string|max:20',
        'address'  => 'required|string',
        'password' => 'required|min:6|confirmed',
    ]);

    User::create([
        'name'     => $request->name,
        'email'    => $request->email,
        'phone'    => $request->phone,
        'address'  => $request->address,
        'password' => Hash::make($request->password),
        'role'     => 'user',
    ]);

    return redirect('/login')->with('success', 'Registrasi berhasil! Silakan login.');
}

    public function loginForm() { return view('auth.login'); }

    public function login(Request $request) {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return auth()->user()->isAdmin()
                ? redirect('/admin/dashboard')
                : redirect('/');
        }

        return back()->withErrors(['email' => 'Email atau password salah.']);
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}