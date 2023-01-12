<div class="card">
    <div class="card-header align-items-center d-flex">
        <h4 class="card-title mb-0 flex-grow-1">Description</h4>
        <div class="flex-shrink-0">
            <a href="javascript:void(0);" class="badge bg-light text-primary fs-12" id="helpdesk_edit_desc_btn">
                <i class="ri-edit-box-line align-bottom me-1"></i> Edit
            </a>
        </div>
        <div class="flex-shrink-0 ms-1 d-none" id="helpdesk_edit_desc_btn_box">
            <a href="javascript:void(0);" class="badge bg-soft-info text-primary fs-12" id="helpdesk_update_desc_btn">
                <i class="ri-checkbox-line align-bottom me-1"></i> Save
            </a>
            <a href="javascript:void(0);" class="badge bg-soft-warning text-primary fs-12" id="helpdesk_cancel_desc_btn">
                <i class="ri-delete-back-2-line align-bottom me-1"></i> Cancel
            </a>

        </div>
    </div>
    <div class="card-body p-4">

        <textarea name="helpdesk_description" id="helpdesk_edit_desc_input" class="form-control d-none" rows="4"></textarea>
        <p class="text-muted" id="helpdesk_edit_desc_txt">
            {{ $ticket->description }}
        </p>
    </div>
</div>
