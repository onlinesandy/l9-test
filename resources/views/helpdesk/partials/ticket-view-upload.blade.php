<div class="card" id="helpdeskViewDropzoneArea">
    <div class="card-header bg-soft-info">
        <h4 class="card-title mb-0">Images</h4>

    </div>
    <div class="card-body">
        <form id="fileUploadForm" method="POST" action="{{ route('helpdeskUploadImg') }}" enctype="multipart/form-data">
            @csrf
            <input id="helpdeskViewInputFiles" name="helpdesk_view_images[]" class="d-none" multiple type="file" />
            <input type="hidden" id="helpdeskViewImgTicketId" name="helpdeskViewImgTicketId" value="{{ $ticket->id }}" />
            <div id="imageUploadDiv" class="d-none">
                <lord-icon src="https://cdn.lordicon.com/xjovhxra.json" trigger="loop"
                    colors="primary:#66a1ee,secondary:#66a1ee" style="width:150px;height:150px;left:25%;">
                </lord-icon>
                <div class="align-center" style="position: relative;bottom:0%;left:35%;"> Uploading.... </div>
            </div>
            <div class="border-dashed" id="helpdeskViewDropzone" style="border-color: #e9ebec;cursor: pointer;">
                <div class="text-center">
                    <div class="mb-3">
                        <i class="display-4 text-muted ri-upload-cloud-2-fill"></i>
                    </div>
                    <h4>Drop files here or click to upload.</h4>
                </div>
            </div>
        </form>
    </div>
    <div class="col mt-2 p-0" id="helpdeskViewImagesDiv">

    </div>

</div>
