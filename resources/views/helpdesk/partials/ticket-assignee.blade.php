<div class="card">
    <div class="card-header align-items-center d-flex">
        <h4 class="card-title mb-0 flex-grow-1">Assiged To</h4>
        <div class="flex-shrink-0">
            <a href="javascript:void(0);" class="badge bg-light text-primary fs-12" id="helpdesk_edit_assignee_btn">
                <i class="ri-edit-box-line align-bottom me-1"></i> Edit
            </a>
        </div>
        <div class="flex-shrink-0 ms-1 d-none" id="helpdesk_edit_assignee_btn_box">
            <a href="javascript:void(0);" class="badge bg-soft-info text-primary fs-12"
                id="helpdesk_update_assignee_btn">
                <i class="ri-checkbox-line align-bottom me-1"></i> Save
            </a>
            <a href="javascript:void(0);" class="badge bg-soft-warning text-primary fs-12"
                id="helpdesk_cancel_assignee_btn">
                <i class="ri-delete-back-2-line align-bottom me-1"></i> Cancel
            </a>

        </div>
    </div>
    <div class="card-body p-1">
        <div id="helpdeskAssigneeListEditBox" class="d-none">
            <form id="helpdeskUpdateAssigneeForm" action="{{ route('helpdeskUpdateAssignee') }}" method="POST">
                @csrf()
                <div class="col border-bottom border-bottom-dashed">
                    <div class="mb-3">
                        <select data-ajax--url="{{ route('getHelpdeskAssigneeList') }}" data-ajax--cache="true"
                            name="helpdesk_edit_assignee_input" id="helpdesk_edit_assignee_input"
                            class="select2_ajax form-control" data-placeholder="Please select Assignee">

                        </select>
                    </div>
                </div>
                <div id="helpdeskAssigneeListDiv">
                    @foreach ($ticket_assignee_list as $a_u)
                        <div id="helpdeskAssignee-{{ $a_u->user->id }}"
                            class="d-flex align-items-center border-bottom border-bottom-dashed p-1">
                            <div class="avatar-xs flex-shrink-0 me-2">
                                <span class="avatar-title rounded-circle bg-info fs-10">
                                    {{ $a_u->user->getNameAllFirstLetter($a_u->user->name) }}
                                </span>

                            </div>
                            <div class="flex-grow-1">
                                <h5 class="fs-13 mt-2">
                                    {{ $a_u->user->name }}
                                </h5>
                            </div>
                            <div class="flex-shrink-0">
                                <input type="hidden" name="helpdeskAssigneeList[]" value="{{ $a_u->user->id }}" />
                                <input type="hidden" name="ticket_id" value="{{ $ticket->id }}" />
                                <span class="text-danger cursor-pointer fw-medium fs-12 hepdeskAssigneeDelBtn"
                                    helpdeskAssigneeDelID="{{ $a_u->user->id }}">
                                    <i class=" ri-delete-bin-fill"></i>
                                </span>
                            </div>
                        </div>
                    @endforeach

                </div>
            </form>
        </div>

        <div id="helpdeskAssigneeListViewBox">
            <div class="vstack">
                @foreach ($ticket_assignee_list as $a_u)
                    <div class="d-flex align-items-center border-bottom border-bottom-dashed p-1">
                        <div class="avatar-xs flex-shrink-0 me-2">
                            <span class="avatar-title rounded-circle bg-info fs-10">
                                {{ $a_u->user->getNameAllFirstLetter($a_u->user->name) }}
                            </span>

                        </div>
                        <div class="flex-grow-1">
                            <h5 class="fs-13 mt-2">
                                {{ $a_u->user->name }}
                            </h5>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>




    </div>
</div>
