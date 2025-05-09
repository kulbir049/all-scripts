<div>
    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <h3>Assign Permissions to User</h3>

    <div class="form-group">
        <label for="userId">Select User</label>
        <select wire:model="userId" class="form-control">
            <option value="">Select User</option>
            @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>
        @error('userId') <span class="error">{{ $message }}</span> @enderror
    </div>

    @if($userId)
        <div class="form-group">
            <h5>Select Permissions</h5>
            @foreach($permissions as $permission)
                <div>
                    <label>
                        <input type="checkbox" wire:model="userPermissions" value="{{ $permission->id }}">
                        {{ $permission->name }}
                    </label>
                </div>
            @endforeach
            @error('userPermissions') <span class="error">{{ $message }}</span> @enderror
        </div>

        <button wire:click="assignPermissions" class="btn btn-primary">Assign Permissions</button>
    @endif
</div>
