@extends('layouts.admin')
@section('body-title')
	@lang('equicare.healthfacilitys')
@endsection
@section('title')
	| @lang('equicare.healthfacilitys')
@endsection
@section('breadcrumb')
<li class="active">@lang('equicare.healthfacilitys')</li>
@endsection

@section('content')
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
			<div class="box-header">
				<h4 class="box-title">@lang('equicare.manage_healthfacilitys')
						@if(
							Auth::user()->hasDirectPermission('Create healthfacilitys'))
							<a href="{{ route('healthfacilitys.create') }}" class="btn btn-primary btn-flat">@lang('equicare.add_new')</a></h4>
						@endif

				</div>

				<div class="box-body table-responsive">
					<table class="table table-bordered table-hover dataTable bottom-padding" id="data_table">
						<thead class="thead-inverse">
							<tr>
								<th> # </th>
								<th> @lang('equicare.name') </th>
								<th> @lang('equicare.email') </th>
								<th> @lang('equicare.user') </th>
								<th> @lang('equicare.slug') </th>
								<th> @lang('equicare.phone') </th>
								<th> @lang('equicare.mobile') </th>
								@if(Auth::user()->hasDirectPermission('Edit healthfacilitys') || Auth::user()->hasDirectPermission('Delete healthfacilitys'))
								<th> @lang('equicare.action')</th>
								@endif
							</tr>
						</thead>
						<tbody>
							@if (isset($healthfacilitys))
							@php
								$count = 0;
							@endphp
							@foreach ($healthfacilitys as $healthfacility)
							@php
								$count++;
							@endphp
							<tr>
							<td> {{ $count }} </td>
							<td> {{ ucfirst($healthfacility->name) }} </td>
							<td> {{  $healthfacility->email ?? '-' }}</td>
							<td> {{ $healthfacility->user ? ucfirst($healthfacility->user->name) : '-' }}</td>
							<td> {{ $healthfacility->slug ?? '-' }}</td>
							<td> {{ $healthfacility->phone_no ?? '-'}} </td>
							<td> {{ $healthfacility->mobile_no ?? '-'}} </td>
							@if(
							Auth::user()->hasDirectPermission('Edit healthfacilitys') || Auth::user()->hasDirectPermission('Delete healthfacilitys'))
                        	<td class="text-nowrap">
								{!! Form::open(['url' => 'admin/healthfacilitys/'.$healthfacility->id,'method'=>'DELETE','class'=>'form-inline']) !!}
									{{-- @can('Edit healthfacilitys') --}}
									@if(Auth::user()->hasDirectPermission('Edit healthfacilitys'))
									<a href="{{ route('healthfacilitys.edit',$healthfacility->id) }}" class="btn bg-purple btn-sm btn-flat" title="@lang('equicare.edit')"><i class="fa fa-edit"></i>  </a>
									{{-- @endcan  --}}
									&nbsp;
		                            @endif
		                            <input type="hidden" name="id" value="{{ $healthfacility->id }}">
									@if(Auth::user()->hasDirectPermission('Delete healthfacilitys'))

		                            {{-- @can('Delete healthfacilitys') --}}
		                            <button class="btn btn-warning btn-sm btn-flat" type="submit" onclick="return confirm('@lang('equicare.are_you_sure')')" title="@lang('equicare.delete')"><span class="fa fa-trash-o" aria-hidden="true"></span></button>
		                            {{-- @endcan --}}
		                            @endif
		                        {!! Form::close() !!}
							</td>
							@endif
						</tr>
						@endforeach
						@endif
						</tbody>
						<tfoot>
							<tr>
								<th> # </th>
								<th> @lang('equicare.name') </th>
								<th> @lang('equicare.email') </th>
								<th> @lang('equicare.user') </th>
								<th> @lang('equicare.slug') </th>
								<th> @lang('equicare.phone') </th>
								<th> @lang('equicare.mobile') </th>
								@if(Auth::user()->hasDirectPermission('Edit healthfacilitys') || Auth::user()->hasDirectPermission('Delete healthfacilitys'))
								<th> @lang('equicare.action')</th>
								@endif
							</tr>
						</tfoot>
					</table>
				</div>

			</div>
		</div>
	</div>
@endsection