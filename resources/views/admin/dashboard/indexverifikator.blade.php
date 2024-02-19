@extends('layouts.admin')
@section('content')
{{-- @include('partials.breadcrumb') --}}
{{-- @include('partials.subheader') --}}
@can('dashboard_access')
<!-- Page Content -->
<div class="subheader">
	<h1 class="subheader-title">
		<i class="subheader-icon {{ ($heading_class ?? '') }}"></i><span class="fw-700 mr-2 ml-2">{{  ($page_heading ?? '') }}</span><span class="fw-300">Verifikasi</span>
	</h1>
	<div class="subheader-block d-lg-flex align-items-center  d-print-none d-block">
		<div class="d-inline-flex flex-column justify-content-center ">
			<div class="form-group row">
				<label for="periodetahun" class="col-sm-7 col-form-label text-right">Verifikasi Tahun</label>
				<div class="col-sm-5">
					<input id="periodetahun" name="periode" type="text" class="form-control custom-select yearpicker" placeholder="{{$currentYear}}" aria-label="Pilih tahun" aria-describedby="basic-addon2">
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<div class="panel rounded overflow-hidden position-relative text-white mb-g">
			<div class="card-body bg-danger-300">
				<div class="">
					<h3 class="display-5 d-block l-h-n m-0 fw-500 text-white" data-toggle="tooltip" title data-original-title="Jumlah antrian pengajuan verifikasi">
						<span id="ajucount"></span>
						<small class="m-0 l-h-n">Pengajuan</small>
					</h3>
				</div>
			</div>
			<i class="fal fa-landmark position-absolute pos-right pos-bottom opacity-25 mb-n1 mr-n1" style="font-size:4rem"></i>
		</div>
	</div>
	<div class="col-md-3">
		<div class="panel rounded overflow-hidden position-relative text-white mb-g">
			<div class="card-body bg-warning-400">
				<div class="">
					<h3 class="display-5 d-block l-h-n m-0 fw-500 text-white" data-toggle="tooltip" title data-original-title="Jumlah antrian dalam proses verifikasi.">
						<span id="proccesscount"></span>
						<small class="m-0 l-h-n">Diproses</small>
					</h3>
				</div>
			</div>
			<i class="fal fa-balance-scale position-absolute pos-right pos-bottom opacity-40 mb-n1 mr-n1" style="font-size:4rem"></i>
		</div>
	</div>
	<div class="col-md-3">
		<div class="panel rounded overflow-hidden position-relative text-white mb-g">
			<div class="card-body bg-info-300">
				<div class="">
					<h3 class="display-5 d-block l-h-n m-0 fw-500 text-white" data-toggle="tooltip" title data-original-title="Jumlah pengajuan yang telah diverifikasi dengan status SELESAI.">
						<!-- nilai ini diperoleh dari jumlah seluruh pengajuan yang belum diverifikasi. where status = 1 (user) -->
						<span id="verifiedcount"></span>
						<small class="m-0 l-h-n">Selesai (Perbaikan <span id="failCount"></span>)</small>
					</h3>
				</div>
			</div>
			<i class="fal fa-seedling position-absolute pos-right pos-bottom opacity-40 mb-n1 mr-n1" style="font-size:4rem"></i>
		</div>
	</div>
	<div class="col-md-3">
		<div class="panel rounded overflow-hidden position-relative text-white mb-g">
			<div class="card-body bg-success-500">
				<div class="">
					<h3 class="display-5 d-block l-h-n m-0 fw-500 text-white" data-toggle="tooltip" title data-original-title="Jumlah SKL diterbitkan untuk RIPH periode ini.">
						<span id="lunascount"></span>
						<small class="m-0 l-h-n">Lunas</small>
					</h3>
				</div>
			</div>
			<i class="fal fa-dolly position-absolute pos-right pos-bottom opacity-40 mb-n1 mr-n1" style="font-size:4rem"></i>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="panel" id="panel-2">
			<div class="panel-hdr">
				<h2>
					<i class="subheader-icon fal fa-ballot-check mr-1"></i>Pengajuan dan Progress<span class="fw-300"><i> Verifikasi</i></span>
				</h2>
				<div class="panel-toolbar">
					{{-- @include('layouts.globaltoolbar') --}}
				</div>
			</div>
			<div class="panel-container show">
				<div class="panel-content">
					<table class="table table-bordered table-hover table-sm w-100" id="tabelVerif">
						<thead class="thead-themed">
							<th width="25%">Nama Perusahaan</th>
							<th width="20%">Nomor RIPH</th>
							<th width="20%">Jenis</th>
							<th width="10%">Diajukan</th>
							<th width="10%">Diperbarui</th>
							<th width="15%">Progress</th>
						</thead>
						<tbody>
						</tbody>
					</table>
					<table hidden class="table table-bordered table-hover table-sm w-100" id="verifprogress">
						<thead>
							<th>Nama Perusahaan</th>
							<th>Nomor Pengajuan</th>
							<th>Nomor RIPH</th>
							<th>Pengajuan</th>
							<th>Tahap 1</th>
							<th>Tahap 2</th>
							<th>Tahap 3</th>
						</thead>
						<tbody>

						</tbody>
					</table>
					<span hidden class="help-block mt-2">
						<label for="" class="form-label">Keterangan:</label>
						<div class="row d-flex align-items-top">
							<div class="col-md-4 col-sm-6">
								<ul>
									<li>Tahap 1: Pemeriksaan Data</li>
									<li>Tahap 2: Pemeriksaan Lapangan</li>
									<li>Tahap 3: Rekomendasi dan Penerbitan SKL</li>
								</ul>
							</div>
							<div class="col-md-5 col-sm-6">
								<ul>
									<li>
										<span class="btn btn-icon btn-xs btn-success">
											<i class="fal fa-check-circle mr-1"></i>
										</span> : Pemeriksaan selesai dan dinyatakan sesuai.
									</li>
									<li>
										<span class="btn btn-icon btn-xs btn-danger">
											<i class="fal fa-ban mr-1"></i>
										</span> : Pemeriksaan selesai, data dinyatakan <span class="text-danger">TIDAK SESUAI</span>.
									</li>
									<li>
										<span class="btn btn-icon btn-xs btn-info">
											<i class="fal fa-file-signature mr-1"></i>
										</span> : Rekomendasi penerbitan SKL.</span>.
									</li>
									<li>
										<span class="btn btn-icon btn-xs btn-success">
											<i class="fal fa-award mr-1"></i>
										</span> : Komitmen dinyatakan <span class="fw-700">LUNAS dan SKL diterbitkan.</span></span>.
									</li>
								</ul>
							</div>
						</div>
					</span>
				</div>
			</div>
		</div>
	</div>
