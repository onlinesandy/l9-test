document.addEventListener("DOMContentLoaded", function (e) {
    document.querySelector(".gallery-wrapper") &&
        (t = new Isotope(".gallery-wrapper", {
            itemSelector: ".element-item",
            layoutMode: "fitRows",
        }));
    var t,
        r = document.querySelector(".categories-filter"),
        r =
            (r &&
                r.addEventListener("click", function (e) {
                    !matchesSelector(e.target, "li a") ||
                        ((e = e.target.getAttribute("data-filter")) &&
                            t.arrange({ filter: e }));
                }),
            document.querySelectorAll(".categories-filter"));
    r &&
        Array.from(r).forEach(function (e) {
            var t;
            (t = e).addEventListener("click", function (e) {
                matchesSelector(e.target, "li a") &&
                    (t.querySelector(".active").classList.remove("active"),
                    e.target.classList.add("active"));
            });
        });
});
var lightbox = GLightbox({ selector: ".image-popup", title: !1 });

function helpdeskUploadImg(ajaxUrl) {
    var form = $("#fileUploadForm")[0];
    var formData = new FormData(form);
    $.ajax({
        type: "POST",
        url: ajaxUrl,
        data: formData,
        processData: false,
        contentType: false,
        beforeSend: function (data) {},
        complete: function (data) {
            $("#imageUploadDiv").addClass("d-none");
            $("#helpdeskViewDropzone").removeClass("d-none");
        },
        success: function (data) {
            window.location.reload();
        },
        error: function (xhr) {
            let errorMsg = JSON.parse(xhr.responseText);
        },
    });
}

function HelpdeskUpdateStatus(ajaxUrl, formData) {
    $.ajax({
        type: "POST",
        url: ajaxUrl,
        data: formData,
        beforeSend: function (data) {},
        complete: function (data) {},
        success: function (data) {
            $("#helpdesk-popup").addClass("show");
            setTimeout(function () {
                $("#helpdesk-popup").removeClass("show");
            }, 5e3);
        },
        error: function (xhr) {
            let errorMsg = JSON.parse(xhr.responseText);
        },
    });
}

$(document).ready(function () {
    $("#helpdesk_edit_title_btn").on("click", function (e) {
        $("#helpdesk_edit_title").addClass("d-none");
        $("#helpdesk_edit_title_input_box").removeClass("d-none");
        $("#helpdesk_edit_title_input").val(
            $("#helpdesk_edit_title_txt").text()
        );
    });

    $("#helpdesk_cancel_title_btn").on("click", function (e) {
        $("#helpdesk_edit_title").removeClass("d-none");
        $("#helpdesk_edit_title_input_box").addClass("d-none");
        $("#helpdesk_edit_title_input").val("");
    });

    $("#helpdesk_edit_desc_btn").on('click', function(e) {
        $('#helpdesk_edit_desc_btn').addClass('d-none');
        $('#helpdesk_edit_desc_btn_box').removeClass('d-none');
        $('#helpdesk_edit_desc_txt').addClass('d-none');
        $('#helpdesk_edit_desc_input').removeClass('d-none');
        $('#helpdesk_edit_desc_input').val($('#helpdesk_edit_desc_txt').text().trim());
    });
    $("#helpdesk_cancel_desc_btn").on('click', function(e) {
        $('#helpdesk_edit_desc_btn').removeClass('d-none');
        $('#helpdesk_edit_desc_btn_box').addClass('d-none');
        $('#helpdesk_edit_desc_txt').removeClass('d-none');
        $('#helpdesk_edit_desc_input').addClass('d-none');
    });

    $("#helpdesk_edit_html_btn").on("click", function (e) {
        $("#helpdesk_edit_html_btn").addClass("d-none");
        $("#helpdesk_edit_html_btn_box").removeClass("d-none");
        $("#helpdesk_edit_html_txt").addClass("d-none");
        $(".helpdesk_edit_html_input").removeClass("d-none");
        $(".ql-toolbar").removeClass("d-none");
    });
    $("#helpdesk_cancel_html_btn").on("click", function (e) {
        $("#helpdesk_edit_html_btn").removeClass("d-none");
        $("#helpdesk_edit_html_btn_box").addClass("d-none");
        $("#helpdesk_edit_html_txt").removeClass("d-none");
        $(".helpdesk_edit_html_input").addClass("d-none");
        $(".ql-toolbar").addClass("d-none");

    });

    $("#helpdesk_edit_assignee_btn").on('click', function(e) {
        $('#helpdesk_edit_assignee_btn').addClass('d-none');
        $('#helpdesk_edit_assignee_btn_box').removeClass('d-none');
        $('#helpdeskAssigneeListViewBox').addClass('d-none');
        $('#helpdeskAssigneeListEditBox').removeClass('d-none');
    });
    $("#helpdesk_cancel_assignee_btn").on('click', function(e) {
        $('#helpdesk_edit_assignee_btn').removeClass('d-none');
        $('#helpdesk_edit_assignee_btn_box').addClass('d-none');
        $('#helpdeskAssigneeListViewBox').removeClass('d-none');
        $('#helpdeskAssigneeListEditBox').addClass('d-none');
    });


});
