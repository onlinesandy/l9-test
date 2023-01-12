<x-app-layout>
    <div class="profile-foreground position-relative mx-n4 mt-n4">
        <div class="profile-wid-bg">
            <img src="{{ Vite::asset('resources/assets/images/profile-bg.jpg') }}" alt="" class="profile-wid-img" />
        </div>
    </div>
    <div class="pt-4 mb-4 mb-lg-3 pb-lg-4">
        <div class="row g-4">
            <div class="col-auto">
                <div class="avatar-lg">
                    <img src="{{ Vite::asset('resources/assets/images/user.jpg') }}" alt="user-img"
                        class="img-thumbnail rounded-circle" />
                </div>
            </div>
            <div class="col">
                <div class="p-2">
                    <h3 class="text-white mb-1">{{ Auth::user()->name }}</h3>
                    <p class="text-white-75">{{ Auth::user()->email }}</p>
                </div>
            </div>
            <div class="col-12 col-lg-auto">
                <div class="row text text-white-50 text-center">
                    <a href="{{ route('profile.edit') }}" class="btn btn-info">
                        <i class="ri-edit-box-line align-bottom"></i> Edit Profile
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-xxl-3">
                    @include('profile.partials.complete-profile')
                    @include('profile.partials.info')
                    @include('profile.partials.skills')
                    @include('profile.partials.login-history')

                </div>

                <div class="col-xxl-9">
                    @include('profile.partials.about')

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
