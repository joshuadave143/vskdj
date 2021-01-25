@extends('plugins.dashboardplugs')

@section('content')			
			<!-- BEGIN PAGE HEADER-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN PAGE TITLE & BREADCRUMB-->
            <h3 class="page-title">
                Voters <small>Data</small>
            </h3>
            <ul class="page-breadcrumb breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="/admin">Home</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <a href="#">Voters</a>
                </li>
            </ul>
            <!-- END PAGE TITLE & BREADCRUMB-->
        </div>
    </div>
			<!-- END PAGE HEADER-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-edit"></i>Voters Table
                    </div>
                </div>
                <voterstable></voterstable>

            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>

    
			

@endsection
