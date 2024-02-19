@extends ('layouts.admin')
@section ('style')
@endsection
@section('content')
<div class="" data-title="System Alert" data-intro="Ini adalah Panel yang berisi informasi atau pemberitahuan penting untuk Anda." data-step="1">@include('partials.sysalert')</div>

<div class="row">
	<div class="col-12">
		<div class="panel" id="panel-1">
			<div class="panel-hdr">
				<h2>
					DAFTAR BANTUAN <span class="fw-300 hidden-sm-down"><i>Kegiatan Usaha Tani</i></span>
				</h2>
			</div>
			<div class="alert alert-info border-0 mb-0">
				<div class="d-flex align-item-center">
					<div class="alert-icon">
						<div class="icon-stack icon-stack-sm mr-3 flex-shrink-0">
							<i class="base base-7 icon-stack-3x opacity-100 color-primary-400"></i>
							<i class="base base-7 icon-stack-2x opacity-100 color-primary-800"></i>
							<i class="fa fa-info icon-stack-1x opacity-100 color-white"></i>
						</div>
					</div>
					<div class="flex-1">
						<span>Bagian ini digunakan untuk mencatat/melaporkan data-data bantuan yang diberikan kepada kelompoktani sesuai perjanjian dalam rangka pelaksanaan kegiatan wajib tanam dan produksi.</span>
					</div>
				</div>
			</div>
			<div class="panel-container show">
				<div class="panel-content">
					<!-- datatable start -->
					<table id="dataSaprodi" class="table table-sm table-bordered table-hover table-striped w-100">
						<thead>
							<tr>
								<th>Tanggal</th>
								<th hidden>Kategori</th>
								<th>Jenis</th>
								<th>Vol</th>
								<th>sat</th>
								<th>harga</th>
								<th>Jumlah</th>
								<th>Tindakan</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($saprodis as $saprodi)
								<tr>
									<td>{{$saprodi->tanggal_saprodi}}</td>
									<td hidden>{{$saprodi->kategori}}</td>
									<td>{{$saprodi->jenis}}</td>
									<td>{{$saprodi->volume}}</td>
									<td>{{$saprodi->satuan}}</td>
									<td>{{number_format($saprodi->harga, 2, ',', '.')}}</td>
									<td>{{number_format($saprodi->volume * $saprodi->harga, 2, ',', '.')}}</td>
									<td class="text-center">
										<div class="justify-content-between">
											
										</div>
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
<!-- @parent -->
<!-- start script for this page -->
@section('scripts')
<script src="{{ asset('/js/datagrid/datatables/datatables.bundle.js') }}"></script>
<script src="{{ asset('/js/datagrid/datatables/datatables.export.js') }}"></script>
<script src="{{ asset('/js/formplugins/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script>

<script>
	$(document).ready(function() {
		$('#dataSaprodi').dataTable({
			pagingType: 'full_numbers',
			responsive: true,
			lengthChange: false,
			order: [
				[0, 'desc']
			],
			rowGroup: {
				dataSrc: 1
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
			]
		});
	});
</script>

<script>
	$(document).ready(function() {
	  // Function to calculate and update the total
	  function calculateTotal() {
		var volume = parseFloat($('#volume').val());
		var harga = parseFloat($('#harga').val());
		
		// Check for valid numbers
		if (isNaN(volume) || isNaN(harga)) {
		  $('#total').val(0).addClass('text-danger');
		  $('#formattedTotal').val(0).addClass('text-danger');
		} else {
		  var total = volume * harga;
		  $('#total').val(total.toFixed(2)).removeClass('text-danger');
		  $('#formattedTotal').val(formatNumber(total)).removeClass('text-danger');
		}
	  }
  
	  // Bind the input events to recalculate the total
	  $('#volume, #harga').on('input', calculateTotal);
  
	  // Function to format number with thousand separator
	  function formatNumber(number) {
		return number.toLocaleString('en-US');
	  }
	});
</script>
@endsection