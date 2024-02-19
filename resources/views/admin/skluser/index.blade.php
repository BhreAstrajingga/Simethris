@extends('layouts.admin')
@section('content')
{{-- @include('partials.breadcrumb') --}}
@include('partials.subheader')

@can('skl_access')
<div class="row">
	<div class="col-12">
		<div class="panel" id="panel-1">
			<div class="panel-container show">
				<div class="panel-content">
					<table class="table table-hover table-striped table-bordered table-sm" id="datatable">
						<thead>
							<th>No. Riph</th>
							<th>No. SKL</th>
							<th>Tanggal Pengajuan</th>
							<th>Tanggal Terbit</th>
							<th>Tindakan</th>
						</thead>
						<tbody>
							@foreach ($skls as $skl)
							<tr>
								<td>{{$skl->no_ijin}}</td>
								<td>{{$skl->no_skl}}</td>
								<td class="text-center">{{ date('d/m/Y', strtotime($skl->pengajuan->created_at)) }}</td>
								<td class="text-center">{{ date('d/m/Y', strtotime($skl->published_date)) }}</td>
								<td class="text-center">
									<a href="{{route('admin.task.user.skl.show', $skl->id)}}"
										class="btn btn-xs btn-icon btn-success"
										data-toggle="tooltip" title data-original-title="Lihat SKL">
										<i class="fal fa-file-certificate"></i>
									</a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endcan
@endsection

@section('scripts')
@parent
<script>
	$(document).ready(function() {
	// initialize datatable
	$('#datatable').dataTable(
			{
			responsive: true,
			lengthChange: false,
			order:[],
			dom:
				"<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'f><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'lB>>" +
				"<'row'<'col-sm-12'tr>>" +
				"<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'>>",
			buttons: [
				{
					extend: 'pdfHtml5',
					text: '<i class="fa fa-file-pdf"></i>',
					titleAttr: 'Generate PDF',
					className: 'btn-outline-danger btn-sm btn-icon mr-1'
				},
				{
					extend: 'excelHtml5',
					text: '<i class="fa fa-file-excel"></i>',
					titleAttr: 'Generate Excel',
					className: 'btn-outline-success btn-sm btn-icon mr-1'
				},
				{
					extend: 'csvHtml5',
					text: '<i class="fal fa-file-csv"></i>',
					titleAttr: 'Generate CSV',
					className: 'btn-outline-primary btn-sm btn-icon mr-1'
				},
				{
					extend: 'copyHtml5',
					text: '<i class="fa fa-copy"></i>',
					titleAttr: 'Copy to clipboard',
					className: 'btn-outline-primary btn-sm btn-icon mr-1'
				},
				{
					extend: 'print',
					text: '<i class="fa fa-print"></i>',
					titleAttr: 'Print Table',
					className: 'btn-outline-primary btn-sm btn-icon mr-1'
				}
			]
		});
	});
</script>
@endsection