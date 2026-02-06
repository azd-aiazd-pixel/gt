<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use App\Enum\Role;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
       
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'confirmed', Password::defaults()],
        ]);

        
        $user = DB::transaction(function () use ($validated) {
        
        
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => Role::Participant, 
        ]);

       /*
        $user->participant()->create([
            'balance' => 0,
            'nfc_tag_id' => null, 
        ]);*/

        return $user;
        });
        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('participant.dashboard');
    }
}