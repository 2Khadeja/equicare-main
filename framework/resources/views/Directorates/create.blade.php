@extends('layouts.admin')
@section('body-title')
	@lang('equicare.Directorates')
@endsection
@section('title')
	| @lang('equicare.Directorates')
@endsection
@section('breadcrumb')
	<li><a href="{{ route('Directorates.index') }}">@lang('equicare.Directorates')</a></li>
	<li class="active">@lang('equicare.create_Directorates')</li>
@endsection
@section('styles')
	<style type="text/css">
		.mt-2{
			margin-top: 10px;
		}
	</style>
@endsection
@section('content')
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
					<div class="box-header with-border">
						<h4 class="box-title">
							@lang('equicare.create_Directorates')
						</h4>
					</div>
					<div class="box-body">
					@include ('errors.list')
						{!! Form::open(['url'=>'admin/Directorates','method'=>'POST']) !!}
						<div class="row">
							<div class="form-group col-md-6">
								{!! Form::label('name',__('equicare.name')) !!}
								{!! Form::text('name',null,['class' => 'form-control']) !!}
							</div>
							{{-- <div class="form-group col-md-6">
								{!! Form::label('short_name',__('equicare.short_name_e')) !!}
								{!! Form::text('short_name',null,['class' => 'form-control']) !!}
							</div> --}}
							<div class="form-group col-md-6">
								<label for="Governorate_id"> @lang('equicare.Governorate') </label>
								<select name="Governorate_id" class="form-control">
									<option value="">---select---</option>
									@if(isset($hospitals))
										@foreach ($hospitals as $hospital)
											<option value="{{ $hospital->id }}"
												{{ old('Governorate_id')?'selected':'' }}
												>{{ $hospital->name }}
											</option>
										@endforeach
									@endif
								</select>
							</div>


							<div class="form-group col-md-12">
								{!! Form::submit(__('equicare.submit'),['class' => 'btn btn-primary btn-flat']) !!}
							</div>
						</div>
						{!! Form::close() !!}
					</div>
			</div>
		</div>
	</div>
@endsection