<form id="send-verification" method="post" action="{{ route('verification.send') }}">
    @csrf
</form>

<form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
    @csrf
    @method('patch')
    <div class="row">
        <div class="col-lg-6">
            <div class="mb-3">
                <x-input-label for="name" class="form-label" :value="__('Name')" />
                <x-text-input id="name" name="name" type="text" class="form-control" :value="old('name', $user->name)"
                    required autofocus autocomplete="name" placeholder="Enter your firstname" />
                <x-input-error-cust :messages="$errors->get('name')" />
            </div>
        </div>
        <!--end col-->
        <div class="col-lg-6">
            <div class="mb-3">
                <x-input-label for="email" class="form-label" :value="__('Email')" />
                <x-text-input id="email" name="email" type="email" class="form-control" :value="old('email', $user->email)"
                    required autocomplete="email" placeholder="Enter your lastname" />
                <x-input-error-cust :messages="$errors->get('email')" />

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                    <div>
                        <p class="text-sm mt-2 text-gray-800">
                            {{ __('Your email address is unverified.') }}

                            <button form="send-verification" class="btn btn-info">
                                {{ __('Click here to re-send the verification email.') }}
                            </button>
                        </p>

                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-2 font-medium text-sm text-green-600">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </p>
                        @endif
                    </div>
                @endif
            </div>
        </div>
        <!--end col-->
        <div class="col-lg-6">
            <div class="mb-3">
                <label for="phonenumberInput" class="form-label">Phone
                    Number</label>
                <input type="text" class="form-control" id="phonenumberInput" placeholder="Enter your phone number"
                    value="">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="mb-3">
                <label for="JoiningdatInput" class="form-label">Joining
                    Date</label>
                <input type="text" class="form-control" data-provider="flatpickr" id="JoiningdatInput"
                    data-date-format="d M, Y" data-deafult-date="24 Nov, 2021" placeholder="Select date" />
            </div>
        </div>
        <!--end col-->
        <div class="col-lg-12">
            <div class="mb-3">
                <label for="skillsInput" class="form-label">Skills</label>
                <select class="form-control" name="skillsInput" data-choices data-choices-text-unique-true multiple
                    id="skillsInput">
                    <option value="illustrator">Illustrator</option>
                    <option value="photoshop">Photoshop</option>
                    <option value="css">CSS</option>
                    <option value="html">HTML</option>
                    <option value="javascript" selected>Javascript
                    </option>
                    <option value="python">Python</option>
                    <option value="php">PHP</option>
                </select>
            </div>
        </div>
        <!--end col-->
        <div class="col-lg-6">
            <div class="mb-3">
                <label for="designationInput" class="form-label">Designation</label>
                <input type="text" class="form-control" id="designationInput" placeholder="Designation"
                    value="">
            </div>
        </div>
        <!--end col-->
        <div class="col-lg-6">
            <div class="mb-3">
                <label for="websiteInput1" class="form-label">Website</label>
                <input type="text" class="form-control" id="websiteInput1" placeholder="www.example.com"
                    value="" />
            </div>
        </div>
        <!--end col-->
        <div class="col-lg-4">
            <div class="mb-3">
                <label for="cityInput" class="form-label">City</label>
                <input type="text" class="form-control" id="cityInput" placeholder="City" value="California" />
            </div>
        </div>
        <!--end col-->
        <div class="col-lg-4">
            <div class="mb-3">
                <label for="countryInput" class="form-label">Country</label>
                <input type="text" class="form-control" id="countryInput" placeholder="Country"
                    value="United States" />
            </div>
        </div>
        <!--end col-->
        <div class="col-lg-4">
            <div class="mb-3">
                <label for="zipcodeInput" class="form-label">Zip
                    Code</label>
                <input type="text" class="form-control" minlength="5" maxlength="6" id="zipcodeInput"
                    placeholder="Enter zipcode" value="">
            </div>
        </div>
        <!--end col-->
        <div class="col-lg-12">
            <div class="mb-3 pb-2">
                <label for="exampleFormControlTextarea" class="form-label">Description</label>
                <textarea class="form-control" id="exampleFormControlTextarea" placeholder="Enter your description" rows="3">
                    Hi I'm Anna Adame,It will be as simple as Occidental; in fact, it will be Occidental. To an English person, it will seem like simplified English, as a skeptical Cambridge friend of mine told me what Occidental is European languages are members of the same family.
                </textarea>
            </div>
        </div>
        <!--end col-->
        <div class="col-lg-12">
            <div class="hstack gap-2 justify-content-end">
                <button type="submit" class="btn btn-info">Save</button>

                @if (session('status') === 'profile-updated')
                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                        class="text-sm text-gray-600">
                        {{ __('Saved.') }}</p>
                @endif
            </div>
        </div>
        <!--end col-->
    </div>
    <!--end row-->
</form>
