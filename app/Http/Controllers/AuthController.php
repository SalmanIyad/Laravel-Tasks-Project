<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        if (! Auth::check()) {
            $roles = ['Admin', 'User', 'Guest'];

            return view('login', compact('roles'));
        } else {
            return redirect('/dashboard');
        }
    }

    public function loginPost(Request $request)
    {
        // Validation

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required|in:Admin,User,Guest',
        ], [
            'email.required' => 'Email is required',
            'password.required' => 'Password is required',
        ]);

        // 2. Prepare credentials 
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
            'role' => $request->role,
        ];

        // 3. Attempt to authenticate
        if (Auth::attempt($credentials)) {

            // renew the session to prevent session fixation attacks
            $request->session()->regenerate();

            return redirect('/dashboard');
        }

        return redirect('/login')->with('error', 'Incorrect email, password, or role');
    }

    public function register()
    {
        if (Auth::check()) {
            return redirect('/dashboard');
        }
        
        $roles = ['Admin', 'User', 'Guest'];
        return view('register', compact('roles'));
    }

    public function registerPost(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users', // unique
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:Admin,User,Guest',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // hash the password
            'role' => $request->role,
        ]);

        Auth::login($user);


        return redirect('/dashboard');
    }
    public function logout(Request $request)
    {
        Auth::logout();

        // invalidate the session and regenerate the CSRF token to prevent session fixation attacks
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
    public function edit()
    {
        $user = Auth::user();
        $roles = ['Admin', 'User', 'Guest'];
        return view('edit_user', compact('user', 'roles'));
    }

    public function update(Request $request)
    {
        $user = User::find(Auth::id());

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|in:Admin,User,Guest',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect('/dashboard')->with('success', 'Profile updated successfully!');
    }

    public function destroy()
    {
        $user = User::find(Auth::id());
        
        Auth::logout();
        $user->delete();

        return redirect('/login')->with('success', 'Account deleted successfully.');
    }
}
