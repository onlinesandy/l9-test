<div class="offcanvas offcanvas-end border-0" tabindex="-1" id="userProfileCanvasExample">
    <!--end offcanvas-header-->
    <div class="offcanvas-body profile-offcanvas p-0">
        <div class="team-cover">
            <img src="{{ Vite::asset('resources/assets/images/user.jpg') }}" alt="" class="img-fluid" />
        </div>
        <div class="p-1 pb-4 pt-0">
            <div class="team-settings">
                <div class="row g-0">
                    <div class="col">
                        <div class="btn nav-btn">
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="user-chat-nav d-flex">
                            <button type="button" class="btn nav-btn favourite-btn active">
                                <i class="ri-star-fill"></i>
                            </button>

                            <div class="dropdown">
                                <a class="btn nav-btn" href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="ri-more-2-fill"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-inbox-archive-line align-bottom text-muted me-2"></i>Archive</a></li>
                                    <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-mic-off-line align-bottom text-muted me-2"></i>Muted</a></li>
                                    <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-delete-bin-5-line align-bottom text-muted me-2"></i>Delete</a></li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!--end col-->
        </div>
        <div class="p-3 text-center">
            <img src="{{ Vite::asset('resources/assets/images/user.jpg') }}" alt="" class="avatar-lg img-thumbnail rounded-circle mx-auto profile-img">
            <div class="mt-3">
                <h5 class="fs-16 mb-1"><a href="javascript:void(0);" class="link-primary username">Lisa Parker</a></h5>
                <p class="text-muted"><i class="ri-checkbox-blank-circle-fill me-1 align-bottom text-success"></i>Online</p>
            </div>

            <div class="d-flex gap-2 justify-content-center">
                <button type="button" class="btn avatar-xs p-0" data-bs-toggle="tooltip" data-bs-placement="top" title="Message">
                    <span class="avatar-title rounded bg-light text-body">
                        <i class="ri-question-answer-line"></i>
                    </span>
                </button>

                <button type="button" class="btn avatar-xs p-0" data-bs-toggle="tooltip" data-bs-placement="top" title="Favourite">
                    <span class="avatar-title rounded bg-light text-body">
                        <i class="ri-star-line"></i>
                    </span>
                </button>

                <button type="button" class="btn avatar-xs p-0" data-bs-toggle="tooltip" data-bs-placement="top" title="Phone">
                    <span class="avatar-title rounded bg-light text-body">
                        <i class="ri-phone-line"></i>
                    </span>
                </button>

            </div>
        </div>

        <div class="border-top border-top-dashed p-3">
            <h5 class="fs-15 mb-3">Personal Details</h5>
            <div class="mb-3">
                <p class="text-muted text-uppercase fw-medium fs-12 mb-1">Number</p>
                <h6>xxx xxx xxxx</h6>
            </div>
            <div class="mb-3">
                <p class="text-muted text-uppercase fw-medium fs-12 mb-1">Email</p>
                <h6>example@gmail.com</h6>
            </div>
            <div>
                <p class="text-muted text-uppercase fw-medium fs-12 mb-1">Location</p>
                <h6 class="mb-0">California, USA</h6>
            </div>
        </div>


    </div>
</div>
