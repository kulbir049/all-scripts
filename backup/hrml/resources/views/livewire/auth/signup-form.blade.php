<div class="main-card-signin d-md-flex">
    <div class="wd-100p">
        <div class="text-center mb-4">
            <a href="{{ url('index') }}">
                <img src="{{ asset('assets/img/brand/favicon.png') }}" class="sign-favicon ht-40" alt="logo">
            </a>
        </div>

        <div class="main-signup-header">
            <h2 class="text-dark text-center">Get Started</h2>
            <h6 class="font-weight-normal mb-4 text-center">It's free to signup and only takes a minute.</h6>

            <!-- User type buttons -->
            <div class="mb-3 text-center">
                <button type="button" class="btn btn-sm me-2 {{ $userType === 'company' ? 'btn-primary' : 'btn-outline-primary' }}" wire:click="setUserType('company')">Company</button>
                <button type="button" class="btn btn-sm {{ $userType === 'employee' ? 'btn-primary' : 'btn-outline-primary' }}" wire:click="setUserType('employee')">Employee</button>
            </div>

            @if (session()->has('message'))
                <div class="alert alert-success text-center">{{ session('message') }}</div>
            @endif

            <form wire:submit.prevent="register">
                <div class="form-group">
                    <label>Firstname & Lastname</label>
                    <input class="form-control" type="text" placeholder="Enter your name" wire:model="name">
                    @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input class="form-control" type="email" placeholder="Enter your email" wire:model="email">
                    @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input class="form-control" type="password" placeholder="Enter your password" wire:model="password">
                    @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                @if ($userType === 'company')
                    <div class="form-group">
                        <label>Company Name</label>
                        <input class="form-control" type="text" placeholder="Enter company name" wire:model="companyName">
                        @error('companyName') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="form-group">
                        <label>Company's Website Url</label>
                        <input class="form-control" type="url" placeholder="Enter company website url" wire:model="companyWebsiteUrl">
                        @error('companyWebsiteUrl') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
               
                @endif

                <button type="submit" class="btn btn-primary btn-block">Create Account</button>
            </form>

            <div class="main-signup-footer mt-3 text-center">
                <p>Already have an account? <a href="{{ route('login') }}">Sign In</a></p>
            </div>
        </div>
    </div>
</div>
