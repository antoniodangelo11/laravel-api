<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900 mt-2">
            Delete Account
        </h2>

        <p class="mt-1 text-sm text-gray-600 mt-2">
            Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.
        </p>
    </header>

    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirm-user-deletion">
        {{ __('Delete Account') }}
    </button>

    <div class="modal fade" id="confirm-user-deletion" tabindex="-1" aria-labelledby="confirm-user-deletion-label" aria-hidden="true">
        <div class="modal-dialog">
            <form method="post" action="{{ route('admin.profile.destroy') }}" class="modal-content p-6">
                @csrf
                @method('delete')

                <div class="mb-3">
                    <label for="password">Password</label>
                    <input class="mt-2" type="password" id="password" name="password">
                    @error('password')
                        {{ $message }}
                    @enderror
                </div>

                <button class="btn btn-danger">Delete Account</button>
            </form>
        </div>
    </div>
</section>
