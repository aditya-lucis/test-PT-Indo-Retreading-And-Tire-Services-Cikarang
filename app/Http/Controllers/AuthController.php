<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request) {
        $validated = $request->validate([
            'email'    => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($validated)) {
            $request->session()->regenerate();

            return response()->json([
                'redirect' => url('/products'),
            ]);
        }

        return response()->json([
            'message' => 'Email atau password salah.',
        ], 401);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
