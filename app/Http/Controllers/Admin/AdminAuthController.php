<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginRequest;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function showLogin()
    {
        return view('admin.auth.login', [
            'metaTitle' => 'Admin Login | '.config('hala.site_name'),
        ]);
    }

    public function login(AdminLoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials, remember: true)) {
            return back()->withErrors(['email' => __('site.auth.invalid')])->onlyInput('email');
        }

        $request->session()->regenerate();

        if (!optional($request->user())->is_admin) {
            Auth::logout();
            return back()->withErrors(['email' => __('site.auth.invalid')])->onlyInput('email');
        }

        return redirect()->route('admin.dashboard');
    }

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
