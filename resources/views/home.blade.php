@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title">Dashboard</h3>
					</div>

					<div class="panel-body">
						<div class="btn-group btn-group-lg btn-group-justified" role="group" aria-label="...">
							<a href="{{ url('/admin/categories') }}" class="btn btn-default">
								<b>Categories</b>
							</a>
							<a href="{{ url('/admin/items') }}" class="btn btn-default">
								<b>Items</b>
							</a>
							<a href="#" class="btn btn-default">
								<b>About us</b>
							</a>
							<a href="#" class="btn btn-default">
								<b>Contact us</b>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
