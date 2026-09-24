<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    $user = User::where('email', $credentials['email'])->first();

    if (!$user || !Hash::check($credentials['password'], $user->password)) {
        return back()->with('error', 'Email atau password salah.');
    }

    session(['user' => $user]);

    // Redirect berdasarkan role
    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard-admin');
    } else {
        return redirect()->route('guru.dashboard');
    }
}


    public function logout()
    {
        session()->forget('user');
        return redirect('/login');
    }
}

