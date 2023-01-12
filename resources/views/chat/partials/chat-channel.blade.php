<div class="position-relative" id="channel-chat" style="display: none;">
    <div class="p-3 user-chat-topbar">
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
                            </div>
                            <div class="flex-grow-1 overflow-hidden">
                                <h5 class="text-truncate mb-0 fs-16"><a class="text-reset username"
                                        data-bs-toggle="offcanvas" href="#userProfileCanvasExample"
                                        aria-controls="userProfileCanvasExample">Lisa Parker</a></h5>
                                <p class="text-truncate text-muted fs-14 mb-0 userStatus"><small>24
                                        Members</small></p>
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
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    class="feather feather-search icon-sm">
                                    <circle cx="11" cy="11" r="8"></circle>
                                    <line x1="21" y1="21" x2="16.65"
                                        y2="16.65"></line>
                                </svg>
                            </button>
                            <div class="dropdown-menu p-0 dropdown-menu-end dropdown-menu-lg">
                                <div class="p-2">
                                    <div class="search-box">
                                        <input type="text"
                                            class="form-control bg-light border-light"
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
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-info icon-sm">
                                <circle cx="12" cy="12" r="10"></circle>
                                <line x1="12" y1="16" x2="12" y2="12">
                                </line>
                                <line x1="12" y1="8" x2="12.01" y2="8">
                                </line>
                            </svg>
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
    <!-- end chat user head -->
    <div class="chat-conversation p-3 p-lg-4" id="chat-conversation" data-simplebar="init">
        <div class="simplebar-wrapper" style="margin: -24px;">
            <div class="simplebar-height-auto-observer-wrapper">
                <div class="simplebar-height-auto-observer"></div>
            </div>
            <div class="simplebar-mask">
                <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                    <div class="simplebar-content-wrapper" tabindex="0" role="region"
                        aria-label="scrollable content" style="height: auto; overflow: hidden;">
                        <div class="simplebar-content" style="padding: 24px;">
                            <ul class="list-unstyled chat-conversation-list"
                                id="channel-conversation">
                            </ul>
                            <!-- end chat-conversation-list -->

                        </div>
                    </div>
                </div>
            </div>
            <div class="simplebar-placeholder" style="width: 0px; height: 0px;"></div>
        </div>
        <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
            <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
        </div>
        <div class="simplebar-track simplebar-vertical" style="visibility: hidden;">
            <div class="simplebar-scrollbar" style="height: 0px; display: none;"></div>
        </div>
    </div>
    <div class="alert alert-warning alert-dismissible copyclipboard-alert px-4 fade show "
        id="copyClipBoardChannel" role="alert">
        Message copied
    </div>
</div>
