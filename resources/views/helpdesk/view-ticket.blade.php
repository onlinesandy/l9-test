<x-app-layout>

    @include('helpdesk.partials.ticket-overview')

    <link rel="stylesheet" href="{{ Vite::asset('resources/assets/libs/glightbox/css/glightbox.min.css') }}">

    <div class="row">
        <div class="col-lg-12">
            <div class="tab-content text-muted">
                <div class="tab-pane fade show active" id="helpdesk-overview" role="tabpanel">
                    <div class="row">
                        <div class="col-xxl-9">
                            @include('helpdesk.partials.ticket-description')
                            @include('helpdesk.partials.ticket-html')
                            @include('helpdesk.partials.ticket-view-images')
                            @include('helpdesk.partials.ticket-comments')

                        </div>
                        <div class="col-xxl-3">
                            @include('helpdesk.partials.ticket-details')
                            @include('helpdesk.partials.ticket-assignee')
                            @include('helpdesk.partials.ticket-view-upload')
                        </div>
                    </div>
                </div>
                {{-- @include('helpdesk.partials.ticket-tab-document') --}}
                @include('helpdesk.partials.ticket-tab-activity')
            </div>
        </div>
    </div>
    <div id="helpdesk-popup" class="toast" role="alert" aria-live="polite" aria-atomic="true" data-delay="50000"
        style="position: absolute; top: 10%; right: 0%;z-index:1002;">
        <div role="alert" aria-live="assertive" aria-atomic="true" style="display: block;">
            <div class="toast-header bg-info text-white">
                <strong class="mr-auto">Helpdesk</strong>
            </div>
            <div class="toast-body bg-white" id="chat-msg-text">Ticket Updated</div>
        </div>
    </div>
    @include('helpdesk.modal.delete-modal')
    <script src="{{ Vite::asset('resources/assets/libs/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ Vite::asset('resources/assets/libs/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ Vite::asset('resources/assets/libs/quill/quill.min.js') }}"></script>
    <script src="{{ Vite::asset('resources/js/quill-editor.init.js') }}"></script>
    <script src="{{ Vite::asset('resources/js/helpdesk_edit.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('[data-bs-toggle="tooltip"]').tooltip();
            $(".ql-toolbar").addClass("d-none");
            $('.confirm_del').on('click', function(e) {
                let delUrl = $(this).attr('delUrl');
                let attachment_id = $(this).attr('attachment-id');
                $('#helpdeskDeleteModalForm').find('.id').val(attachment_id);
                $('#helpdeskDeleteModalForm').attr('action',delUrl);
                $('#helpdeskDeleteModal').modal('show');
            });

            $('#helpdeskViewDropzoneArea').on('click', '#helpdeskViewDropzone', function() {
                $('#helpdeskViewInputFiles').click();
            });


            $("#helpdesk_update_desc_btn").on('click', function(e) {
                $('#helpdesk_edit_desc_btn').removeClass('d-none');
                $('#helpdesk_edit_desc_btn_box').addClass('d-none');
                $('#helpdesk_edit_desc_txt').removeClass('d-none');
                $('#helpdesk_edit_desc_input').addClass('d-none');
                let h_desc = $('#helpdesk_edit_desc_input').val();
                $('#helpdesk_edit_desc_txt').text(h_desc);
                let formData = {
                    description: h_desc,
                    ticket_id: '{{ $ticket->id }}'
                };
                let ajaxUrl = "{{ route('helpdeskUpdateStatus') }}";
                HelpdeskUpdateStatus(ajaxUrl, formData);
            });

            $("#helpdesk_update_html_btn").on('click', function(e) {
                $('#helpdesk_edit_html_btn').removeClass('d-none');
                $('#helpdesk_edit_html_btn_box').addClass('d-none');
                $('#helpdesk_edit_html_txt').removeClass('d-none');
                $('.helpdesk_edit_html_input').addClass('d-none');
                let h_html_str = $('#helpdesk_update_html_content').val();
                let h_html_json = $.parseJSON(h_html_str);
                let h_html = h_html_json.data;
                $('#helpdesk_edit_html_txt').html(h_html);
                let formData = {
                    html: h_html_str,
                    ticket_id: '{{ $ticket->id }}'
                };
                let ajaxUrl = "{{ route('helpdeskUpdateStatus') }}";
                HelpdeskUpdateStatus(ajaxUrl, formData);
                $("#helpdesk_update_html_txt").empty();
            });








            $("#helpdesk_update_title_btn").on('click', function(e) {
                let h_title = $('#helpdesk_edit_title_input').val();
                $('#helpdesk_edit_title_txt').text(h_title);
                let formData = {
                    title: h_title,
                    ticket_id: '{{ $ticket->id }}'
                };
                let ajaxUrl = "{{ route('helpdeskUpdateStatus') }}";
                HelpdeskUpdateStatus(ajaxUrl, formData);
                $('#helpdesk_edit_title').removeClass('d-none');
                $('#helpdesk_edit_title_input_box').addClass('d-none');

            });

            $("#helpdesk_update_assignee_btn").on('click', function(e) {
                $('#helpdeskUpdateAssigneeForm').submit();
            });

            $("#helpdeskAssigneeListDiv").on("click", '.hepdeskAssigneeDelBtn', function(e) {
                let h_del_val = $(this).attr('helpdeskAssigneeDelID');
                $("#helpdeskAssignee-" + h_del_val).fadeOut(300, function() {
                    $(this).remove();
                });
            });

            $('#helpdesk_edit_assignee_input').on("change", function(e) {
                let h_name = $("#helpdesk_edit_assignee_input option:selected").text();
                let h_val = $("#helpdesk_edit_assignee_input option:selected").val();

                if ($("#helpdeskAssignee-" + h_val).length == 0) {
                    let helpdeskAssigneeHtml = `
                    <div id="helpdeskAssignee-${h_val}"
                            class="d-flex align-items-center border-bottom border-bottom-dashed p-1">
                            <div class="avatar-xs flex-shrink-0 me-2">
                                <span class="avatar-title rounded-circle bg-info fs-10">
                                    ${h_name.slice(0, 1)}
                                </span>

                            </div>
                            <div class="flex-grow-1">
                                <h5 class="fs-13 mt-2">
                                    ${h_name}
                                </h5>
                            </div>
                            <div class="flex-shrink-0">
                                <input type="hidden" name="helpdeskAssigneeList[]" value="${h_val}" />
                                <input type="hidden" name="ticket_id" value="{{ $ticket->id }}" />
                                <span class="text-danger cursor-pointer fw-medium fs-12 hepdeskAssigneeDelBtn"
                                    helpdeskAssigneeDelID="${h_val}">
                                    <i class=" ri-delete-bin-fill"></i>
                                </span>
                            </div>
                        </div>`;
                    $("#helpdeskAssigneeListDiv").append(helpdeskAssigneeHtml);
                }




            });



            $("#helpdeskViewInputFiles").change(function(e) {

                let files = e.target.files;
                let filesLength = files.length;
                $("#helpdeskViewImagesDiv").empty();
                for (let i = 0; i < filesLength; i++) {
                    let f = files[i];
                    var fileReader = new FileReader();
                    fileReader.onload = (function(e) {
                        let file = e.target;
                        let img =
                            '<img style="display:block;" height="50px" width="50px" class="" src="' +
                            e
                            .target.result + '" />';
                        var imgsize = f.size / 1024;
                        imgsize = imgsize / 1024;
                        let imgInfo = `<div class="border helpdesk-file-attachment">
                    <div class="d-flex p-2">
                        <div class="flex-shrink-0 me-3">
                            <div class="avatar-sm bg-light rounded">
                            ${img}
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <div class="pt-1">
                                <h5 class="fs-14 mb-1">${f.name}</h5>
                                <p class="fs-13 text-muted mb-0" data-dz-size="">
                                    <strong>${imgsize.toFixed(2)}</strong> MB</p>
                            </div>
                        </div>
                    </div>
                </div>`;


                        $("#helpdeskViewImagesDiv").append(imgInfo);


                    });
                    fileReader.readAsDataURL(f);

                }
                $("#imageUploadDiv").removeClass('d-none');
                $("#helpdeskViewDropzone").addClass('d-none');

                var helpdeskImg = new FormData();
                helpdeskImg.append('helpdesk_view_images', files);
                helpdeskImg.append('ticket_id', '{{ $ticket->id }}');
                let ajaxUrlImg = "{{ route('helpdeskUploadImg') }}";
                helpdeskUploadImg(ajaxUrlImg);
            });


            $('#helpdesk_priority_select').on('change', function() {
                let priority_id = $(this).val();
                let formData = {
                    priority_id: priority_id,
                    ticket_id: '{{ $ticket->id }}'
                };
                let ajaxUrl = "{{ route('helpdeskUpdateStatus') }}";
                HelpdeskUpdateStatus(ajaxUrl, formData)
            });

            $('#helpdesk_category_select').on('change', function() {
                let category_id = $(this).val();
                let formData = {
                    category_id: category_id,
                    ticket_id: '{{ $ticket->id }}'
                };
                let ajaxUrl = "{{ route('helpdeskUpdateStatus') }}";
                HelpdeskUpdateStatus(ajaxUrl, formData);
            });

            $('#helpdesk_project_select').on('change', function() {
                let project_id = $(this).val();
                let formData = {
                    project_id: project_id,
                    ticket_id: '{{ $ticket->id }}'
                };
                let ajaxUrl = "{{ route('helpdeskUpdateStatus') }}";
                HelpdeskUpdateStatus(ajaxUrl, formData);
            });

            $('#helpdesk_status_select').on('change', function() {
                let helpdesk_status_id = $(this).val();
                let formData = {
                    helpdesk_status_id: helpdesk_status_id,
                    ticket_id: '{{ $ticket->id }}'
                };
                let ajaxUrl = "{{ route('helpdeskUpdateStatus') }}";
                HelpdeskUpdateStatus(ajaxUrl, formData);
            });

            $('#helpdesk_client_select').on('change', function() {
                let client_id = $(this).val();
                let formData = {
                    client_id: client_id,
                    ticket_id: '{{ $ticket->id }}'
                };
                let ajaxUrl = "{{ route('helpdeskUpdateStatus') }}";
                HelpdeskUpdateStatus(ajaxUrl, formData);
            });

        });
    </script>
</x-app-layout>
