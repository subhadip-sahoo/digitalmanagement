@extends('app')
@section('content')
<!-- maincont Section -->
    <section id="maincont">
        <div class="container" ng-app="settingsApp" ng-controller="settingsController">
            
			<h2 class="genheading">Settings</h2>
			
			<div class="alert alert-success" ng-show="showSuccessAlert">
				<button type="button" class="close" data-ng-click="switchBool('showSuccessAlert')">x</button> 
				<% successTextAlert %>
			</div>
			
			<div class="serarhform row">
				<div class="panel-body">
					<form ng-submit="updateUser(userdata)" method="post" role="form" >
						<div class="form-group">
							<label for="name">First Name</label>
							<input type="text" class="form-control" ng-model="userdata.first_name" placeholder="First Name"  />
							<p class="error-block"><% errorAlert.first_name.toString() %></p>
						</div>
						<div class="form-group">
							<label for="name">Last Name</label>
							<input type="text" class="form-control" ng-model="userdata.last_name" placeholder="Last Name"  />
							<p class="error-block"><% errorAlert.last_name.toString() %></p>
						</div>
						<div class="form-group">
							<label for="name">Email</label>
							<input type="text" class="form-control" ng-model="userdata.email" placeholder="Email"  />
							<p class="error-block"><% errorAlert.email.toString() %></p>
						</div>
						<div class="form-group">
							<label for="name">Password</label>
							<input type="password" name="password" class="form-control" ng-model="userdata.password" placeholder="Password" />
						</div>
						<div class="form-group">
							<label for="name">Confirm Password</label>
							<input type="password" class="form-control" ng-model="userdata.confirm_password" placeholder="Confirm Password"/>
							<p class="error-block"><% errorAlert.password.toString() %></p>
						</div>
						
						<div class="form-group">
							<label for="name">Phone No</label>
							<input type="text" class="form-control" ng-model="userdata.phone" placeholder="Phone No"  />
							<p class="error-block"><% errorAlert.phone.toString() %></p>
						</div>
						<input type="hidden" name="_token" value="{!! csrf_token() !!}">
						<input type="submit" value="Update" class="btn btn-primary" />
					</form>
				</div>	
			</div>
			
        </div>
    </section>

@endsection
