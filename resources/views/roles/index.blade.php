<x-app-layout>
    <x-breadcrumbs :help=$help_url :title=$title :breadcrumb=$breadcrumb></x-breadcrumbs>

    @include('includes.input-msg')


    <div class="row">
        <div class="col-lg-12">

            <div class="card">

                @include('roles.partials.title')
                {{-- @include('roles.partials.filters') --}}


                <div class="card-body">
                    <div class="table-responsive table-card mb-4">
                        <table class="table align-middle table-nowrap mb-0" id="ticketTable">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col" style="width: 40px;">
                                        Sr No.
                                    </th>
                                    <th scope="col">Role Name</th>
                                    <th scope="col">Assigned Permission</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody class="list form-check-all">
                                @php $i = 0; @endphp
                                @foreach ($roles as $key => $role)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $role->name }}</td>
                                        <td class="status">
                                            @foreach ($role->permissions as $p_key => $r_permission)
                                                <span class="badge badge-soft-info text-uppercase">
                                                    {{ $r_permission->name }}
                                                </span>
                                            @endforeach
                                        </td>
                                        <td>
                                            <div class="hstack gap-2">
                                                <button class="btn btn-sm btn-soft-info edit-list"
                                                    data-bs-toggle="modal" data-bs-target="#showModal"
                                                    data-edit-name="{{ $role->name }}"
                                                    data-edit-permission="{{ $role->permissions }}"
                                                    data-edit-id="{{ $role->id }}">
                                                    <i class="ri-pencil-fill align-bottom"></i>
                                                </button>
                                                <button class="btn btn-sm btn-soft-danger remove-list"
                                                    data-bs-toggle="modal" data-bs-target="#deleteModal"
                                                    data-remove-id="{{ $role->id }}">
                                                    <i class="ri-delete-bin-5-fill align-bottom"></i>
                                                </button>

                                            </div>


                                            {{-- <a class="btn btn-info" href="{{ route('roles.show', ['role' => $role->id]) }}">Show</a> --}}
                                            {{-- @can('role-edit') --}}
                                            {{-- <a class="btn btn-primary" href="{{ route('roles.edit', $role->id) }}">Edit</a> --}}
                                            {{-- @endcan
                                            @can('role-delete') --}}
                                            {{-- {!! Form::open(['method' => 'DELETE', 'route' => ['roles.destroy', $role->id], 'style' => 'display:inline']) !!}
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

    @include('roles.modal.add-modal')
    @include('roles.modal.delete-modal')
    <script type="text/javascript" defer>
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
