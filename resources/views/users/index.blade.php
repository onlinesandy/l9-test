<x-app-layout>
    <x-breadcrumbs :help=$help_url :title=$title :breadcrumb=$breadcrumb></x-breadcrumbs>

    @include('includes.input-msg')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                @include('users.partials.title')

                <div class="card-body">
                    <div class="table-responsive table-card mb-4">
                        @if ($userList->count() > 0)
                            <table class="table table-hover  align-middle table-nowrap mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col" style="width: 40px;">
                                            Sr No.
                                        </th>
                                        <th scope="col">{{ __('Name') }}</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Permissions via Roles</th>
                                        <th scope="col">Direct Permissions</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                    @php
                                        $srno = ($userList->currentPage() - 1) * $userList->perPage() + 1;

                                    @endphp
                                    @foreach ($userList as $u)
                                        <tr>
                                            <th scope="row">
                                                {{ $srno++ }}
                                            </th>
                                            <td class="name">{{ $u->name }}</td>
                                            <td class="name">{{ $u->email }}</td>
                                            <td class="status">
                                                <span class="badge badge-soft-info text-uppercase">Active</span>
                                            </td>
                                            <td class="roles">
                                                @php
                                                    $u_model = \App\Models\User::find($u->id);
                                                @endphp
                                                <ul class="list-group-cust list-group-flush border-dashed">
                                                    @if (count($u_model->roles))
                                                        @foreach ($u_model->roles as $r)
                                                            <li class="list-group-item ps-0">
                                                                <div class="row align-items-center g-3">
                                                                    <div class="col-auto">
                                                                        <div
                                                                            class="avatar-md p-1 h-auto bg-light rounded-3 w-auto">
                                                                            <div class="text-center">
                                                                                <h6 class="mb-0">{{ $r->name }}
                                                                                </h6>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col">
                                                                        @foreach ($r->permissions as $p)
                                                                            <span
                                                                                class="badge badge-soft-info text-uppercase">{{ $p->name }}</span>
                                                                        @endforeach
                                                                    </div>

                                                                </div>
                                                                <!-- end row -->
                                                            </li>
                                                        @endforeach
                                                    @endif


                                                </ul>


                                            </td>
                                            <td class="permission">
                                                @if (count($u_model->getDirectPermissions()))
                                                    @foreach ($u_model->getDirectPermissions() as $p)
                                                        <span
                                                            class="badge badge-soft-info text-uppercase">{{ $p->name }}</span>
                                                    @endforeach
                                                @endif



                                            </td>
                                            <td>
                                                <div class="hstack gap-2">
                                                    <button class="btn btn-sm btn-soft-info" data-bs-toggle="modal"
                                                        data-bs-target="#showModal" data-edit-id="{{ $u_model->id }}"
                                                        data-edit-name="{{ $u_model->name }}"
                                                        data-edit-email="{{ $u_model->email }}"
                                                        data-edit-roles="{{ $u_model->roles }}"
                                                        data-edit-permissions="{{ $u_model->getDirectPermissions() }}">
                                                        <i class="ri-pencil-fill align-bottom"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-soft-danger remove-list"
                                                        data-bs-toggle="modal" data-bs-target="#deleteModal"
                                                        data-remove-id="{{ $u_model->id }}">
                                                        <i class="ri-delete-bin-5-fill align-bottom"></i>
                                                    </button>

                                                </div>


                                            </td>
                                        </tr>
                                    @endforeach


                                </tbody>
                            </table>
                        @else
                            <x-no-data-found />
                        @endif
                    </div>
                    <div class="d-flex justify-content-end mt-2">

                        <div class="pagination-wrap hstack gap-2">
                            {{ $userList->links() }}

                        </div>
                    </div>


                </div>
                <!--end card-body-->
            </div>
            <!--end card-->
        </div>
        <!--end col-->
    </div>

    @include('users.modal.add-modal')
    @include('users.modal.delete-modal')

    <script type="text/javascript" defer>
        $(document).ready(function() {
            $('#showModal').on('show.bs.modal', function(e) {
                $('.user-name').val('');
                $('.user-id').val('');
                $('.user-email').val('');
                $('.user-email').attr('disabled', false);
                $(".select2").val('').change();
                let btn = $(e.relatedTarget);
                let id = btn.data('edit-id');
                if (id > 0) {
                    let name = btn.data('edit-name');
                    let email = btn.data('edit-email');
                    $('.user-name').val(name);
                    $('.user-email').val(email);
                    $('.user-email').attr('disabled', true);
                    $('.user-id').val(id);
                    let user_roles = btn.data('edit-roles');
                    var selectedRoles = user_roles.map(s => s.id);
                    $(".user-roles").val(selectedRoles).change();
                    let user_permissions = btn.data('edit-permissions');
                    var selectedPermission = user_permissions.map(s => s.id);
                    $(".user-permissions").val(selectedPermission).change();
                    $('#showModal  #add-btn').html('Update');
                } else {
                    $('#showModal  #add-btn').html('Add');
                }

            });



            $('#deleteModal').on('show.bs.modal', function(e) {
                let btn = $(e.relatedTarget);
                let p_id = btn.data('remove-id');
                $('.id').val(p_id);
            });



            window.Echo.channel('test')
                .listen('.TestEvent', (e) => {
                    console.log(e);
                    let notify_html = `
                    <div id="" class="text-reset notification-item d-block dropdown-item position-relative">
                            <div class="d-flex">
                                <div class="avatar-xs me-3 mt-2">
                                    <span class="avatar-title bg-soft-info text-info rounded-circle fs-16">
                                        <i class="bx bx-badge-check"></i>
                                    </span>
                                </div>
                                <div class="flex-1">
                                    <a href="#!" class="stretched-link">
                                        <h6 class="mt-0 mb-2 lh-base">
                                            Hiii you have new notification
                                        </h6>
                                    </a>
                                    <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                        <span><i class="mdi mdi-clock-outline"></i> Just 30 sec
                                            ago</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    `;
                    $(".notifications-inner-block").prepend(notify_html);

                });
        });
    </script>

</x-app-layout>
