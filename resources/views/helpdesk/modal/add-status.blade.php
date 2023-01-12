<div class="modal" id="helpdesk_add_status_model" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 needs-validation">
            <div class="modal-header p-3 bg-soft-info">
                <h5 class="modal-title" id="ModalLabel">Add Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    id="close-modal"></button>
            </div>

            <input type="hidden" name="id" class="id" value="" />

            <x-ajax-modal-loader></x-ajax-modal-loader>
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-lg-12">
                        <div>
                            <label for="name-field" class="form-label">Name</label>
                            <input type="text" name="name" id="status_name" class="form-control name"
                                placeholder="Name" required />
                            <div class="invalid-feedback">
                                Please enter name
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="hstack gap-2 justify-content-end">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-info" id="add-btn"
                            onclick="saveStatus('{{ route('helpdeskAddStatus') }}');">Add</button>
                    </div>
                </div>

            </div>




        </div>
    </div>
</div>
