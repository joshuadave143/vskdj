<!DOCTYPE html>

<html lang="{{ app()->getLocale() }}">
    <head>
        @yield('head')
    </head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body>
<div id="app">

<div class="clearfix">
</div>

<!-- BEGIN CONTAINER -->
    <div class="page-container">

    <!-- BEGIN CONTENT -->
        <div class="page-content-wrapper">
            <div class="page-content-wrapper">
                <div class="page-content" style="margin-left: 0px;">
                    
                        @yield('content')
                    <!-- </div> -->
                </div>
            </div>
        </div>
    <!-- END CONTENT -->
        <electiontitle></electiontitle>
    </div>
<!-- END CONTAINER -->

<!-- BEGIN FOOTER -->
    <div class="footer">
        <div class="footer-inner">
            2019 &copy; Develop by Joshua Dave F. Tonido.
        </div>
        <div class="footer-tools">
            <span class="go-top">
                <i class="fa fa-angle-up"></i>
            </span>
        </div>

    </div>

</div> <!-- END of #APP -->
<!-- END FOOTER -->
@yield('footer')
<!-- END JAVASCRIPTS -->
</html>