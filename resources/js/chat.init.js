function getchatUserList(ajaxUrl, formData) {
    $.ajax({
        type: "GET",
        url: ajaxUrl,
        data: formData,
        beforeSend: function (data) {
            // showLoader();
        },
        complete: function (data) {
            // showLoader(false);
        },
        success: function (data) {
            $("#userList").html(data);
        },
        error: function (data) {
            console.log(data);
        },
    });
}

function getchatContactList(ajaxUrl, formData) {
    $.ajax({
        type: "GET",
        url: ajaxUrl,
        data: formData,
        beforeSend: function (data) {
            // showLoader();
        },
        complete: function (data) {
            // showLoader(false);
        },
        success: function (data) {
            $("#contactList").html(data);
        },
        error: function (data) {
            console.log(data);
        },
    });
}


function showUserPanel(isTrue = true) {
    if (isTrue) {
        $("#users-chat").removeClass("d-none");
    } else {
        $("#users-chat").addClass("d-none");
    }
}

function chatScroll() {
    let chatOutterDiv = document
        .getElementById("users-chat")
        .querySelector("#chat-conversation .simplebar-content-wrapper");
    let chatInnerDiv = document.getElementsByClassName(
        "chat-conversation-list"
    )[0]
        ? document
              .getElementById("users-chat")
              .getElementsByClassName("chat-conversation-list")[0]
              .scrollHeight -
          window.innerHeight +
          400
        : 0;
    chatInnerDiv &&
        chatOutterDiv.scrollTo({
            top: chatInnerDiv,
            behavior: "smooth",
        });
}

function delChatMsg(ajaxUrl, id) {
    let formData = {
        id: id,
    };
    $.ajax({
        type: "PATCH",
        url: ajaxUrl,
        data: formData,
        success: function (data) {
            // console.log(data);
        },
        error: function (data) {
            // console.log(data);
        },
    });
}

function getUserChat(ajaxUrl, to_id) {
    let formData = {
        to_id: to_id,
    };
    $.ajax({
        type: "GET",
        url: ajaxUrl,
        data: formData,
        beforeSend: function (data) {
            showLoader();
        },
        complete: function (data) {
            showLoader(false);
            chatScroll();
        },
        success: function (data) {
            $("#users-conversation").html(data);
        },

    });
}

function seenChatMsg(ajaxUrl, id) {
    let formData = {
        id: id,
    };
    $.ajax({
        type: "PATCH",
        url: ajaxUrl,
        data: formData,
        success: function (data) {
            console.log(data);
        },
        error: function (data) {
            console.log(data);
        },
    });
}

function searchMessages() {
    var t,
        s = document.getElementById("searchMessage").value.toUpperCase();
    Array.from(
        document.getElementById("users-conversation").getElementsByTagName("li")
    ).forEach((e) => {
        (t = e.getElementsByTagName("p")[0]
            ? e.getElementsByTagName("p")[0]
            : ""),
            -1 <
            (t.textContent || t.innerText ? t.textContent || t.innerText : "")
                .toUpperCase()
                .indexOf(s)
                ? (e.style.display = "")
                : (e.style.display = "none");
    });
}

function getTime() {
    var e = 12 <= new Date().getHours() ? "PM" : "AM",
        t =
            12 < new Date().getHours()
                ? new Date().getHours() % 12
                : new Date().getHours(),
        s =
            new Date().getMinutes() < 10
                ? "0" + new Date().getMinutes()
                : new Date().getMinutes();
    return t < 10 ? "0" + t + ":" + s + " " + e : t + ":" + s + " " + e;
}

