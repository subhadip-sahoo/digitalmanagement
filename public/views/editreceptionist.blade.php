@extends('app')

@section('content')
<!-- maincont Section -->
    <section id="maincont">
        <div class="container">
            
			<h2 class="genheading">Edit Receptionist</h2>
			<div class="panel panel-default">
				<div class="panel-body">	
					<form action="{{ action('CommonController@handleEditReceptionist') }}" method="post" role="form" enctype="multipart/form-data" >
						<input type="hidden" name="id" value="{{ $receptionist->id }}">
						<div class="form-group">
							<label for="first_name">First Name</label>
							<input type="text" class="form-control" name="first_name" value="{{ $receptionist->first_name }}" />
							@if ($errors->has('first_name')) <p class="error-block">{{ $errors->first('first_name') }}</p> @endif
						</div>
						<div class="form-group">
							<label for="last_name">Last Name</label>
							<input type="text" class="form-control" name="last_name" value="{{ $receptionist->last_name }}" />
							@if ($errors->has('last_name')) <p class="error-block">{{ $errors->first('last_name') }}</p> @endif
						</div>
						<div class="form-group">
							<label for="email">Email</label>
							<input type="text" class="form-control" name="email" value="{{ $receptionist->email }}" />
							@if ($errors->has('email')) <p class="error-block">{{ $errors->first('email') }}</p> @endif
						</div>
						<div class="form-group">
							<label for="location">Location</label>
							<select name="location" class="form-control">
								<option value="">Select</option>
								@foreach($locations as $location)
								<option value="{{ $location->id }}" @if ($receptionist->location_id == $location->id) selected @endif >{{ $location->name }}</option>
								@endforeach
							</select>
							@if ($errors->has('location')) <p class="error-block">{{ $errors->first('location') }}</p> @endif
						</div>
						<div class="form-group">
							@if($receptionist->avatar != null)
								<img src="{{ url('/') }}/public/uploads/avatar/{{ $receptionist->avatar }}?{{ uniqid(md5(mt_rand()), true) }}" alt="{{ $receptionist->first_name }} {{ $receptionist->last_name }}" title="{{ $receptionist->first_name }} {{ $receptionist->last_name }}" class="avatar_img">
								<br>
							@endif
							<label for="avatar">Upload Photo</label>
							<input type="file" name="avatar"/>
							@if ($errors->has('avatar')) <p class="error-block">{{ $errors->first('avatar') }}</p> @endif
						</div>
						<input type="hidden" name="_token" value="{!! csrf_token() !!}">
						<input type="submit" value="Save" class="btn btn-primary" />
						<a href="{{ action('CommonController@receptionists') }}" class="btn btn-link">Cancel</a>
					</form>
				</div> 
			</div>    
        </div>
    </section>
@endsection
