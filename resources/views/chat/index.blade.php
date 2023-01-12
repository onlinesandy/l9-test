<x-app-layout>
    <link rel="stylesheet" type="text/css" href="{{ Vite::asset('resources/assets/libs/toastify-js/src/toastify.css') }}">

    <x-breadcrumbs :help=$help_url :title=$title :breadcrumb=$breadcrumb></x-breadcrumbs>

    <div class="container-fluid">
        <div class="chat-wrapper d-lg-flex gap-1 mx-n4 mt-n4 p-1">
            @include('chat.partials.chat-leftsidebar')
            @include('chat.partials.chat-panel')
        </div>
    </div>

    <div id="chat-msg-popup" class="toast" role="alert" aria-live="polite" aria-atomic="true" data-delay="50000"
        style="position: absolute; top: 10%; right: 0%;z-index:1002;">
        <div role="alert" aria-live="assertive" aria-atomic="true" class="toast" style="display: block">
            <div class="toast-header bg-info">
                <strong class="mr-auto text-white" id="chat-msg-from"></strong>
            </div>
            <div class="toast-body bg-white" id="chat-msg-text"></div>
        </div>
    </div>



    <script src="{{ Vite::asset('resources/assets/libs/toastify-js/src/toastify.js') }}"></script>

    <script src="{{ Vite::asset('resources/assets/libs/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ Vite::asset('resources/assets/libs/fg-emoji-picker/fgEmojiPicker.js') }}"></script>
    <script src="{{ Vite::asset('resources/js/chat.init.js') }}"></script>

    <script>
        let delchatMsgUrl = "{{ route('delChatMsg') }}";
        getchatUserList("{{ route('getchatUserList') }}", {});
        getchatContactList("{{ route('getchatContactList') }}", {});



        $(document).ready(function() {

            EmojiPicker("{{ Vite::asset('resources/assets/js/pages/plugins/json') }}");

            window.Echo.private(`ChatMsgSeen-{{ auth()->user()->id }}`)
                .listen('.ChatMsgSeen', (data) => {
                    let m = data.msg;
                    $("#check-message-icon-" + m.id).find("i.bx").removeClass("bx-check").addClass(
                        "bx-check-double");
                });

            $("#users-chat").on("click", "#close_toggle_chat_img", function(ele) {
                $(".chatImgCard").removeClass("show");
                $("#chat_file_input").val("");
                $('#imgPreview').addClass("d-none");
            });

            $("#chat_file_btn").on('click', function(event) {
                $("#chat_file_input").click();
            });
            $("#chat_file_input").on('change', function() {
                const file = this.files[0];
                $(".chatImgCard").addClass("show");
                if (file) {
                    let reader = new FileReader();
                    reader.onload = function(event) {
                        // console.log(event.target.result);
                        $('#imgPreview').attr('src', event.target.result);
                        $('#imgPreview').removeClass("d-none");
                    }
                    reader.readAsDataURL(file);
                }
            });


            $("#chatinput-form").on('submit', function(event) {
                event.preventDefault();
                let msg = $("#chat-input").val();
                let to_id = $("#to_id_input").val();
                let reply_to = $("#reply_to_input").val();
                let reply_conversation_name = '';
                let reply_conversation_text = '';
                let newMsgHtml = '';
                let chtImg = $('#chat_file_input')[0].files[0];

                $(".chat-input-feedback").css({
                    "display": "none"
                });

                if (msg == "" && chtImg == undefined) {
                    $(".chat-input-feedback").css({
                        "display": "block"
                    });
                    return false;
                }

                sendMsg("{{ route('sendMsg') }}", msg, to_id, reply_to);

                $('#imgPreviewHolder#imgPreview').removeAttr('id');
                let chatImgHtml_before = document.querySelector('#imgPreviewHolder').innerHTML;
                document.querySelector('#imgPreview').removeAttribute('id');
                let chatImgHtml = document.querySelector('#imgPreviewHolder').innerHTML;
                document.querySelector('#imgPreviewHolder').innerHTML = chatImgHtml_before;



                if (reply_to > 0) {
                    reply_conversation_name = document.querySelector(
                        ".replyCard .replymessage-block .flex-grow-1 .conversation-name").innerHTML;
                    reply_conversation_text = document.querySelector(
                        ".replyCard .replymessage-block .flex-grow-1 .mb-0").innerText;
                    newMsgHtml =
                        '<li class="chat-list right pending-msg-id" id=""><div class="conversation-list"> <div class="user-chat-content">  <div class="ctext-wrap"><div class="ctext-wrap-content"><div class="replymessage-block mb-0 d-flex align-items-start">  <div class="flex-grow-1"><h5 class="conversation-name">' +
                        reply_conversation_name +
                        '</h5><p class="mb-0">' +
                        reply_conversation_text +
                        '</p>  </div>  <div class="flex-shrink-0"><button type="button" class="btn btn-sm btn-link mt-n2 me-n3 font-size-18"></button>  </div> </div> ' +
                        chatImgHtml + ' <p class="mb-0 ctext-content mt-1">   ' +
                        msg +
                        '  </p></div><div class="dropdown align-self-start message-box-drop">  <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">   <i class="ri-more-2-fill"></i>  </a>  <div class="dropdown-menu">   <a class="dropdown-item reply-message" href="#"><i class="ri-reply-line me-2 text-muted align-bottom"></i>Reply</a>   <a class="dropdown-item" href="#"><i class="ri-share-line me-2 text-muted align-bottom"></i>Forward</a>   <a class="dropdown-item copy-message" href="#"><i class="ri-file-copy-line me-2 text-muted align-bottom"></i>Copy</a>   <a class="dropdown-item" href="#"><i class="ri-bookmark-line me-2 text-muted align-bottom"></i>Bookmark</a>   <a class="dropdown-item delete-item" href="#"><i class="ri-delete-bin-5-line me-2 text-muted align-bottom"></i>Delete</a></div>  </div> </div> <div class="conversation-name">  <small class="text-muted time">' +
                        getTime() +
                        '</small>  <span class="text-info check-message-icon pending-check-message-icon" id=""><i class="bx bx-check"></i></span> </div>     </div> </div></li>';

                    $(".replyCard").removeClass("show");
                } else {
                    newMsgHtml =
                        '<li class="chat-list right pending-msg-id" id=""><div class="conversation-list"> <div class="user-chat-content">  <div class="ctext-wrap"><div class="ctext-wrap-content">' +

                        chatImgHtml + '<p class="mb-0 ctext-content mt-1">   ' +
                        msg +
                        '  </p></div><div class="dropdown align-self-start message-box-drop">  <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">   <i class="ri-more-2-fill"></i>  </a>  <div class="dropdown-menu">   <a class="dropdown-item reply-message" href="#"><i class="ri-reply-line me-2 text-muted align-bottom"></i>Reply</a>   <a class="dropdown-item" href="#"><i class="ri-share-line me-2 text-muted align-bottom"></i>Forward</a>   <a class="dropdown-item copy-message" href="#"><i class="ri-file-copy-line me-2 text-muted align-bottom"></i>Copy</a>   <a class="dropdown-item" href="#"><i class="ri-bookmark-line me-2 text-muted align-bottom"></i>Bookmark</a>   <a class="dropdown-item delete-item" href="#"><i class="ri-delete-bin-5-line me-2 text-muted align-bottom"></i>Delete</a></div>  </div> </div> <div class="conversation-name">  <small class="text-muted time">' +
                        getTime() +
                        '</small>  <span class="text-info check-message-icon pending-check-message-icon" id=""><i class="bx bx-check"></i></span> </div>     </div> </div></li>';

                }

                $("#users-conversation").append(newMsgHtml);
                chatScroll();
                $("#chat-input").val('');
                $("#chat_file_input").val("");

            });

            $(".chat-message-list").on("click", "#userList li", function() {
                let li_id = $(this).attr("id");
                let li_name = $(this).find(".text-truncate").text();
                document.querySelector(".user-chat-topbar .text-truncate .username").innerHTML = li_name;
                document.querySelector(".profile-offcanvas .username").innerHTML = li_name;
                document.getElementById("to_id_input").value = $(this).attr('to_id');
                document.getElementById("user-chat-topbar").setAttribute("chat-to", li_id);


                // let li_profile_src = document.getElementById(li_id).querySelector(".userprofile").getAttribute("src");
                let li_profile_src = "{{ Vite::asset('resources/assets/images/user.jpg') }}";
                document.querySelector(".user-chat-topbar .avatar-xs").setAttribute("src", li_profile_src);
                document.querySelector(".profile-offcanvas .avatar-lg").setAttribute("src", li_profile_src);
                document.getElementById("users-conversation").querySelectorAll(".left .chat-avatar")
                    .forEach(function(e) {
                        li_profile_src ? e.querySelector("img").setAttribute("src", li_profile_src) :
                            e.querySelector("img").setAttribute("src", li_profile_src);
                    });

                $(".chat-user-list li.active").removeClass("active");
                $(".user-chat").addClass("user-chat-show");
                $(this).addClass("active");
                showUserPanel();
                showLoader();
                $("#users-conversation").empty();
                getUserChat("{{ route('getUserChat') }}", $("#to_id_input").val());

            });

            window.Echo.private(`Chat-{{ auth()->user()->id }}`)
                .listen('.Chat', (data) => {
                    let m = data.msg;
                    let msg = m.message;
                    let msg_from = data.from;
                    let chat_to = $("#user-chat-topbar").attr('chat-to');
                    let me = "{{ auth()->user()->id }}";
                    if ('u_li_' + m.from_id == chat_to) {
                        newMsgHtml =
                            '<li class="chat-list left pending-msg-id" id="' + m.id +
                            '"><div class="conversation-list"> <div class="user-chat-content">  <div class="ctext-wrap"><div class="ctext-wrap-content">' +
                            '<p class="mb-0 ctext-content mt-1">   ' +
                            msg +
                            '  </p></div><div class="dropdown align-self-start message-box-drop">  <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">   <i class="ri-more-2-fill"></i>  </a>  <div class="dropdown-menu">   <a class="dropdown-item reply-message" href="#"><i class="ri-reply-line me-2 text-muted align-bottom"></i>Reply</a>   <a class="dropdown-item" href="#"><i class="ri-share-line me-2 text-muted align-bottom"></i>Forward</a>   <a class="dropdown-item copy-message" href="#"><i class="ri-file-copy-line me-2 text-muted align-bottom"></i>Copy</a>   <a class="dropdown-item" href="#"><i class="ri-bookmark-line me-2 text-muted align-bottom"></i>Bookmark</a>   <a class="dropdown-item delete-item" href="#"><i class="ri-delete-bin-5-line me-2 text-muted align-bottom"></i>Delete</a></div>  </div> </div> <div class="conversation-name">  <small class="text-muted time">' +
                            getTime() +
                            '</small>  <span class="text-info check-message-icon" id="check-message-icon-' + m
                            .id + '"><i class="bx bx-check"></i></span> </div>     </div> </div></li>';

                        $("#users-conversation").append(newMsgHtml);
                        chatScroll();
                        seenChatMsg("{{ route('seenChatMsg') }}", m.id);
                    } else {
                        $("#chat-msg-from").text(msg_from);
                        $("#chat-msg-text").text(msg);
                        $("#chat-msg-popup").addClass("show");
                        setTimeout(function() {
                            $("#chat-msg-popup").removeClass("show");
                        }, 5e3);
                        $("#u_name_" + m.from_id).removeClass("fw-500").addClass("fw-bold");
                        $("#u_msg_div_" + m.from_id).removeClass("d-none");
                        $("#u_msg_count_" + m.from_id).removeClass("fw-500").addClass("fw-bold").text(data
                            .messageCount);
                        $("#u_li_" + m.from_id).prependTo("#userList").animate({
                            top: 0
                        }, "slow");

                    }


                });




        });
    </script>


</x-app-layout>
