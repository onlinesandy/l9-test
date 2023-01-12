function updateNotificationCount(){
    let notificationItems = $('div.notifications-inner-block .notification-item').length;
    $(".notification-topbar-badge").text(notificationItems);
    $(".notification-badge").text(notificationItems);
    if(notificationItems ==  1){
        $(".notification-topbar-badge").removeClass('d-none');
        $("#empty-notification").addClass('d-none');
        $(".all-notofication-div").removeClass('d-none');
    }

}


function showLoader(isTrue = true) {
    if (isTrue) {
        $("#elmLoader").removeClass("d-none");
    } else {
        $("#elmLoader").addClass("d-none");
    }
}

function showLoaderAjaxModal(isTrue = true) {
    if (isTrue) {
        $(".ajax-modal-loader").removeClass("d-none");
        $(".modal-body").addClass("d-none");
    } else {
        $(".ajax-modal-loader").addClass("d-none");
        $(".modal-body").removeClass("d-none");
    }
}
