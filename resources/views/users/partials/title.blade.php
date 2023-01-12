<div class="alert alert-info border-0 rounded-0 m-0 d-flex align-items-center" role="alert">
    <div class="flex-grow-1 text-truncate">
        <h5 class="card-title mb-0 flex-grow-1">{{$breadcrumb}} </h5>
    </div>
    <div class="flex-shrink-0">
        <a href="{{route('user-export')}}" class="btn btn-soft-info btn-icon border-info btn-sm float-left me-2 " title="Export">
            <i class="ri-file-excel-line"></i>
        </a>
        <button class="btn btn-soft-info border-info btn-sm add-btn" data-bs-toggle="modal"
            data-bs-target="#showModal">
            <i class="ri-menu-add-line align-bottom me-1"></i> Add {{$title}}
        </button>
    </div>
</div>
