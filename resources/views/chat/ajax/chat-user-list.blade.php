@foreach ($users as $u)
    <li class="" id="u_li_{{ $u->id }}" to_id="{{ $u->id }}">
        <a href="javascript: void(0);" class="unread-msg-user">
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0 chat-user-img online align-self-center me-2 ms-0">
                    <div class="avatar-xxs">
                        <img src="{{ Vite::asset('resources/assets/images/user.jpg') }}"
                            class="rounded-circle img-fluid userprofile" alt="">
                    </div>
                    <span class="user-status"></span>
                </div>
                <div class="flex-grow-1 overflow-hidden">
                    <p id="u_name_{{ $u->id }}"
                        class="text-truncate mb-0 @if ($u->messageCount > 0) fw-bold @else fw-500 @endif">
                        {{ $u->name }}</p>
                </div>
                <div class="flex-shrink-0 @if ($u->messageCount == 0) d-none @endif"
                    id="u_msg_div_{{ $u->id }}">
                    <span id="u_msg_count_{{ $u->id }}" class="badge badge-soft-info rounded p-1 fw-bold fs-12">
                        {{ $u->messageCount }}
                    </span>
                </div>


            </div>
        </a>
    </li>
@endforeach
