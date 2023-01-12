<div class="user-chat w-100 overflow-hidden">
    <div class="chat-content d-lg-flex">
        <div class="w-100 overflow-hidden position-relative">
            <div class="position-relative">
                <div class="position-relative d-none" id="users-chat">
                    @include('chat.partials.chat-panel-topbar')

                    @include('chat.partials.chat-user')
                    @include('chat.partials.chat-channel')
                    @include('chat.partials.chat-form')
                    @include('chat.partials.chat-reply')
                    @include('chat.partials.chat-image')
                </div>

            </div>
        </div>
    </div>
</div>
