<x-app-layout>
    <x-breadcrumbs :help=$help_url :title=$title :breadcrumb=$breadcrumb></x-breadcrumbs>
    @include('includes.input-msg')


    <div class="row">
        <form id="helpdeskAddTicketForm" class="row g-3 needs-validation" novalidate
            action="{{ route('addHelpdeskTicket') }}" method="POST" enctype="multipart/form-data">
            @csrf()
            <div class="row">
                <div class="col-lg-9">
                    <div class="card">
                        <div class="card-header bg-soft-info">
                            <h4 class="card-title mb-0">Add Ticket</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="title" class="form-label">Title</label>
                                        <input type="text" class="form-control" name="helpdesk_title"
                                            id="helpdesk_title" placeholder="Enter Title" id="title">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="status" class="form-label">Category</label>
                                        <select data-ajax--url="{{ route('getHelpdeskCategory') }}"
                                            data-ajax--cache="true" name="helpdesk_category" id="helpdesk_category"
                                            class="select2_ajax form-control" data-placeholder="Select Ticket Category">

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="due_date" class="form-label">Due Date</label>
                                        <div class="form-icon right">
                                            <input type="text" name="helpdesk_due_date" id="helpdesk_due_date"
                                                class="form-control form-control-icon flatpickr-input"
                                                data-provider="flatpickr" data-date-format="d/m/yy"
                                                placeholder="Select date range">
                                            <i class="ri-delete-back-2-line flatpickr-reset" id="flatpickrBtnClear"></i>
                                        </div>
                                    </div>
                                </div>

                                <!--end col-->
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="status" class="form-label">Status</label>
                                        <select data-ajax--url="{{ route('getHelpdeskStatus') }}"
                                            data-ajax--cache="true" name="helpdesk_status" id="helpdesk_status"
                                            class="select2_ajax form-control" data-placeholder="Select Ticket Status">

                                        </select>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="priority" class="form-label">Priority</label>
                                        <select data-ajax--url="{{ route('getHelpdeskPriority') }}"
                                            data-ajax--cache="true" name="helpdesk_priority" id="helpdesk_priority"
                                            class="select2_ajax form-control" data-placeholder="Select Ticket Priority">

                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="client" class="form-label">Client</label>

                                        <select data-ajax--url="{{ route('getHelpdeskClients') }}"
                                            data-ajax--cache="true" name="helpdesk_client" id="helpdesk_client"
                                            class="select2_ajax form-control" data-placeholder="Please Select Client">

                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="project" class="form-label">Project</label>

                                        <select data-ajax--url="{{ route('getHelpdeskProjects') }}"
                                            data-ajax--cache="true" name="helpdesk_project" id="helpdesk_project"
                                            class="select2_ajax form-control" data-placeholder="Please Select Project">

                                        </select>
                                    </div>
                                </div>



                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="client" class="form-label">Description</label>
                                        <textarea name="helpdesk_description" id="helpdesk_description" class="form-control" name="decription" id="description"
                                            rows="4"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div id="editor" class="snow-editor ql-container ql-snow"
                                        style="min-height:150px;max-height: 500px;overflow:auto">

                                    </div>
                                </div>
                                <div class="col-lg-12 pb-5"></div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">


                    <div class="card">
                        <div class="card-header bg-soft-info">
                            <h4 class="card-title mb-0">Assign To</h4>
                        </div>
                        <div class="card-body">
                            <div class="col border-bottom border-bottom-dashed">
                                <div class="mb-3">
                                    <select data-ajax--url="{{ route('getHelpdeskAssigneeList') }}"
                                        data-ajax--cache="true" name="helpdesk_assignee" id="helpdesk_assignee"
                                        class="select2_ajax form-control" data-placeholder="Please select Assignee">

                                    </select>
                                </div>
                            </div>
                            <div id="helpdeskAssigneeListDiv">

                            </div>


                            </select>
                        </div>
                    </div>

                    @include('helpdesk.partials.ticket-images')

                </div>

                <div class="col-md-12">
                    <div class="text-end mb-3">
                        <button type="button" id="helpdeskAddTicketSaveBtn" class="btn btn-info add-btn"> Save
                            Ticket</button>
                    </div>

                </div>
            </div>




        </form>
    </div>

    @include('menu.modal.add-modal')
    @include('helpdesk.modal.add-client')
    @include('helpdesk.modal.add-project')
    @include('helpdesk.modal.add-priority')
    @include('helpdesk.modal.add-status')
    @include('helpdesk.modal.add-category')


    <script src="{{ Vite::asset('resources/assets/libs/quill/quill.min.js') }}"></script>
    {{-- <script src="{{ Vite::asset('resources/assets/js/quill-image-resize.min.js') }}"></script> --}}
    <script src="{{ Vite::asset('resources/js/quill-editor.init.js') }}"></script>
    <script src="{{ Vite::asset('resources/js/helpdesk.init.js') }}"></script>



    <script type="text/javascript">
        $(document).ready(function() {
            $('#helpdeskAddTicketSaveBtn').on('click', function(eventObj) {
                $('#helpdeskAddTicketForm').submit();
            });



            $('#helpdeskDropzoneArea').on('click', '#helpdeskDropzone', function() {
                $('#helpdeskInputFiles').click();
            });

            $('#helpdeskInputFiles').on("change", function(e) {
                let files = e.target.files;
                let filesLength = files.length;
                $("#helpdeskImagesDiv").empty();;
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
                        <div class="flex-shrink-0 ms-3 mt-3 text-danger remove-helpdesk-img">
                            <i class=" ri-delete-bin-fill"></i>
                         </div>
                    </div>
                </div>`;

                        $("#helpdeskImagesDiv").append(imgInfo);
                        $(".remove-helpdesk-img").click(function() {
                            $(this).parent().parent(".helpdesk-file-attachment").remove();
                        });

                    });
                    fileReader.readAsDataURL(f);
                }

            });

            $("#helpdeskAssigneeListDiv").on("click", '.hepdeskAssigneeDelBtn', function(e) {
                let h_del_val = $(this).attr('helpdeskAssigneeDelID');
                $("#helpdeskAssignee-" + h_del_val).fadeOut(300, function() {
                    $(this).remove();
                });

            });
            $('#helpdesk_assignee').on("change", function(e) {
                let h_name = $("#helpdesk_assignee option:selected").text();
                let h_val = $("#helpdesk_assignee option:selected").val();

                if ($("#helpdeskAssignee-" + h_val).length == 0) {
                    let helpdeskAssigneeHtml = `<div id="helpdeskAssignee-${h_val}" class="d-flex justify-content-between border-bottom border-bottom-dashed py-2">
                                    <p class="fw-medium mb-0">
                                        <i class="ri-user-fill text-primary align-middle me-2"></i>
                                        <input type="hidden" name="helpdeskAssigneeList[]" value="${h_val}" />
                                        ${h_name}
                                    </p>
                                    <div>
                                        <span class="text-danger cursor-pointer fw-medium fs-12 hepdeskAssigneeDelBtn" helpdeskAssigneeDelID="${h_val}">
                                            <i class=" ri-delete-bin-fill"></i>
                                        </span>
                                    </div>
                                </div>`;
                    $("#helpdeskAssigneeListDiv").append(helpdeskAssigneeHtml);
                }




            });



        });
    </script>

</x-app-layout>
