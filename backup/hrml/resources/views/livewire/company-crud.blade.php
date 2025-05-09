<div>
    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <h3>Manage Companies</h3>

    <!-- Create or Edit Company Form -->
    <div>
        @if($companyId)
            <h4>Edit Company</h4>
        @else
            <h4>Create New Company</h4>
        @endif
        <form wire:submit.prevent="{{ $companyId ? 'updateCompany' : 'createCompany' }}">
            <!-- Company Name -->
            <input type="text" wire:model="name" placeholder="Company Name" />
            @error('name') <span class="error">{{ $message }}</span> @enderror

            <!-- Owner Email -->
            <input type="email" wire:model="owner_email" placeholder="Owner Email" />
            @error('owner_email') <span class="error">{{ $message }}</span> @enderror

            <!-- HR Email -->
            <input type="email" wire:model="hr_email" placeholder="HR Email" />
            @error('hr_email') <span class="error">{{ $message }}</span> @enderror

            <!-- Company Logo (File Upload) -->
            <div>
                <label for="company_logo">Company Logo</label>
                <input type="file" wire:model="company_logo" accept="image/*" />
                @if($company_logo)
                    <img src="{{ $company_logo->temporaryUrl() }}" width="100" height="100" alt="Logo Preview">
                @endif
                @error('company_logo') <span class="error">{{ $message }}</span> @enderror
            </div>

            <!-- Company URL -->
            <input type="url" wire:model="company_url" placeholder="Company URL" />
            @error('company_url') <span class="error">{{ $message }}</span> @enderror

            <button type="submit">{{ $companyId ? 'Update' : 'Create' }} Company</button>
        </form>
    </div>

    <!-- Company List Table -->
    <h4>Company List</h4>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Owner Email</th>
                <th>HR Email</th>
                <th>Logo</th>
                <th>URL</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($companies as $company)
                <tr>
                    <td>{{ $company->name }}</td>
                    <td>{{ $company->owner_email }}</td>
                    <td>{{ $company->hr_email }}</td>
                    <td>
                        @if($company->company_logo)
                            <img src="{{ asset('storage/' . $company->company_logo) }}" width="50" height="50" alt="Logo">
                        @else
                            No Logo
                        @endif
                    </td>
                    <td><a href="{{ $company->company_url }}" target="_blank">{{ $company->company_url }}</a></td>
                    <td>
                        <button wire:click="editCompany({{ $company->id }})">Edit</button>
                        <button wire:click="deleteCompany({{ $company->id }})">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
