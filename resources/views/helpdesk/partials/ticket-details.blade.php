<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">Ticket Details</h5>
    </div>
    <div class="card-body">
        <div class="table-card">
            <table class="table table-borderless align-middle mb-0">
                <tbody>
                    <tr>
                        <td class="fw-medium">Client:</td>
                        <td>
                            <div class="input-light">
                                <select class="form-control" data-choices data-choices-search-false
                                    name="helpdesk_client_select" id="helpdesk_client_select">
                                    @foreach ($ticket_client_list as $h_c)
                                    @php
                                            $sel = '';
                                            if ($ticket->client_id == $h_c->id) {
                                                $sel = 'selected = "selected"';
                                            }
                                        @endphp
                                        <option value="{{ $h_c->id }}" {{ $sel}}>
                                            {{ $h_c->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="fw-medium">Project:</td>
                        <td>
                            <div class="input-light">
                                <select class="form-control" data-choices data-choices-search-false
                                    name="helpdesk_project_select" id="helpdesk_project_select">
                                    @foreach ($ticket_project_list as $h_p)
                                    @php
                                            $sel = '';
                                            if ($ticket->project_id == $h_p->id) {
                                                $sel = 'selected = "selected"';
                                            }
                                        @endphp
                                        <option value="{{ $h_p->id }}" {{$sel}}>
                                            {{ $h_p->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="fw-medium">Category:</td>
                        <td>
                            <div class="input-light">
                                <select class="form-control" data-choices data-choices-search-false
                                    name="helpdesk_category_select" id="helpdesk_category_select">
                                    @foreach ($ticket_category_list as $h_cat)
                                        @php
                                            $sel = '';
                                            if ($ticket->category_id == $h_cat->id) {
                                                $sel = 'selected = "selected"';
                                            }
                                        @endphp
                                        <option value="{{ $h_cat->id }}" {{ $sel }}>
                                            {{ $h_cat->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="fw-medium">Status:</td>
                        <td>
                            <div class="input-light">
                                <select class="form-control" data-choices data-choices-search-false
                                    name="helpdesk_status_select" id="helpdesk_status_select">
                                    @foreach ($ticket_status_list as $h_s)
                                        @php
                                            $sel = '';
                                            if ($ticket->ticket_status_id == $h_s->id) {
                                                $sel = 'selected = "selected"';
                                            }
                                        @endphp
                                        <option value="{{ $h_s->id }}" {{ $sel }}>
                                            {{ $h_s->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="fw-medium">Priority:</td>
                        <td>
                            <div class="input-light">
                                <select class="form-control" data-choices data-choices-search-false
                                    name="helpdesk_priority_select" id="helpdesk_priority_select">
                                    @foreach ($ticket_priority_list as $h_p)
                                        @php
                                            $sel = '';
                                            if ($ticket->priority_id == $h_p->id) {
                                                $sel = 'selected = "selected"';
                                            }
                                        @endphp
                                        <option value="{{ $h_p->id }}" {{ $sel }}>
                                            {{ $h_p->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <!--end card-body-->
</div>
