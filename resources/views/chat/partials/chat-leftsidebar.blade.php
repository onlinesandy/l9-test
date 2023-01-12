<div class="chat-leftsidebar">
    <div class="px-4 pt-4 mb-3">
        <div class="d-flex align-items-start">
            <div class="flex-grow-1">
                <h5 class="mb-4">Chats</h5>
            </div>
            <div class="flex-shrink-0">
                <div data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="bottom" title="Add Contact">

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-soft-info btn-sm">
                        <i class="ri-add-line align-bottom"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="search-box">
            <input type="text" class="form-control bg-light border-light" placeholder="Search here...">
            <i class="ri-search-2-line search-icon"></i>
        </div>
    </div> <!-- .p-4 -->

    <ul class="nav nav-tabs nav-tabs-custom nav-info nav-justified" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" data-bs-toggle="tab" href="#chats" role="tab">
                Chats
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#contacts" role="tab">
                Contacts
            </a>
        </li>
    </ul>

    <div class="tab-content text-muted">
        <div class="tab-pane active" id="chats" role="tabpanel">
            <div class="chat-room-list pt-3" data-simplebar>


                @include('chat.partials.chat-user-list')


            </div>
        </div>
        <div class="tab-pane" id="contacts" role="tabpanel">
            <div class="chat-room-list pt-3" data-simplebar>

                @include('chat.partials.chat-contact-list')
            </div>
        </div>
    </div>

</div>
