<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="description" content="DAnsS MultiPro">
        <meta name="keyword" content="DAnsS MultiPro">
        <meta name="author"  content="Andryanto"/>
        
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Auth Account | DAnS MultiPro</title>

        <!-- Global stylesheets -->
        <!-- <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css"> -->

        <link href="{{ url('assets/css/icons/icomoon/styles.min.css') }}" rel="stylesheet" type="text/css">

        <link href="{{ url('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ url('assets/css/bootstrap_limitless.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ url('assets/css/layout.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ url('assets/css/components.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ url('assets/css/colors.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ url('assets/css/icons/fontawesome/styles.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ url('assets/css/custom.css') }}" rel="stylesheet" type="text/css">
        <!-- /global stylesheets -->

        <!-- Core JS files -->
        <script src="{{ url('assets/js/jquery.min.js') }}"></script>
        <script src="{{ url('assets/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ url('assets/js/plugins/loaders/blockui.min.js') }}"></script>
        <!-- /core JS files -->

        <!-- Theme JS files -->
        <script src="{{ url('assets/js/plugins/forms/styling/uniform.min.js') }}"></script>
        <script src="{{ url('assets/js/app.js') }}"></script>
        <script src="{{ url('assets/js/pages/login.js') }}"></script>
        <!-- /theme JS files -->

        <style type="text/css">
            .page-content {
            /* The image used */
            background-image: url({{ env("APP_URL") }}assets/images/widget_background_colors.png);
            overflow:hidden !important;
            /* Full height */
            height: 100%; 
            /* Center and scale the image nicely */
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            }
         </style>
    
        @stack('css')

        @stack('stylesheet')

        <script>
            var baseUrl = '{!! url('/') !!}';
        </script>
    </head>
    <body>
        <!-- Page content -->
        <div class="page-content">
            <!-- Main content -->
            <div class="content-wrapper">
                <div class="d-flex content justify-content-center align-items-center" style="padding-top:0; !important">
                    @yield('content')
                </div>
            </div>
            <!-- /main content -->
        </div>
        <!-- /page content -->
    </body>
</html>