</div>
	<!-- End Page Content -->

@endcan
@endsection
@section('scripts')
@parent
	<script>
		$(document).ready(function () {
			var table = $('#tabelVerif').dataTable({
				responsive: true,
				lengthChange: false,
				ordering: true,
				dom:
					"<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'<'select'>>>"+
					"<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'f><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'B>>"+
					"<'row'<'col-sm-12'tr>>"+
					"<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
				buttons: [
					{
						extend: 'pdfHtml5',
						text: '<i class="fa fa-file-pdf"></i>',
						titleAttr: 'Generate PDF',
						className: 'btn-outline-danger btn-xs btn-icon mr-1'
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
				]
			});

			// Ketika halaman dimuat
			var currentYear = new Date().getFullYear();
			$('#periodetahun').val(currentYear);
			var url = '{{ route("admin.verifikatormonitoringDataByYear", ":periodetahun") }}';
			url = url.replace(':periodetahun', currentYear);
			updateTableData(url);

			// Initialize the year picker
			$('.yearpicker').datepicker({
				format: 'yyyy',
				viewMode: 'years',
				minViewMode: 'years',
				autoclose: true
			});

			$('#periodetahun').on('change', function () {
				var selectedValue = $(this).val(); // Get the selected value
				var updatedUrl = '{{ route("admin.verifikatormonitoringDataByYear", ":periodetahun") }}';
				updatedUrl = updatedUrl.replace(':periodetahun', selectedValue);
				table.fnClearTable();
				// Update the table data using the new URL
				updateTableData(updatedUrl);
			});

			// Function to update the table data using AJAX
			function updateTableData(url) {
				$.ajax({
					url: url,
					type: 'GET',
					dataType: 'json',
					success: function (data) {
						// Update the table and other elements with data received from the server
						$('#ajucount').text(data.ajucount);
						$('#proccesscount').text(data.proccesscount);
						$('#verifiedcount').text(data.verifiedcount);
						$('#failCount').text(data.failCount);
						$('#lunascount').text(data.lunascount);
						table.fnClearTable();
						// Populate the table with data tanam from the server
						$.each(data.progresVT, function (index, verifikasi) {
							var company = verifikasi.commitment.datauser.company_name;
							var jenis = verifikasi.jenis;
							var no_ijin = verifikasi.no_ijin;
							var created = verifikasi.created_at;
							var updated = verifikasi.updated_at;
							var progress = verifikasi.TProgress;
							var progressHTML = ''; // Ini adalah variabel untuk menyimpan HTML yang akan dihasilkan

							if (progress === '1') {
								progressHTML = '<span class="badge btn-xs btn-warning"><i class="fa fa-exclamation-circle"></i> Baru</span>';
							} else if (progress === '2') {
								progressHTML = '<span class="badge btn-xs btn-primary"><i class="fal fa-hourglass"></i> Berkas</span>';
							} else if (progress === '3') {
								progressHTML = '<span class="badge btn-xs btn-info"><i class="fal fa-hourglass"></i> PKS</span>';
							} else if (progress === '4') {
								progressHTML = '<span class="badge btn-xs btn-success"><i class="fa fa-check"></i> Selesai</span>';
							} else if (progress === '5') {
								progressHTML = '<span class="badge btn-xs btn-danger"><i class="fa fa-ban"></i> Perbaikan</span>';
							}
							table.fnAddData([company, no_ijin, jenis,created, updated, progressHTML]);
						});

						// Populate the table with data produksi from the server
						$.each(data.progresVP, function (index, verifikasi) {
							var company = verifikasi.commitment.datauser.company_name;
							var jenis = verifikasi.jenis;
							var no_ijin = verifikasi.no_ijin;
							var created = verifikasi.created_at;
							var updated = verifikasi.updated_at;
							var progress = verifikasi.PProgress;
							var progressHTML = ''; // Ini adalah variabel untuk menyimpan HTML yang akan dihasilkan

							if (progress === '1') {
								progressHTML = '<span class="badge btn-xs btn-warning"><i class="fa fa-exclamation-circle"></i> Baru</span>';
							} else if (progress === '2') {
								progressHTML = '<span class="badge btn-xs btn-primary"><i class="fal fa-hourglass"></i> Berkas</span>';
							} else if (progress === '3') {
								progressHTML = '<span class="badge btn-xs btn-info"><i class="fal fa-hourglass"></i> PKS</span>';
							} else if (progress === '4') {
								progressHTML = '<span class="badge btn-xs btn-success"><i class="fa fa-check"></i> Selesai</span>';
							} else if (progress === '5') {
								progressHTML = '<span class="badge btn-xs btn-danger"><i class="fa fa-ban"></i> Perbaikan</span>';
							}
							table.fnAddData([company, no_ijin, jenis,created, updated, progressHTML]);
						});

						// Populate the table with data skl from the server
						// $.each(data.progresVSkl, function (index, verifikasi) {
						// 	var company = verifikasi.commitment.datauser.company_name;
						// 	var jenis = verifikasi.jenis;
						// 	var no_ijin = verifikasi.no_ijin;
						// 	var created = verifikasi.created_at;
						// 	var updated = verifikasi.updated_at;
						// 	var progress = verifikasi.SklProgress;
						// 	var progressHTML = ''; // Ini adalah variabel untuk menyimpan HTML yang akan dihasilkan

						// 	if (progress === '1') {
						// 		progressHTML = '<span class="badge btn-xs btn-warning"><i class="fa fa-exclamation-circle"></i> Baru</span>';
						// 	} else if (progress === '2') {
						// 		progressHTML = '<span class="badge btn-xs btn-primary"><i class="fal fa-hourglass"></i> Rekomendasi</span>';
						// 	} else if (progress === '3') {
						// 		progressHTML = '<span class="badge btn-xs btn-info"><i class="fal fa-hourglass"></i> Disetujui</span>';
						// 	} else if (progress === '4') {
						// 		progressHTML = '<span class="badge btn-xs btn-success"><i class="fa fa-check"></i> Terbit</span>';
						// 	} else if (progress === '5') {
						// 		progressHTML = '<span class="badge btn-xs btn-danger"><i class="fa fa-ban"></i> Perbaikan</span>';
						// 	}
						// 	table.fnAddData([company, no_ijin, jenis,created, updated, progressHTML]);
						// });
						table.fnDraw();
					},
					error: function (xhr, status, error) {
						console.log("AJAX request error: " + error);
					}
				});
			}
		});
	</script>
@endsection
