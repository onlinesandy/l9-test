<div>
    <h5 class="card-title text-decoration-underline mb-3">
        Delete This Account:
    </h5>
    <p class="text-muted">
        {{ __('Follow the instructions to delete your account') }}
    </p>
    <div class="hstack gap-2 mt-3">
        <a href="javascript:void(0);" class="btn btn-soft-danger" data-bs-toggle="modal"
        data-bs-target="#DeleteAccountModal" >
        Delete Account
    </a>

    </div>
</div>

<div class="modal fade" id="DeleteAccountModal" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center p-5">
                <lord-icon src="https://cdn.lordicon.com/tdrtiskw.json" trigger="loop"
                    colors="primary:#f7b84b,secondary:#405189" style="width:130px;height:130px"></lord-icon>
                <div class="mt-4 pt-4">
                    <h4>Are you sure ?</h4>
                    <p class="text-muted">
                        {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                    </p>

                    <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
                        @csrf
                        @method('delete')
                        <div class="mb-3">
                            <x-input-label for="password" value="Please Enter Password" class="col-form-label" />
                            <x-text-input id="password" name="password" type="password" class="form-control" placeholder="Password" />
                            <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                        </div>
                        <button type="submit" class="btn btn-danger">
                            Delete
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
