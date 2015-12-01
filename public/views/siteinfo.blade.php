@extends('app')
@section('content')
@include('tinymce::tpl')
<script type="text/javascript">
	tinymce.init({
		selector: "#terms_conditions"
	});
</script>
<!-- maincont Section -->
<section id="maincont">
	<div class="container">
		<h2 class="genheading">Site Info</h2>
		<div class="serarhform row">
			<div class="panel-body">
				<form action="{{ action('CommonController@handleEditSiteinfo') }}" method="post" role="form" enctype="multipart/form-data" >
					<div class="form-group">
						<label for="title">Site Title</label>
						<input type="text" class="form-control" name="title"  @if($site != null) value="{{ $site->title }}" @else value="{{ old('title') }}" @endif />
						@if ($errors->has('title')) <p class="error-block">{{ $errors->first('title') }}</p> @endif
					</div>
					<div class="form-group">
						@if($site != null)
							<img src="{{ url('/') }}/public/uploads/site/{{ $site->logo }}?{{ uniqid(md5(mt_rand()), true) }}" alt="logo" title="logo">
							<br>
						@endif
						<label for="logo">Site Logo</label>
						<input type="file" name="logo"/>
						@if ($errors->has('logo')) <p class="error-block">{{ $errors->first('logo') }}</p> @endif
					</div>
					<div class="form-group">
						<label for="title">Terms & Conditions</label>
						<textarea id="terms_conditions" name="terms_conditions" cols="40" rows="6" class="form-control" title="Please enter Terms & Conditions">
						@if($site != null) {{ $site->terms_conditions }} @else {{ old('terms_conditions') }} @endif
						</textarea>
						@if ($errors->has('terms_conditions')) <p class="error-block">{{ $errors->first('terms_conditions') }}</p> @endif
					</div>
					<input type="hidden" name="_token" value="{!! csrf_token() !!}">
					<input type="submit" value="Update" class="btn btn-primary" />
					<a href="{{ action('CommonController@admincontrol') }}" class="btn btn-link">Cancel</a>
				</form>
			</div>
		</div>
	</div>
</section>
@endsection
	