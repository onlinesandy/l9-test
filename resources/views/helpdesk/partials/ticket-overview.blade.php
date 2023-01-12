<div class="row">
    <div class="col-lg-12">
        <div class="card mt-n4 mx-n4">
            <div class="bg-soft-danger">
                <div class="card-body pb-0 px-4">
                    <div class="row mb-3">
                        <div class="col-md">
                            <div class="row align-items-center">
                                <div class="col-md-auto">
                                    <div class="avatar-md mb-md-0 mb-4">
                                        <div class="bg-info avatar-title rounded-circle">
                                            <i class="ri-ticket-2-line align-center fs-48"></i>
                                        </div>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-md">
                                    <h4 class="fw-semibold" id="helpdesk_edit_title">#{{ $ticket->ticket_no }}
                                        <span id="helpdesk_edit_title_txt" >{{ $ticket->title }}</span>
                                        <label for="helpdesk_edit_title_btn" class="avatar-xs">
                                            <span id="helpdesk_edit_title_btn" class="avatar-title rounded-circle bg-light text-body cursor-pointer">
                                                <i class="ri-edit-box-line fs-16"></i>
                                            </span>
                                        </label>
                                    </h4>
                                    <div class="col-lg-10 mb-3 d-none" id="helpdesk_edit_title_input_box">
                                        <div class="input-group">
                                            <input id="helpdesk_edit_title_input" name="helpdesk_edit_title_input" type="text" class="form-control">
                                            <button id="helpdesk_cancel_title_btn"  class="btn btn-warning" type="button">Cancel</button>
                                            <button id="helpdesk_update_title_btn"  class="btn btn-success" type="button">Update</button>
                                        </div>
                                    </div>

                                    <div class="hstack gap-3 flex-wrap">
                                        <div class="text-muted">
                                            <i class="ri-building-line align-bottom me-1"></i>
                                            <span id="ticket-client">{{ $ticket->client->name }}</span>
                                        </div>
                                        <div class="vr"></div>
                                        <div class="text-muted">
                                            <i class="ri-pages-line align-bottom me-1"></i>
                                            <span id="ticket-project">{{ $ticket->project->name }}</span>
                                        </div>
                                        <div class="vr"></div>
                                        <div class="text-muted">
                                            <i class="ri-calendar-check-line align-bottom me-1"></i>
                                            Create Date :
                                            <span class="fw-medium" id="create-date">
                                                {{ \Carbon::createFromTimeString($ticket->created_at)->format('d-m-Y g:i A') }}
                                            </span>
                                        </div>
                                        <div class="vr"></div>
                                        <div class="text-muted">
                                            <i class="ri-calendar-todo-line align-bottom me-1"></i>
                                            Due Date :
                                            <span class="fw-medium" id="due-date">
                                                {{ $ticket->due_date }}</span>
                                        </div>
                                        <div class="vr"></div>
                                        <div class="text-muted">
                                            <i class="ri-file-edit-fill align-bottom me-1"></i>
                                            Last activity :
                                            <span class="fw-medium" id="due-date">
                                                @php
                                                    $lastActivity = '';
                                                    if (!empty($ticket->last_activity)) {
                                                        $lastActivity = Carbon::parse($ticket->last_activity)->diffForHumans();
                                                    }
                                                @endphp
                                                {{ $lastActivity }}
                                            </span>
                                        </div>
                                        <div class="vr"></div>
                                        <div class="badge rounded-pill bg-info fs-12" id="ticket-status">
                                            {{ $ticket->ticket_status->name }}
                                        </div>
                                        <div class="badge rounded-pill bg-danger fs-12" id="ticket-priority">
                                            {{ $ticket->priority->name }}
                                        </div>
                                    </div>
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </div>
                        <!--end col-->
                        <div class="col-md-auto mt-md-0 mt-4">
                            <div class="hstack gap-1 flex-wrap">
                                <button type="button" class="btn avatar-xs mt-n1 p-0 favourite-btn active">
                                    <span class="avatar-title bg-transparent fs-15">
                                        <i class="ri-star-fill"></i>
                                    </span>
                                </button>
                                <button type="button" class="btn py-0 fs-16 text-body" id="settingDropdown"
                                    data-bs-toggle="dropdown">
                                    <i class="ri-share-line"></i>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="settingDropdown">
                                    <li><a class="dropdown-item" href="#"><i
                                                class="ri-eye-fill align-bottom me-2 text-muted"></i> View</a></li>
                                    <li><a class="dropdown-item" href="#"><i
                                                class="ri-share-forward-fill align-bottom me-2 text-muted"></i>
                                            Share with</a></li>
                                    <li><a class="dropdown-item" href="#"><i
                                                class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                            Delete</a></li>
                                </ul>
                                <button type="button" class="btn py-0 fs-16 text-body">
                                    <i class="ri-flag-line"></i>
                                </button>
                            </div>
                        </div>
                        <!--end col-->
                    </div>
                    <ul class="nav nav-tabs-custom border-bottom-0" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active fw-semibold" data-bs-toggle="tab" href="#helpdesk-overview"
                                role="tab">
                                Overview
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-semibold" data-bs-toggle="tab" href="#helpdesk-activities"
                                role="tab">
                                Activities
                            </a>
                        </li>

                    </ul>
                    <!--end row-->
                </div><!-- end card body -->
            </div>
        </div><!-- end card -->
    </div><!-- end col -->
</div>
