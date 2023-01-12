@props(['title','breadcrumb'])
<div class="col-12">
    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
        <h4 class="mb-sm-0">{{$title}}</h4>

        <div class="page-title-right col-md-4">
            <button type="button" class="btn btn-soft-info btn-icon border-info btn-sm float-left me-2 " title="Print"><i class="ri-printer-line"></i></button>

            <a href="{{$help}}" class="btn btn-soft-info border-info btn-sm float-left me-2" title="Help">
                <i class="ri-information-line align-bottom me-1"></i> Help
            </a>

            <nav aria-label="breadcrumb float-right">
                <ol class="breadcrumb p-3 py-1 bg-light mb-0">
                    <li class="breadcrumb-item">{{$title}}</li>
                    <li class="breadcrumb-item active" aria-current="page">{{$breadcrumb}}</li>
                </ol>
            </nav>
        </div>

    </div>
</div>

