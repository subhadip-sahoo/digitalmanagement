@extends('app')

@section('content')
<!-- maincont Section -->
    <section id="maincont">
        <div class="container">
            
			<h2 class="genheading">Delete Receptionist</h2>
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="page-header">
					<h4>Delete {{ $receptionist->first_name }} {{ $receptionist->last_name }} <br><small>Do you really want to delete Receptionist?</small></h4>
					</div>
					<form action="{{ action('CommonController@handleDeleteReceptionist') }}" method="post" role="form">
						<input type="hidden" name="_token" value="{!! csrf_token() !!}">
						<input type="hidden" name="receptionist" value="{{ $receptionist->id }}" />
						<input type="submit" class="btn btn-danger" value="Yes" />
						<a href="{{ action('CommonController@receptionists') }}" class="btn btn-default">No</a>
					</form>
				</div> 
            </div>    
        </div>
    </section>
@endsection
