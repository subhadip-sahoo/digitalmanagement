@extends('app')
@section('content')
<!-- maincont Section -->
    <section id="maincont" ng-app="welcomeApp" ng-controller="welcomeController">
        <div class="container">
            <div class="row">
                <h2 class="genheading"><% page_heading %></h2>
				
				<div class="col-sm-3" ng-repeat="user in users">
					<div class="whiteblock" ng-if="u_type == 'v'">
						<a href="#" ng-click="loadAppointment(user.id)">
						<img ng-if="user.avatar == 1 ? imgurl = user.card_no : imgurl = 'blank_face'" src="{{ url('/') }}/public/uploads/avatar/<% imgurl %>.jpg" class="visitorlerightpan" alt="" height="74" width="74">
						<span class="vname"><% user.first_name %> <% user.last_name %></span>
						<span class="vadd"><% user.location %></span></a>
					</div>
					<div class="whiteblock" ng-if="u_type == 'r'">
						<img ng-if="user.avatar != '' ? imgurl = user.avatar : imgurl = 'blank_face.jpg'" src="{{ url('/') }}/public/uploads/avatar/<% imgurl %>" class="visitorlerightpan" alt="" height="74" width="74">
						<span class="vname"><% user.first_name %> <% user.last_name %></span>
						<span class="vadd"><% user.location %></span>
					</div>
				</div>
				
                
            </div>
        </div>
    </section>
@endsection
	