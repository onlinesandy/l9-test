<div class="dropdown topbar-head-dropdown ms-1 header-item">
    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle"
        id="page-header-cart-dropdown" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-haspopup="true"
        aria-expanded="false">
        <i class='bx bx-bell fs-22'></i>

            <span
                class="position-absolute topbar-badge notification-topbar-badge fs-10 translate-middle badge rounded-pill bg-info  @if (count(auth()->user()->notifications) == 0) d-none  @endif">
                {{ count(auth()->user()->unreadNotifications) ? count(auth()->user()->unreadNotifications) : "" }}
            </span>

    </button>
    <div class="dropdown-menu dropdown-menu-xl dropdown-menu-end p-0 dropdown-menu-cart"
        aria-labelledby="page-header-cart-dropdown">
        <div class="p-3 border-top-0 border-start-0 border-end-0 border-dashed border">
            <div class="row align-items-center">
                <div class="col">
                    <h6 class="m-0 fs-16 fw-semibold"> Notifications</h6>
                </div>
                <div class="col-auto">
                    @if (count(auth()->user()->notifications) > 0)
                        <span class="badge badge-soft-warning fs-13">
                            <span class="notification-badge">{{ count(auth()->user()->unreadNotifications) }}</span>
                            item
                        </span>
                    @endif
                </div>
            </div>
        </div>

            <div data-simplebar style="max-height: 300px;">
                <div class="p-2">
                    <div class="notifications-inner-block">
                        @if (count(auth()->user()->notifications) > 0)
                        @foreach (auth()->user()->unreadNotifications as $n)
                        @php
                            $notify_link = 'javascript:void(0)';
                            if(isset($n->data['url'])){
                                $notify_link = $n->data['url'];
                            }

                        @endphp
                            <div class="d-block notification-item dropdown-item dropdown-item-cart text-wrap px-3 py-2">
                                <div class="d-flex align-items-center">
                                    <div class="avatar-xs me-3">
                                        <span class="avatar-title bg-soft-info text-info rounded-circle fs-16">
                                            <i class="bx bx-badge-check"></i>
                                        </span>
                                    </div>
                                    <div class="flex-1">
                                        <a href="{{ $notify_link }}" class="stretched-link">
                                        <p class="mt-0 mb-1 fs-14">
                                            {{ $n->data['message'] }}
                                        </p>
                                    </a>
                                        <p class="mb-0 fs-12 text-muted">
                                            <span><i class="mdi mdi-clock-outline"></i>
                                                {{ Carbon::parse($n->created_at)->diffForHumans() }}</span>
                                        </p>
                                    </div>
                                    <div class="ps-2">
                                        <form method="POST" action="{{ route('notification.read', $n->id) }}">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-sm btn-soft-info">Mark as
                                                Read</button>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                        @else
                        <div class="text-center" id="empty-notification">
                            <div class="avatar-md mx-auto my-3">
                                <div class="avatar-title bg-soft-info text-info fs-36 rounded-circle">
                                    <i class='bx bx-bell'></i>
                                </div>
                            </div>
                            <h5 class="mb-3">No Notification Yet</h5>
                        </div>
                    @endif

                    </div>
                </div>
            </div>
            <div class="my-3 text-center d-none all-notofication-div @if (count(auth()->user()->notifications) == 0) d-none  @endif">
                <button type="button" class="btn btn-soft-info waves-effect waves-light">
                    View All Notifications
                    <i class="ri-arrow-right-line align-middle"></i>
                </button>
            </div>

    </div>
</div>
