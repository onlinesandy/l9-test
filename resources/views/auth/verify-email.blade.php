<x-guest-layout>

    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6 col-xl-5">
            <div class="card mt-4">

                <div class="card-body p-4">
                    <div class="text-center mt-2">
                        <h5 class="text-primary">Verify Email</h5>
                        <lord-icon src="https://cdn.lordicon.com/rhvddzym.json" trigger="loop" colors="primary:#0ab39c"
                            class="avatar-xl"></lord-icon>
                    </div>

                    <div class="alert alert-borderless alert-warning text-center mb-2 mx-2" role="alert">
                        Thanks for signing up! Before getting started, could you verify your email address by clicking
                        on the link we just emailed to you? If you didn't receive the email, we will gladly send you
                        another.
                    </div>
                    <div class="p-2">

                        <form method="POST" action="{{ route('verification.send') }}">
                            @csrf

                            <div>
                                <x-primary-button class="btn btn-success w-100">
                                    {{ __('Resend Verification Email') }}
                                </x-primary-button>
                            </div>
                        </form>

                        <hr />
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-primary-button class="btn btn-success w-100 mt-10 ">
                                {{ __('Logout') }}
                            </x-primary-button>
                        </form>


                    </div>
                </div>
                <!-- end card body -->
            </div>


        </div>
    </div>

</x-guest-layout>
