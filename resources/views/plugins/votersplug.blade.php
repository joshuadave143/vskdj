@extends('layouts.voters')



    @section('head')
        <meta charset="utf-8"/>
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Voting System</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
        <meta content="" name="description"/>
        <meta content="" name="author"/>
        <meta name="MobileOptimized" content="320">
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="{{asset('assets/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('assets/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('assets/plugins/uniform/css/uniform.default.css')}}" rel="stylesheet" type="text/css"/>
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
        <link href="{{asset('css/style.css')}}" rel="stylesheet" type="text/css"/> 
        <!-- END PAGE LEVEL PLUGIN STYLES -->
        <!-- BEGIN THEME STYLES -->
        <link href="{{asset('assets/css/style-conquer.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('assets/css/style.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('assets/css/style-responsive.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('assets/css/plugins.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('assets/css/pages/tasks.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('assets/css/themes/default.css')}}" rel="stylesheet" type="text/css" id="style_color"/>
        <link href="{{asset('assets/css/custom.css')}}" rel="stylesheet" type="text/css"/>
        <!-- END THEME STYLES -->
        <link rel="shortcut icon" href="favicon.html"/>
    @endsection



    @section('footer')
    <!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
    <!-- BEGIN CORE PLUGINS -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{asset('assets/plugins/jquery-1.10.2.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/plugins/jquery-migrate-1.2.1.min.js')}}" type="text/javascript"></script>
    <!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
    <script src="{{asset('assets/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/plugins/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/plugins/bootstrap-hover-dropdown/twitter-bootstrap-hover-dropdown.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/plugins/jquery.blockui.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/plugins/jquery.cokie.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/plugins/uniform/jquery.uniform.min.js')}}" type="text/javascript"></script>
    <!-- END CORE PLUGINS -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="{{asset('js/jquery.ba-bbq.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/icheck.js')}}" type="text/javascript"></script>
   
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    
    <script src="{{ asset('assets/scripts/apps.js')}} " type="text/javascript"></script>

    <!-- END PAGE LEVEL SCRIPTS -->
    
    <script>

        jQuery(document).ready(function() {    
            App.init(); // initlayout and core plugins
        });
    </script>

    @endsection
