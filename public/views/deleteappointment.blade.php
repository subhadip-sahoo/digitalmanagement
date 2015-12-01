@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading"><h2>Major Share <small>Visitors Management System </small></h2></div>
				<div class="panel-body">
					<div class="page-header">
					<h4>Delete {{ $visitor->first_name }} {{ $visitor->last_name }} <br><small>Do you really want to delete Visitor?</small></h4>
					</div>
					<form action="{{ action('VisitorsController@handleDelete') }}" method="post" role="form">
						<input type="hidden" name="_token" value="{!! csrf_token() !!}">
						<input type="hidden" name="visitor" value="{{ $visitor->id }}" />
						<input type="submit" class="btn btn-danger" value="Yes" />
						<a href="{{ action('VisitorsController@index') }}" class="btn btn-default">No</a>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
