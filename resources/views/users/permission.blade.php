<x-app-layout>
    <x-breadcrumbs help={{ $help_url }} title={{ $title }} breadcrumb={{ $breadcrumb }}></x-breadcrumbs>

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>{{ $error }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endforeach
    @endif

    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ $message }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-0">
                    <div class="d-flex align-items-center">
                        <h5 class="card-title mb-0 flex-grow-1">Permission List</h5>
                        <div class="flex-shrink-0">
                            <button class="btn btn-danger add-btn" data-bs-toggle="modal"
                                data-bs-target="#showPermissionModal">
                                <i class="ri-menu-add-line align-bottom me-1"></i> Add Permission
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body border border-dashed border-end-0 border-start-0">

                    <form>
                        <div class="row g-3">
                            <div class="col-xxl-2 col-sm-4">
                                <div class="input-light">
                                    <select class="form-control" data-choices data-choices-search-false
                                        name="menu_status" id="menu_status">
                                        <option value="all" selected>All</option>
                                        <option value="1">Active</option>
                                        <option value="0">Deactive</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xxl-8 col-sm-4">
                                <div class="input-light">

                                </div>
                            </div>

                            <div class="col-xxl-2 col-sm-4 float-right align-right">
                                <button type="button" class="btn btn-danger"> <i
                                        class="ri-search-line me-1 align-bottom"></i>
                                    Search
                                </button>
                            </div>

                        </div>

                    </form>
                </div>

                <div class="card-body">
                    <div class="table-responsive table-card mb-4">
                        <table class="table align-middle table-nowrap mb-0" id="ticketTable">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col" style="width: 40px;">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="checkAll"
                                                value="option">
                                        </div>
                                    </th>
                                    <th scope="col">ID</th>
                                    <th scope="col">Menu</th>
                                    <th scope="col">Parent</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody class="list form-check-all">
                                <tr>
                                    <th scope="row">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="checkAll"
                                                value="option1">
                                        </div>
                                    </th>
                                    <td class="id">
                                        <a href="javascript:void(0);" data-id="001"
                                            class="fw-medium link-primary">#VLZ001</a>
                                    </td>
                                    <td class="tasks_name">Menu</td>
                                    <td class="client_name">-</td>
                                    <td class="status"><span
                                            class="badge badge-soft-warning text-uppercase">Inprogress</span></td>
                                    <td>
                                        <div class="hstack gap-2">
                                            <button class="btn btn-sm btn-soft-info edit-list" data-bs-toggle="modal"
                                                data-bs-target="#createTask" data-edit-id="6">
                                                <i class="ri-pencil-fill align-bottom"></i>
                                            </button>
                                            <button class="btn btn-sm btn-soft-danger remove-list"
                                                data-bs-toggle="modal" data-bs-target="#removeModal" data-remove-id="6">
                                                <i class="ri-delete-bin-5-fill align-bottom"></i>
                                            </button>

                                        </div>


                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="noresult">
                            <div class="text-center" style="display:none">
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

    @include('modal.remove-modal')
    @include('permissions.partials.add-permission')



</x-app-layout>
