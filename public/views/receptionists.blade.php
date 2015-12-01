@extends('app')
@section('content')
<!-- for Uploader -->
<script src="{{ url('/') }}/public/js/angular-file-upload-shim.js"></script>
<script src="{{ url('/') }}/public/js/angular-file-upload.js"></script>
<script src="{{ url('/') }}/public/js/codemirror.min.js"></script>
<!-- maincont Section -->
    <section id="maincont">
        <div class="container" ng-app="receptionistApp" ng-controller="receptionistController">
            
			<h2 class="genheading">Manage Receptionist</h2>
			
			<div class="alert alert-success" ng-show="showSuccessAlert">
				<button type="button" class="close" data-ng-click="switchBool('showSuccessAlert')">x</button> 
				<strong>Done! </strong><% successTextAlert %>
			</div>
			<div class="serarhform row">
			
				<div class="addreceptionist" >
					<a href="javascript:void(0);" ng-click="addForm();isFormOpen = true; showFlag = true;"><i class="fa fa-user"></i> Add Receptionist</a>
				</div>
				<form class="" action="#">    
					<div class="searchcatdrop">
						<label for="name">Search All Receptionists</label>
					</div>
					<div class="searchcatinput">
						<input type="text" placeholder="Search by Receptionist Name" value="" ng-model="searchText">
						<span class="resetsearch"><i class="fa"><img src="{{ url('/') }}/public/images/cross.png" alt="" height="14" width="14" ng-click="searchText = undefined"></i></span>
					</div>
					
				</form>
			</div>
			<div class="serarhform row" ng-show="isFormOpen" >
				<div class="panel-body"> 
					<form ng-submit="saveForm(receptionistData);" method="post" role="form" enctype="multipart/form-data">
						<div class="form-group">
							<label for="first_name">First Name</label>
							<input type="text" class="form-control" name="first_name" ng-model="receptionistData.first_name" placeholder="First Name" required />
						</div>
						<div class="form-group">
							<label for="last_name">Last Name</label>
							<input type="text" class="form-control" name="last_name" ng-model="receptionistData.last_name" placeholder="Last Name" required />
						</div>
						<div class="form-group">
							<label for="email">Email</label>
							<input type="text" class="form-control" name="email" ng-model="receptionistData.email" placeholder="Email" required />
						</div>
						<div class="form-group">
							<label for="location">Location</label>
							<select name="location" class="form-control" ng-model="receptionistData.location_id">
								<option value="">Select</option>
								<option ng-repeat="location in receptionists.locations" value="<% location.id %>" ><% location.name %></option>
							</select>
						</div>
						
						<div class="form-group" ng-if="showFlag"> 
							<label for="password">Password</label>
							<input type="password" class="form-control" name="password" ng-model="receptionistData.password" placeholder="Password" required>
						</div>

						<div class="form-group" ng-if="showFlag">
							<label for="password_confirmation">Confirm Password</label>
							<input type="password" class="form-control" name="password_confirmation" ng-model="receptionistData.password_confirmation" placeholder="Confirm Password" required>
						</div>
						
						
					
						<div class="form-group">
							<label for="avatar">Upload Photo</label>
							<span class="img_container">
								<img alt="" src="{{ url('/') }}/public/uploads/avatar/<% receptionistData.avatar %>?<% random_no %>" width="100" height="100" ng-if="receptionistData.avatar">
							</span>
							<table>					 
					 
								<tr>
									<td align="center" ng-model="receptionistData.attachFile"> 
										<div ng-file-select ng-model="files" class="btn btn-gry btn-sm" ng-file-change="upload(files)" multiple="false" accept="image/*" tabindex="0"><i class="glyphicon glyphicon-paperclip"></i>&nbsp;<strong>Attach File</strong></div>
									</td>
								</tr>
							
							</table>
							<?php /*?><input type="file" file-model="myavatar" />
							<file ng-model="myavatar" accept="image/png,image/jpg,image/jpeg" /><?php */?>
						</div>
						
						
						<input type="hidden" name="_token" value="{!! csrf_token() !!}">
						<input type="submit" value="<% buttonText %>" class="btn btn-primary"/>
						<a href="javascript:void(0);" ng-click="switchBool('isFormOpen')" class="btn btn-link">Cancel</a>
					</form>

				</div>	
			</div>
			<ul class="recepsearchresult">
				<li dir-paginate="receptionist in receptionists.allreceptionists  | filter:searchText | itemsPerPage: 10" >
					<div class="row">
						<div class="col-sm-6">
							<span ng-if="receptionist.avatar.length != 0">
								<img src="{{ url('/') }}/public/uploads/avatar/<% receptionist.avatar %>?<% random_no %>" alt="<% receptionist.first_name %> <% receptionist.last_name %>" title="<% receptionist.first_name %> <% receptionist.last_name %>" width="74" height="74">
							</span>
							<span ng-if="receptionist.avatar.length == 0">
								<img src="{{ url('/') }}/public/images/profile_pic.jpg" alt="" title="" width="74" height="74">
							</span>
							<span class="receptname"><% receptionist.first_name %> <% receptionist.last_name %></span>
							<?php /*?><span class="receptdate">( <% receptionist.created_at %> )</span><?php */?>
							<span class="receptdate" ng-if="receptionist.location_id">Location:&nbsp;</span><span class="receptdet" ng-if="receptionist.location_id"><% receptionist.location %></span>
						</div>
						<div class="col-sm-6 align-right">
							<a href="javascript:void(0);" ng-click="$parent.isFormOpen = true; $parent.showFlag = false; editReceptionist(receptionist.id);" class="btn btn-info"><i class="glyphicon glyphicon-edit icon-white"></i>Edit</a>
							<a href="javascript:void(0);" ng-click="deleteReceptionist(receptionist.id)" class="btn btn-danger"><i class="glyphicon glyphicon-trash icon-white"></i>Delete</a>
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
