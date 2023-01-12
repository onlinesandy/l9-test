<div class="offcanvas offcanvas-top" tabindex="-1" id="offcanvasTop" aria-labelledby="offcanvasTopLabel"
    style="min-height:46vh;">
    <div class="offcanvas-header border-bottom">
        <h5 class="offcanvas-title text-grey" id="offcanvasTopLabel">Mega Menu</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <div class="offcanvas-body">
        <div class="row g-3">
            <div class="col-md-2 mt-0">
                <div class="card card-height-100">
                    <div class="alert alert-info border-0 rounded-0 m-0 d-flex align-items-center" role="alert">
                        <div class="flex-grow-1 text-truncate"> <b>Quick Links </b></div>
                    </div>
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush border-dashed px-3">
                            <li class="list-group-item ps-0"><a href="{{ route('menu') }}">Menu</a></li>
                            <li class="list-group-item ps-0"><a href="{{ route('permission') }}">Permission</a></li>
                            <li class="list-group-item ps-0"><a href="{{ route('roles.index') }}">Roles</a></li>
                            <li class="list-group-item ps-0"><a href="{{ route('users.index') }}">Users</a></li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>



    </div>
</div>
