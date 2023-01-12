<x-app-layout>
    <x-breadcrumbs :help=$help_url :title=$title :breadcrumb=$breadcrumb></x-breadcrumbs>

    @include('includes.input-msg')

    <div class="row">
        <div class="col-xxl-3 col-sm-6">
            <div class="card card-animate">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="fw-medium text-muted mb-0">Total Tickets</p>
                            <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value" data-target="547">547</span>k</h2>
                            <p class="mb-0 text-muted"><span class="badge bg-light text-success mb-0"> <i class="ri-arrow-up-line align-middle"></i> 17.32 % </span> vs. previous month</p>
                        </div>
                        <div>
                            <div class="avatar-sm flex-shrink-0">
                                <span class="avatar-title bg-soft-info text-info rounded-circle fs-4">
                                    <i class="ri-ticket-2-line"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div><!-- end card body -->
            </div> <!-- end card-->
        </div>
        <!--end col-->
        <div class="col-xxl-3 col-sm-6">
            <div class="card card-animate">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="fw-medium text-muted mb-0">Pending Tickets</p>
                            <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value" data-target="124">124</span>k</h2>
                            <p class="mb-0 text-muted"><span class="badge bg-light text-danger mb-0"> <i class="ri-arrow-down-line align-middle"></i> 0.96 % </span> vs. previous month</p>
                        </div>
                        <div>
                            <div class="avatar-sm flex-shrink-0">
                                <span class="avatar-title bg-soft-info text-info rounded-circle fs-4">
                                    <i class="mdi mdi-timer-sand"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div><!-- end card body -->
            </div>
        </div>
        <!--end col-->
        <div class="col-xxl-3 col-sm-6">
            <div class="card card-animate">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="fw-medium text-muted mb-0">Closed Tickets</p>
                            <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value" data-target="107">107</span>K</h2>
                            <p class="mb-0 text-muted"><span class="badge bg-light text-danger mb-0"> <i class="ri-arrow-down-line align-middle"></i> 3.87 % </span> vs. previous month</p>
                        </div>
                        <div>
                            <div class="avatar-sm flex-shrink-0">
                                <span class="avatar-title bg-soft-info text-info rounded-circle fs-4">
                                    <i class="ri-shopping-bag-line"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div><!-- end card body -->
            </div>
        </div>
        <!--end col-->
        <div class="col-xxl-3 col-sm-6">
            <div class="card card-animate">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="fw-medium text-muted mb-0">Deleted Tickets</p>
                            <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value" data-target="15.95">15.95</span>%</h2>
                            <p class="mb-0 text-muted"><span class="badge bg-light text-success mb-0"> <i class="ri-arrow-up-line align-middle"></i> 1.09 % </span> vs. previous month</p>
                        </div>
                        <div>
                            <div class="avatar-sm flex-shrink-0">
                                <span class="avatar-title bg-soft-info text-info rounded-circle fs-4">
                                    <i class="ri-delete-bin-line"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div><!-- end card body -->
            </div>
        </div>
        <!--end col-->
    </div>

    <div class="row">
        <div class="col-lg-12">

            <div class="card">

                @include('helpdesk.partials.title')
                {{-- @include('helpdesk.partials.filters') --}}
                <div class="card-body border border-dashed border-end-0 border-start-0">
                    <form>
                        <div class="row g-3">
                            <div class="col-xxl-1 col-sm-1 w-auto">
                                <button class="btn btn-soft-danger"><i class="ri-delete-bin-2-line"></i></button>
                            </div>
                            <div class="col-xxl-2 col-sm-4">
                                <div class="input-light">
                                    <select class="form-control" data-choices data-choices-search-false name="choices-single-default" id="idStatus">
                                        <option value="">Status</option>
                                        <option value="all" selected>All</option>
                                        <option value="Open">Open</option>
                                        <option value="Inprogress">Inprogress</option>
                                        <option value="Closed">Closed</option>
                                        <option value="New">New</option>
                                    </select>

                                </div>
                            </div>
                            <div class="col-xxl-3 col-sm-4">
                                <input type="text" class="form-control flatpickr-input bg-light border-light" data-provider="flatpickr" data-date-format="d/m/yy" data-mode="range" id="demo-datepicker" placeholder="Select date range">
                            </div>
                            <div class="col-xxl-4 col-sm-12">
                                <div class="search-box">
                                    <input type="text" class="form-control search bg-light border-light" placeholder="Search for ticket details or something...">
                                    <i class="ri-search-line search-icon"></i>
                                </div>
                            </div>

                            <div class="col-xxl-2 col-sm-4">
                                <button type="button" class="btn btn-info"> <i class="ri-equalizer-fill me-1 align-bottom"></i>
                                    Search
                                </button>
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                    </form>
                </div>


                <div class="card-body">
                    <div class="table-responsive table-card mb-4">
                        <table class="table align-middle table-nowrap mb-0" id="ticketTable">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col" style="width: 40px;">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="checkAll" value="option">
                                        </div>
                                    </th>
                                    <th scope="col">
                                        Ticket No.
                                    </th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Client</th>
                                    <th scope="col">Project</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Priority</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody class="list form-check-all">
                                @php $i = 0; @endphp
                                @foreach ($tickets as $key => $ticket)
                                    <tr>
                                        <th scope="row">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="checkAll" value="option1">
                                            </div>
                                        </th>
                                        <td>
                                            <a href="{{route('viewticket',$ticket->ticket_no)}}" target="__blank" data-id="{{ $ticket->id }}" class="fw-medium link-primary">
                                                #{{ $ticket->ticket_no }}
                                            </a>
                                        </td>
                                        <td>{{ $ticket->title }}</td>
                                        <td>{{ $ticket->client->name }}</td>
                                        <td>{{ $ticket->project->name }}</td>
                                        <td>{{ $ticket->ticket_status->name }}</td>
                                        <td>{{ $ticket->priority->name }}</td>
                                        <td>
                                            <div class="hstack gap-2">
                                                <button class="btn btn-sm btn-soft-info edit-list"
                                                    data-bs-toggle="modal" data-bs-target="#showModal"
                                                    data-edit-name="{{ $ticket->title }}"
                                                    data-edit-permission="{{ $ticket->title }}"
                                                    data-edit-id="{{ $ticket->id }}">
                                                    <i class="ri-pencil-fill align-bottom"></i>
                                                </button>
                                                <button class="btn btn-sm btn-soft-danger remove-list"
                                                    data-bs-toggle="modal" data-bs-target="#deleteModal"
                                                    data-remove-id="{{ $ticket->id }}">
                                                    <i class="ri-delete-bin-5-fill align-bottom"></i>
                                                </button>

                                            </div>


                                            {{-- <a class="btn btn-info" href="{{ route('roles.show', ['role' => $ticket->id]) }}">Show</a> --}}
                                            {{-- @can('role-edit') --}}
                                            {{-- <a class="btn btn-primary" href="{{ route('roles.edit', $ticket->id) }}">Edit</a> --}}
                                            {{-- @endcan
                                            @can('role-delete') --}}
                                            {{-- {!! Form::open(['method' => 'DELETE', 'route' => ['roles.destroy', $ticket->id], 'style' => 'display:inline']) !!}
                                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                                {!! Form::close() !!} --}}
                                            {{-- @endcan --}}
                                        </td>
                                    </tr>
                                @endforeach



                            </tbody>
                        </table>
                        <div class="noresult">
                            <div class="text-center">
                                <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop"
                                    colors="primary:#121331,secondary:#08a88a" style="width:75px;height:75px">
                                </lord-icon>
                                <h5 class="mt-2">Sorry! No Result Found</h5>
                                <p class="text-muted mb-0">We've searched more than 150+ Tickets We did not find any
                                    Tickets for you search.</p>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mt-2">
                        <div class="pagination-wrap hstack gap-2">
                            <a class="page-item pagination-prev disabled" href="#">
                                Previous
                            </a>
                            <ul class="pagination listjs-pagination mb-0"></ul>
                            <a class="page-item pagination-next" href="#">
                                Next
                            </a>
                        </div>
                    </div>


                </div>
                <!--end card-body-->
            </div>
            <!--end card-->
        </div>
        <!--end col-->
    </div>

    @include('helpdesk.modal.add-modal')
    @include('helpdesk.modal.delete-modal')

    <script src="{{ Vite::asset('resources/assets/libs/multi.js/multi.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#showModal').on('show.bs.modal', function(e) {
                $('.name').val('');
                $('.id').val('');
                $(".select2").val('').change();
                let btn = $(e.relatedTarget);
                let id = btn.data('edit-id');
                let name = btn.data('edit-name');

                if (id > 0) {
                    let permission = btn.data('edit-permission');
                    var selectedPermission = permission.map(s => s.id);
                    $(".select2").val(selectedPermission).change();
                    $('.name').val(name);
                    $('.id').val(id);
                }

            });



            $('#deleteModal').on('show.bs.modal', function(e) {
                let btn = $(e.relatedTarget);
                let p_id = btn.data('remove-id');
                $('.id').val(p_id);
            });
        });
    </script>



</x-app-layout>
