<!DOCTYPE html>

<html lang="{{ app()->getLocale() }}">
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <head>
        <meta charset="utf-8"/>
        <title>Admin Login</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL STYLES -->
        <link rel="stylesheet" type="text/css" href="assets/plugins/select2/select2_conquer.css"/>
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME STYLES -->
        <link href="assets/css/style-conquer.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/style.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/style-responsive.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/plugins.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
        <link href="assets/css/pages/login.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/custom.css" rel="stylesheet" type="text/css"/>
        <!-- END THEME STYLES -->
        <!-- <link rel="shortcut icon" href="favicon.html"/> -->
    </head>
    <body class="login">
        <div id="app">
            <div class="logo">
            
            </div>
            @yield('content')
        </div>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>