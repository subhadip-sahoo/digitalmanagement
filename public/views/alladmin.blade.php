@extends('app')
@section('content')

<!-- maincont Section -->
    <section id="maincont">
        <div class="container" ng-app="alladminApp" ng-controller="alladminController">
            
			<h2 class="genheading">Create Admin</h2>
			
			<div class="alert alert-success" ng-show="showSuccessAlert">
				<button type="button" class="close" data-ng-click="switchBool('showSuccessAlert')">x</button> 
				<strong>Done! </strong><% successTextAlert %>
			</div>
			<div class="serarhform row">
			
				<div class="addreceptionist" >
					<a href="javascript:void(0);" ng-click="addForm();isFormOpen = true;"><i class="fa fa-user"></i> Add Admin</a>
				</div>
				<form class="" action="#">    
					<div class="searchcatdrop">
						<label for="name">Search All Admin</label>
					</div>
					<div class="searchcatinput">
						<input type="text" placeholder="Search by Admin Name" value="" ng-model="searchText">
						<span class="resetsearch"><i class="fa"><img src="{{ url('/') }}/public/images/cross.png" alt="" height="14" width="14" ng-click="searchText = undefined"></i></span>
					</div>
					
				</form>
			</div>
			<div class="serarhform row" ng-show="isFormOpen" >
				<div class="panel-body"> 
					<form ng-submit="saveForm(alladminData);" method="post" role="form" enctype="multipart/form-data">
						<div class="form-group">
							<label for="first_name">First Name</label>
							<input type="text" class="form-control" name="first_name" ng-model="alladminData.first_name" placeholder="First Name" />
							<p class="error-block"><% errorAlert.first_name.toString() %></p>
						</div>
						<div class="form-group">
							<label for="last_name">Last Name</label>
							<input type="text" class="form-control" name="last_name" ng-model="alladminData.last_name" placeholder="Last Name" />
							<p class="error-block"><% errorAlert.last_name.toString() %></p>
						</div>
						<div class="form-group">
							<label for="email">Email</label>
							<input type="text" class="form-control" name="email" ng-model="alladminData.email" placeholder="Email" />
							<p class="error-block"><% errorAlert.email.toString() %></p>
						</div>
						<div class="form-group"> 
							<label for="password">Password</label>
							<input type="password" class="form-control" name="password" ng-model="alladminData.password" placeholder="Password" >
						</div>

						<div class="form-group">
							<label for="password_confirmation">Confirm Password</label>
							<input type="password" class="form-control" name="password_confirmation" ng-model="alladminData.password_confirmation" placeholder="Confirm Password" >
							<p class="error-block"><% errorAlert.password.toString() %></p>
						</div>
						
						<input type="hidden" name="_token" value="{!! csrf_token() !!}">
						<input type="submit" value="<% buttonText %>" class="btn btn-primary"/>
						<a href="javascript:void(0);" ng-click="switchBool('isFormOpen')" class="btn btn-link">Cancel</a>
					</form>

				</div>	
			</div>
			<ul class="recepsearchresult">
				<li dir-paginate="admin in alladmin  | filter:searchText | itemsPerPage: 10" >
					<div class="row">
						<div class="col-sm-6">
							<img src="{{ url('/') }}/public/images/profile_pic.jpg" alt="" title="" width="74" height="74">
							<span class="receptname"><% admin.first_name %> <% admin.last_name %></span>
							<span class="receptdate">( <% admin.created_at %> )</span>
						</div>
						<div class="col-sm-6 align-right">
							<a href="javascript:void(0);" ng-click="$parent.isFormOpen = true; editAdmin(admin.id);" class="btn btn-info"><i class="glyphicon glyphicon-edit icon-white"></i>Edit</a>
							<a href="javascript:void(0);" ng-click="deleteAdmin(admin.id)" class="btn btn-danger" ng-if="admin.id!=3"><i class="glyphicon glyphicon-trash icon-white"></i>Delete</a>
						</div>
					</div>
				</li>
			</ul>
			<div class="paginate_area">
				<dir-pagination-controls></dir-pagination-controls>
			</div>
        </div>
    </section>

@endsection
