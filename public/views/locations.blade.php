@extends('app')
@section('content')
<!-- maincont Section -->
    <section id="maincont">
        <div class="container" ng-app="locationApp" ng-controller="locationController">
            
			<h2 class="genheading">Create Location</h2>
			
			<div class="alert alert-success" ng-show="showSuccessAlert">
				<button type="button" class="close" data-ng-click="switchBool('showSuccessAlert')">x</button> 
				<strong>Done! </strong><% successTextAlert %>
			</div>
			<div class="serarhform row">
			
				<div class="addreceptionist" >
					<a href="javascript:void(0);" ng-click="addForm();isFormOpen = true;"><i class="fa fa-user"></i> Add Location</a>
				</div>
				<form class="" action="#">    
					<div class="searchcatdrop">
						<?php /*?><select>
							<option>Search All Receptionists </option>
							<option ng-repeat="location in locations" value="<% location.name %>" ><% location.name %></option>
						</select><?php */?>
						<label for="name">Search All Locations</label>
					</div>
					<div class="searchcatinput" mass-autocomplete>
						
						<input type="text" placeholder="Search by Location Name" value="" ng-model="searchText" mass-autocomplete-item="autocomplete_options">
						
						<span class="resetsearch"><i class="fa"><img src="{{ url('/') }}/public/images/cross.png" alt="" height="14" width="14" ng-click="clearSearch();searchText = undefined;"></i></span>
					</div>
					
				</form>
			</div>
			<div class="serarhform row" ng-show="isFormOpen" >
				<div class="panel-body">
					<form ng-submit="saveForm(locationData)" method="post" role="form" >
						<div class="form-group">
							<label for="name">Name</label>
							<input type="text" class="form-control" name="name" ng-model="locationData.name" placeholder="Name" required />
						</div>
						<input type="hidden" name="_token" value="{!! csrf_token() !!}">
						<input type="submit" value="<% buttonText %>" class="btn btn-primary" />
						<a href="javascript:void(0);" ng-click="switchBool('isFormOpen')" class="btn btn-link">Cancel</a>
					</form>
				</div>	
			</div>
			<ul class="recepsearchresult">
				<li dir-paginate="location in locations  | filter:searchText | itemsPerPage: 10" >
					<div class="row">
						<div class="col-sm-6">
							<span class="receptname"><% location.name %></span>
						</div>
						<div class="col-sm-6 align-right">
							<a href="javascript:void(0);" ng-click="$parent.isFormOpen = true; editLocation(location.id);" class="btn btn-info"><i class="glyphicon glyphicon-edit icon-white"></i>Edit</a>
							<a href="javascript:void(0);" ng-click="deleteLocation(location.id)" class="btn btn-danger"><i class="glyphicon glyphicon-trash icon-white"></i>Delete</a>
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
