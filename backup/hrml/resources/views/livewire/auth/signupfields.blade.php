<div>
    {{-- Toggle Buttons --}}
    <div class="mb-4">
        <button wire:click="setUserType('company')" class="{{ $userType === 'company' ? 'font-bold' : '' }}">
            Signup as Company
        </button>
        |
        <button wire:click="setUserType('employee')" class="{{ $userType === 'employee' ? 'font-bold' : '' }}">
            Signup as Employee
        </button>
    </div>

    {{-- Form --}}
    <form wire:submit.prevent="register">
        <div>
            <label>Name:</label>
            <input type="text" wire:model.defer="name">
            @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <label>Email:</label>
            <input type="email" wire:model.defer="email">
            @error('email') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <label>Password:</label>
            <input type="password" wire:model.defer="password">
            @error('password') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        @if ($userType === 'company')
            <div>
                <label>Company Name:</label>
                <input type="text" wire:model.defer="companyName">
                @error('companyName') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
        @else
            <div>
                <label>Employee ID:</label>
                <input type="text" wire:model.defer="employeeId">
                @error('employeeId') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
        @endif

        <button type="submit">Register</button>
    </form>

    @if (session()->has('message'))
        <div class="mt-4 text-green-600">
            {{ session('message') }}
        </div>
    @endif
</div>
