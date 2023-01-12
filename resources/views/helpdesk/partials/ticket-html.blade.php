<div class="card">
    <div class="card-header align-items-center d-flex">
        <h4 class="card-title mb-0 flex-grow-1">Content</h4>
        <div class="flex-shrink-0">
            <a href="javascript:void(0);" class="badge bg-light text-primary fs-12" id="helpdesk_edit_html_btn">
                <i class="ri-edit-box-line align-bottom me-1"></i>
                Edit
            </a>
        </div>
        <div class="flex-shrink-0 ms-1 d-none" id="helpdesk_edit_html_btn_box">
            <a href="javascript:void(0);" class="badge bg-soft-info text-primary fs-12" id="helpdesk_update_html_btn">
                <i class="ri-checkbox-line align-bottom me-1"></i> Save
            </a>
            <a href="javascript:void(0);" class="badge bg-soft-warning text-primary fs-12"
                id="helpdesk_cancel_html_btn">
                <i class="ri-delete-back-2-line align-bottom me-1"></i> Cancel
            </a>

        </div>
    </div>
    <div class="card-body p-4">
        @php
            $contentHtml = '';
            if (!empty($ticket->html)) {
                $contentHtml = json_decode(trim($ticket->html, "\""), true)['data'];
            }
        @endphp
        <div id="helpdesk_edit_html_txt">
            {!! $contentHtml !!}
        </div>
        <div id="helpdesk_update_html_txt" class="d-none">

        </div>

        <div id="editor" class="helpdesk_edit_html_input snow-editor ql-container ql-snow d-none"
            style="min-height:150px;max-height: 500px;overflow:auto">
            {!! $contentHtml !!}
        </div>
    </div>
</div>
