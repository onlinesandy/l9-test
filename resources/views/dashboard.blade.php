<x-app-layout>
    <x-breadcrumbs :help=$help_url :title=$title :breadcrumb=$breadcrumb></x-breadcrumbs>

    <div class="row">

        <div class="col-xl-3">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Pie Charts</h4>
                </div>
                <div class="card-body p-0 pb-3">
                    <canvas id="myChart"></canvas>
                </div>
            </div>
            <!-- end card -->
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card" id="ticketsList">
                <div class="card-header border-0">
                    <div class="d-flex align-items-center">
                        <h5 class="card-title mb-0 flex-grow-1">Tickets</h5>

                        <div class="flex-shrink-0">
                            <button class="btn btn-danger add-btn" data-bs-toggle="modal" data-bs-target="#showModal"><i class="ri-add-line align-bottom me-1"></i> Create Tickets</button>
                            <button class="btn btn-soft-danger"><i class="ri-delete-bin-2-line"></i></button>

                            <div class="form-check form-switch form-switch-right form-switch-md">
                                <label for="card-tables-showcode" class="form-label text-muted">Toggle</label>
                                <input class="form-check-input code-switcher" type="checkbox" id="card-tables-showcode">
                            </div>
                        </div>

                    </div>



                </div>
                <div class="card-body border border-dashed border-end-0 border-start-0">
                    <form>
                        <div class="row g-3">
                            <div class="col-xxl-5 col-sm-12">
                                <div class="search-box">
                                    <input type="text" class="form-control search bg-light border-light" placeholder="Search for ticket details or something...">
                                    <i class="ri-search-line search-icon"></i>
                                </div>
                            </div>
                            <!--end col-->

                            <div class="col-xxl-3 col-sm-4">
                                <input type="text" class="form-control flatpickr-input bg-light border-light" data-provider="flatpickr" data-date-format="d/m/yy" data-mode="range" id="demo-datepicker" placeholder="Select date range">
                            </div>
                            <!--end col-->

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
                            <!--end col-->
                            <div class="col-xxl-2 col-sm-4">
                                <button type="button" class="btn btn-danger"> <i class="ri-equalizer-fill me-1 align-bottom"></i>
                                    Generate Report
                                </button>
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                    </form>
                </div>
                <!--end card-body-->
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
                                    <th scope="col">ID</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Client</th>
                                    <th scope="col">Assigned To</th>
                                    <th scope="col">Create Date</th>
                                    <th scope="col">Due Date</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Priority</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody class="list form-check-all">
                                <tr>
                                    <th scope="row">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="checkAll" value="option1">
                                        </div>
                                    </th>
                                    <td class="id">
                                        <a href="javascript:void(0);" data-id="001" class="fw-medium link-primary">#VLZ001</a>
                                    </td>
                                    <td class="tasks_name">Error message when placing an orders?</td>
                                    <td class="client_name">Tonya Noble</td>
                                    <td class="assignedto">James Morris</td>
                                    <td class="create_date">08 Dec, 2021</td>
                                    <td class="due_date">25 Jan, 2022</td>
                                    <td class="status"><span class="badge badge-soft-warning text-uppercase">Inprogress</span></td>
                                    <td class="priority"><span class="badge bg-danger text-uppercase">High</span></td>
                                    <td>
                                        <div class="hstack gap-2">
                                            <button class="btn btn-sm btn-soft-danger remove-list" data-bs-toggle="modal" data-bs-target="#removeTaskItemModal" data-remove-id="6">
                                                <i class="ri-delete-bin-5-fill align-bottom"></i>
                                            </button>
                                            <button class="btn btn-sm btn-soft-info edit-list" data-bs-toggle="modal" data-bs-target="#createTask" data-edit-id="6">
                                                <i class="ri-pencil-fill align-bottom"></i>
                                            </button>
                                        </div>


                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="noresult">
                            <div class="text-center" style="display:none">
                                <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop" colors="primary:#121331,secondary:#08a88a" style="width:75px;height:75px"></lord-icon>
                                <h5 class="mt-2">Sorry! No Result Found</h5>
                                <p class="text-muted mb-0">We've searched more than 150+ Tickets We did not find any Tickets for you search.</p>
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

    <div class="modal fade zoomIn" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0">
                <div class="modal-header p-3 bg-soft-info">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                </div>
                <form>
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-lg-12">
                                <div id="modal-id">
                                    <label for="orderId" class="form-label">ID</label>
                                    <input type="text" id="orderId" class="form-control" placeholder="ID" value="#VLZ462" readonly />
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div>
                                    <label for="tasksTitle-field" class="form-label">Title</label>
                                    <input type="text" id="tasksTitle-field" class="form-control" placeholder="Title" required />
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div>
                                    <label for="client_nameName-field" class="form-label">Client Name</label>
                                    <input type="text" id="client_nameName-field" class="form-control" placeholder="Client Name" required />
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div>
                                    <label for="assignedtoName-field" class="form-label">Assigned To</label>
                                    <input type="text" id="assignedtoName-field" class="form-control" placeholder="Assigned to" required />
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label for="date-field" class="form-label">Create Date</label>
                                <input type="text" id="date-field" class="form-control" data-provider="flatpickr" data-date-format="d M, Y" placeholder="Create Date" required />
                            </div>
                            <div class="col-lg-6">
                                <label for="duedate-field" class="form-label">Due Date</label>
                                <input type="text" id="duedate-field" class="form-control" data-provider="flatpickr" data-date-format="d M, Y" placeholder="Due Date" required />
                            </div>
                            <div class="col-lg-6">
                                <label for="ticket-status" class="form-label">Status</label>
                                <select class="form-control" data-plugin="choices" name="ticket-status" id="ticket-status">
                                    <option value="">Status</option>
                                    <option value="New">New</option>
                                    <option value="Inprogress">Inprogress</option>
                                    <option value="Closed">Closed</option>
                                    <option value="Open">Open</option>
                                </select>
                            </div>
                            <div class="col-lg-6">
                                <label for="priority-field" class="form-label">Priority</label>
                                <select class="form-control" data-plugin="choices" name="priority-field" id="priority-field">
                                    <option value="">Priority</option>
                                    <option value="High">High</option>
                                    <option value="Medium">Medium</option>
                                    <option value="Low">Low</option>
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <div class="hstack gap-2 justify-content-end">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success" id="add-btn">Add Ticket</button>
                            <button type="button" class="btn btn-success" id="edit-btn">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="{{ Vite::asset('resources/assets/libs/chart.js/chart.min.js') }}"></script>
    {{-- <script src="{{ Vite::asset('resources/assets/js/pages/ticketlist.init.js') }}"></script> --}}
    <script>
        document.addEventListener("DOMContentLoaded", () => {

            const ctx = document.getElementById('myChart');
            const data = {
                labels: [
                    'Red',
                    'Blue',
                    'Yellow'
                ],
                datasets: [{
                    label: 'My First Dataset',
                    data: [300, 50, 100],
                    backgroundColor: [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 205, 86)'
                    ],
                    hoverOffset: 4
                }]
            };

            new Chart(ctx, {
                type: 'pie',
                data: data,

            });

        });
    </script>


</x-app-layout>
