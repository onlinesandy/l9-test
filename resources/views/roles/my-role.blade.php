<x-app-layout>
    <x-breadcrumbs :help=$help_url :title=$title :breadcrumb=$breadcrumb></x-breadcrumbs>

    @include('includes.input-msg')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="alert alert-info border-0 rounded-0 m-0 d-flex align-items-center" role="alert">
                    <div class="flex-grow-1 text-truncate">
                        <h5 class="card-title mb-0 flex-grow-1">My Role </h5>
                    </div>
                    <div class="flex-shrink-0">

                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive table-card mb-4">
                        <table class="table align-middle table-nowrap mb-0" id="ticketTable">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col" style="width: 40px;">
                                        Sr No.
                                    </th>
                                    <th scope="col">Assigned Role</th>
                                    <th scope="col">Assigned Permission</th>
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

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
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
