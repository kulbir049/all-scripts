<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use App\Models\Signup;

class SignupForm extends Component
{
    public $userType = 'company'; // default tab

    // Form fields (shared and unique)
    public $name, $email, $password;
    public $companyName;
    public $companyWebsiteUrl;
    public $employeeId;

    public function setUserType($type)
    {
        $this->userType = $type;
        // reset fields if needed
        $this->reset(['name', 'email', 'password', 'companyName', 'companyWebsiteUrl']);
    }

    public function register()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:signups,email',
            'password' => 'required|min:6',
            'companyName' => $this->userType === 'company' ? 'required' : 'nullable',
            'companyWebsiteUrl' => $this->userType === 'company' ? 'required' : 'nullable',
        ]);

        Signup::create([
            'user_type' => $this->userType,
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password),
            'company_name' => $this->companyName,
            'company_website_url' => $this->companyWebsiteUrl,
            'employee_id' => $this->employeeId,
        ]);

        // Save logic here (e.g., User::create([...]))
        session()->flash('message', ucfirst($this->userType) . ' registered successfully!');
        $this->reset();

    }

    public function render()
    {
        return view('livewire.auth.signup-form');
    }
}
