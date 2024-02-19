@extends('layouts.admin')
@section('content')
{{-- @include('partials.breadcrumb') --}}
{{-- @include('partials.subheader') --}}
@can('dashboard_access')
<div class="subheader">
	<h1 class="subheader-title">
		<i class="subheader-icon {{ ($heading_class ?? '') }}"></i><span class="fw-700 mr-2 ml-2">{{  ($page_heading ?? '') }}</span><span class="fw-300">Realisasi & Verifikasi</span>
	</h1>

	<div class="subheader-block d-lg-flex align-items-center  d-print-none d-block">
		<div class="d-inline-flex flex-column justify-content-center ">
			<div class="form-group row">
				<label for="periodetahun" class="col-sm-4 col-form-label text-right">Tahun</label>
				<div class="col-sm-8">
					<input id="periodetahun" name="periode" type="text" class="form-control custom-select yearpicker" placeholder="{{ date('Y') }}" aria-label="Pilih tahun" aria-describedby="basic-addon2">
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-4">
		<div id="totalRiph" class="p-3 bg-primary-500 rounded overflow-hidden position-relative text-white mb-g">
			<div class="">
				<h3 class="display-5 d-block l-h-n m-0 fw-500" data-toggle="tooltip" title data-original-title="Volume RIPH yang tercantum di dalam Surat Rekomendasi Import Produk Hortikultura">
					<span id="volumeImport">{{ number_format($volumeImport, 0, ',', '.') }}</span>
					<small class="m-0 l-h-n">Volume RIPH (ton)</small>
				</h3>
			</div>
			<i class="fal fa-globe-asia position-absolute pos-right pos-bottom opacity-15 mb-n1 mr-n1" style="font-size:6rem"></i>
		</div>
	</div>
	<div class="col-md-4">
		<div id="totalTanam" class="p-3 bg-success-500 rounded overflow-hidden position-relative text-white mb-g">
			<div class="">
				<h3 class="display-5 d-block l-h-n m-0 fw-500" data-toggle="tooltip" title data-original-title="Jumlah Realisasi Tanam yang telah dilaporkan oleh pelaku usaha hingga saat ini.">
					<span id="count_poktan">{{ number_format($jumlah_poktan, 0, ',', '.') }}</span>
					<small class="m-0 l-h-n">Kelompoktani</small>
				</h3>
			</div>
			<i class="fal fa-users position-absolute pos-right pos-bottom opacity-30 mb-n1 mr-n1" style="font-size:6rem"></i>
		</div>
	</div>
	<div class="col-md-4">
		<div id="totalProduksi" class="p-3 bg-warning-500 rounded overflow-hidden position-relative text-white mb-g">
			<div class="">
				<h3 class="display-5 d-block l-h-n m-0 fw-500" data-toggle="tooltip" title data-original-title="Jumlah Realisasi Produksi yang telah dilaporkan oleh pelaku usaha hingga saat ini.">
					<span id="count_anggota">{{ number_format($jumlah_anggota, 0, ',', '.') }}</span>
					<small class="m-0 l-h-n">Jumlah Petani (anggota)</small>
				</h3>
			</div>
			<i class="fal fa-hat-cowboy position-absolute pos-right pos-bottom opacity-30 mb-n1 mr-n1" style="font-size:6rem"></i>
		</div>
	</div>
	<div class="col-md-4" hidden>
		<div id="totalProduksi" class="p-3 bg-danger-500 rounded overflow-hidden position-relative text-white mb-g">
			<div class="">
				<h3 class="display-5 d-block l-h-n m-0 fw-500" data-toggle="tooltip" title data-original-title="Jumlah Realisasi Produksi yang telah dilaporkan oleh pelaku usaha hingga saat ini.">
					<span id="total_saprodi">0</span>
					<small class="m-0 l-h-n">Total bantuan sarana produksi.</small>
				</h3>
			</div>
			<i class="fal fa-hands-helping position-absolute pos-right pos-bottom opacity-40 mb-n1 mr-n1" style="font-size:6rem"></i>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-6">
		<div class="panel" id="panel-1">
			<div class="panel-hdr">
				<h2>
					<i class="subheader-icon fal fa-seedling mr-1"></i>Realisasi <span class="fw-300"><i>Komitmen Wajib Tanam</i></span>
				</h2>
			</div>
			<div class="panel-container show">
				<div class="panel-content">
					<!-- Row -->
					<div class="row align-items-center mb-3">
						<div class="col-lg-5 col-sm-6 align-self-center text-center">
							<div class="c-chart-wrapper">
								<div
									id = "naschartTanam"
									class="js-easy-pie-chart color-success-300 position-relative d-inline-flex align-items-center justify-content-center"
									data-percent="{{ number_format($prosentanam, 2, ',', '.') }}"
									data-piesize="145"
									data-linewidth="10"
									data-linecap="butt"
									data-scalelength="7"
									data-toggle="tooltip"
									title data-original-title="{{ number_format($prosentanam, 2, ',', '.') }}% dari kewajiban"
									data-placement="bottom">
									<div class="d-flex flex-column align-items-center justify-content-center position-absolute pos-left pos-right pos-top pos-bottom fw-300 fs-xl">
										<span class="fs-xxl fw-500 text-dark">
											<span name="prosenTanam" id="prosenTanam">{{ number_format($prosentanam, 2, ',', '.') }}</span>
											<sup>%</sup>
										</span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-7 col-sm-6">
							<div class="shadow-1 p-2 bg-success-400 rounded overflow-hidden position-relative text-white mb-2">
								<div class="">
									<span class="small">Kewajiban</span>
									<h3 class="d-block l-h-n m-0 fw-500">
										<span id="wajib_tanam">{{ number_format($wajib_tanam, 2, ',', '.') }}</span> ha
									</h3>
								</div>
								<i class="fal fa-hand-holding-seedling position-absolute pos-right pos-bottom opacity-15 mb-n1 mr-n1" style="font-size:3rem"></i>
							</div>
							<div class="shadow-1 p-2 bg-success-600 rounded overflow-hidden position-relative text-white mb-2">
								<div class="">
									<span class="small">Realisasi</span>
									<h3 class="d-block l-h-n m-0 fw-500">
										<span id="total_luastanam">{{ number_format($realisasi_tanam, 2, ',', '.') }}</span> ha
									</h3>
								</div>
								<i class="fal fa-seedling position-absolute pos-right pos-bottom opacity-15 mb-n1 mr-n1" style="font-size:3rem"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="panel" id="panel-2">
			<div class="panel-hdr">
				<h2>
					<i class="subheader-icon fal fa-balance-scale-left mr-1"></i>Realisasi <span class="fw-300"><i>Komitmen Wajib Produksi</i></span>
				</h2>
			</div>
			<div class="panel-container show">
				<div class="panel-content">
					<!-- Row -->
					<div class="row mb-3 align-items-center">
						<div class="col-lg-5 col-sm-6 align-self-center text-center">
							<div class="c-chart-wrapper">
								<div
									id = "naschartProduksi"
									data-percent=""
									data-piesize="145"
									data-linewidth="10"
									data-linecap="butt"
									data-scalelength="7"
									data-toggle="tooltip"
									title data-original-title="{{ number_format($prosenproduksi, 2, ',', '.') }}% dari Kewajiban"
									data-placement="bottom"
									class="js-easy-pie-chart color-warning-500 position-relative d-inline-flex align-items-center justify-content-center" >
									<div class="d-flex flex-column align-items-center justify-content-center position-absolute pos-left pos-right pos-top pos-bottom fw-300 fs-xl">
										<span class="fs-xxl fw-500 text-dark">
											<span name="prosenProduksi" id="prosenProduksi">{{ number_format($prosenproduksi, 2, ',', '.') }}</span>
											<sup>%</sup>
										</span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-7 col-sm-6">
							<div class="shadow-1 p-2 bg-warning-400 rounded overflow-hidden position-relative text-white mb-2">
								<div class="">
									<span class="small">Kewajiban</span>
									<h3 class="d-block l-h-n m-0 fw-500">
										<span id="wajib_produksi">{{ number_format($wajib_produksi, 2, ',', '.') }}</span> ton
									</h3>
								</div>
								<i class="fal fa-dolly-empty position-absolute pos-right pos-bottom opacity-30 mb-n1 mr-n1" style="font-size:3rem"></i>
							</div>
							<div class="shadow-1 p-2 bg-warning-600 rounded overflow-hidden position-relative text-white mb-2">
								<div class="">
									<span class="small">Realisasi</span>
									<h3 class="d-block l-h-n m-0 fw-500">
										<span id="total_volume">{{ number_format($realisasi_produksi, 2, ',', '.') }}</span> ton
									</h3>
								</div>
								<i class="fal fa-dolly position-absolute pos-right pos-bottom opacity-30 mb-n1 mr-n1" style="font-size:3rem"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="panel" id="panel-2">
			<div class="panel-hdr">
				<h2>
					<i class="subheader-icon fal fa-ballot-check mr-1"></i>STATUS <span class="fw-300"><i>Verifikasi</i></span>
				</h2>
				<div class="panel-toolbar">
					@include('layouts.globaltoolbar')
				</div>
			</div>
			<div class="panel-container show">
				<div class="panel-content">
					<table class="table table-bordered table-hover table-sm w-100" id="verifprogress">
						<thead>
							<th>Nomor RIPH</th>
							{{-- <th>Pengajuan</th> --}}
							<th>Tanam</th>
							<th>Produksi</th>
							<th>SKL</th>
							<th>Status Lunas</th>
						</thead>
						<tbody>
							@foreach ($allPengajuan as $pengajuan)
								<tr>
									@php
										$statusAjutanam = $pengajuan->ajutanam->status ?? null;
										$statusAjuproduksi = $pengajuan->ajuproduksi->status ?? null;
										$statusAjuskl = $pengajuan->ajuskl->status ?? null;
										$statusCompleted = $pengajuan->completed->url ?? null;
									@endphp
									<td>{{$pengajuan->no_ijin}}</td>
									{{-- <td class="text-center">
										@if ($pengajuan->status)
											<span class="btn btn-xs btn-icon btn-info"><i class="fa fa-check-circle"></i></span>
										@endif
									</td> --}}
									<td class="text-center">
										@if ($statusAjutanam === '1')
											<span class="btn btn-xs btn-icon btn-warning" data-toggle="tooltip" data-original-title="Sudah diajukan"><i class="fa fa-upload"></i></span>
										@elseif ($statusAjutanam === '2')
											<span class="btn btn-xs btn-icon btn-info" data-toggle="tooltip" data-original-title="Proses Pemeriksaan Berkas"><i class="fa fa-file-search"></i></span>
										@elseif ($statusAjutanam === '3')
											<span class="btn btn-xs btn-icon btn-primary" data-toggle="tooltip" data-original-title="Proses Pemeriksaan PKS"><i class="fa fa-file-search"></i></span>
										@elseif ($statusAjutanam === '4')
											<span class="btn btn-xs btn-icon btn-success" data-toggle="tooltip" data-original-title="Selesai diperiksa dan Sesuai"><i class="fa fa-check-circle"></i></span>
										@elseif ($statusAjutanam === '5')
											<span class="btn btn-xs btn-icon btn-danger" data-toggle="tooltip" data-original-title="Selesai diperiksa. Perbaiki Data"><i class="fa fa-ban"></i></span>
										@endif
									</td>
									<td class="text-center">
										@if ($statusAjuproduksi === '1')
											<span class="btn btn-xs btn-icon btn-warning" data-toggle="tooltip" data-original-title="Sudah diajukan"><i class="fa fa-upload"></i></span>
										@elseif ($statusAjuproduksi === '2')
											<span class="btn btn-xs btn-icon btn-info" data-toggle="tooltip" data-original-title="Proses Pemeriksaan Berkas"><i class="fa fa-file-search"></i></span>
										@elseif ($statusAjuproduksi === '3')
											<span class="btn btn-xs btn-icon btn-primary" data-toggle="tooltip" data-original-title="Proses Pemeriksaan PKS"><i class="fa fa-file-search"></i></span>
										@elseif ($statusAjuproduksi === '4')
											<span class="btn btn-xs btn-icon btn-success" data-toggle="tooltip" data-original-title="Selesai diperiksa dan Sesuai"><i class="fa fa-check-circle"></i></span>
										@elseif ($statusAjuproduksi === '5')
											<span class="btn btn-xs btn-icon btn-danger" data-toggle="tooltip" data-original-title="Selesai diperiksa. Perbaiki Data"><i class="fa fa-ban"></i></span>
										@endif
									</td>
									<td class="text-center">
										@if (empty($statusAjuskl))
										@elseif($statusAjuskl == 1)
											<span class="btn btn-xs btn-icon btn-info" data-toggle="tooltip" data-original-title="Penerbitan SKL sudah diajukan"><i class="fal fa-upload"></i></span>
										@elseif($statusAjuskl == 2)
											<span class="btn btn-xs btn-icon btn-primary" data-toggle="tooltip" data-original-title="Direkomendasikan"><i class="fal fa-thumbs-up"></i></span>
										@elseif($statusAjuskl == 3)
											<span class="btn btn-xs btn-icon btn-warning" data-toggle="tooltip" data-original-title="Penerbitan SKL sudah disetujui. Menunggu Petugas mengunggah berkas SKL."><i class="fal fa-signature"></i></span>
										@elseif($statusAjuskl == 4)
											<span class="btn btn-xs btn-icon btn-success" data-toggle="tooltip" data-original-title="SKL Terbit"><i class="fa fa-award"></i></span>
										@elseif ($statusAjuskl === '5')
											<span class="btn btn-xs btn-icon btn-danger"><i class="fa fa-ban"></i></span>
										@endif
									</td>
									<td class="text-center">
										@if ($statusCompleted)
											<span class="btn btn-xs btn-icon btn-success"><i class="fa fa-award"></i></span>
										@endif
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
		//initialize datatable verifprogress
		$('#verifprogress').dataTable({
			responsive: true,
			lengthChange: false,
			dom:
			"<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'<'select'>>>" +
			"<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'f><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'B>>" +
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
				}
			]
		});

		// Create the "Status" select element and add the options
		// var selectStatus = $('<select>')
		// 	.attr('id', 'selectverifprogressStatus')
		// 	.addClass('custom-select custom-select-sm col-3 mr-2')
		// 	.on('change', function() {
		// 	var status = $(this).val();
		// 	table.column(6).search(status).draw();
		// 	});

		// $('<option>').val('').text('Semua Status').appendTo(selectStatus);
		// $('<option>').val('1').text('Sudah Terbit').appendTo(selectStatus);
		// $('<option>').val('2').text('Belum Terbit').appendTo(selectStatus);

		// // Add the select elements before the first datatable button in the second table
		// $('#verifprogress_wrapper .dt-buttons').before(selectStatus);
	});
