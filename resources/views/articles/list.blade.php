@extends('layouts.app')

@section('title','DataFilter')

@section('content')

	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<a href="#" class="btn btn-success">Add Category</a>
			</div>
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title">Categories</h3>
					</div>
					<div class="panel-body">
						<h1>DataFilter</h1>

						<p>
							{!! $filter !!}
							{!! $grid !!}
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>

@stop
