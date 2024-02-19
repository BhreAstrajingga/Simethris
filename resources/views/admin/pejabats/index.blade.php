@extends('layouts.admin')
@section('content')
{{-- @include('partials.breadcrumb') --}}
@include('partials.subheader')
@include('partials.sysalert')
<div class="row">
	<div class="col-12">
		<div class="panel" id="panel-1">
			<div class="panel-hdr">
				<h2>
					Daftar Pejabat Penandatangan
				</h2>
				<div class="panel-toolbar">
					@include('partials.globaltoolbar')
				</div>
			</div>
			<div class="panel-container show">
				<div class="panel-content">
					<table id="datatable" class="table table-bordered table-hover table-striped w-100">
						<thead>
							<th>Nama Pejabat</th>
							<th>NIP</th>
							<th>Created at</th>
							<th>Updated at</th>
							<th>Status</th>
							<th>Tindakan</th>
						</thead>
						<tbody>
							@foreach ($pejabats as $pejabat)
							<tr>
								<td>{{$pejabat->nama}}</td>
								<td>{{$pejabat->nip}}</td>
								<td>{{$pejabat->created_at}}</td>
								<td>{{$pejabat->updated_at}}</td>
								<td>
									@if ($pejabat->status ===0)
										<form action="{{ route('admin.pejabat.activate', $pejabat->id) }}" method="POST" style="display: inline-block;">
											@csrf
											@method('PUT')
											<button type="submit" class="btn btn-xs btn-outline-default rounded-circle btn-icon" onclick="return confirm('Anda akan mengaktifkan Pejabat ini sebagai default Penandatangan SKL?');">
												<i class="fa fa-power-off text-muted"></i>
											</button>
										</form>
									@else
										<button class="btn btn-xs btn-icon btn-outline-default rounded-circle">
											<i class="fa fa-power-off text-danger"></i>
										</button>
									@endif
								</td>
								<td>
									<a href="{{ route('admin.pejabat.edit', [$pejabat->id]) }}" class="btn btn-icon btn-xs btn-outline-default rounded-circle"
										title="ubah data Pejabat ini">
										<i class="fa fa-edit text-primary"></i>
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
			order: [[4, 'desc']],
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
					titleAttr: 'Tambah Pejabat Penandatangan',
					className: 'btn btn-info btn-sm btn-icon ml-2',
					action: function(e, dt, node, config) {
						window.location.href = '{{ route('admin.pejabat.create') }}';
					}
				}
			]
		});

	});
</script>

@endsection