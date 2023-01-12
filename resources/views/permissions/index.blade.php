<x-app-layout>
    <x-breadcrumbs :help=$help_url :title=$title :breadcrumb=$breadcrumb></x-breadcrumbs>

    @include('includes.input-msg')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                @include('permissions.partials.title')

                <div class="card-body">
                    <div class="table-responsive table-card mb-4">
                        <table class="table align-middle table-nowrap mb-0" id="ticketTable">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col" style="width: 40px;">
                                        Sr No.
                                    </th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody class="list form-check-all">
                                @php
                                    $srno = ($permissionList->currentPage() - 1) * $permissionList->perPage() + 1;

                                @endphp
                                @foreach ($permissionList as $p)
                                    <tr>
                                        <th scope="row">
                                            {{ $srno++ }}
                                        </th>
                                        <td class="tasks_name">{{ $p->name }}</td>
                                        <td class="status">
                                            <span class="badge badge-soft-info text-uppercase">Active</span>
                                        </td>
                                        <td>
                                            <div class="hstack gap-2">
                                                <button class="btn btn-sm btn-soft-info edit-list"
                                                    data-bs-toggle="modal" data-bs-target="#showModal"
                                                    data-edit-name="{{ $p->name }}"
                                                    data-edit-id="{{ $p->id }}">
                                                    <i class="ri-pencil-fill align-bottom"></i>
                                                </button>
                                                <button class="btn btn-sm btn-soft-danger remove-list"
                                                    data-bs-toggle="modal" data-bs-target="#deleteModal"
                                                    data-remove-id="{{ $p->id }}">
                                                    <i class="ri-delete-bin-5-fill align-bottom"></i>
                                                </button>

                                            </div>


                                        </td>
                                    </tr>
                                @endforeach


                            </tbody>
                        </table>
                        <div class="noresult">
                            <div class="text-center" style="display:none">
                                <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop"
                                    colors="primary:#121331,secondary:#08a88a" style="width:75px;height:75px">
                                </lord-icon>
                                <h5 class="mt-2">Sorry! No Result Found</h5>
                                <p class="text-muted mb-0">We've searched more than 150+ records We did not find any
                                    result for your search.</p>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mt-2">

                        <div class="pagination-wrap hstack gap-2">
                            {{ $permissionList->links() }}

                        </div>
                    </div>


                </div>
                <!--end card-body-->
            </div>
            <!--end card-->
        </div>
        <!--end col-->
    </div>

    @include('permissions.modal.add-modal')
    @include('permissions.modal.delete-modal')

    <script type="text/javascript" defer>
        $(document).ready(function() {
            $('#showModal').on('show.bs.modal', function(e) {
                $('.name').val('');
                let btn = $(e.relatedTarget);
                let p_id = btn.data('edit-id');
                let p_name = btn.data('edit-name');
                if(p_id > 0){
                    $('#showModal  #add-btn').html('Update');
                }else{
                    $('#showModal  #add-btn').html('Add');
                }
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
