<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleManagerCrud extends Component
{
    public $roles, $roleName, $roleId, $permissions = [], $AssinedPermissions = [], $AllPermissions = [];
    
    protected $rules = [
        'roleName' => 'required|string|unique:roles,name',
    ];

    public function mount()
    {
        $this->roles = Role::all();
    }

    // Create Role
    public function createRole()
    {
        $this->validate();
        Role::create(['name' => $this->roleName]);
        $this->resetFields();
        session()->flash('message', 'Role created successfully');
        $this->roles = Role::all();
    }

    // Edit Role
    public function editRole($id)
    {
        $role = Role::find($id);
        $this->roleId = $role->id;
        $this->roleName = $role->name;
        $this->AssinedPermissions = $role->permissions->pluck('id')->toArray();
        $this->AllPermissions = Permission::all();
    }

    public function updateRole()
    {
        // Validate the form data
        $this->validate([
            'roleName' => 'required|string|unique:roles,name,' . $this->roleId, // Ignore the current role being updated
            'permissions' => 'required|array|min:1',  // Validate permissions (at least one permission selected)
            'permissions.*' => 'exists:permissions,id',  // Ensure all selected permissions exist in the DB
        ]);
    
        // Find the role by its ID
        $role = Role::find($this->roleId);
    
        // Filter out invalid permissions (if any)
        $validPermissions = Permission::whereIn('id', $this->permissions)->get();
        $validPermissionIds = $validPermissions->pluck('id')->toArray();
    
        // Update the role name and sync permissions
        $role->update(['name' => $this->roleName]);
        
        // Sync only valid permissions to the role
        $role->syncPermissions($validPermissionIds);
    
        // Reset fields and display success message
        $this->resetFields();
        session()->flash('message', 'Role updated successfully');
    
        // Reload the roles list
        $this->roles = Role::all();
    }
    

    // Delete Role
    public function deleteRole($id)
    {
        $role = Role::find($id);
        $role->delete();
        session()->flash('message', 'Role deleted successfully');
        $this->roles = Role::all();
    }

    public function render()
    {
        $AllPermissions = Permission::all();
        return view('livewire.role-manager-crud', compact('AllPermissions'));
    }

    public function resetFields()
    {
        $this->roleName = '';
        $this->roleId = null;
        $this->permissions = [];
    }
}
