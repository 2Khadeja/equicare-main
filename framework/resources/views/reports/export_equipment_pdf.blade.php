<!DOCTYPE html>
<html>
<head>
	<title>@lang('equicare.equipment_report_pdf')</title>
	<style type="text/css">
		.table ,td,th{
			border:1px solid;
		}
		td,th{
			padding: 2px 5px 2px 5px;
		}
		.table{
			border-collapse: collapse;
		}
	</style>
</head>
<body>
	<h2> @lang('equicare.equipment_report') </h2>
<table class="table table-bordered table-hover">
	<thead class="thead-inverse">
		<tr>
			<th> # </th>
			<th> @lang('equicare.healthfacility') </th>
			<th> @lang('equicare.unique_id') </th>
			<th> @lang('equicare.status') </th>
			<th> @lang('equicare.call_attended_by')</th>
			<th> @lang('equicare.call_register_date_time')</th>
			<th> @lang('equicare.call_complete_date_time')</th>
			<th> @lang('equicare.purchase_date') </th>
		</tr>
	</thead>
	<tbody>

		@php
		$count = 0;
		@endphp
		@foreach ($call_entries as $call_entry)
		@php
		$count++;
		@endphp
		<tr>
			<td> {{ $count }} </td>
			<td>{{ $call_entry->equipment?$call_entry->equipment->healthfacility->name : '-' }}
			</td>
			<td>{{ $call_entry->equipment->unique_id }}</td>
			<td>{{ ucwords($call_entry->working_status??'-') }}
			</td>
			<td>{{ $call_entry->user_attended_fn->name?? '-' }}
			</td>
			<td>{{$call_entry->call_register_date_time?date('Y-m-d h:i A',strtotime($call_entry->call_register_date_time)): '-' }}</td>
			<td>{{$call_entry->call_complete_date_time?date('Y-m-d h:i A',strtotime($call_entry->call_complete_date_time)): '-' }}</td>
			<td>{{ date_change($call_entry->equipment->date_of_purchase)?? '-' }}</td>
		</tr>
		@endforeach
	</tbody>
	<tfoot>
		<tr>
			<th> # </th>
			<th> @lang('equicare.healthfacility') </th>
			<th> @lang('equicare.unique_id') </th>
			<th> @lang('equicare.status') </th>
			<th> @lang('equicare.call_attended_by')</th>
			<th> @lang('equicare.call_register_date_time')</th>
			<th> @lang('equicare.call_complete_date_time')</th>
			<th> @lang('equicare.purchase_date') </th>
		</tr>
	</tfoot>
</table>
</body>
</html>
