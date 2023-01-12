<div class="chat-input-section p-3 p-lg-4">

    <form id="chatinput-form" enctype="multipart/form-data">
        <div class="row g-0 align-items-center">
            <div class="col-auto">
                <div class="chat-input-links me-2">
                    <div class="links-list-item">
                        <button type="button" class="btn btn-link text-decoration-none emoji-btn" id="emoji-btn">
                            <i class="bx bx-smile align-middle"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-auto">
                <div class="chat-input-links">
                    <div class="links-list-item">
                        <span class="btn btn-link text-decoration-none" id="chat_file_btn">
                            <i class="bx bx-link align-middle fs-20"></i>
                        </span>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="chat-input-feedback">
                    Please Enter a Message
                </div>
                <input type="text" class="form-control chat-input bg-light border-light" id="chat-input"
                    placeholder="Type your message..." autocomplete="off">
                <input type="hidden" name="to_id" id="to_id_input" value="" />
                <input type="hidden" name="reply_to" id="reply_to_input" value="" />
                <input type="file" name="chat_file" id="chat_file_input" value="" class="d-none">
            </div>
            <div class="col-auto">
                <div class="chat-input-links ms-2">
                    <div class="links-list-item">

                        <button type="submit" class="btn btn-info chat-send waves-effect waves-light">
                            <i class="ri-send-plane-2-fill align-bottom"></i>
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </form>
</div>
