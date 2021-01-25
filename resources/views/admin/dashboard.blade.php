<?php
	use voting_system\Http\Controllers\DashboardController; 
	use voting_system\Http\Controllers\adminController; 

	$dash = new DashboardController();
	$admin = new adminController();
?>

@extends('plugins.dashboardplugs')

@section('content')			
			<!-- BEGIN PAGE HEADER-->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
					Dashboard <small>statistics and more</small>
					</h3>
					<ul class="page-breadcrumb breadcrumb">
						<li>
							<i class="fa fa-home"></i>
							<a href="index.html">Home</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="#">Dashboard</a>
						</li>
					</ul>
					<!-- END PAGE TITLE & BREADCRUMB-->
				</div>
			</div>
			<!-- END PAGE HEADER-->
			<stat></stat>
			<div class="row">
				<div class="col-xs-12">
				<h3>Votes Tally
				</h3>
				</div>
			</div>
			<div class='row'> 
				@php 
					$inc = 2;
				@endphp
				@foreach($data as $position)
					@php 
						$inc = ($inc == 2) ? 1 : $inc+1;
					@endphp
					<div class='col-sm-6'>
						<div class='box box-solid'>
							<div class='box-header with-border'>
								<h4 class='box-title'><b>{{ $position['description'] }}</b></h4>
							</div>
							<div class='box-body'>
								<div class='chart'>
									<canvas id='{{ $dash->slugify($position['description'])}}' style='height:200px'></canvas>
								
								</div>
							</div>
						</div>
					</div>
					
				@endforeach
				
				
			</div>
@endsection
