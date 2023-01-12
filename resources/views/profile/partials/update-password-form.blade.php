<div class="card">
    <div class="alert alert-info border-0 rounded-top rounded-0 m-0 d-flex align-items-center" role="alert">
        <div class="flex-grow-1 text-truncate"> <b>Change Password </b></div>
        <div class="flex-shrink-0">
            <a href="{{ route('password.request') }}" class="text-reset text-decoration-underline">
                Forgot Password ?
            </a>
        </div>
    </div>
    <div class="card-body">

        @if (session('status') === 'password-updated')
                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                        class="text-sm text-gray-600">{{ __('Saved.') }}</p>
        @endif

        <form class="needs-validation" novalidate method="POST" action="{{ route('password.update') }}">
            @csrf
            @method('put')
            <div class="mb-3">
                <input id="current_password" name="current_password" type="password" class="form-control"
                    autocomplete="current-password" placeholder="Enter current password" required="" />
                <div class="invalid-feedback"> The current password field is required</div>
                <x-input-error-cust :messages="$errors->updatePassword->get('current_password')"/>
            </div>
            <div class="mb-3">
                <input id="password-input" name="password" type="password" class="form-control"
                    autocomplete="new-password" placeholder="Enter new password" required="" />
                <div class="invalid-feedback">The password field is required</div>
                <x-input-error-cust :messages="$errors->updatePassword->get('password')" />
            </div>
            <div class="mb-3">
                <input id="confirm-password-input" name="password_confirmation" type="password"
                    class="form-control" autocomplete="new-password" placeholder="Confirm password" required="" />
                <div class="invalid-feedback">The Confirm password field is required</div>
                <x-input-error-cust :messages="$errors->updatePassword->get('password_confirmation')"/>

            </div>

            <div class="mb-3">
                    <button class="btn btn-info w-100" type="submit">Change Password</button>
            </div>


        </form>

    </div>
</div>
