@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading"><h2>Major Share <small>Visitors Management System </small></h2></div>
				<div class="panel-body">
					<div class="left-panel">
						<div class="page-header">
							<h4>Edit Appointment </h4>
						</div>
						
						<form action="{{ action('VisitorsController@handleEdit') }}" method="post" role="form">
							<input type="hidden" name="id" value="{{ $visitor->id }}">
							<div class="form-group">
								<label for="card_no">Card No</label>
								<input type="text" class="form-control" name="card_no" value="{{ $visitor->card_no }}" />
								@if ($errors->has('card_no')) <p class="error-block">{{ $errors->first('card_no') }}</p> @endif
							</div>
							<div class="form-group">
								<label for="title">Title</label>
								<select name="title" class="form-control">
									<option value="">Select</option>
									<option value="Mr" @if ($visitor->title == 'Mr') selected @endif >Mr</option>
									<option value="Ms" @if ($visitor->title == 'Mrs') selected @endif >Ms</option>
									<option value="Mrs" @if ($visitor->title == 'Mrs') selected @endif>Mrs</option>
								</select>
							</div>
							<div class="form-group">
								<label for="first_name">First Name</label>
								<input type="text" class="form-control" name="first_name" value="{{ $visitor->first_name }}" />
								@if ($errors->has('first_name')) <p class="error-block">{{ $errors->first('first_name') }}</p> @endif
							</div>
							<div class="form-group">
								<label for="last_name">Last Name</label>
								<input type="text" class="form-control" name="last_name" value="{{ $visitor->last_name }}" />
								@if ($errors->has('last_name')) <p class="error-block">{{ $errors->first('last_name') }}</p> @endif
							</div>
							<div class="form-group">
								<label for="email">Email</label>
								<input type="text" class="form-control" name="email" value="{{ $visitor->email }}" />
								@if ($errors->has('email')) <p class="error-block">{{ $errors->first('email') }}</p> @endif
							</div>
							<div class="form-group">
								<label for="company_name">Company Name</label><br />
								<input type="text" class="form-control" name="company_name" value="{{ $visitor->company_name }}" />
							</div>
							<div class="form-group">
								<label for="visitor_type">Visitor Type</label><br />
								<select name="visitor_type" class="form-control">
									<option value="">Select</option>								
									@foreach($visitortypes as $visitortype)
									<option value="{{ $visitortype->id }}" @if ($visitorrole == $visitortype->id) selected @endif >{{ $visitortype->name }}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group">
								<label for="host_name">Host Name</label><br />
								<select name="host_name" class="form-control">
									<option value="">Select</option>								
									@foreach($hostnames as $hostname)
									<option value="{{ $hostname->id }}" @if ($visitor->host_name == $hostname->id) selected @endif >{{ $hostname->name }}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group">
								<label for="location">Location</label><br />
								<input type="text" class="form-control" name="location" value="{{ $location }}" readonly />
								<input type="hidden" name="location_id" value="{{ $location_id }}">
							</div>
							<div class="form-group">
								<label for="arival_date">Arival Date</label><br />
								<input type="text" class="form-control" name="arival_date" value="{{ $visitor->arival_date }}" />
							</div>
							<div class="form-group">
								<label for="arival_time">Arival Time</label><br />
								<input type="text" class="form-control" name="arival_time" value="{{ $visitor->arival_time }}" />
							</div>
							<input type="hidden" name="_token" value="{!! csrf_token() !!}">
							<input type="submit" value="Save" class="btn btn-primary" />
							<a href="{{ action('VisitorsController@index') }}" class="btn btn-link">Cancel</a>
						</form>
					</div>
					<div class="right-panel">
						<div class="page-header">
							<h4>Latest Visitors</h4>
						</div>
						@if ($visitors == null)
							There are no Visitors! :(
						@else
							@foreach($visitors as $visitor)
								<div class="visitors_list">
									<h4><a href="{{ url('/') }}/edit-appointment/{{ $visitor->id }}" >{{ $visitor->title }} {{ $visitor->first_name }} {{ $visitor->last_name }}</a></h4>
									<span>{{ $visitor->name }}</span>
								</div>
							@endforeach
						@endif
						@stop
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
