<div class="p-3 user-chat-topbar" id="user-chat-topbar" chat-to="">
    <div class="row align-items-center">
        <div class="col-sm-4 col-8">
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0 d-block d-lg-none me-3">
                    <a href="javascript: void(0);" class="user-chat-remove fs-18 p-1"><i
                            class="ri-arrow-left-s-line align-bottom"></i></a>
                </div>
                <div class="flex-grow-1 overflow-hidden">
                    <div class="d-flex align-items-center">
                        <div
                            class="flex-shrink-0 chat-user-img online user-own-img align-self-center me-3 ms-0">
                            <img src="{{ Vite::asset('resources/assets/images/user.jpg') }}"
                                class="rounded-circle avatar-xs" alt="">
                            <span class="user-status"></span>
                        </div>
                        <div class="flex-grow-1 overflow-hidden">
                            <h5 class="text-truncate mb-0 fs-16"><a class="text-reset username"
                                    data-bs-toggle="offcanvas" href="#userProfileCanvasExample"
                                    aria-controls="userProfileCanvasExample"></a></h5>
                            <p class="text-truncate text-muted fs-14 mb-0 userStatus">
                                <small>Online</small>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-8 col-4">
            <ul class="list-inline user-chat-nav text-end mb-0">
                <li class="list-inline-item m-0">
                    <div class="dropdown">
                        <button class="btn btn-ghost-secondary btn-icon" type="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="ri-search-2-line fs-22"></i>
                        </button>
                        <div class="dropdown-menu p-0 dropdown-menu-end dropdown-menu-lg">
                            <div class="p-2">
                                <div class="search-box">
                                    <input type="text" class="form-control bg-light border-light"
                                        placeholder="Search here..." onkeyup="searchMessages()"
                                        id="searchMessage">
                                    <i class="ri-search-2-line search-icon"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>

                <li class="list-inline-item d-none d-lg-inline-block m-0">
                    <button type="button" class="btn btn-ghost-secondary btn-icon"
                        data-bs-toggle="offcanvas" data-bs-target="#userProfileCanvasExample"
                        aria-controls="userProfileCanvasExample">
                        <i class="ri-information-line fs-22"></i>
                    </button>
                </li>

                <li class="list-inline-item m-0">
                    <div class="dropdown">
                        <button class="btn btn-ghost-secondary btn-icon" type="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-more-vertical icon-sm">
                                <circle cx="12" cy="12" r="1"></circle>
                                <circle cx="12" cy="5" r="1"></circle>
                                <circle cx="12" cy="19" r="1"></circle>
                            </svg>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item d-block d-lg-none user-profile-show"
                                href="#"><i
                                    class="ri-user-2-fill align-bottom text-muted me-2"></i> View
                                Profile</a>
                            <a class="dropdown-item" href="#"><i
                                    class="ri-inbox-archive-line align-bottom text-muted me-2"></i>
                                Archive</a>
                            <a class="dropdown-item" href="#"><i
                                    class="ri-mic-off-line align-bottom text-muted me-2"></i>
                                Muted</a>
                            <a class="dropdown-item" href="#"><i
                                    class="ri-delete-bin-5-line align-bottom text-muted me-2"></i>
                                Delete</a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>

</div>
