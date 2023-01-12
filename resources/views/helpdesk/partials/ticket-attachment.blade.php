<div class="card">
    <div class="card-header">
        <h6 class="card-title fw-semibold mb-0">Files Attachment</h6>
    </div>
    <div class="card-body">
        @foreach ($ticket_attachments as $attchment)
            <div class="d-flex align-items-center border border-dashed p-2 rounded">
                <div class="flex-shrink-0 avatar-sm">
                    <div class="avatar-title bg-light rounded">
                        <i class="ri-image-2-line fs-20 text-primary"></i>
                    </div>
                </div>
                <div class="flex-grow-1 ms-3">
                    <h6 class="mb-1"><a href="javascript:void(0);">{{ basename($attchment->file) }}</a></h6>
                </div>
                <div class="hstack gap-3 fs-16">
                    <a href="{{ route('downloadFile', $attchment->id) }}" class="text-muted"><i
                            class="ri-download-2-line"></i></a>
                </div>
            </div>
        @endforeach

    </div>
</div>
