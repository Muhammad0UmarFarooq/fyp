<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Handle entrepreneur registration.
     */
    public function registerEntrepreneur(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'cnic' => 'required|string|max:15',
            'phone' => 'required|string|max:20',
            'city' => 'required|string|max:100',
            'company_name' => 'required|string|max:255',
            'total_valuation' => 'required|numeric',
            'future_valuation' => 'required|numeric',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'entrepreneur',
            'cnic' => $request->cnic,
            'phone' => $request->phone,
            'city' => $request->city,
        ]);

        $user->entrepreneurProfile()->create([
            'company_name' => $request->company_name,
            'total_valuation' => $request->total_valuation,
            'future_valuation' => $request->future_valuation,
        ]);

        Auth::login($user);

        return redirect()->route('entrepreneur.dashboard');
    }

    /**
     * Handle investor registration.
     */
    public function registerInvestor(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'cnic' => 'required|string|max:15',
            'phone' => 'required|string|max:20',
            'city' => 'required|string|max:100',
            'investment_amount' => 'required|numeric',
            'investment_focus' => 'required|string',
            'businesses' => 'nullable|array',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'investor',
            'cnic' => $request->cnic,
            'phone' => $request->phone,
            'city' => $request->city,
        ]);

        $user->investorProfile()->create([
            'investment_amount' => $request->investment_amount,
            'investment_focus' => $request->investment_focus,
            'interested_businesses' => $request->businesses, // Will be cast to JSON if defined in model
        ]);

        Auth::login($user);

        return redirect()->route('investor.home');
    }

    /**
     * Handle a login request.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            $user = Auth::user();

            if ($user->role === 'entrepreneur') {
                return redirect()->intended(route('entrepreneur.dashboard'));
            }

            if ($user->role === 'investor') {
                return redirect()->intended(route('investor.home'));
            }

            return redirect()->intended(route('home'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * Handle a logout request.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
