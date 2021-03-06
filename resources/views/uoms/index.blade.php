@extends('layouts.admin')
@section('title', 'Setup UOM')
@section('breadcrumbs')
	{!! Breadcrumbs::render('Uom') !!}
@stop
@section('top-menu')
	<li><a href="{!! route('admin.uoms.create') !!}" class="btn btn-primary">
		<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
		Add UOM</a>
	</li>
	<li><a href="{!! route('admin.products.index') !!}">Procuct</a></li>
	<li><a href="{!! route('admin.productCategories.index') !!}">Procuct Categories</a></li>
	<li class="active"><a href="{!! route('admin.uoms.index') !!}">UOM</a></li>
@stop
@section('content')
		<div class="row">
			@if($uoms->isEmpty())
				<div class="well text-center">No UOM found.</div>
			@else
				<table class="table table-hover">
					<thead>
					<th>Name</th>
					<th width="50px">Action</th>
					</thead>
					<tbody>
					<tr>
						{!! Form::open(['route' => 'admin.uoms.index', 'method' => 'get', 'class' => "form-inline", 'id' => "search_form"]) !!}
							<td>
								{!! Form::text('name', null, ['class' => 'form-control', 'placeholder'=>'Search by UOM']) !!}
							</td>
							<td>
								<button onclick="return $('#search_form').submit()" class="btn btn-primary">
									<i class="glyphicon glyphicon-search"></i>
								</button>
							</td>

						{!! Form::close() !!}
					</tr>
					@foreach($uoms as $uom)
						<tr>
							<td>{!! $uom->name !!}</td>
							<td>
								<a href="{!! route('admin.uoms.edit', [$uom->id]) !!}"><i class="glyphicon glyphicon-edit"></i></a>
								<!--<a href="{!! route('admin.uoms.delete', [$uom->id]) !!}" onclick="return confirm('Are you sure wants to delete this Uom?')"><i class="glyphicon glyphicon-remove"></i></a>-->
							</td>
						</tr>
					@endforeach
					</tbody>
				</table>
			@endif
		</div>
		{!! $uoms->render() !!}
@endsection