<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Permission;

class PermissionCrud extends Component
{
        public $permissions, $permissionName, $permissionId;
    
        // Mount method to load all permissions initially
        public function mount()
        {
            $this->permissions = Permission::all();
        }
    
        // Create a new permission
        public function createPermission()
        {
            $this->validate([
                'permissionName' => 'required|unique:permissions,name',
            ]);
    
            Permission::create(['name' => $this->permissionName]);
    
            session()->flash('message', 'Permission created successfully!');
            $this->resetInputs();
            $this->permissions = Permission::all();
        }
    
        // Edit an existing permission
        public function editPermission($permissionId)
        {
            $permission = Permission::find($permissionId);
            $this->permissionName = $permission->name;
            $this->permissionId = $permissionId;
        }
    
        // Update an existing permission
        public function updatePermission()
        {
            $this->validate([
                'permissionName' => 'required|unique:permissions,name,' . $this->permissionId,
            ]);
    
            $permission = Permission::find($this->permissionId);
            $permission->name = $this->permissionName;
            $permission->save();
    
            session()->flash('message', 'Permission updated successfully!');
            $this->resetInputs();
            $this->permissions = Permission::all();
        }
    
        // Delete a permission
        public function deletePermission($permissionId)
        {
            $permission = Permission::find($permissionId);
            $permission->delete();
    
            session()->flash('message', 'Permission deleted successfully!');
            $this->permissions = Permission::all();
        }
    
        // Reset input fields
        public function resetInputs()
        {
            $this->permissionName = '';
            $this->permissionId = null;
        }
    
        public function render()
        {
            return view('livewire.permission-crud');
        }
    }
    