</script>
<script>
	$(document).ready(function() {
		var currentDate = new Date();
		var currentYear = currentDate.getFullYear(); // Mendapatkan tahun berjalan
		var url = '{{ route("admin.userMonitoringDataByYear", ":periodetahun") }}';
		url = url.replace(':periodetahun', currentYear);
		// Datepicker initialization
		// Initialize the year picker
		$('.yearpicker').datepicker({
			format: 'yyyy',
			viewMode: 'years',
			minViewMode: 'years',
			autoclose: true
		});
		$('#periodetahun').on('change', function() {
			var periodetahun = $(this).val();
			var url = '{{ route("admin.userMonitoringDataByYear", ":periodetahun") }}';
			url = url.replace(':periodetahun', periodetahun);

			$.get(url, function (data) {
				$('#volumeImport').text(formatNumber(data.volumeImport));
				$('#count_poktan').text(formatNumber(data.count_poktan));
				$('#count_anggota').text(formatNumber(data.count_anggota));

				$('#wajib_tanam').text(formatdecimals(data.wajib_tanam));
				$('#wajib_produksi').text(formatdecimals(data.wajib_produksi));
				$('#total_luastanam').text(formatdecimals(data.total_luastanam));
				$('#total_volume').text(formatdecimals(data.total_volume));
				$('#prosenTanam').text(formatdecimals(data.prosenTanam));
				$('#prosenProduksi').text(formatdecimals(data.prosenProduksi));

				var prosenTanam = formatdecimals(data.prosenTanam);
				$('#naschartTanam').attr('data-percent', prosenTanam);
				$('#naschartTanam').attr('data-original-title', prosenTanam  + '% dari kewajiban');
				var $chartTanam = $('#naschartTanam');
				$chartTanam.data('easyPieChart').update(prosenTanam);

				var prosenProduksi = formatdecimals(data.prosenProduksi);
				$('#naschartProduksi').attr('data-percent', prosenProduksi);
				$('#naschartProduksi').attr('data-original-title', prosenProduksi  + '% dari kewajiban');
				var $chartProduksi = $('#naschartProduksi');
				$chartProduksi.data('easyPieChart').update(prosenProduksi);

				// var lvToWt = (data.lvTowt);
				// $('#naschartTanamVerif').attr('data-percent', lvToWt);
				// $('#naschartTanamVerif').attr('data-original-title', lvToWt  + '% dari kewajiban');
				// var $chartTanam = $('#naschartTanamVerif');
				// $chartTanam.data('easyPieChart').update(lvToWt);

				// var vvToWp = (data.vvTowp);
				// $('#naschartProduksiVerif').attr('data-percent', vvToWp);
				// $('#naschartProduksiVerif').attr('data-original-title', vvToWp  + '% dari kewajiban');
				// var $chartTanam = $('#naschartProduksiVerif');
				// $chartTanam.data('easyPieChart').update(vvToWp);

				// Build table for pengajuanv2s
				var tableBody = $("#verifprogress tbody");
				tableBody.empty(); // Clear previous table data

				$.each(data.verifikasis, function (index, verifikasi) {
					console.log('Verifikasi:', verifikasi);
					var row = $("<tr></tr>");
					var nomorRIPH = $("<td></td>").text(verifikasi.no_ijin);


					var tanamCell = $('<td class="text-center"></td>').html(function() {
							if (!verifikasi.statusTanam) {
								return '<span class="btn btn-xs btn-icon btn-warning"><i class="fa fa-exclamation-circle"></i></span>';
							}else if (verifikasi.statusTanam === '1'){
								return '<span class="btn btn-xs btn-icon btn-primary"><i class="fa fa-check-upload"></i></span>';
							}else if (verifikasi.statusTanam === '2'){
								return '<span class="btn btn-xs btn-icon btn-primary"><i class="fa fa-hourglass"></i></span>';
							}else if (verifikasi.statusTanam === '3'){
								return '<span class="btn btn-xs btn-icon btn-primary"><i class="fa fa-hourglass"></i></span>';
							}else if (verifikasi.statusTanam === '4'){
								return '<span class="btn btn-xs btn-icon btn-success"><i class="fa fa-check-circle"></i></span>';
							}else if (verifikasi.statusTanam === '5'){
								return '<span class="btn btn-xs btn-icon btn-danger"><i class="fa fa-exclamation-circle"></i></span>';
							}
						});

					var produksiCell = $('<td class="text-center"></td>').html(function() {
						if (!verifikasi.statusProduksi) {
							return '<span class="btn btn-xs btn-icon btn-warning"><i class="fa fa-exclamation-circle"></i></span>';
						}else if (verifikasi.statusProduksi === '1'){
							return '<span class="btn btn-xs btn-icon btn-primary"><i class="fa fa-check-upload"></i></span>';
						}else if (verifikasi.statusProduksi === '2'){
							return '<span class="btn btn-xs btn-icon btn-primary"><i class="fa fa-hourglass"></i></span>';
						}else if (verifikasi.statusProduksi === '3'){
							return '<span class="btn btn-xs btn-icon btn-primary"><i class="fa fa-hourglass"></i></span>';
						}else if (verifikasi.statusProduksi === '4'){
							return '<span class="btn btn-xs btn-icon btn-success"><i class="fa fa-check-circle"></i></span>';
						}else if (verifikasi.statusProduksi === '5'){
							return '<span class="btn btn-xs btn-icon btn-danger"><i class="fa fa-exclamation-circle"></i></span>';
						}
					});

					var sklCell = $('<td class="text-center"></td>').html(function() {
						if (!verifikasi.statusSkl) {
							return '<span class="btn btn-xs btn-icon btn-warning"><i class="fa fa-exclamation-circle"></i></span>';
						}else if (verifikasi.statusSkl === '1'){
							return '<span class="btn btn-xs btn-icon btn-primary"><i class="fa fa-check-upload"></i></span>';
						}else if (verifikasi.statusSkl === '2'){
							return '<span class="btn btn-xs btn-icon btn-primary"><i class="fa fa-hourglass"></i></span>';
						}else if (verifikasi.statusSkl === '3'){
							return '<span class="btn btn-xs btn-icon btn-primary"><i class="fa fa-hourglass"></i></span>';
						}else if (verifikasi.statusSkl === '4'){
							return '<span class="btn btn-xs btn-icon btn-success"><i class="fa fa-check-circle"></i></span>';
						}else if (verifikasi.statusSkl === '5'){
							return '<span class="btn btn-xs btn-icon btn-danger"><i class="fa fa-exclamation-circle"></i></span>';
						}
					});

					var lunasCell = $('<td class="text-center"></td>').html(function() {
						if (verifikasi.status === '6') {
							return '<span class="btn btn-xs btn-icon btn-primary"><i class="fa fa-file-signature"></i></span>';
						} else if (verifikasi.status === '7') {
							return '<span class="btn btn-xs btn-icon btn-success"><i class="fa fa-award"></i></span>';
						}else if (verifikasi.status === '8') {
							return '<span class="btn btn-xs btn-icon btn-danger"><i class="fa fa-ban"></i></span>';
						}
					});

					row.append(nomorRIPH, tanamCell, produksiCell, sklCell, lunasCell);
					tableBody.append(row);
				});

			});

			function formatNumber(number) {
				return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
			}

			function formatdecimals(number) {
				var parts = number.toFixed(2).toString().split(".");
				var formattedNumber = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ".");
				if (parts.length > 1) {
					formattedNumber += "," + parts[1];
				} else {
					formattedNumber += ",00"; // Add two decimal places if there are none
				}
				return formattedNumber;
			}
		});
	});
</script>


@endsection
