<div>
    @section('content')
    @if (session()->has('message'))
    <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <h4>Signups List</h4>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>User Type</th>
                <th>Name</th>
                <th>Email</th>
                <th>Company</th>
                <th>Website</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($signups as $signup)
            <tr wire:key="signup-{{ $signup->id }}">
                <td>{{ ucfirst($signup->user_type) }}</td>
                <td>{{ $signup->name }}</td>
                <td>{{ $signup->email }}</td>
                <td>{{ $signup->company_name }}</td>
                <td>{{ $signup->company_website_url }}</td>
                <td>
                    <button class="btn btn-sm btn-success" wire:click="approve({{ $signup->id }})">Approve</button>
                    <button class="btn btn-sm btn-warning" wire:click="edit({{ $signup->id }})">Edit</button>
                    <button class="btn btn-sm btn-danger" wire:click="deleteSignup({{ $signup->id }})">Delete</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Edit Form --}}
    @if ($editMode)
    <hr>
    <h5>Edit Signup</h5>
    <form wire:submit.prevent="update">
        <div class="form-group">
            <label>User Type</label>
            <select class="form-control" wire:model="user_type">
                <option value="company">Company</option>
                <option value="employee">Employee</option>
            </select>
        </div>

        <div class="form-group">
            <label>Name</label>
            <input class="form-control" type="text" wire:model="name">
        </div>

        <div class="form-group">
            <label>Email</label>
            <input class="form-control" type="email" wire:model="email">
        </div>

        <div class="form-group">
            <label>Company Name</label>
            <input class="form-control" type="text" wire:model="company_name">
        </div>

        <div class="form-group">
            <label>Company Website</label>
            <input class="form-control" type="text" wire:model="company_website_url">
        </div>

        <button class="btn btn-primary" type="submit">Update</button>
        <button class="btn btn-secondary" type="button" wire:click="resetForm">Cancel</button>
    </form>
    @endif

    @endsection
</div>