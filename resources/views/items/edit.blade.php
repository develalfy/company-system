@extends('layouts.app')

@section('title','Edit | Items')

@section('content')

	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title">Items</h3>
					</div>
					<div class="panel-body">
						<p>
							{!! $edit !!}
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>

@stop
