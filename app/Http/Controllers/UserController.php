<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Types\Relations\Role;

class UserController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }
    public function register(Request $request)
    {
        $request->validate([
            // User Validation
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            // Company Validation 
            'role' => 'required|in:seeker,company,admin',
            'company_name' => 'nullable|string|max:255',
            'company_location' => 'nullable|string|max:255',
            'company_website' => 'nullable|url|max:255',

        ]);

        if ($request->role === 'company') {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'role' => 'company',
                'password' => Hash::make($request->password)
            ]);
            $user = User::where('email', $request->email)->first();
            $user->companies()->create([
                'user_id' => $user->id,
                'name' => $request->company_name,
                'location' => $request->company_location,
                'website' => $request->company_website,
            ]);
        // } else if ($request->role === 'seeker') {
        //     User::create([
        //         'name' => $request->name,
        //         'email' => $request->email,
        //         'role' => 'seeker',
        //         'password' => Hash::make($request->password)
        //     ]);
        }
        return redirect()->route('home');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|string',
            'password' => 'required|string|min:8'
        ]);
        if (!Auth::attempt($request->only('email', 'password'))) {
            return redirect()->back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
                'password' => 'The provided password is incorrect.',
            ])->withInput();
        }
        $user = User::where('email', $request->email)->firstorfail();
        $token = $user->createtoken('Auth_Token')->plainTextToken;
        return redirect()->route('home');
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }


    public function show(User $user)
    {
        return view('user.show', compact('user'));
    }
}
