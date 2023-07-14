<form action="{{ route('password.update') }}" method="post">
    @csrf
    @method('put')

    <div class="mb-3">
        <label for="password" class="form-label">Current Password</label>
        <input class="mt-2" type="password" class="form-control" id="password" name="current_password">
        @error('current_password')
            {{ $message }}
        @enderror
    </div>
    
    <div class="mb-3">
        <label for="password" class="form-label">New Password</label>
        <input class="mt-2" type="password" class="form-control" id="password" name="password">
        @error('password')
            {{ $message }}
        @enderror
    </div>
    
    <div class="mb-3">
        <label for="password" class="form-label">Password Confirmation</label>
        <input class="mt-2" type="password" class="form-control" id="password" name="password_confirmation">
        @error('password_confirmation')
            {{ $message }}
        @enderror
    </div>
    
    <div class="d-flex align-items-center gap-4">
        <button class="btn btn-primary">{{ 'Save' }}</button>
    
        @if (session('status') === 'password-updated')
            <p
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 2000)"
                class="text-sm text-gray-600"
            >Updated</p>
        @endif
    </div>
</form>
