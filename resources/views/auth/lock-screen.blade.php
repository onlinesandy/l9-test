<x-guest-layout>
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6 col-xl-5">
            <div class="card mt-4">

                <div class="card-body p-4">
                    <div class="text-center mt-2">
                        <h5 class="text-primary">Lock Screen</h5>
                        <p class="text-muted">Enter your password to unlock the screen!</p>
                    </div>
                    <div class="user-thumb text-center">
                        <img src="{{ Vite::asset('resources/assets/images/user.jpg')}}" class="rounded-circle img-thumbnail avatar-lg" alt="thumbnail">
                        <h5 class="font-size-15 mt-3">{{auth()->user()->name}}</h5>
                    </div>
                    <div class="p-2 mt-4">
                        <x-auth-session-status class="mb-4" :status="session('status')" />
                        <form method="POST" action="{{ route('lock-screen') }}">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label" for="userpassword">Password</label>
                                <input type="password" name="password" class="form-control" id="userpassword" placeholder="Enter password" required="">
                            </div>
                            <div class="mb-2 mt-4">
                                <button class="btn btn-success w-100" type="submit">Unlock</button>
                            </div>
                        </form><!-- end form -->

                    </div>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->

            <div class="mt-4 text-center">
                <p class="mb-0">Not you ? return <a href="{{ route('login') }}" class="fw-semibold text-primary text-decoration-underline"> Signin </a> </p>
            </div>

        </div>
    </div>
</x-guest-layout>
