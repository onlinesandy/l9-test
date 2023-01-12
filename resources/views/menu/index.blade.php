<x-app-layout>
    <x-breadcrumbs :help=$help_url :title=$title :breadcrumb=$breadcrumb></x-breadcrumbs>

    @include('includes.input-msg')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                @include('menu.partials.title')
                @include('menu.partials.filters')

                <div class="card-body">
                    <div class="table-responsive table-card mb-4">
                        <table class="table align-middle table-nowrap mb-0">
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
                                                data-bs-target="#showModal" data-edit-id="6">
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

    @include('menu.modal.add-modal')

    <script type="text/javascript" defer>
        $(document).ready(function() {
            $('#showModal').on('show.bs.modal', function(e) {
                $('.name').val('');
                let btn = $(e.relatedTarget);
                let p_id = btn.data('edit-id');
                let p_name = btn.data('edit-name');
                $('.name').val(p_name);
                $('.id').val(p_id);
            });



            $('#deleteModal').on('show.bs.modal', function(e) {
                let btn = $(e.relatedTarget);
                let p_id = btn.data('remove-id');
                $('.id').val(p_id);
            });
        });
    </script>

    </x-app-layout>
