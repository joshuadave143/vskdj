<!DOCTYPE html>

<html lang="{{ app()->getLocale() }}">
    <head>
        @yield('head')
    </head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="page-header-fixed">
<div id="app">
<!-- BEGIN HEADER -->
<div class="header navbar navbar-inverse navbar-fixed-top">
	<!-- BEGIN TOP NAVIGATION BAR -->
	<div class="header-inner">
		<!-- BEGIN LOGO -->
		<a class="navbar-brand" href="/admin/dashboard">
			<div class="col-md-12">
            	VOTING SYSTEM
			</div>
		</a>
		<!-- END LOGO -->
		<!-- BEGIN RESPONSIVE MENU TOGGLER -->
		
		<a href="javascript:;" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
			<img src="{{ asset('assets/img/menu-toggler.png')}}" alt=""/>
		</a>
		<!-- END RESPONSIVE MENU TOGGLER -->
		<!-- BEGIN TOP NAVIGATION MENU -->
		<ul class="nav navbar-nav pull-right">
			<li class="devider">
				 &nbsp;
			</li>
			<!-- BEGIN USER LOGIN DROPDOWN -->
			<li class="dropdown user">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
				
					<span class="username">
					{{{ isset(Auth::user()->name) ? Auth::user()->name : Auth::user()->email }}}
					</span>
					<i class="fa fa-angle-down"></i>
				</a>
				<ul class="dropdown-menu">
					<li>
						<!-- <a href="login.html"><i class="fa fa-key"></i> Log Out</a> -->
						<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
							<i class="fa fa-key"></i>
							Logout
						</a>

						<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
							{{ csrf_field() }}
						</form>
					</li>
				</ul>
			</li>
			<!-- END USER LOGIN DROPDOWN -->
		</ul>
		<!-- END TOP NAVIGATION MENU -->
	</div>
	<!-- END TOP NAVIGATION BAR -->
</div>
<!-- END HEADER -->
<div class="clearfix">
</div>

<!-- BEGIN CONTAINER -->
<div class="page-container">

	<!-- BEGIN SIDEBAR -->
	<div class="page-sidebar-wrapper">
		<div class="page-sidebar-wrapper">
			<div class="page-sidebar navbar-collapse collapse">
				<!-- BEGIN SIDEBAR MENU -->
				<ul class="page-sidebar-menu">
					<li class="sidebar-toggler-wrapper">
						<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
						<div class="sidebar-toggler">
						</div>
						<div class="clearfix">
						</div>
						<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
					</li>
					<li class="start @if( Request::is('admin/dashboard') ) active @endif">
						<a href="/admin/dashboard">
						<i class="fa fa-home"></i>
						<span class="title">
							Dashboard
						</span>
						<span class="selected">
						</span>
						</a>
					</li>
					<li class=" @if( Request::is('admin/votes') ) active @endif">
						<a href="/admin/votes">
							<i class="fa fa-sitemap"></i>
							<span class="title">
								Votes
							</span>
						</a>
					</li>
					<li class=" @if( Request::is('admin/voters') ) active @endif">
						<a href="/admin/voters">
							<i class="fa fa-group"></i>
							<span class="title">
								Voters
							</span>
						</a>
					</li>
					<li class=" @if( Request::is('admin/positions') ) active @endif">
						<a href="/admin/positions">
						<i class="fa fa-tasks"></i>
						<span class="title">
							Positions
						</span>
						</a>
					</li>
					<li class=" @if( Request::is('admin/candidates') ) active @endif">
						<a href="/admin/candidates">
							<i class="fa fa-male"></i>
							<span class="title">
								Candidates
							</span>
							
						</a>
					</li>
					<li class=" @if( Request::is('admin/ballot_position') ) active @endif">
						<a href="/admin/ballot_position">
							<i class="fa fa-file-text"></i>
							<span class="title">
								Ballot Pisition
							</span>
							
						</a>
					</li>
					<li class=" @if( Request::is('admin/tally') ) active @endif">
						<a href="/admin/tally">
							<i class="fa fa-archive"></i>
							<span class="title">
								Election Tally Results
							</span>
							
						</a>
					</li>
					<li class="last ">
						<a href="#ElectionTittle"  data-toggle="modal">
							<i class="fa fa-cogs"></i>
							<span class="title">
								Election Tittle
							</span>
						</a>
					</li>
				</ul>
				<!-- END SIDEBAR MENU -->
			</div>
		</div>
	</div>
	<!-- END SIDEBAR -->
	<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content-wrapper">
			<div class="page-content">
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