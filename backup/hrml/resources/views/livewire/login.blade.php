<div>
    <div class="max-w-md mx-auto mt-10 p-6 bg-white shadow-md rounded">
        @if (session()->has('message'))
        <div class="mb-4 text-green-500">
            {{ session('message') }}
        </div>
        @endif

        <form wire:submit.prevent="login" class="mb-4">
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" class="form-control" placeholder="Enter your email" wire:model="email" autocomplete="off">
                @error('email') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-group">
                    <input type="password" id="password" class="form-control" placeholder="Enter your password" wire:model="password" autocomplete="off">
                    <div class="input-group-append">
                        <button type="button" class="btn btn-outline-secondary" onclick="togglePassword()">👁</button>
                    </div>
                </div>
                @error('password') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="btn btn-primary btn-block" wire:loading.attr="disabled">
                <span wire:loading.remove>Sign In</span>
                <span wire:loading>Signing In...</span>
            </button>
        </form>

        <script>
            function togglePassword() {
                let passwordField = document.getElementById("password");
                passwordField.type = (passwordField.type === "password") ? "text" : "password";
            }
        </script>

    </div>

</div>