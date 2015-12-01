@extends('app')
@section('content')
<!-- maincont Section -->
    <section id="maincont">
        <div class="container" ng-app="visitorApp" ng-controller="allvisitorController">
            
			<h2 class="genheading">Visitors</h2>
			
			<div class="alert alert-success" ng-show="showSuccessAlert">
				<button type="button" class="close" data-ng-click="switchBool('showSuccessAlert')">x</button> 
				<strong>Done! </strong><% successTextAlert %>
			</div>
            <div class="col-sm-12">
				<div class="serarhform row">
			
				<div class="addreceptionist" >
					<a href="{{ url('/') }}/create-appointment"><i class="fa fa-user"></i> Make Appointment</a>
				</div>
				<form class="" action="#">    
					<div class="searchcatdrop">
						<label for="name">Search All Visitors</label>
					</div>
					<div class="searchcatinput">
						<input type="text" placeholder="Search by Visitor Name" value="" ng-model="searchText">
						<span class="resetsearch"><i class="fa"><img src="{{ url('/') }}/public/images/cross.png" alt="" height="14" width="14" ng-click="searchText = undefined"></i></span>
					</div>
					
				</form>
			</div>
            </div>
			
			<ul class="recepsearchresult">
				<li dir-paginate="visitor in visitors | orderBy:'-created_at'  | filter:searchText | itemsPerPage: 10" >
                	<div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-6">
                                <span ng-if="visitor.avatar.length != 0">
                                    <img ng-if="visitor.avatar == 1 ? imgurl = visitor.card_no : imgurl = 'blank_face'" src="{{ url('/') }}/public/uploads/avatar/<% imgurl %>.jpg" class="visitorlerightpan" alt="<% visitor.first_name %> <% visitor.last_name %>" title="<% visitor.first_name %> <% visitor.last_name %>" height="74" width="74">
                                </span>
                                <span ng-if="visitor.avatar.length == 0">
                                    <img src="{{ url('/') }}/public/images/profile_pic.jpg" alt="" title="" width="74" height="74">
                                </span>
                                <span class="receptname"><% visitor.first_name %> <% visitor.last_name %></span>
								<span class="receptdet">Visiting</span>
                                <span class="receptdate"><% visitor.hostname %></span>
                            </div>
                            <div class="col-sm-6 align-right">
                                <a href="javascript:void(0);" ng-click="loadAppointment(visitor.id)" class="btn btn-info"><i class="glyphicon glyphicon-edit icon-white"></i>Edit</a>
                                <a href="javascript:void(0);" ng-click="deleteVisitor(visitor.id)" class="btn btn-danger"><i class="glyphicon glyphicon-trash icon-white"></i>Delete</a>
                            </div>
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
