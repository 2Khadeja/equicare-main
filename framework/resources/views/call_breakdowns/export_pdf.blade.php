
<!DOCTYPE html>
<html>
<head>
	<title>@lang('equicare.breakdown_pdf')</title>
	<style type="text/css">
	html{
width: 100%;
height: 100%;
padding: 0;
margin: 10px;
}
	.table ,td,th{
		border:1px solid;
		text-align: center;
		font-size: 14px;
	}
	td,th{
		padding: 2px 5px 2px 5px;
	}
	.table{
		border-collapse: collapse;
		overflow: scroll;
	}

	.table-responsive{
		width: 90%;
	}
	.page-break{
		page-break-after: always;
	}
	.container-fluid{
		width:100%;
	}


</style>
</head>
<body>
	<div class="container-fluid">
		@if(isset($breakdowns) && $breakdowns->count())
				<h2>@lang('equicare.breakdowns') </h2>
				@php($c= 0)
				@if(isset($breakdowns) && $breakdowns->count())
						@php($breakdowns_chunk = $breakdowns->chunk(10))
						@foreach ($breakdowns_chunk as $k => $chunk)
						@php($c = $c + 10)
						<div class="table-responsive">
							<table class="table table-bordered table-hover">
								<thead class="thead-inverse">
									
										<tr>
												<th>#</th>
												<th> @lang('equicare.equipment_name') </th>
												<th> @lang('equicare.user') </th>
												<th> @lang('equicare.call_handle') </th>
												<th> @lang('equicare.working_status') </th>
												<th> @lang('equicare.report_number') </th>
												<th> @lang('equicare.call_registration_date_time')</th>
												<th> @lang('equicare.attended_by') </th>
												<th> @lang('equicare.first_attended_on') </th>
												<th> @lang('equicare.completed_on') </th>
												
											</tr>
									
								</thead>
								<tbody>
											@php($count=0)
											@if (isset($breakdowns))
											@foreach ($breakdowns as $breakdown)
											@php($count++)
											<tr>
												<td> {{ $count }} </td>
												<td> {{ $breakdown->equipment->name?? '-' }} </td>
												<td> {{ $breakdown->user->name ?? '-'}}</td>
												<td> {{ $breakdown->call_handle?ucfirst($breakdown->call_handle): '-' }} </td>
												<td> {{ $breakdown->working_status?ucfirst($breakdown->working_status): '-' }}</td>
												<td> {{ $breakdown->report_no?sprintf("%04d",$breakdown->report_no):'-'  }} </td>
												<td>
													{{ $breakdown->call_register_date_time? date('Y-m-d h:i A', strtotime($breakdown->call_register_date_time)) : '-' }}
												</td>
												<td>{{$breakdown->user_attended_fn?$breakdown->user_attended_fn->name:'-'}}</td>
												<td>
													{{$breakdown->user_attended_fn?date('Y-m-d H:i A',strtotime($breakdown->call_attend_date_time)):'-'}}
												</td>
												<td>
													{{$breakdown->call_complete_date_time?date('Y-m-d H:i A',strtotime($breakdown->call_complete_date_time)):'-'}}
												</td>
												
											</tr>
											@endforeach
											@endif
										</tbody>
								<tfoot>
									<tr>
												<th>#</th>
												<th> @lang('equicare.equipment_name') </th>
												<th> @lang('equicare.user') </th>
												<th> @lang('equicare.call_handle') </th>
												<th> @lang('equicare.working_status') </th>
												<th> @lang('equicare.report_number') </th>
												<th> @lang('equicare.call_registration_date_time')</th>
												<th> @lang('equicare.attended_by') </th>
												<th> @lang('equicare.first_attended_on') </th>
												<th> @lang('equicare.completed_on') </th>
												
											</tr>
								</tfoot>
							</table>
						</div>
						@if($c % 10 == 0 && !($loop->last == $breakdowns_chunk[$k]))
							<div class="page-break"></div>
						@endif
						@php($c = 0)
						@endforeach
				@endif
		@else
					<p class="text-center" style="text-align: center;">@lang('equicare.no_data_found')</p>
		@endif		
	</div>
</body>
</html>