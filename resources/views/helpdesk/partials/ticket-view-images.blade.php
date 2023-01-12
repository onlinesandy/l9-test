<div class="card">
    <div class="card-header">
        <h6 class="card-title fw-semibold mb-0">Files Attachment</h6>
    </div>
    <div class="card-body h-100">
        <div class="row gallery-wrapper">
            @foreach ($ticket_attachments as $attchment)
                <div class="element-item col-xxl-4 col-xl-4 col-sm-6">
                    <div class="gallery-box card">
                        <div class="gallery-container">
                            <a class="image-popup" href="{{ Vite::asset('resources'.$attchment->file)}}" title="">
                                <img class="gallery-img img-fluid mx-auto" src="{{ Vite::asset('resources'.$attchment->file) }}"
                                    alt="" />
                                <div class="gallery-overlay">
                                    <h5 class="overlay-caption">{{ basename($attchment->file) }}</h5>
                                </div>
                            </a>
                        </div>

                        <div class="box-content">
                            <div class="d-flex align-items-center mt-1">
                                <div class="flex-grow-1 text-muted">by
                                    <a href="" class="text-body text-truncate">
                                        {{ $attchment->user->name }}
                                    </a>
                                </div>
                                <div class="flex-shrink-0 me-3">
                                    <div class="d-flex gap-3">
                                        <a href="{{ route('downloadFile', $attchment->id) }}" class="text-muted">
                                            <i class="ri-download-2-line"></i></a>
                                    </div>
                                </div>

                                <div class="flex-shrink-0">
                                    <div class="d-flex gap-3">
                                        <a href="javascript:void(0);"  delUrl="{{ route('helpdeskDeleteAttachment', $attchment->id) }}" attachment-id="{{$attchment->id}}" class="text-muted confirm_del">
                                            <i class="ri-delete-bin-5-fill"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</div>
