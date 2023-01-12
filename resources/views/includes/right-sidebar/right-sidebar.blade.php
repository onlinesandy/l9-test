<div class="offcanvas offcanvas-end border-0" tabindex="-1" id="right-sidebar-offcanvas">
    <div class="d-flex align-items-center bg-primary bg-gradient p-3 offcanvas-header">
        <h5 class="m-0 me-2 text-white">Right Sidebar</h5>

        <button type="button" class="btn-close btn-close-white ms-auto" id="customizerclose-btn"
            data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-0">
        <div data-simplebar class="h-100">
            @include('includes.right-sidebar.right-sidebar-navs')
            @include('includes.right-sidebar.right-sidebar-nav-body')


        </div>

    </div>

</div>
