@extends('plugins.dashboardplugs')

@section('content')			
			<!-- BEGIN PAGE HEADER-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN PAGE TITLE & BREADCRUMB-->
            <h3 class="page-title">
            Ballot <small>Positions</small>
            </h3>
            <ul class="page-breadcrumb breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="/admin">Home</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <a href="#">Ballot Positions</a>
                </li>
            </ul>
            <!-- END PAGE TITLE & BREADCRUMB-->
        </div>
    </div>
			<!-- END PAGE HEADER-->
    <div class="row">
        
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        
        <ballotposition></ballotposition>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>

    
			

@endsection
