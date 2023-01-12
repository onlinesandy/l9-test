function saveClient(ajaxUrl) {
    let ele_id = "client_name";
    let modal_ele_id = "helpdesk_add_client_model";
    let js_model_id = document.getElementById(ele_id);
    let jq_id = $("#" + ele_id);
    let name = jq_id.val();
    if (name.trim() == "") {
        js_model_id.classList.add("was-validated");
        return false;
    }
    let formData = { name: name };
    saveHelpdesk(ele_id, modal_ele_id, formData, ajaxUrl);
}

function saveProject(ajaxUrl) {
    let ele_id = "project_name";
    let modal_ele_id = "helpdesk_add_project_model";
    let js_model_id = document.getElementById(ele_id);
    let jq_id = $("#" + ele_id);
    let name = jq_id.val();
    if (name.trim() == "") {
        js_model_id.classList.add("was-validated");
        return false;
    }
    let formData = { name: name };
    saveHelpdesk(ele_id, modal_ele_id, formData, ajaxUrl);
}

function saveStatus(ajaxUrl) {
    let ele_id = "status_name";
    let modal_ele_id = "helpdesk_add_status_model";
    let js_model_id = document.getElementById(ele_id);
    let jq_id = $("#" + ele_id);
    let name = jq_id.val();
    if (name.trim() == "") {
        js_model_id.classList.add("was-validated");
        return false;
    }
    let formData = { name: name };
    saveHelpdesk(ele_id, modal_ele_id, formData, ajaxUrl);
}
function saveCategory(ajaxUrl) {
    let ele_id = "category_name";
    let modal_ele_id = "helpdesk_add_category_model";
    let js_model_id = document.getElementById(ele_id);
    let jq_id = $("#" + ele_id);
    let name = jq_id.val();
    if (name.trim() == "") {
        js_model_id.classList.add("was-validated");
        return false;
    }
    let formData = { name: name };
    saveHelpdesk(ele_id, modal_ele_id, formData, ajaxUrl);
}

function savePriority(ajaxUrl) {
    let ele_id = "priority_name";
    let modal_ele_id = "helpdesk_add_priority_model";
    let js_model_id = document.getElementById(ele_id);
    let jq_id = $("#" + ele_id);
    let name = jq_id.val();
    if (name.trim() == "") {
        js_model_id.classList.add("was-validated");
        return false;
    }
    let formData = { name: name };
    saveHelpdesk(ele_id, modal_ele_id, formData, ajaxUrl);
}

function saveHelpdeskTicket(helpdeskhtmlContent) {
    $("#helpdeskAddTicketForm").append(
        '<input type="hidden" id="helpdesk_html_content" name="helpdesk_html_content" value="' +
            helpdeskhtmlContent +
            '" /> '
    );
}

function saveHelpdesk(id, modal_id, formData, ajaxUrl) {
    let js_model_id = document.getElementById(modal_id);
    let jq_id = $("#" + id);
    let js_id = document.getElementById(id);
    let jq_model_id = $("#" + modal_id);
    js_model_id.classList.remove("was-validated");
    jq_id.next(".invalid-feedback").text("Please Enter Name");
    $.ajax({
        type: "POST",
        url: ajaxUrl,
        data: formData,
        beforeSend: function (data) {
            showLoaderAjaxModal();
        },
        complete: function (data) {
            showLoaderAjaxModal(false);
        },
        success: function (data) {
            jq_id.val("");
            jq_model_id.modal("hide");
            $("#toast-success-msg").text(data.success);
            $("#toast-success-modal").toast("show");
        },
        error: function (xhr) {
            let errorMsg = JSON.parse(xhr.responseText);
            js_id.setCustomValidity("invalid");
            jq_id.next(".invalid-feedback").text(errorMsg.message);
            js_model_id.classList.add("was-validated");
        },
    });
}


