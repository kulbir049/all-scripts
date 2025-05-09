<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Company;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Livewire\WithFileUploads; // To handle file uploads

class CompanyCrud extends Component
{
    use WithFileUploads; // Enable file uploads in Livewire

    public $companies, $companyId, $name, $owner_email, $hr_email, $company_logo, $company_url;
    
    protected $rules = [
        'name' => 'required|string|max:255',
        'owner_email' => 'required|email|max:255',
        'hr_email' => 'required|email|max:255',
        'company_logo' => 'nullable|image|max:1024', // Handle image upload
        'company_url' => 'nullable|url|max:255',
    ];

    public function mount()
    {
        $this->companies = Company::all(); // Load all companies when the component is mounted
    }

    // Create company
    public function createCompany()
    {
        $this->validate(); // Validate inputs

        // Handle logo upload
        $logoPath = null;
        if ($this->company_logo) {
            $logoPath = $this->company_logo->store('company_logos', 'public');
        }

       $company_id= Company::create([
            'name' => $this->name,
            'owner_email' => $this->owner_email,
            'hr_email' => $this->hr_email,
            'company_logo' => $logoPath,
            'company_url' => $this->company_url,
        ]);

        User::create([
            'name' => 'Admin',
            'email' => $this->owner_email,
            'company_id' => $company_id->id
        ]);
        User::create([
            'name' => 'HR Manager',
            'email' => $this->hr_email,
            'company_id' => $company_id->id
        ]);

        // Assign 'Owner' role to the user 
            $user_owner = User::where('email',$this->owner_email)->first();  // Find the user by ID
            $role_owner = Role::where('id', 2)->first(); // Find the role by name
            if ($user_owner && $role_owner) {
                $user_owner->assignRole($role_owner);
            }
        // Assign 'HR Manage' role to the user 
            $user_hr = User::where('email',$this->hr_email)->first();  // Find the user by ID
            $role_hr = Role::where('id', 3)->first(); // Find the role by name
            if ($user_hr && $role_hr) {
                $user_hr->assignRole($role_hr);
            }

        session()->flash('message', 'Company created successfully');
        $this->resetFields(); // Reset input fields
        $this->companies = Company::all(); // Reload the list of companies
    }

    // Edit company
    public function editCompany($id)
    {
        $company = Company::findOrFail($id);
        $this->companyId = $company->id;
        $this->name = $company->name;
        $this->owner_email = $company->owner_email;
        $this->hr_email = $company->hr_email;
        $this->company_logo = null; // Don't keep the old logo in the form
        $this->company_url = $company->company_url;
    }

    // Update company
    public function updateCompany()
    {
        $this->validate(); // Validate inputs

        // Handle logo upload (if new logo is uploaded)
        $logoPath = $this->company_logo ? $this->company_logo->store('company_logos', 'public') : null;

        $company = Company::find($this->companyId);
        $company->update([
            'name' => $this->name,
            'owner_email' => $this->owner_email,
            'hr_email' => $this->hr_email,
            'company_logo' => $logoPath ?: $company->company_logo, // Keep old logo if no new one is uploaded
            'company_url' => $this->company_url,
        ]);

        session()->flash('message', 'Company updated successfully');
        $this->resetFields(); // Reset input fields
        $this->companies = Company::all(); // Reload the list of companies
    }

    // Delete company
    public function deleteCompany($id)
    {
        $company = Company::find($id);
        if ($company->company_logo) {
            // Delete the logo file if it exists
            \Storage::delete('public/' . $company->company_logo);
        }
        $company->delete();

        session()->flash('message', 'Company deleted successfully');
        $this->companies = Company::all(); // Reload the list of companies
    }

    // Reset input fields
    public function resetFields()
    {
        $this->name = '';
        $this->owner_email = '';
        $this->hr_email = '';
        $this->company_logo = null;
        $this->company_url = '';
        $this->companyId = null;
    }

    public function render()
    {
        return view('livewire.company-crud');
    }
}
