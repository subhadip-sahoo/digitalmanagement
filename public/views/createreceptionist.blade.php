@extends('app')

@section('content')
<!-- maincont Section -->
    <section id="maincont">
        <div class="container">
            
			<h2 class="genheading">Add Receptionist</h2>
			<div class="panel panel-default">
				<div class="panel-body">
					<form action="{{ action('CommonController@handleCreateReceptionist') }}" method="post" role="form" enctype="multipart/form-data" >
						<div class="form-group">
							<label for="first_name">First Name</label>
							<input type="text" class="form-control" name="first_name" value="{{ old('first_name') }}"/>
							@if ($errors->has('first_name')) <p class="error-block">{{ $errors->first('first_name') }}</p> @endif
						</div>
						<div class="form-group">
							<label for="last_name">Last Name</label><br />
							<input type="text" class="form-control" name="last_name" value="{{ old('last_name') }}"/>
							@if ($errors->has('last_name')) <p class="error-block">{{ $errors->first('last_name') }}</p> @endif
						</div>
						<div class="form-group">
							<label for="email">Email</label><br />
							<input type="text" class="form-control" name="email" value="{{ old('email') }}"/>
							@if ($errors->has('email')) <p class="error-block">{{ $errors->first('email') }}</p> @endif
						</div>
						<div class="form-group">
							<label for="location">Location</label>
							<select name="location" class="form-control">
								<option value="">Select</option>
								@foreach($locations as $location)
								<option value="{{ $location->id }}" @if (old('location') == $location->id) selected @endif >{{ $location->name }}</option>
								@endforeach
							</select>
							@if ($errors->has('location')) <p class="error-block">{{ $errors->first('location') }}</p> @endif
						</div>
						
						<div class="form-group">
							<label for="password">Password</label>
							<input type="password" class="form-control" name="password">
							@if ($errors->has('password')) <p class="error-block">{{ $errors->first('password') }}</p> @endif
						</div>

						<div class="form-group">
							<label for="password_confirmation">Confirm Password</label>
							<input type="password" class="form-control" name="password_confirmation">
							@if ($errors->has('password_confirmation')) <p class="error-block">{{ $errors->first('password_confirmation') }}</p> @endif
						</div>
						
						<div class="form-group">
							<label for="avatar">Upload Photo</label>
							<input type="file" name="avatar"/>
							@if ($errors->has('avatar')) <p class="error-block">{{ $errors->first('avatar') }}</p> @endif
						</div>
						
						<input type="hidden" name="_token" value="{!! csrf_token() !!}">
						<input type="submit" value="Add" class="btn btn-primary" />
						<a href="{{ action('CommonController@receptionists') }}" class="btn btn-link">Cancel</a>
					</form>
				</div> 
            </div>    
        </div>
    </section>

@endsection
