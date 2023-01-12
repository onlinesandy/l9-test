<div class="dropdown ms-1 topbar-head-dropdown header-item">
    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle" data-bs-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        <img id="header-lang-img" src="{{ Vite::asset('resources/assets/images/flags/us.svg') }}" alt="Language"
            height="20" class="rounded">
    </button>
    <div class="dropdown-menu dropdown-menu-end">
        <a href="javascript:void(0);" class="dropdown-item notify-item language py-2" data-lang="in" title="India">
            <img id="lang-option-india" src="{{ Vite::asset('resources/assets/images/flags/in.svg') }}" alt="user-image" class="me-2 rounded"
                height="18">
            <span class="align-middle">India</span>
        </a>
        <a href="javascript:void(0);" class="dropdown-item notify-item language py-2" data-lang="en" title="US">
            <img id="lang-option-us" src="{{ Vite::asset('resources/assets/images/flags/us.svg') }}" alt="user-image" class="me-2 rounded"
                height="18">
            <span class="align-middle">US</span>
        </a>
        <a href="javascript:void(0);" class="dropdown-item notify-item language py-2" data-lang="sp" title="Spain">
            <img id="lang-option-spain" src="{{ Vite::asset('resources/assets/images/flags/spain.svg') }}" alt="user-image" class="me-2 rounded"
                height="18">
            <span class="align-middle">Spain</span>
        </a>

    </div>
</div>
