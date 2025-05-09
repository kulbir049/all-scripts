<?php

namespace App\Http\Livewire\Auth;


use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Models\Role;

class Signin extends Component
{
    public $email, $password;

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Handle the callback from Google.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->user();

        // Check if the user exists in the database, or create a new user
        $user = User::where('email', $googleUser->getEmail())->first();


        if (!$user) {
            // Create a new user if not found
            $user = User::create([
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'google_id' => $googleUser->getId(),
                // You can add more fields here if you want
            ]);
        }
        
        if (empty($user->company_id) && !$user->hasRole('super-admin')) {
            return redirect()->route('login')->with('error','Your account not approved by your employer!');
        }

        // Log the user in
        Auth::login($user, true);

        // Redirect to the intended page
        return redirect()->route('dashboard')->with('success','Login Successfull!');;  // Adjust to your dashboard route
    }
    // Logout function
    public function logout()
    {
        Auth::logout();  // Log the user out
        session()->invalidate();  // Invalidate the session
        session()->regenerateToken();  // Regenerate the CSRF token

        // Redirect the user to the login page
        return redirect()->route('login'); // Adjust route if needed
    }
    public function render()
    {
        // Assign 'admin' role to a user
        // $user = User::find(3);  // Find a user by ID
        
        // $role = Role::where('name', 'HR Manager')->first();
        // //dd($user,$role);
        // $user->roles()->attach($role);

        return view('livewire.auth.signin')->layout('layouts.custom-app'); // Use custom layout for Signin page
    }
}