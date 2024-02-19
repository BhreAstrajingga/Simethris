@extends('layouts.admin')
@section('content')
{{-- @include('partials.breadcrumb') --}}
@include('partials.subheader')

@can('poktan_access')
<div class="row">
	<div class="col-12">
		<div class="panel" id="panel-1">
			<div class="panel-hdr">
				<h2>
					Daftar Penangkar Benih Bawang Putih Berlabel
				</h2>
				<div class="panel-toolbar">
					@include('partials.globaltoolbar')
				</div>
			</div>
			<div class="panel-container show">
				<div class="panel-content">
					<table id="datatable" class="table table-bordered table-hover table-striped w-100">
						<thead>
							<th>Nama Lembaga</th>
							<th>Pimpinan</th>
							<th>Alamat & Kontak</th>
							<th>Provinsi</th>
							<th>Kota</th>
							<th>Tindakan</th>
						</thead>
						<tbody>
							@foreach ($masterpenangkars as $penangkar)
							<tr>
								<td>{{$penangkar->nama_lembaga}}</td>
								<td>{{$penangkar->nama_pimpinan}}</td>
								<td>
									<div class="row">
										<div class="col-1">
											<i class="mr-1 fal fa-home-alt"></i>
										</div>
										<div class="col">
											{{$penangkar->alamat}}
										</div>
									</div>
									<div class="row">
										<div class="col-1">
											<i class="mr-1 fal fa-phone"></i>
										</div>
										<div class="col">
											{{$penangkar->hp_pimpinan}}
										</div>
									</div>
								</td>
								<td>{{$penangkar->provinsi->nama}}</td>
								<td>{{$penangkar->kabupaten->nama_kab}}</td>
								<td>
									<a href="{{ route('admin.task.penangkar.edit', [$penangkar->id]) }}" class="btn btn-icon btn-xs btn-primary"
										title="ubah data kelompok">
										<i class="fal fa-edit"></i>
									</a>
									<form action="{{ route('admin.task.penangkar.delete', $penangkar->id) }}" method="POST" style="display: inline-block;">
										@csrf
										@method('DELETE')
										<button type="submit" class="btn btn-icon btn-xs btn-danger" onclick="return confirm('Are you sure you want to delete this item?');">
											<i class="fal fa-trash-alt"></i>
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
			dom:
				/*	--- Layout Structure 
					--- Options
					l	-	length changing input control
					f	-	filtering input
					t	-	The table!
					i	-	Table information summary
					p	-	pagination control
					r	-	processing display element
					B	-	buttons
					R	-	ColReorder
					S	-	Select

					--- Markup
					< and >				- div element
					<"class" and >		- div with a class
					<"#id" and >		- div with an ID
					<"#id.class" and >	- div with an ID and a class

					--- Further reading
					https://datatables.net/reference/option/dom
					--------------------------------------
				 */
				"<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'f><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'lB>>" +
				"<'row'<'col-sm-12'tr>>" +
				"<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
			buttons: [
				/*{
					extend:    'colvis',
					text:      'Column Visibility',
					titleAttr: 'Col visibility',
					className: 'mr-sm-3'
				},*/
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
					titleAttr: 'Tambah Data Penangkar',
					className: 'btn btn-info btn-sm btn-icon ml-2',
					action: function(e, dt, node, config) {
						window.location.href = '{{ route('admin.task.penangkar.create') }}';
					}
				}
			]
		});

	});
</script>

@endsection

