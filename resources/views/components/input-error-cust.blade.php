@props(['messages'])

@if ($messages)
    @foreach ((array) $messages as $message)
        <div class="alert alert-danger alert-dismissible fade show p-1 mt-1 mb-1" role="alert" style="font-size:.875em;">
            {{ $message }}
        </div>
    @endforeach
@endif
