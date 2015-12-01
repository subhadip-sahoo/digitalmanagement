@extends('app')
@section('content')
<!-- for Uploader -->
<script src="{{ url('/') }}/public/js/angular-file-upload-shim.js"></script>
<script src="{{ url('/') }}/public/js/angular-file-upload.js"></script>
<script src="{{ url('/') }}/public/js/codemirror.min.js"></script>
<!-- maincont Section -->
    <section id="maincont">
        <div class="container" ng-app="employeeApp" ng-controller="employeeController">
            
			<h2 class="genheading">Manage Employee</h2>
			
			<div class="alert alert-success" ng-show="showSuccessAlert">
				<button type="button" class="close" data-ng-click="switchBool('showSuccessAlert')">x</button> 
				<strong>Done! </strong><% successTextAlert %>
			</div>
			<div ng-model="attachFile" class="attachfile">
				<label>Uploads your contacts: </label>
				<input type="hidden" ng-model="uploaded_csv">
				<div ng-file-select ng-model="files" class="btn btn-gry btn-sm" ng-file-change="upload(files)" multiple="false" accept="text/csv" tabindex="0">Choose File</div>
				<div class="fileformathelp">(.csv supported)</div>
				<button type="button" class="button" data-ng-click="importemployee()">Upload</button> 
				<button type="button" class="button" data-ng-click="deleteallemployee()">Delete All Contacts</button>
				<h5>Total Contacts: <% employees.length %></h5>
				<span>(For Sample format file <a href="{{ url('/') }}/public/uploads/sample.csv" download >click here</a> to download)</span>
			</div>
			
			
			<div class="serarhform row">
			
				<div class="addreceptionist" >
					<a href="javascript:void(0);" ng-click="addForm();isFormOpen = true;"><i class="fa fa-user"></i> Add Employee</a>
				</div>
				<form class="" action="#">    
					<div class="searchcatdrop">
						<label for="name">Search All Employees</label>
					</div>
					<div class="searchcatinput" mass-autocomplete>
						<input type="text" placeholder="Search by Employee Name" value="" ng-model="searchText" mass-autocomplete-item="autocomplete_options">
						<span class="resetsearch"><i class="fa"><img src="{{ url('/') }}/public/images/cross.png" alt="" height="14" width="14" ng-click="clearSearch();searchText = undefined"></i></span>
					</div>
					
				</form>
			</div>
			<div class="serarhform row" ng-show="isFormOpen" >
				<div class="panel-body">
					<form ng-submit="saveForm(employeeData)" method="post" role="form" >
						<div class="form-group">
							<label for="first_name">First Name</label>
							<input type="text" class="form-control" name="first_name" ng-model="employeeData.first_name" placeholder="First Name" required />
						</div>
						<div class="form-group">
							<label for="last_name">Last Name</label>
							<input type="text" class="form-control" name="last_name" ng-model="employeeData.last_name" placeholder="Last Name" required />
						</div>
						<div class="form-group">
							<label for="email">Email</label>
							<input type="text" class="form-control" name="email" ng-model="employeeData.email" placeholder="Email" required />
						</div>
						<div class="form-group">
							<label for="position">Title/Position</label><br />
							<input type="text" class="form-control" name="position" ng-model="employeeData.position" placeholder="Title/Position" required />
						</div>
						<div class="form-group">
							<label for="phone">Phone No</label><br />
							<input type="text" class="form-control" name="phone" ng-model="employeeData.phone" placeholder="Phone No" required />
						</div>
						<div class="form-group">
							<label for="department">Department</label><br />
							<input type="text" class="form-control" name="department" ng-model="employeeData.department" placeholder="Department" required />
						</div>
						<div class="form-group">
							<label for="extension_no">Extension No</label><br />
							<input type="text" class="form-control" name="extension_no" ng-model="employeeData.extension_no" placeholder="Extension No" required />
						</div>
						<div class="form-group">
							<label for="vehicle_no">Vehicle No</label><br />
							<input type="text" class="form-control" name="vehicle_no" ng-model="employeeData.vehicle_no" placeholder="Vehicle No" required />
						</div>
						<input type="hidden" name="_token" value="{!! csrf_token() !!}">
						<input type="submit" value="<% buttonText %>" class="btn btn-primary" />
						<a href="javascript:void(0);" ng-click="switchBool('isFormOpen')" class="btn btn-link">Cancel</a>
					</form>
				</div>	
			</div>
			<ul class="recepsearchresult">
				<li dir-paginate="employee in employees  | filter:searchText | itemsPerPage: 10" >
					<div class="row">
						<div class="col-sm-9">
							<span ng-if="employee.avatar !== ''">
								<img src="{{ url('/') }}/public/uploads/avatar/<% employee.avatar %>?{{ uniqid(md5(mt_rand()), true) }}" alt="<% employee.first_name %> <% employee.last_name %>" title="<% employee.first_name %> <% employee.last_name %>" width="74" height="74">
							</span>
							<span ng-if="employee.avatar == ''">
								<img src="{{ url('/') }}/public/images/profile_pic.jpg" alt="" title="" width="74" height="74">
							</span>
							<span class="receptname"><% employee.first_name %> <% employee.last_name %></span>
							<?php /*?><span class="receptdate">( <% employee.created_at %> )</span><?php */?>
							<span class="receptdate" ng-if="employee.department">Department:&nbsp;</span><span class="receptdet" ng-if="employee.department"><% employee.department %></span>
							<span class="receptdate" ng-if="employee.extension_no">Extension No:&nbsp;</span><span class="receptdet" ng-if="employee.extension_no"><% employee.extension_no %></span>
							<span class="receptdate" ng-if="employee.vehicle_no">Vehicle No:&nbsp;</span><span class="receptdet" ng-if="employee.vehicle_no"><% employee.vehicle_no %></span>
						</div>
						<div class="col-sm-3 align-right">
							<a href="javascript:void(0);" ng-click="$parent.isFormOpen = true; editEmployee(employee.id);" class="btn btn-info"><i class="glyphicon glyphicon-edit icon-white"></i>Edit</a>
							<a href="javascript:void(0);" ng-click="deleteEmployee(employee.id)" class="btn btn-danger"><i class="glyphicon glyphicon-trash icon-white"></i>Delete</a>
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
