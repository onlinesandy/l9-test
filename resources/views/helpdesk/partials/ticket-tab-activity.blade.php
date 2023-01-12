<div class="tab-pane fade" id="helpdesk-activities" role="tabpanel">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Activities</h5>
            <div class="acitivity-timeline py-3">
                @foreach ($ticket_activities as $act)
                    <div class="acitivity-item d-flex mb-3">
                        <div class="flex-shrink-0 avatar-xs acitivity-avatar">
                            <div class="avatar-title bg-soft-info text-info rounded-circle">
                                {{ $act->user->getNameAllFirstLetter($act->user->name) }}
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-1">{{ $act->user->name }}
                                <span
                                    class="badge bg-soft-primary text-primary align-middle">{{ $act->activity }}</span>
                            </h6>

                            {!! $act->description !!}

                            <small class="text-muted ms-2">
                                <i class="ri-time-line align-middle"></i>
                                {{ \Carbon::createFromTimeString($act->created_at)->format('d-m-Y g:i A') }}
                            </small>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
