<?php

namespace App\Http\Livewire\Modules\SuperAdmin;

use Livewire\Component;
use App\Models\Signup;

class SignupList extends Component
{
    public $signups;
    public $editMode = false;
    public $signupId;
    public $user_type, $name, $email, $company_name, $company_website_url;

    public function mount()
    {
        $this->loadSignups();
    }

    public function loadSignups()
    {
        $this->signups = Signup::latest()->get();
    }

    public function resetForm()
    {
        $this->reset(['signupId', 'user_type', 'name', 'email', 'company_name', 'company_website_url', 'editMode']);
    }

    public function edit($id)
    {
        $signup = Signup::findOrFail($id);
        $this->signupId = $signup->id;
        $this->user_type = $signup->user_type;
        $this->name = $signup->name;
        $this->email = $signup->email;
        $this->company_name = $signup->company_name;
        $this->company_website_url = $signup->company_website_url;
        $this->editMode = true;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        $signup = Signup::find($this->signupId);
        if ($signup) {
            $signup->update([
                'name' => $this->name,
                'email' => $this->email,
                'user_type' => $this->user_type,
                'company_name' => $this->company_name,
                'company_website_url' => $this->company_website_url,
            ]);

            session()->flash('message', 'Signup updated successfully.');
            $this->resetForm();
            $this->loadSignups();
        }
    }

    public function deleteSignup($id)
    {
        $signup = Signup::find($id);
        if ($signup) {
            $signup->delete();
            session()->flash('message', 'Signup deleted successfully.');
            $this->loadSignups();
        }
    }

    public function approve($id)
    {
        // optional: update a column like `is_approved`
        session()->flash('message', 'Signup approved successfully.');
    }

    public function render()
    {
        return view('livewire.modules.super-admin.signup-list');
    }
}
