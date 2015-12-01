@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading"><h2><small>Visitor Type Management </small></h2></div>
				<div class="panel-body">
					<div class="page-header">
					<h4>Delete {{ $visitortype->name }} <br><small>Do you really want to delete visitor type?</small></h4>
					</div>
					<form action="{{ action('CommonController@handleDeleteVisitortype') }}" method="post" role="form">
						<input type="hidden" name="_token" value="{!! csrf_token() !!}">
						<input type="hidden" name="visitortype" value="{{ $visitortype->id }}" />
						<input type="submit" class="btn btn-danger" value="Yes" />
						<a href="{{ action('CommonController@visitortypes') }}" class="btn btn-default">No</a>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
