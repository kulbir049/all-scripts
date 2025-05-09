<!-- permission-manager.blade.php -->
<div>
    <h2>Permission Management</h2>

    <!-- Success Message -->
    @if (session()->has('message'))
        <div>{{ session('message') }}</div>
    @endif

    <!-- Create or Edit Permission Form -->
    <form wire:submit.prevent="{{ $permissionId ? 'updatePermission' : 'createPermission' }}">
        <input type="text" wire:model="permissionName" placeholder="Permission Name" required>
        <button type="submit">{{ $permissionId ? 'Update' : 'Create' }} Permission</button>
    </form>

    <hr>

    <!-- Display Permissions -->
  

    <div class="row">
          <div class="col-xl-12">
							<div class="card">
								<div class="card-header pb-0">
									<div class="d-flex justify-content-between">
										<h4 class="card-title mg-b-0">Existing Permissions</h4>
									</div>
									<p class="tx-12 tx-gray-500 mb-2">Manage List of all Permissions. <a href="">Learn more</a></p>
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
                                            @foreach ($permissions as $permission)
												<tr>
													<th scope="row">{{ $permission->id }}</th>
													<td>{{ $permission->name }}</td>
													<td><button wire:click="editPermission({{ $permission->id }})">Edit</button></td>
													<td><button wire:click="deletePermission({{ $permission->id }})">Delete</button> </td>
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
