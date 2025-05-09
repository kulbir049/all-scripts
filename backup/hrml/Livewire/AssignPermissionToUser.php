<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Spatie\Permission\Models\Permission;

class AssignPermissionToUser extends Component
{
    public $users; // All users
    public $permissions; // All permissions
    public $userId; // Selected user
    public $userPermissions = []; // Permissions to be assigned

    // Load users and permissions on mount
    public function mount()
    {
        $this->users = User::where('company_id',auth()->user()->company_id)
        ->where('id','!=',auth()->user()->id)
        ->get(); // Fetch all users
        $this->permissions = Permission::all(); // Fetch all permissions
    }

    // Assign permissions to a user
    public function assignPermissions()
    {
        $this->validate([
            'userId' => 'required|exists:users,id', // Ensure the user exists
            'userPermissions' => 'required|array|min:1', // At least one permission should be selected
            'userPermissions.*' => 'exists:permissions,id', // Ensure all selected permissions are valid
        ]);

        $user = User::find($this->userId); // Find the user by ID
        $user->syncPermissions($this->userPermissions); // Sync selected permissions with the user

        session()->flash('message', 'Permissions assigned successfully.');
    }

    public function render()
    {
        $permissions = Permission::all();
        return view('livewire.assign-permission-to-user',compact('permissions'));
    }
}
