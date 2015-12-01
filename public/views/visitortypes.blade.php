@extends('app')
@section('content')
<!-- maincont Section -->
    <section id="maincont">
        <div class="container" ng-app="visitortypeApp" ng-controller="visitortypeController">
            
			<h2 class="genheading">Create Visitor Type</h2>
			
			<div class="alert alert-success" ng-show="showSuccessAlert">
				<button type="button" class="close" data-ng-click="switchBool('showSuccessAlert')">x</button> 
				<strong>Done! </strong><% successTextAlert %>
			</div>
			<div class="serarhform row">
			
				<div class="addreceptionist" >
					<a href="javascript:void(0);" ng-click="addForm();isFormOpen = true;"><i class="fa fa-user"></i> Add Visitor Type</a>
				</div>
				<form class="" action="#">    
					<div class="searchcatdrop">
						<label for="name">Search All Visitor Types</label>
					</div>
					<div class="searchcatinput">
						<input type="text" placeholder="Search by Visitor Type Name" value="" ng-model="searchText">
						<span class="resetsearch"><i class="fa"><img src="{{ url('/') }}/public/images/cross.png" alt="" height="14" width="14" ng-click="searchText = undefined"></i></span>
					</div>
					
				</form>
			</div>
			<div class="serarhform row" ng-show="isFormOpen" >
				<div class="panel-body">
					<form ng-submit="saveForm(visitortypeData)" method="post" role="form" >
						<div class="form-group">
							<label for="name">Name</label>
							<input type="text" class="form-control" name="name" ng-model="visitortypeData.name" placeholder="Name" required />
						</div>
						<input type="hidden" name="_token" value="{!! csrf_token() !!}">
						<input type="submit" value="<% buttonText %>" class="btn btn-primary" />
						<a href="javascript:void(0);" ng-click="switchBool('isFormOpen')" class="btn btn-link">Cancel</a>
					</form>
				</div>	
			</div>
			<ul class="recepsearchresult">
				<li dir-paginate="visitortype in visitortypes  | filter:searchText | itemsPerPage: 10" >
					<div class="row">
						<div class="col-sm-6">
							<span class="receptname"><% visitortype.name %></span>
						</div>
						<div class="col-sm-6 align-right">
							<a href="javascript:void(0);" ng-click="$parent.isFormOpen = true; editVisitortype(visitortype.id);" class="btn btn-info"><i class="glyphicon glyphicon-edit icon-white"></i>Edit</a>
							<a href="javascript:void(0);" ng-click="deleteVisitortype(visitortype.id)" class="btn btn-danger"><i class="glyphicon glyphicon-trash icon-white"></i>Delete</a>
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
