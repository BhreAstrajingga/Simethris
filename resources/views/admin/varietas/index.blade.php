@extends('layouts.admin')
@section('content')
{{-- @include('partials.breadcrumb') --}}
@include('partials.subheader')
@include('partials.sysalert')
@can('varietas_access')
<div class="row">
	<div class="col-12">
		<div class="panel" id="panel-1">
			<div class="panel-hdr">
				<h2>
					Daftar Varietas Wajib Tanam
				</h2>
				<div class="panel-toolbar">
					@include('partials.globaltoolbar')
				</div>
			</div>
			<div class="panel-container show">
				<div class="panel-content">
					<table id="datatable" class="table table-bordered table-hover table-striped w-100 table-sm">
						<thead>
							<th hidden>Nama Komoditas</th>
							<th>Nama Varietas</th>
							<th>Kode Varietas</th>
							<th>Datalain</th>
							<th>Keterangan</th>
							<th>Tindakan</th>
						</thead>
						<tbody>
							@foreach ($varieties as $variety)
							<tr>
								<td hidden>{{$variety->nama_komoditas}}</td>
								<td>{{$variety->nama_varietas}}</td>
								<td>{{$variety->kode_varietas}}</td>
								<td>{{$variety->datalain}}</td>
								<td>{{$variety->keterangan}}</td>
								<td>
									<a href="{{ route('admin.varietas.edit', [$variety->id]) }}" class="btn btn-icon btn-xs btn-outline-default rounded-circle"
										title="ubah data varietas ini">
										<i class="fa fa-edit text-primary"></i>
									</a>
									<form action="{{ route('admin.varietas.delete', $variety->id) }}" method="POST" style="display: inline-block;">
										@csrf
										@method('DELETE')
										<button type="submit" class="btn btn-xs btn-outline-default rounded-circle btn-icon" onclick="return confirm('Anda akan menghapus varietas ini?');">
											<i class="fa fa-trash text-danger"></i>
										</button>
									</form>
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
	$(document).ready(function()
	{

		// initialize datatable
		$('#datatable').dataTable(
		{
			responsive: true,
			lengthChange: false,
			order: [[1, 'desc']],
			rowGroup: {
                dataSrc: 0
            },
			dom:
				"<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'f><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'lB>>" +
				"<'row'<'col-sm-12'tr>>" +
				"<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
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
				},
				{
					text: '<i class="fa fa-plus"></i>',
					titleAttr: 'Tambah Varietas',
					className: 'btn btn-info btn-sm btn-icon ml-2',
					action: function(e, dt, node, config) {
						window.location.href = '{{ route('admin.varietas.create') }}';
					}
				}
			]
		});

	});
</script>

@endsection