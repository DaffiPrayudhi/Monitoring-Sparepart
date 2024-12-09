<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);
    
        $credentials = $request->only('name', 'password');
    
        // Fetch the user by name
        $user = \App\Models\User::where('name', $request->input('name'))->first();
    
        // Check if the user exists and the password matches
        if ($user && $user->password === $request->input('password')) {
            Auth::login($user);
            $request->session()->regenerate();
    
            // Redirect based on user role
            return redirect()->intended($user->isAdmin() ? 'dashboard' : 'dashboarduser');
        }
    
        throw ValidationException::withMessages([
            'name' => 'Username atau Password salah tolong login kembali',
        ]);
    }
    

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

}