function sendMsg(ajaxUrl, msg, to_id) {
    let reply_to = $("#reply_to_input").val();
    // let formData = {
    //     msg: msg,
    //     to_id: to_id,
    //     reply_to: reply_to,
    // };

    var file = $("#chat_file_input")[0].files[0];
    // alert(file.name+" | "+file.size+" | "+file.type);
    var formdata = new FormData();
    formdata.append("chat_file", file);
    formdata.append("msg", msg);
    formdata.append("to_id", to_id);
    formdata.append("reply_to", reply_to);

    // console.log("sasa",formdata);
    // return false;
    $("#progressbar").removeClass("d-none");

    $.ajax({
        xhr: function () {
            var xhr = new window.XMLHttpRequest();
            xhr.upload.addEventListener(
                "progress",
                function (evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = Math.round(
                            (evt.loaded / evt.total) * 100
                        );
                        $("#progressbar_span").css({
                            width: percentComplete + "%",
                        });
                    }
                },
                false
            );
            return xhr;
        },
        type: "POST",
        url: ajaxUrl,
        data: formdata,
        cache: false,
        processData: false,
        contentType: false,
        complete: function () {
            $("#progressbar").addClass("d-none");
            $("#progressbar_span").css({ width: "0%" });
            $(".chatImgCard").removeClass("show");
            $("#chat_file_input").val("");
        },
        success: function (data) {
            let pending_msg_id = data.mid;
            $(".pending-msg-id")
                .attr("id", pending_msg_id)
                .removeClass("pending-msg-id");
            $(".pending-check-message-icon")
                .attr("id", "check-message-icon-" + pending_msg_id)
                .removeClass("pending-check-message-icon");
        },
        error: function (data) {
            console.log(data);
        },
    });
}

function EmojiPicker(emojiPath) {
    new FgEmojiPicker({
        trigger: [".emoji-btn"],
        removeOnSelection: !1,
        closeButton: !0,
        position: ["top", "right"],
        preFetch: !0,
        dir: emojiPath,
        insertInto: document.querySelector(".chat-input"),
    });
}

function progressHandler(event) {
    _("loaded_n_total").innerHTML =
        "Uploaded " + event.loaded + " bytes of " + event.total;
    var percent = (event.loaded / event.total) * 100;
    _("progressBar").value = Math.round(percent);
    _("status").innerHTML = Math.round(percent) + "% uploaded... please wait";
}

function completeHandler(event) {
    _("status").innerHTML = event.target.responseText;
    _("progressBar").value = 0; //wil clear progress bar after successful upload
}

function errorHandler(event) {
    _("status").innerHTML = "Upload Failed";
}

function abortHandler(event) {
    _("status").innerHTML = "Upload Aborted";
}

$(document).ready(function () {
    $("#users-conversation").on("click", ".delete-item", function () {
        let del_li = $(this).attr("del-msg-id");
        $("#" + del_li).remove();
        delChatMsg(delchatMsgUrl, del_li);
    });

    $("#users-chat").on("click", "#close_toggle", function (ele) {
        $(".replyCard").removeClass("show");
        $("#reply_to_input").val("");
    });

    $("#users-conversation").on("click", ".copy-message", function () {
        let copyMsg = $(this)
            .parent()
            .parent()
            .parent()
            .find(".ctext-wrap-content")
            .find(".ctext-content")
            .text();
        if (copyMsg != "" && copyMsg !== undefined) {
            navigator.clipboard.writeText(copyMsg);
            $(".copyclipboard-alert").css("display", "block");
            setTimeout(function () {
                $(".copyclipboard-alert").css("display", "none");
            }, 1e3);
        }
    });

    $(".user-chat-remove").on("click", function (ele) {
        $(".user-chat").removeClass("user-chat-show");
    });

    document.getElementById("emoji-btn").addEventListener("click", function () {
        setTimeout(function () {
            var e,
                t = document.getElementsByClassName("fg-emoji-picker")[0];
            t &&
                (e = window.getComputedStyle(t)
                    ? window.getComputedStyle(t).getPropertyValue("left")
                    : "") &&
                ((e = e.replace("px", "")), (t.style.left = e = e - 40 + "px"));
        }, 0);
    });

    $("#users-conversation").on("click", ".reply-message", function () {
        let reply_to = $(this)
            .parent()
            .parent()
            .parent()
            .parent()
            .parent()
            .parent()
            .attr("id");
        let replyMsg = $(this)
            .parent()
            .parent()
            .parent()
            .find(".ctext-content")
            .text();
        document.querySelector(
            ".replyCard .replymessage-block .flex-grow-1 .mb-0"
        ).innerText = replyMsg;
        let checkName = document.querySelector(
            ".user-chat-topbar .text-truncate .username"
        ).innerHTML;
        let checkUserCls = $(this)
            .parent()
            .parent()
            .parent()
            .parent()
            .parent()
            .parent()
            .hasClass("left");
        let conversation_name = checkUserCls ? checkName : "You";
        document.querySelector(
            ".replyCard .replymessage-block .flex-grow-1 .conversation-name"
        ).innerText = conversation_name;
        $("#reply_to_input").val(reply_to);
        $(".replyCard").addClass("show");
    });
});
