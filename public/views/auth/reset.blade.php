@extends('app')

@section('content')
<!-- maincont Section -->
    <section id="maincont">
        <div class="container">
			
			<form class="form-horizontal" id="loginform" role="form" method="POST" action="{{ url('/') }}/password/reset">
				
				<div class="adminlogo">
					@if (count($site) > 0)
						<a href="{{ url('/') }}"><img src="{{ url('/') }}/public/uploads/site/{{ $site->logo }}?{{ uniqid(md5(mt_rand()), true) }}" alt="{{ $site->title }}" title="{{ $site->title }}" ></a>
					@else
						<a href="{{ url('/') }}"><img src="{{ url('/') }}/public/images/adminlogo.png" alt="" title="" width="112" height="62"></a>
					@endif
				</div>
				@if (count($errors) > 0)
					<div class="alert alert-danger">
						<strong>Whoops!</strong> There were some problems with your input.<br><br>
						<ul>
							@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
				@endif
				
				<div class="panel-heading paneltitle">Reset Password</div>
				
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<input type="hidden" name="token" value="{{ $token }}">

				<div class="input-group" style="margin-bottom: 12px">
					<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                    <input type="email" placeholder="email" name="email" value="{{ old('email') }}" required class="form-control" id="login-username">
				</div>

				<div class="input-group" style="margin-bottom: 12px">
					<span class="input-group-addon"><i class="fa fa-key"></i></span>
                    <input type="password" placeholder="password" name="password" required class="form-control" id="login-password">
				</div>

				<div class="input-group" style="margin-bottom: 12px">
					<span class="input-group-addon"><i class="fa fa-key"></i></span>
                    <input type="password" placeholder="password" name="password_confirmation" required class="form-control" id="login-repassword">
				</div>

				<div class="form-group">
					<div class="col-sm-12 controls">
						<button type="submit" class="btn btn-primary">
							Reset Password
						</button>
					</div>
				</div>
			</form>
		</div>
	</section>
@endsection
