<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-layout="vertical" data-topbar="dark" data-sidebar="light"
    data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable" data-layout-mode="light"
    data-layout-width="fluid" data-layout-position="fixed" data-layout-style="default">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <script src="{{ Vite::asset('resources/assets/js/layout.js') }}"></script>

    <script src="{{ Vite::asset('resources/assets/libs/jquery.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    if (jqXHR.status == 401) {
                        alert("Please Login again");
                    }
                }

            });
        });
    </script>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body>
    <div id="layout-wrapper">

        @include('includes.header.header')
        @include('includes.sidebar.sidebar')

        <div class="main-content">
            <x-toast-success />
            <x-toast-warning />
            <x-toast-danger />

            <div class="page-content">
                <div class="container-fluid">
                    {{ $slot }}
                </div>
            </div>

            @include('includes.canvas.top-canvas')
            @include('includes.canvas.chat-user-profile')
            @include('includes.footer.footer')
            @include('modal.privacy-policy')



        </div>


    </div>
    @include('includes.back-to-top')

    @include('includes.preloader')

    @include('includes.right-sidebar.right-sidebar')


    {{-- <script src="{{ Vite::asset('resources/assets/js/plugins.js') }}"></script> --}}



    {{-- <script src="{{ Vite::asset('resources/assets/js/pages/select2.init.js') }}"></script> --}}


    <script src="{{ Vite::asset('resources/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ Vite::asset('resources/assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ Vite::asset('resources/assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ Vite::asset('resources/assets/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ Vite::asset('resources/assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>

    <script src="{{ Vite::asset('resources/assets/libs/select2/select2.min.js') }}"></script>

    <script src="{{ Vite::asset('resources/assets/libs/list.js/list.min.js') }}"></script>
    <script src="{{ Vite::asset('resources/assets/libs/list.pagination.js/list.pagination.min.js') }}"></script>



    <script src="{{ Vite::asset('resources/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ Vite::asset('resources/assets/libs/choices.js/js/choices.min.js') }}"></script>

    {{-- <script src="{{ Vite::asset('resources/assets/libs/prismjs/prism.js') }}"></script> --}}

    <script src="{{ Vite::asset('resources/assets/js/pages/form-validation.init.js') }}"></script>
    <script src="{{ Vite::asset('resources/assets/libs/flatpickr/flatpickr.min.js') }}"></script>


    <script src="{{ Vite::asset('resources/assets/js/app.js') }}"></script>
    <script src="{{ Vite::asset('resources/js/custom.js') }}"></script>


    <script type="text/javascript">
        function formatState(state) {
            if (state.id == 'add_new') {
                var $state = $(
                    '<span data-bs-toggle="modal" data-bs-target="#' + state.modal + '"> ' + state.text + '</span>'
                );
                return $state;
            } else {
                return state.text;
            }


        };
        $(document).ready(function() {
            let usr = "{{ Vite::asset('resources/assets/images/user.jpg') }}";
            let usr_name = "{{ auth()->user()->name }}";
            let notificationCount = '{{count(auth()->user()->unreadNotifications)}}';
            let checkNotificationModalshown = "{{session()->has('notificationModalshown')}}";
            if(notificationCount > 0 && !checkNotificationModalshown){
                Swal.fire({
                    title: 'Welcome '+usr_name+'',
                    icon: "info",
                    html: 'You have <span class="fw-semibold text-success">'+notificationCount+'</span> Notifications',
                    showCloseButton: !0,
                    showCancelButton: !1,
                    confirmButtonClass: "btn btn-success me-2",
                    cancelButtonClass: "btn btn-danger",
                    buttonsStyling: !1,
                    confirmButtonText:
                        '<i class="ri-thumb-up-fill align-bottom me-1"></i> Got It!',
                    cancelButtonText:
                        '<i class="ri-thumb-down-fill align-bottom"></i>',
                });
                checkNotificationModalshown = "{{ session()->put('notificationModalshown','true') }}";
            }

            let select2 = document.getElementsByClassName("select2");
            if (typeof(select2) != 'undefined' && select2 != null) {
                $('.select2').select2({
                    allowClear: true,
                    // minimumResultsForSearch: -1,
                    placeholder: function() {
                        $(this).data('placeholder');
                    }
                });
            }

            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            })
            let select2_ajax = document.getElementsByClassName("select2_ajax");
            if (typeof(select2_ajax) != 'undefined' && select2_ajax != null) {


                $('.select2_ajax').select2({
                    // templateResult: formatState,
                    allowClear: true,
                    // minimumResultsForSearch: -1,
                    placeholder: function() {
                        $(this).data("placeholder");
                    },
                    ajax: {
                        dataType: "json",
                        delay: 250,
                        type: "GET",
                        data: function(params) {
                            return {
                                search: params.term // search term
                            };
                        },

                        processResults: function(response) {
                            return {
                                results: response,
                            };
                        },
                    },
                });

                $('.select2_ajax').on('select2:select', function(e) {
                    let addnewUrl = e.params.data.url;
                    let addnewModal = e.params.data.modal;
                    if (addnewModal != undefined) {
                        $('#' + addnewModal).modal('show');
                        $(this).val('').trigger('change');
                    } else if (addnewUrl != undefined) {
                        window.location = e.params.data.url;
                    }

                });
            }





            let instance = document.getElementsByClassName("flatpickr-input");
            let btnClear = document.getElementById('flatpickrBtnClear');
            if (typeof(instance) != 'undefined' && instance != null) {
                let calendar = flatpickr(instance, {});
                if (typeof(btnClear) != 'undefined' && btnClear != null) {
                    btnClear.onclick = function() {
                        calendar.clear();
                    }
                }
            }

            // helpdeskinit();

            window.Echo.private('App.Models.User.{{ auth()->user()->id }}')
                .notification((notification) => {
                    let notify_link = 'javascript:void(0)';
                    if (typeof notification.link !== 'undefined') {
                        notify_link = notification.link;
                    }
                    let notify_html = `
                    <div id="${notification.created_at}" class="text-reset notification-item d-block dropdown-item position-relative">
                            <div class="d-flex">
                                <div class="avatar-xs me-3 mt-2">
                                    <span class="avatar-title bg-soft-info text-info rounded-circle fs-16">
                                        <i class="bx bx-badge-check"></i>
                                    </span>
                                </div>
                                <div class="flex-1">
                                    <a href="${notify_link}" class="stretched-link">
                                        <p class="mt-0 mb-2 lh-base">
                                           <b> ${notification.message}</b>
                                        </p>
                                    </a>
                                    <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                        <span><i class="mdi mdi-clock-outline"></i> A few seconds ago </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    `;
                    $(".notifications-inner-block").prepend(notify_html);
                    updateNotificationCount();
                });


        });
    </script>



</body>

</html>
