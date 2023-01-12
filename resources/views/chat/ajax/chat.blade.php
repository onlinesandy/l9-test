@foreach ($chats as $c)
    <li msg-id="{{ $c->id }}" class="chat-list @if (auth()->user()->id == $c->from_id) right @else left @endif"
        id="{ $c->id }}">
        <div class="conversation-list">
            @if (auth()->user()->id != $c->from_id)
                <div class="chat-avatar">
                    <img src="{{ Vite::asset('resources/assets/images/user.jpg') }}" alt="">
                </div>
            @endif

            <div class="user-chat-content">
                <div class="conversation-name">
                    <span class="@if (auth()->user()->id == $c->from_id) d-none @endif name">
                        @if (auth()->user()->id == $c->from_id)
                            You
                        @else
                            {{ App\Models\User::find($c->from_id)->name }}
                        @endif
                    </span>
                    <small class="text-muted time">{{ $c->created_at->format('h:i A') }}</small>
                    <span class="text-success check-message-icon" id="check-message-icon-{{ $c->id }}">
                        @if ($c->read_status == 1)
                            <i class="bx bx-check-double"></i>
                        @else
                            <i class="bx bx-check"></i>
                        @endif
                    </span>
                </div>
                <div class="ctext-wrap">
                    <div class="ctext-wrap-content" id="{{ $c->id }}">
                        @if ($c->reply_to > 0)
                            <div class="replymessage-block mb-0 d-flex align-items-start">
                                <div class="flex-grow-1">
                                    <h5 class="conversation-name">

                                        @if (auth()->user()->id == App\Models\Message::find($c->reply_to)->from_id)
                                            You
                                        @else
                                            {{ App\Models\User::find(App\Models\Message::find($c->reply_to)->from_id)->name }}
                                        @endif
                                    </h5>
                                    <p class="mb-0"> {{ App\Models\Message::find($c->reply_to)->message }} </p>
                                </div>
                            </div>
                        @endif
                        @if ($c->file_id > 0)
                            <img src="{{ Vite::asset('resources' . $c->chat_file->unique_name) }}" class="chat-img" />
                        @endif

                        <p class="mb-0 ctext-content">{{ $c->message }}</p>
                    </div>
                    <div class="dropdown align-self-start message-box-drop">
                        <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="ri-more-2-fill"></i>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item reply-message" href="#">
                                <i class="ri-reply-line me-2 text-muted align-bottom"></i>
                                Reply
                            </a>
                            <a class="dropdown-item copy-message" href="#">
                                <i class="ri-file-copy-line me-2 text-muted align-bottom"></i>
                                Copy
                            </a>
                            @if (auth()->user()->id == $c->from_id)
                                <a class="dropdown-item delete-item" href="#" del-msg-id="{{ $c->id }}">
                                    <i class="ri-delete-bin-5-line me-2 text-muted align-bottom"></i>
                                    Delete
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </li>
@endforeach
