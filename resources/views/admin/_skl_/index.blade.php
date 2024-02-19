@extends('layouts.admin')
@section('content')
{{-- @include('partials.breadcrumb') --}}
{{-- @include('partials.subheader') --}}
@can('skl_access')
	<div class="row">
		<div class="col-lg-12">
			<div id="panel-1" class="panel">
				<div class="panel-hdr">
					<h2>
						SKL<span class="fw-300">|<i>Terbit</i></span>
					</h2>
					<div class="panel-toolbar">
						@include('partials.globaltoolbar')
					</div>
				</div>
				<div class="panel-container show">
					<div class="panel-content">
						<div class="table">
							<table id="verifList" class="table table-sm table-bordered table-hover table-striped w-100">
								<thead class="thead-dark">
									<tr>
										<th id="">Nomor Penerbitan</th>
										<th id="">Detail</th>
										<th id="">Tanggal diajukan</th>
										<th id="">Tanggal Terbit</th>
										<th id="">Status</th>
										<th id="">Hasil</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td></td>
										<!-- field berikut ini berasal dari Nomor RIPH (jika pengajuan RIPH), PKS (jika pks), tanam/produksi (jika tanam/produksi) -->
										<td></td>
										<td></td>
										<td></td>
										<!-- khusus status lunas, icon tertaut dengan Surat Keterangan Lunas DIgital -->
										<td></td>
										<td></td>
									</tr>
									
								</tbody>
							</table>
						</div>
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
		$('#verifList').dataTable({
			pagingType: 'full_numbers',
			responsive: true,
			lengthChange: true,
			pageLength: 10,
			order: [
				[0, 'asc']
			],
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
				"<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'f><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'B>>" +
				"<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'>>" +
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
					text: 'PDF',
					titleAttr: 'Generate PDF',
					className: 'btn-outline-danger btn-sm mr-1'
				},
				{
					extend: 'excelHtml5',
					text: 'Excel',
					titleAttr: 'Generate Excel',
					className: 'btn-outline-success btn-sm mr-1'
				},
				{
					extend: 'csvHtml5',
					text: 'CSV',
					titleAttr: 'Generate CSV',
					className: 'btn-outline-primary btn-sm mr-1'
				},
				{
					extend: 'copyHtml5',
					text: 'Copy',
					titleAttr: 'Copy to clipboard',
					className: 'btn-outline-primary btn-sm mr-1'
				},
				{
					extend: 'print',
					text: 'Print',
					titleAttr: 'Print Table',
					className: 'btn-outline-primary btn-sm'
				}
			]
		});

	});

</script>


@endsection

