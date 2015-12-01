<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Visitors Management</title>
	<link rel="shortcut icon" href="{{ url('/') }}/public/images/favicon.ico" type="image/x-icon">
	<link rel="icon" href="{{ url('/') }}/public/images/favicon.ico" type="image/x-icon">
    <!-- Bootstrap Core CSS -->
    <link href="{{ url('/') }}/public/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ url('/') }}/public/css/agency.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{ url('/') }}/public/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,300,300italic,400italic,600,600italic,700,700italic' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="{{ url('/') }}/public/css/daterangepicker.css">
    <!--[if lt IE 9]>
        <script src="{{ url('/') }}/public/js/html5shiv-3-7-0.js"></script>
        <script src="{{ url('/') }}/public/css/respond-1-4-2.min.js"></script>
    <![endif]-->
	<link rel="stylesheet" type="text/css" href="{{ url('/') }}/public/css/signature-pad.css">
	<link rel="stylesheet" type="text/css" href="{{ url('/') }}/public/css/jquery.dataTables.min.css">
	<!-- JS -->
	<script src="{{ url('/') }}/public/js/jquery_2.1.3.min.js"></script>
	<script src="{{ url('/') }}/public/js/jquery.dataTables.min.js"></script>
	<?php /*?><script src="{{ url('/') }}/public/bower_components/angular/angular.min.js"></script> <!-- load angular --><?php */?>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.5/angular.min.js"></script>
	<script src="{{ url('/') }}/public/js/angular-datatables.min.js"></script>
	
	<script src="{{ url('/') }}/public/js/bootstrap.js"></script>
	<script src="{{ url('/') }}/public/bower_components/moment/moment.js"></script>
	<?php /*?><script src="{{ url('/') }}/public/js/daterangepicker.js"></script>
	<script src="{{ url('/') }}/public/js/ng-bs-daterangepicker.js"></script><?php */?>
	
	<!-- Include Date Range Picker -->
	<script type="text/javascript" src="{{ url('/') }}/public/js/daterangepicker.js"></script>
	<link rel="stylesheet" type="text/css" href="{{ url('/') }}/public/css/daterangepicker.css" />
	
	<!-- ANGULAR -->
	<!-- all angular resources will be loaded from the /public folder -->
	<script src="{{ url('/') }}/public/scripts/controllers/mainCtrl.js"></script> <!-- load our controller -->
	<script src="{{ url('/') }}/public/scripts/services/allService.js"></script> <!-- load our service -->
	<script src="{{ url('/') }}/public/scripts/app.js"></script> <!-- load our application -->
	
	<script src="{{ url('/') }}/public/js/webcam.js"></script>
	<script src="{{ url('/') }}/public/js/dirPagination.js"></script>	

	<link href="{{ url('/') }}/public/css/massautocomplete.theme.css" rel="stylesheet" type="text/css">
	<script src="{{ url('/') }}/public/js/angular-sanitize.js"></script>
    <script src="{{ url('/') }}/public/js/massautocomplete.min.js"></script>

	<script src="{{ url('/') }}/public/vendor/js/tinymce/tinymce.min.js"></script>
</head>
<body id="page-top" class="index">
	@if (Auth::guest())
	
		@yield('content')
		
	@else
		
		<!-- Navigation -->
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="container">
				<div class="navbar-header page-scroll">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<div class="logo_container">
						@if (count($site) > 0)
							<a class="navbar-brand page-scroll" href="{{ url('/') }}"><img src="{{ url('/') }}/public/uploads/site/{{ $site->logo }}?{{ uniqid(md5(mt_rand()), true) }}" alt="{{ $site->title }}" title="{{ $site->title }}" class="header_logo"></a>
						@else
							<a class="navbar-brand page-scroll" href="{{ url('/') }}"><img src="{{ url('/') }}/public/images/logo.png" alt="" title="" class="header_logo"></a>
						@endif
					</div>
					<?php /*?><a class="navbar-brand page-scroll" href="{{ url('/') }}#page-top"><img src="{{ url('/') }}/public/images/logo.png" alt="" title="" height="87" width="130"></a><?php */?>
				</div>

				<!-- the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<div class="toploginbar">
						<span class="username">Welcome {{ Auth::user()->name }} </span>
						<a href="{{ url('/') }}/auth/logout">Logout</a>
					</div>
					<ul class="nav navbar-nav navbar-right">
						<li class="hidden">
							<a href="#page-top"></a>
						</li>
						@if (Auth::user()->role_id == 1)
							<li><a href="{{ url('/') }}/locations">Create Location </a></li>
							<li><a href="{{ url('/') }}/employees"> Manage Employee</a></li>
							<li><a href="{{ url('/') }}/receptionists">Manage Receptionist </a></li>
							<li><a href="{{ url('/') }}/reports">Reports</a></li>
							<li><a href="{{ url('/') }}/settings">Settings</a></li>
							<li><a href="{{ url('/') }}/admin">Admin</a>
								<?php /*?><ul>
									<li><a href="{{ url('/') }}/visitortypes">Create Visitor Type</a></li>
									<li><a href="{{ url('/') }}/edit-siteinfo">Site info</a></li>
								</ul><?php */?>
							</li>
						@else
							<li><a href="{{ url('/') }}/create-appointment">Create Appointment</a></li>
							<li><a href="{{ url('/') }}/visitors">Visitors</a></li>
							<li><a href="{{ url('/') }}/reports">Reports</a></li>
							<li><a href="{{ url('/') }}/settings">Settings</a></li>
						@endif
					</ul>
				</div>
				<!-- /.navbar-collapse -->
			</div>
			<!-- /.container-fluid -->
		</nav>
	
	@yield('content')
	
	<footer>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <span class="copyright">&copy;   {{ date('Y') }}. VisitorManagement . All Rights Reserved.</span>
                </div>
            </div>
        </div>
    </footer>
	
	@endif
	
    <!-- Bootstrap Core JavaScript -->
    <script src="{{ url('/') }}/public/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="{{ url('/') }}/public/js/jquery.easing.min-1-3.js"></script>
    <script src="{{ url('/') }}/public/js/classie.js"></script>
    <script src="{{ url('/') }}/public/js/cbpAnimatedHeader.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="{{ url('/') }}/public/js/agency.js"></script>

	
</body>

</html>
