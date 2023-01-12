<div class="card">
    <div class="card-header align-items-center d-flex">
        <h4 class="card-title mb-0 flex-grow-1">Comments</h4>
    </div>


<div class="card-body p-4">
    <div data-simplebar style="height: 200px;" class="px-3 mx-n3">

        @foreach ($ticket_comments as $c)
        <div class="d-flex mb-4">
            <div class="flex-shrink-0">
                <div class="avatar-xxs">
                    <span class="avatar-title rounded-circle bg-info fs-10">
                        {{ $c->user->getNameAllFirstLetter($c->user->name) }}
                    </span>
                </div>
            </div>
            <div class="flex-grow-1 ms-3">
                <h5 class="fs-13">
                    {{$c->user->name}}
                    <small class="text-muted">{{$c->created_at}}</small>
                </h5>
                <p class="text-muted">
                   {{$c->content}}
                </p>
            </div>
        </div>
        @endforeach


    </div>

    <div class="row g-3 mt-3">
        <form action="{{route('addComment')}}" method="POST" class="mt-3">
            @csrf
            <input type="hidden" name="helpdesk_ticket_id" value="{{$ticket->id}}" />
            <div class="col-lg-12">
                <label for="helpdesk_comment" class="form-label">Leave a Comment</label>
                <textarea class="form-control bg-light border-light" name="helpdesk_comment" id="helpdesk_comment" rows="3"
                    placeholder="Enter comment"></textarea>
            </div>
            <div class="col-lg-12 mt-3 text-end">
                <button type="submit" class="btn btn-info">Add Comment</button>
            </div>
        </form>
    </div>

</div>



</div>
