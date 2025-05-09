<?php

namespace App\Http\Livewire\Pages;

use Livewire\Component;

class Signup extends Component
{
    public $userType = 'company'; // default tab

    // Form fields (shared and unique)
    public $name, $email, $password;
    public $companyName;
    public $employeeId;

    public function setUserType($type)
    {
        $this->userType = $type;
        // reset fields if needed
        $this->reset(['name', 'email', 'password', 'companyName', 'employeeId']);
    }

    public function register()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'companyName' => $this->userType === 'company' ? 'required' : 'nullable',
            'employeeId' => $this->userType === 'employee' ? 'required' : 'nullable',
        ]);

        // Save logic here (e.g., User::create([...]))
        session()->flash('message', ucfirst($this->userType) . ' registered successfully!');
    }

    public function render()
    {
        return view('livewire.auth.signup')->layout('layouts.custom-app');
    }
}

