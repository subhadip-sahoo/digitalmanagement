@extends('app')
@section('content')
<!-- maincont Section -->
<section id="maincont">
	<div class="container">
		<h2 class="genheading">Admin</h2>
		<div class="serarhform row">
			<div class="panel-body admin_mane">
				<ul class="nav navbar-nav">
					<li><a href="{{ url('/') }}/visitortypes">Create Visitor Type</a></li>
					<li><a href="{{ url('/') }}/edit-siteinfo">Site info</a></li>
					<li><a href="{{ url('/') }}/all-admin">All Admin</a></li>
				</ul>
			</div>
		</div>
	</div>
</section>
@endsection
	