<div class="modal fade" id="showModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="ModalLabel" aria-modal="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header p-3 bg-soft-info">
                <h5 class="modal-title" id="createUserLabel">Add User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" id="createUserBtn-close" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" novalidate method="POST" action="{{ route('users.store') }}">
                    @csrf
                    <input type="hidden" id="user-id" name="user-id" class="form-control user-id">
                    <div class="mb-3">
                        <label for="user-title-input" class="form-label">Name</label>
                        <input type="text" id="name" name="name" class="form-control user-name" placeholder="Enter Name" required>
                        <div class="invalid-feedback"> Please Enter Name.</div>
                    </div>
                    <div class="mb-3">
                        <label for="user-title-input" class="form-label">Email</label>
                        <input type="text" id="email" name="email" class="form-control user-email" placeholder="Enter Email" required>
                        <div class="invalid-feedback"> Please Enter Email.</div>
                    </div>
                    <div class="mb-3">
                        <label for="user-role" class="form-label">Assign Role</label>
                        <select class="form-select select2 user-roles" name="user-role[]" id="user-role" data-placeholder="Please Select Role" multiple required>
                            @foreach ($roles as $r)
                            <option value="{{$r->id}}">{{$r->name}}</option>
                            @endforeach

                        </select>
                        <div class="invalid-feedback"> Please select Role.</div>
                    </div>
                    <div class="mb-3">
                        <label for="user-permission" class="form-label">Give Direct Permission</label>
                        <select class="form-select select2 user-permissions" name="user-permission[]" id="user-permission" data-placeholder="Please Select Permission" multiple>
                            @foreach ($permissions as $p)
                            <option value="{{$p->id}}">{{$p->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="hstack gap-2 justify-content-end">
                        <button type="button" class="btn btn-ghost-info" data-bs-dismiss="modal"><i class="ri-close-fill align-bottom"></i> Close</button>
                        <button type="submit" class="btn btn-info" id="add-btn">Add User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
