<div class="dropdown ms-sm-3 header-item topbar-user">
    <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
        aria-expanded="false">
        <span class="d-flex align-items-center">
            <img class="rounded-circle header-profile-user" src="{{ Vite::asset('resources/assets/images/user.jpg') }}"
                alt="Header Avatar">
            <span class="text-start ms-xl-2">
                <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text">{{ Auth::user()->name }}</span>
                <span
                    class="d-none d-xl-block ms-1 fs-12 text-muted user-name-sub-text">{{ Auth::user()->email }}</span>
            </span>
        </span>
    </button>
    <div class="dropdown-menu dropdown-menu-end">
        <!-- item-->
        <h6 class="dropdown-header">Welcome {{ Auth::user()->name }}!</h6>
        <a class="dropdown-item" href="{{ route('profile.index') }}">
            <i class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i> <span
                class="align-middle">Profile</span>
            </a>
        <a class="dropdown-item" href="{{ route('chat') }}">
            <i class="mdi mdi-message-text-outline text-muted fs-16 align-middle me-1"></i>
            <span class="align-middle">Messages</span>
        </a>
        <a class="dropdown-item" href="{{ route('helpdesk') }}">
            <i class="ri-ticket-2-line text-muted fs-16 align-middle me-1"></i>
            <span class="align-middle">Helpdesk</span>
        </a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="{{ route('settings') }}">
            <span class="badge bg-soft-success text-success mt-1 float-end">New</span>
            <i class="mdi mdi-cog-outline text-muted fs-16 align-middle me-1"></i>
            <span class="align-middle">Settings</span>
        </a>
        <a class="dropdown-item" href="{{ route('lock-screen') }}">
            <i class="mdi mdi-lock text-muted fs-16 align-middle me-1"></i>
            <span class="align-middle">Lock screen</span>
        </a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <x-nav-link class="dropdown-item" :href="route('logout')"
                onclick="event.preventDefault();
                this.closest('form').submit();">
                <i class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i>
                <span class="align-middle" data-key="t-logout">Logout</span>
            </x-nav-link>
        </form>

        </a>
    </div>
</div>
