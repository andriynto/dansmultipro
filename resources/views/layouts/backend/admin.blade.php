<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        
        <meta name="author"  content="Andryanto"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>@yield('title') | DAnsS MultiPro</title>

        <!-- Global stylesheets -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">

        <link href="{{ url('assets/css/icons/icomoon/styles.min.css') }}" rel="stylesheet" type="text/css">

        <link href="{{ url('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ url('assets/css/bootstrap_limitless.min.css') }}" rel="stylesheet" type="text/css">
        {{-- <link href="{{ url('assets/css/all.css') }}" rel="stylesheet" type="text/css"> --}}
        <link href="{{ url('assets/css/layout.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ url('assets/css/components.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ url('assets/css/colors.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ url('assets/css/icons/fontawesome/styles.min.css') }}" rel="stylesheet" type="text/css">
        <!-- /global stylesheets -->

        <!-- Core JS files -->
        <script src="{{ url('assets/js/jquery.min.js') }}"></script>
        <script src="{{ url('assets/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ url('assets/js/plugins/notifications/sweet_alert.min.js') }}"></script>
        <!-- /core JS files -->

        <!-- Theme JS files -->

        <script>
            var baseUrl = '{!! url('/') !!}';
        </script>
        @stack('js')
        <script src="{{ url('assets/js/plugins/forms/styling/uniform.min.js') }}"></script>
        <script src="{{ url('assets/js/plugins/forms/selects/select2.min.js') }}"></script>

        
        <script src="{{ url('assets/js/app.js') }}"></script>
        <script src="{{ url('assets/js/form.js') }}"></script>
        <script src="{{ url('assets/js/notification.js') }}"></script>
        <script src="{{ url('assets/js/plugins/loaders/blockui.min.js') }}"></script>
        <script src="{{ url('assets/js/plugins/notifications/jgrowl.min.js') }}"></script>
        <script src="{{ url('assets/js/plugins/notifications/noty.min.js') }}"></script>
        <script src="{{ url('assets/js/plugins/notifications/pnotify.min.js') }}"></script>
        <script src="{{ url('assets/js/plugins/loaders/spinbox.js') }}"></script>
        <script src="{{ url('assets/js/spin.js') }}"></script>
        <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
        <script src="{{ url('assets/js/notifications/Webnotification.js') }}"></script>
        <!-- /theme JS files -->

        <style type="text/css">
            .layout-boxed-bg {
                /* The image used */
                background-image: url({{ env("APP_URL") }}assets/images/widget_background_colors.png);
                /* overflow:scroll !important; */
                /* Full height */
                height: 100%; 
                /* Center and scale the image nicely */
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
            }

            .swal2-container.swal2-backdrop-show, .swal2-container.swal2-noanimation {
                background-color: rgba(0,0,0,.35);
            }

            .has-error .select2-selection {
                border-color : #f44336 !important;
            }
         </style>

        <style>@keyframes nodeInserted{from{outline-color:#fff}to{outline-color:#000}}@-moz-keyframes nodeInserted{from{outline-color:#fff}to{outline-color:#000}}@-webkit-keyframes nodeInserted{from{outline-color:#fff}to{outline-color:#000}}@-ms-keyframes nodeInserted{from{outline-color:#fff}to{outline-color:#000}}@-o-keyframes nodeInserted{from{outline-color:#fff}to{outline-color:#000}}.ace-save-state{animation-duration:10ms;-o-animation-duration:10ms;-ms-animation-duration:10ms;-moz-animation-duration:10ms;-webkit-animation-duration:10ms;animation-delay:0s;-o-animation-delay:0s;-ms-animation-delay:0s;-moz-animation-delay:0s;-webkit-animation-delay:0s;animation-name:nodeInserted;-o-animation-name:nodeInserted;-ms-animation-name:nodeInserted;-moz-animation-name:nodeInserted;-webkit-animation-name:nodeInserted}</style>

        <link href="{{ url('assets/css/spin.css') }}" rel="stylesheet">
    
        @stack('css')

        @stack('stylesheet')

        <script>
            let token = document.head.querySelector('meta[name="csrf-token"]');

            if (token) {
                $(document).ready(function ($) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                });
            } else {
                console.error('CSRF token not found.');
            }

            var swalInit = swal.mixin({
                buttonsStyling: false,
                customClass: {
                    confirmButton: 'btn btn-primary',
                    cancelButton: 'btn btn-danger',
                    denyButton: 'btn btn-light',
                    input: 'form-control'
                }
            });

            // Override Noty defaults
            Noty.overrideDefaults({
                theme: 'limitless',
                layout: 'topRight',
                type: 'alert',
                timeout: 1500
            });

            $('body').on('xhr.dt', function (e, settings, data, xhr) {
                if (typeof phpdebugbar != "undefined") {
                    phpdebugbar.ajaxHandler.handle(xhr);
                }
            });
        </script>
        @stack('broadcast')
    </head>
    {{-- <body class="layout-boxed-bg sidebar-xs"> --}}
    <body class="layout-boxed-bg mt-2">
        <div style="display: none; height: 100%; width: 100%;" id="spinner-preview"></div>
        <!-- Boxed layout wrapper -->
        <div class="d-flex flex-column flex-1 layout-boxed">
            @include('partials.backend.admin.header')

            <!-- Page content -->
            <div class="page-content">
                @include('partials.backend.admin.sidebar')

                @yield('content')
            </div>
            <!-- Page content -->
        </div>
        <!-- /boxed layout wrapper -->

        @stack('scripts')
    </body>
</html>