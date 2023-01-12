<div class="modal fade zoomIn" id="showModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header p-3 bg-soft-info">
                <h5 class="modal-title" id="ModalLabel">Add {{$title}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
            </div>
            <form method="POST" action="{{ route('addMenu') }}">
                @csrf
                <input type="hidden" name="id" class="id" value="" />
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-lg-12">
                            <div>
                                <label for="name-field" class="form-label">Name</label>
                                <input type="text" name="name" id="name" class="form-control name" placeholder="Name" required />
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <div class="hstack gap-2 justify-content-end">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-info" id="add-btn">Add</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
