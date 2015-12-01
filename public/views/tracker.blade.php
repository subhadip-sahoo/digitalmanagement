<!doctype html>
<html>
    <head>
        <title>Time Tracker</title>
        <link href="{{ url('/') }}/public/css/style.css" rel="stylesheet">
		<link href="{{ url('/') }}/public/bower_components/bootstrap/dist/css/bootstrap.css" rel="stylesheet">
    </head>
    <body ng-app="timeTracker" ng-controller="TimeEntry as vm">
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle Navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="{{ url('/') }}">Major Share</a>
				</div>

				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<li><a href="{{ url('/') }}/">Home</a></li>
						<li><a href="{{ url('/') }}/tracker">Time Tracker</a></li>
					</ul>

					<ul class="nav navbar-nav navbar-right">
						@if (Auth::guest())
							<li><a href="{{ url('/') }}/auth/login">Login</a></li>
							<li><a href="{{ url('/') }}/auth/register">Register</a></li>
						@else
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
								<ul class="dropdown-menu" role="menu">
									<li><a href="{{ url('/') }}/auth/logout">Logout</a></li>
								</ul>
							</li>
						@endif
					</ul>
				</div>
			</div>
		</nav>

		<div class="container">
			<nav class="navbar navbar-default">
				<div class="container-fluid">
					<div class="navbar-header">
						<a class="navbar-brand" href="#">Time Tracker</a>
					</div>
				</div>
				<div class="container-fluid time-entry">
					<div class="timepicker">
						<span class="timepicker-title label label-primary">Clock In</span><timepicker ng-model="vm.clockIn" hour-step="1" minute-step="1" show-meridian="true"></timepicker> 
					</div>
					<div class="timepicker">
						<span class="timepicker-title label label-primary">Clock Out</span><timepicker ng-model="vm.clockOut" hour-step="1" minute-step="1" show-meridian="true"></timepicker>
					</div>
					<div class="time-entry-comment">                
						<form class="navbar-form">
							<input class="form-control" ng-model="vm.comment" placeholder="Enter a comment"></input>
							<button class="btn btn-primary" ng-click="vm.logNewTime()">Log Time</button>
						</form>
					</div>    
				</div>
			</nav>

			<div class="container">
				<div class="col-sm-8">

					<div class="well vm" ng-repeat="time in vm.timeentries">
						<div class="row">
							<div class="col-sm-8">
								<h4><i class="glyphicon glyphicon-user"></i> {{time.user_firstname}} {{time.user_lastname}}</h4>
								<p><i class="glyphicon glyphicon-pencil"></i> {{time.comment}}</p>                  
							</div>
							<div class="col-sm-4 time-numbers">
								<h4><i class="glyphicon glyphicon-calendar"></i> {{time.end_time | date:'mediumDate'}}</h4>
								<h2><span class="label label-primary" ng-show="time.loggedTime.duration._data.hours > 0">{{time.loggedTime.duration._data.hours}} hour<span ng-show="time.loggedTime.duration._data.hours > 1">s</span></span></h2>
								<h4><span class="label label-default">{{time.loggedTime.duration._data.minutes}} minutes</span></h4>
							</div>
						</div>
					</div>

				</div>

				<div class="col-sm-4">
					<div class="well time-numbers">
						<h1><i class="glyphicon glyphicon-time"></i> Total Time</h1>
						<h1><span class="label label-primary">{{vm.totalTime.hours}} hours</span></h1>
						<h3><span class="label label-default">{{vm.totalTime.minutes}} minutes</span></h3>
					</div>
				</div>
			</div>  
		</div>
		
	</body>
	<!-- Application Dependencies -->
	<script type="text/javascript" src="{{ url('/') }}/public/bower_components/angular/angular.js"></script>
	<script type="text/javascript" src="{{ url('/') }}/public/bower_components/angular-bootstrap/ui-bootstrap-tpls.js"></script>
	<script type="text/javascript" src="{{ url('/') }}/public/bower_components/angular-resource/angular-resource.js"></script>
	<script type="text/javascript" src="{{ url('/') }}/public/bower_components/moment/moment.js"></script>

	<!-- Application Scripts -->
	<script type="text/javascript" src="{{ url('/') }}/public/scripts/app.js"></script>
	<script type="text/javascript" src="{{ url('/') }}/public/scripts/controllers/TimeEntry.js"></script>
	<script type="text/javascript" src="{{ url('/') }}/public/scripts/services/time.js"></script>
</html>
