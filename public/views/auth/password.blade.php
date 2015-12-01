@extends('app')

@section('content')
<!-- maincont Section -->
    <section id="maincont">
        <div class="container">
			
			<form class="form-horizontal" role="form" id="loginform" method="POST" action="{{ url('/') }}/password/email">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				
				<div class="adminlogo">
					@if (count($site) > 0)
						<a href="{{ url('/') }}"><img src="{{ url('/') }}/public/uploads/site/{{ $site->logo }}?{{ uniqid(md5(mt_rand()), true) }}" alt="{{ $site->title }}" title="{{ $site->title }}" ></a>
					@else
						<a href="{{ url('/') }}"><img src="{{ url('/') }}/public/images/adminlogo.png" alt="" title="" width="112" height="62"></a>
					@endif
				</div>
				
				@if (session('status'))
					<div class="alert alert-success">
						{{ session('status') }}
					</div>
				@endif

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
				
				<div class="input-group" style="margin-bottom: 12px">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                    <input type="email" placeholder="email" name="email" value="{{ old('email') }}" required class="form-control" id="login-username">
                </div>
				
				<div class="form-group">
					<div class="col-sm-12 controls">
						<button type="submit" class="btn btn-primary" style="margin-right: 15px;">
							Send Password Reset Link
						</button>
						<a href="{{ url('/') }}/auth/login">Login?</a>
					</div>
				</div>
			</form>
			
		</div>
	</section>
@endsection
