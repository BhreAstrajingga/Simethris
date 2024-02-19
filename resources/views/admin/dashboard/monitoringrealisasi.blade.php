@extends('layouts.admin')
@section('content')
{{-- @include('partials.breadcrumb') --}}
{{-- @include('partials.subheader') --}}
@can('dashboard_access')
<!-- Page Content -->
	<div class="subheader d-print-none">
		<h1 class="subheader-title">
			<i class="subheader-icon {{ ($heading_class ?? '') }} mr-1"></i>
			<span class="fw-700 mr-1">{{  ($page_heading ?? '') }}</span>
			<span class="fw-300">Komitmen Wajib Tanam-Produksi</span>
		</h1>

		<div class="col-sm-3">
			<div class="form-group">
				<label class="form-label" for="provinsi"></label>
				<div class="input-group">
					<select class="form-control custom-select border-danger select2-tahun" name="periodetahun" id="periodetahun" required>
						<option value="" hidden>--pilih tahun</option>
						<option value="all">Semua Tahun</option>
						@foreach($periodeTahuns as $periodetahun => $records)
						<option value="{{ $periodetahun }}">Tahun {{ $periodetahun }}</option>
						@endforeach
					</select>
				</div>
				<div class="help-block">
				</div>
			</div>
		</div>
	</div>
	{{-- <div class="row"> --}}
		<div class="panel">
			<div class="panel-container">
				<div class="panel-content">
					<table class="table table-bordered table-hover table-sm table-striped w-100" id="dataMonitor">
						<thead class="thead-themed">
							<th width="25%">Nomor RIPH</th>
							<th width="25%">Perusahaan</th>
							<th class="text-left">Komitmen Wajib Tanam</th>
							<th>Luas Dilaporkan (s.d saat ini)</th>
							<th>Komitmen Wajib Produksi</th>
							<th>Volume Dilaporkan (s.d saat ini)</th>
						</thead>
						<tbody></tbody>
					</table>
				</div>
			</div>
		</div>
	{{-- </div> --}}
	<!-- End Page Content -->

@endcan
@endsection
@section('scripts')
@parent
<script>
	$(document).ready(function() {
		$('.yearpicker').datepicker({
			format: 'yyyy',
			viewMode: 'years',
			minViewMode: 'years',
			autoclose: true
		});

		// Event handler untuk mengubah URL saat elemen select berubah
		$('#periodetahun').on('change', function () {
			var selectedValue = $(this).val(); // Mendapatkan nilai yang dipilih
			var updatedUrl = '{{ route("admin.monitoringDataRealisasi", ":periodetahun") }}';
			updatedUrl = updatedUrl.replace(':periodetahun', selectedValue);

			// Perbarui URL pada fungsi updateTableData
			updateTableData(updatedUrl);
		});

		var tableMonitor = $('#dataMonitor').DataTable({
			responsive: true,
			lengthChange: true,
			dom:
			"<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'f><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'lB>>" +
			"<'row'<'col-sm-12'tr>>" +
			"<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
			buttons: [
				{
					extend: 'pdfHtml5',
					text: '<i class="fa fa-file-pdf"></i>',
					titleAttr: 'Generate PDF',
					className: 'btn-outline-danger btn-xs btn-icon ml-5 mr-1'
				},
				{
					extend: 'excelHtml5',
					text: '<i class="fa fa-file-excel"></i>',
					titleAttr: 'Generate Excel',
					className: 'btn-outline-success btn-xs btn-icon mr-1'
				},
				{
					extend: 'print',
					text: '<i class="fa fa-print"></i>',
					titleAttr: 'Print Table',
					className: 'btn-outline-primary btn-xs btn-icon mr-1'
				}
			],
			columnDefs: [
				{ className: 'text-right', targets: [2,3,4,5] },
			// 	{ className: 'text-center', targets: [1] },
			]
		});

		function updateTableData(url) {
			$.ajax({
				url: url, // Gunakan URL yang diperbarui
				type: 'GET',
				dataType: 'json',
				success: function(response) {
					tableMonitor.clear().draw();
					if (response.dataRealisasi.length > 0) {
						$.each(response.dataRealisasi, function(index, realisasi) { // Update response handling
							var company = realisasi.company;
							var noIjin = realisasi.no_ijin;
							var wT = realisasi.wajib_tanam + ' ha';
							var RwT = realisasi.realisasi_tanam + ' ha';
							var wP = realisasi.wajib_produksi + ' ton';
							var RwP = realisasi.realisasi_produksi + ' ton';

							tableMonitor.row.add([noIjin, company, wT,RwT, wP, RwP]).draw(false);
						});
					}
					tableMonitor.draw(); // Draw the table after adding the rows
				},
				error: function(xhr, status, error) {
					console.error(xhr.responseText);
				}
			});
		}
	});
</script>

@endsection
