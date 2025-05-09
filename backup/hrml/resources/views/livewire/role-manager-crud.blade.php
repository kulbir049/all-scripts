<!-- resources/views/livewire/role-manager.blade.php -->

<div>
    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <h3>Manage Roles</h3>
    
  

   
    @if($roleId)
                <div>
                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif

                <h4>Edit Role</h4>
                <!-- Role Name Input -->
                <input type="text" wire:model="roleName" placeholder="Role Name" />
                @error('roleName') 
                    <span class="error text-danger">{{ $message }}</span> 
                @enderror
                
                <!-- Permissions Checkboxes -->
                <div>
                    <h5>Assign Permissions</h5>
                    @foreach($AllPermissions as $permission)
                        <label>
                            <input type="checkbox" wire:model="permissions" value="{{ $permission->id }}">
                            {{ $permission->name }}
                        </label><br>
                    @endforeach
                    @error('permissions') 
                        <span class="error text-danger">{{ $message }}</span>
                    @enderror
                </div>
                
                <button wire:click="updateRole">Update Role</button>
            </div>

        @else
        <div>
        <input type="text" wire:model="roleName" placeholder="Role Name" />
        @error('roleName') <span class="error">{{ $message }}</span> @enderror
        <div>
        <button wire:click="createRole">Create Role</button>
    </div>
    @endif
    <div class="row">
          <div class="col-xl-12">
							<div class="card">
								<div class="card-header pb-0">
									<div class="d-flex justify-content-between">
										<h4 class="card-title mg-b-0">Role List</h4>
									</div>
									<p class="tx-12 tx-gray-500 mb-2">Manage List of all roles. <a href="">Learn more</a></p>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="table mg-b-0 text-md-nowrap">
											<thead>
												<tr>
													<th>ID</th>
													<th>Name</th>
													<th>Edit & Update</th>
													<th>Delete</th>
												</tr>
											</thead>
											<tbody>
                                            @foreach($roles as $role)
												<tr>
													<th scope="row">{{ $role->id }}</th>
													<td>{{ $role->name }}</td>
													<td><button wire:click="editRole({{ $role->id }})">Edit</button></td>
													<td><button wire:click="deleteRole({{ $role->id }})">Delete</button></td>
												</tr>
												@endforeach
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
                  </div>
</div>
