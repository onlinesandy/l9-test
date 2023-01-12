$(document).ready(function () {

    var quill = new Quill("#editor", {
        modules: {
            toolbar: {
                container: [
                    [{ header: [1, 2, 3, 4, 5, 6, false] }],
                    ["bold", "italic", "underline"],
                    [{ list: "ordered" }, { list: "bullet" }],
                    [{ color: [] }],
                    [{ align: [] }],
                    // ["link", "image", "code-block"],
                    ["code-block"],

                ],

            },

        },
        placeholder: "HTML Content",
        theme: "snow", // or 'bubble'
    });

    Quill.prototype.getHtml = function () {
        return this.container.firstChild.innerHTML;
    };
    Quill.prototype.insertToEditor = function (img) {
        return this.container.firstChild.innerHTML;
    };

    // quill.getModule("toolbar").addHandler("image", (q_ele) => {

    // });

    $("#helpdeskAddTicketSaveBtn").on("click", function (e) {
        let helpdeskhtmlContent = JSON.stringify({ data: quill.getHtml() });

        $("#helpdeskAddTicketForm").append(
            '<textarea class="d-none" name="helpdesk_html_content">' +
                helpdeskhtmlContent +
                '"</textarea>'
        );
    });

    $("#helpdesk_update_html_btn").on("click", function (e) {
        let helpdeskhtmlContent = JSON.stringify({ data: quill.getHtml() });
        $("#helpdesk_update_html_txt").append(
            '<textarea class="d-none" name="helpdesk_update_html_content" id="helpdesk_update_html_content">' +
                helpdeskhtmlContent +
                '</textarea>'
        );
        $(".ql-toolbar").addClass("d-none");
    });

});
