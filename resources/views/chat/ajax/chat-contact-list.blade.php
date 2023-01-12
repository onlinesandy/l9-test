@php
    $nameStarts = '';
@endphp
@foreach ($users as $u)
    @if ($nameStarts != $u->getNameFirstLetter($u->name))
        <div class="mt-3">
            <div class="contact-list-title">{{ $u->getNameFirstLetter($u->name) }} </div>
            <ul id="contact-sort-S" class="list-unstyled contact-list">
    @endif

    <li>
        <div class="d-flex align-items-center">
            <div class="flex-shrink-0 me-2">
                <div class="avatar-xxs"> <span class="avatar-title rounded-circle bg-primary fs-10">{{ $u->getNameFirstLetter($u->name) }}</span></div>
            </div>
            <div class="flex-grow-1">
                <p class="text-truncate contactlist-name mb-0">{{ $u->name }}</p>
            </div>
            <div class="flex-shrink-0">
                <div class="dropdown">
                    <a href="#" class="text-muted" data-bs-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <i class="ri-more-2-fill"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="#">
                            <i class="ri-pencil-line text-muted me-2 align-bottom"></i>
                            Edit
                        </a>
                        <a class="dropdown-item" href="#">
                            <i class="ri-forbid-2-line text-muted me-2 align-bottom"></i>
                            Block
                        </a>
                        <a class="dropdown-item" href="#">
                            <i class="ri-delete-bin-6-line text-muted me-2 align-bottom"></i>
                            Remove
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </li>

    @if ($nameStarts != $u->getNameFirstLetter($u->name))
        </ul>
        </div>
    @endif
    @php
        $nameStarts = $u->getNameFirstLetter($u->name);
    @endphp
@endforeach
