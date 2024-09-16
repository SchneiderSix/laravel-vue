<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Call;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request) {
        // Show progress bar
        sleep(1);
        // Validate values from input
        $fields = $request->validate([
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email','max:255', 'unique:users'],
            'password' => ['required', 'confirmed']
        ]);

        // Register new user
        $user = User::create($fields);
        // Login
        Auth::login($user);

        // Redirect
        return redirect()->route('home');
    }

    public function login(Request $request) {
        // Show progress bar
        sleep(1);
        // Validate values from input
        $fields = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        // Check credentials
        if (Auth::attempt($fields, $request->remember)) {
            $request->session()->regenerate();

            $count = Call::where('user_id', Auth::id())->count();
            //dd($count);
            //session(['count' => $count]);
            return redirect()->route('home');
            //return inertia('Home', ['count' => $count]);
        }

        // Wrong credentials
        return back()->withErrors([
            'email' => 'El correo no se encuentra registrado o la contraseña es invalida.',
        ])->onlyInput('email');

    }

    public function logout(Request $request) {
        
        // Logout user and destroy cookie
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
