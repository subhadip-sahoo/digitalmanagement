@extends('app')
@section('content')
<script>
	$( window ).load(function() {
	  $( "table.report_table" ).wrap( "<div class='wrapper_table'></div>" );
	  $("table.report_table").on("draw.dt", function(){
		$( "table.report_table" ).wrap( "<div class='wrapper_table'></div>" );
	  });
	});
</script>
<!-- maincont Section -->
    <section id="maincont">
        <div class="container" ng-app="reportApp" ng-controller="reportController">
            
			<h2 class="genheading">Reports</h2>
			<div class="searchreport">
				<label for="name">Filter by date: </label>
                <div class="input_part">
					<input id="dates1" name="dates1" ng-model="dates1" ng-change="reportsFilter()">
					<input type="hidden" id="startDate" name="startDate" ng-model="startDate">
					<input type="hidden" id="endDate" name="endDate" ng-model="endDate">
                </div>
				
				<label for="name">Type: </label>
                <div class="input_part">
					<select ng-model="visitor_type" class="form-control" ng-change="reportsFilter()" ng-init="visitor_type='0'">
						<option value="0">Select</option>
						<option ng-repeat="visitortype in visitortypes" value="<% visitortype.id %>"><% visitortype.name %></option>
					</select>
                </div>
				
				<label for="name">Host: </label>
                <div class="input_part">
					<select ng-model="visitor_host" class="form-control" ng-change="reportsFilter()" ng-init="visitor_host='0'">
						<option value="0">Select</option>
						<option ng-repeat="visitorhost in visitorhosts" value="<% visitorhost.id %>"><% visitorhost.name %></option>
					</select>
                </div>
				
				<label for="name">Location: </label>
                <div class="input_part">
					<select ng-model="visitor_location" class="form-control" ng-change="reportsFilter()" ng-init="visitor_location='0'">
						<option value="0">Select</option>
						<option ng-repeat="location in locations" value="<% location.id %>"><% location.name %></option>
					</select>
                </div>
			</div>
			<?php /*?><div class="serarhform row">
				
				<form class="" action="#">    
					
					<div class="searchcatinput">
						<input type="text" placeholder="Search by Name" value="" ng-model="searchText">
						<span class="resetsearch"><i class="fa"><img src="{{ url('/') }}/public/images/cross.png" alt="" height="14" width="14" ng-click="searchText = undefined"></i></span>
					</div>
					
				</form>
				
				
			</div>
						
			<ul class="recepsearchresult">
				<li ng-repeat="visitor in visitors | orderBy:'-created_at' | filter:searchText" >
					<div class="row">
						<div class="col-sm-6">
							<span ng-if="visitor.avatar.length != 0">
								<img ng-if="visitor.avatar == 1 ? imgurl = visitor.card_no : imgurl = 'blank_face'" src="{{ url('/') }}/public/uploads/avatar/<% imgurl %>.jpg" class="visitorlerightpan" alt="<% visitor.first_name %> <% visitor.last_name %>" title="<% visitor.first_name %> <% visitor.last_name %>" height="74" width="74">
							</span>
							<span ng-if="visitor.avatar.length == 0">
								<img src="{{ url('/') }}/public/images/profile_pic.jpg" alt="" title="" width="74" height="74">
							</span>
							<span class="receptname"><% visitor.first_name %> <% visitor.last_name %></span>
							<span class="receptdate">( <% visitor.created_at %> )</span>
						</div>
					</div>
				</li>
			</ul>
			<?php */?>
			
			<div class="table-responsive-block">
				<table datatable="" dt-options="tbOptions" class="row-border hover report_table">
					<thead>
					<tr>
						<th>Card No.</th>
						<th>Name</th>
						<th>Signature</th>
						<th>Email</th>
						<th>Type</th>
						<th>Company Name</th>
						<th>Host Name</th>
						<th>Location</th>
						<th>Arival Date</th>
						<th>Arival Time</th>
						<th>Departure Time</th>
						<th>Status</th>
					</tr>
					</thead>
					<?php /*?>
					<tbody>
					<tr ng-repeat="visitor in visitors | orderBy:'-arival_date'">
						<td><% visitor.card_no %></td>
						<td><% visitor.first_name %></td>
						<td><% visitor.last_name %></td>
						<td><% visitor.email %></td>
						<td><% visitor.visitor_type %></td>
						<td><% visitor.company_name %></td>
						<td><% visitor.hostname %></td>
						<td><% visitor.location_name %></td>
						<td><% visitor.arival_date %></td>
						<td><% visitor.arival_time %></td>
						<td><% visitor.departure_time %></td>
					</tr>
					</tbody>
					<?php */?>
				</table>
			</div>
        </div>
    </section>


@endsection
