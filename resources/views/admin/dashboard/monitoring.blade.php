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
			<span class="fw-300">Realisasi & Verifikasi</span>
		</h1>

		<div class="col-sm-3">
			<div class="form-group">
				<label class="form-label" for="provinsi"></label>
				<div class="input-group">
					<select class="form-control custom-select select2-tahun" name="periodetahun" id="periodetahun" required>
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
	<div class="row">
		<div class="col-md-3">
			<div id="new_request" class="p-3 bg-danger-300 rounded overflow-hidden position-relative text-white mb-g">
				<div class="">
					<h3 class="display-5 d-block l-h-n m-0 fw-500" data-toggle="tooltip" title data-original-title="Jumlah Ijin yang telah dilaporkan oleh Pelaku Usaha dalam sistem SIMETHRIS">
						<!-- nilai ini diperoleh dari jumlah seluruh pengajuan yang belum diverifikasi. where status = 1 (user) -->
						<span id="total_commit">0</span>
						<small class="m-0 l-h-n">RIPH</small>
					</h3>
				</div>
				<i class="fal fa-landmark position-absolute pos-right pos-bottom opacity-25 mb-n1 mr-n1" style="font-size:4rem"></i>
			</div>
		</div>
		<div class="col-md-3">
			<div id="onprogress" class="p-3 bg-warning-300 rounded overflow-hidden position-relative text-white mb-g">
				<div class="">
					<h3 class="display-5 d-block l-h-n m-0 fw-500" data-toggle="tooltip" title data-original-title="Total volume RIPH yang dilaporkan oleh Pelaku Usaha dalam sistem SIMETHRIS">
						<!-- nilai ini diperoleh dari jumlah seluruh pengajuan yang SEDANG diverifikasi. where status = 2 (mulai/on progress) -->
						<span id="total_import">0</span>
						<small class="m-0 l-h-n">Volume RIPH (ton)</small>
					</h3>
				</div>
				<i class="fal fa-balance-scale position-absolute pos-right pos-bottom opacity-40 mb-n1 mr-n1" style="font-size:4rem"></i>
			</div>
		</div>
		<div class="col-md-3">
			<div id="verified" class="p-3 bg-info-300 rounded overflow-hidden position-relative text-white mb-g">
				<a class="position-absolute pos-right pos-top mt-2 mr-2">
					<i class="fal fa-info-circle"></i>
				</a>
				<div class="">
					<h3 class="display-5 d-block l-h-n m-0 fw-500" data-toggle="tooltip" title data-original-title="Luas Komitmen Wajib Tanam dalam satuan hektar yang harus dipenuhi berdasarkan volume RIPH yang dilaporkan oleh Pelaku usaha.">
						<!-- nilai ini diperoleh dari jumlah seluruh pengajuan yang TELAH diverifikasi. where status = 3 & 4 (Verified OK & Verified Perbaikan) -->
						<span id="wajibTanam">0</span>
						<small class="m-0 l-h-n">Komitmen Wajib Tanam (ha)</small>
					</h3>
				</div>
				<i class="fal fa-seedling position-absolute pos-right pos-bottom opacity-40 mb-n1 mr-n1" style="font-size:4rem"></i>
			</div>
		</div>
		<div class="col-md-3">
			<div id="accomplished" class="p-3 bg-success-300 rounded overflow-hidden position-relative text-white mb-g">
				<div class="">
					<h4 class="display-5 d-block l-h-n m-0 fw-500" data-toggle="tooltip" title data-original-title="Volume wajib produksi dalam satuan ton yang harus berdasarkan volume RIPH yang dilaporkan oleh Pelaku Usaha.">
						<!-- nilai ini diperoleh dari jumlah seluruh pengajuan yang TELAH LUNAS. where status = 5 (LUNAS) -->
						<span id="wajibProduksi">0</span>
						<small class="m-0 l-h-n">Komitmen Wajib Produksi (ton)</small>
					</h4>
				</div>
				<i class="fal fa-dolly position-absolute pos-right pos-bottom opacity-40 mb-n1 mr-n1" style="font-size:4rem"></i>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<div class="panel" id="panel-2">
				<div class="panel-hdr">
					<h2>
						<i class="subheader-icon fal fa-seedling mr-1"></i>Komitmen Wajib Tanam
					</h2>
				</div>
				<div class="panel-container show">
					<div class="panel-content">
						<!-- Row -->
						<div class="row mb-3 align-items-center">
							<div class="col-lg-5 col-sm-6 align-self-center text-center">
								<div class="tab-content" id="v-pills-tabContent">
									<div class="tab-pane fade show active" id="real_Tanam" role="tabpanel" aria-labelledby="real_Tanam">
										<div class="c-chart-wrapper">
											<div
												id = "naschartTanam"
												class="js-easy-pie-chart color-success-300 position-relative d-inline-flex align-items-center justify-content-center "
												data-percent="50.00"
												data-piesize="145"
												data-linewidth="10"
												data-linecap="butt"
												data-scalelength="7"
												data-toggle="tooltip"
												title data-original-title="% dari Kewajiban"
												data-placement="bottom">
												<div class="d-flex flex-column align-items-center justify-content-center position-absolute pos-left pos-right pos-top pos-bottom fw-300 fs-xl">
													<span class="fs-xxl fw-500 text-dark"><span id="realisasiTanam">0</span><sup>%</sup></span>
													<!--<span class="display-5 fw-500 js-percent d-block text-dark">97.68</span>-->
												</div>
											</div>
										</div>
									</div>
									<div class="tab-pane fade" id="verif_Tanam" role="tabpanel" aria-labelledby="verif_Tanam">
										<div class="c-chart-wrapper">
											<div
												id="naschartTanamVerif"
												class="js-easy-pie-chart color-primary-500 position-relative d-inline-flex align-items-center justify-content-center"
												data-percent=""
												data-piesize="145"
												data-linewidth="10"
												data-linecap="butt"
												data-scalelength="7"
												data-toggle="tooltip"
												title data-original-title="% dari Kewajiban"
												data-placement="bottom">
												<div class="d-flex flex-column align-items-center justify-content-center position-absolute pos-left pos-right pos-top pos-bottom fw-300 fs-xl">
													<span class="fs-xxl fw-500 text-dark" id="verifTanam">0<sup>%</sup></span>
													<!--<span class="display-3 fw-500 js-percent d-block text-dark">97.68</span>-->
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-7 col-sm-6">
								<nav class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
									<a class="nav-link shadow-1 p-1 btn-block btn-success bg-success-300 rounded overflow-hidden position-relative text-white mb-2 waves-effect waves-themed" id="v-pills-home-tab" data-toggle="pill" href="#real_Tanam" role="tab" aria-controls="v-pills-home" aria-selected="true">
									<div class="">
											<span class="small">Realisasi</span>
											<div class="d-flex">
												<h5 class="d-block l-h-n m-0 fw-500 mr-1" id="total_luastanam">0</h5>
												<span>ha</span>
											</div>
										</div>
										<i class="fal fa-hand-holding-seedling position-absolute pos-right pos-bottom opacity-15 mb-n1 mr-n1" style="font-size:3rem"></i>
									</a>
									<a class="nav-link  shadow-1 p-1 btn-block btn-primary bg-primary-300 rounded overflow-hidden position-relative text-white mb-2 waves-effect waves-themed" id="v-pills-profile-tab" data-toggle="pill" href="#verif_Tanam" role="tab" aria-controls="v-pills-profile" aria-selected="false">
										<div class="">
											<span class="small">Verifikasi</span>
											<div class="d-flex">
												<h5 class="d-block l-h-n m-0 fw-500 mr-1" id="luasverif">0</h5>
												<span>ha</span>
											</div>
										</div>
										<i class="fal fa-hand-holding-seedling position-absolute pos-right pos-bottom opacity-15 mb-n1 mr-n1" style="font-size:3rem"></i>
									</a>
								</nav>
							</div>
						</div>
					</div>
				</div>
				<div class="card-footer">
					<span class="help-block">Total realisasi luas tanam yang dilaporkan oleh Pelaku usaha dan diverifikasi oleh Verifikator</span>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="panel" id="panel-2">
				<div class="panel-hdr">
					<h2>
						<i class="subheader-icon fal fa-seedling mr-1"></i>Wajib Produksi
					</h2>
				</div>
				<div class="panel-container show">
					<div class="panel-content">
						<!-- Row -->
						<div class="row mb-3 align-items-center">
							<div class="col-lg-5 col-sm-6 align-self-center text-center">
								<div class="tab-content" id="v-pills-tabContent">
									<div class="tab-pane fade show active" id="real_Produksi" role="tabpanel" aria-labelledby="real_Produksi">
										<div class="c-chart-wrapper">
											<div
												id = "naschartProduksi"
												class="js-easy-pie-chart color-warning-500 position-relative d-inline-flex align-items-center justify-content-center"
												data-percent="50.00"
												data-piesize="145"
												data-linewidth="10"
												data-linecap="butt"
												data-scalelength="7"
												data-toggle="tooltip"
												title data-original-title=""
												data-placement="bottom">
												<div class="d-flex flex-column align-items-center justify-content-center position-absolute pos-left pos-right pos-top pos-bottom fw-300 fs-xl">
													<span class="fs-xxl fw-500 text-dark"><span id="realisasiProduksi">0</span><sup>%</sup></span>
												</div>
											</div>
										</div>
									</div>
									<div class="tab-pane fade" id="verif_Produksi" role="tabpanel" aria-labelledby="v-pills-profile-tab">
										<div class="c-chart-wrapper">
											<div
												id = "naschartProduksiVerif"
												class="js-easy-pie-chart color-warning-500 position-relative d-inline-flex align-items-center justify-content-center"
												data-percent="50.00"
												data-piesize="145"
												data-linewidth="10"
												data-linecap="butt"
												data-scalelength="7"
												data-toggle="tooltip"
												title data-original-title=""
												data-placement="bottom">
												<div class="d-flex flex-column align-items-center justify-content-center position-absolute pos-left pos-right pos-top pos-bottom fw-300 fs-xl">
													<span class="fs-xxl fw-500 text-dark"><span id="verifProduksi">0</span><sup>%</sup></span>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-7 col-sm-6">
								<nav class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
									<a class="nav-link shadow-1 p-1 btn-block btn-warning bg-warning-300 rounded overflow-hidden position-relative text-white mb-2 waves-effect waves-themed" id="v-pills-home-tab" data-toggle="pill" href="#real_Produksi" role="tab" aria-controls="real_Produksi" aria-selected="true">
									<div class="">
											<span class="small">Realisasi</span>
											<div class="d-flex">
												<h5 class="d-block l-h-n m-0 fw-500 mr-1" id="total_volume">0</h5>
												<span>ton</span>
											</div>
										</div>
										<i class="fal fa-hand-holding-seedling position-absolute pos-right pos-bottom opacity-35 mb-n1 mr-n1" style="font-size:3rem"></i>
									</a>
									<a class="nav-link  shadow-1 p-1 btn-block btn-primary bg-primary-300 rounded overflow-hidden position-relative text-white mb-2 waves-effect waves-themed" id="v-pills-profile-tab" data-toggle="pill" href="#verif_Produksi" role="tab" aria-controls="verif_Produksi" aria-selected="false">
										<div class="">
											<span class="small">Verifikasi</span>
											<div class="d-flex">
												<h5 class="d-block l-h-n m-0 fw-500 mr-1" id="volumeverif"></h5>
												<span>ton</span>
											</div>
										</div>
										<i class="fal fa-hand-holding-seedling position-absolute pos-right pos-bottom opacity-15 mb-n1 mr-n1" style="font-size:3rem"></i>
									</a>
								</nav>
							</div>
						</div>
					</div>
				</div>
				<div class="card-footer">
					<span class="help-block">Total realisasi produksi yang dilaporkan oleh Pelaku usaha dan diverifikasi oleh Verifikator</span>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<div class="panel" id="panel-2">
				<div class="panel-hdr">
					<h2>
						<i class="subheader-icon fal fa-ballot-check mr-1"></i>Daftar <span class="fw-300"><i>Verifikasi</i></span>
					</h2>
					<div class="panel-toolbar">
						@include('layouts.globaltoolbar')
					</div>
				</div>
				<div class="panel-container show">
					<div class="panel-content">
						<div class="row d-flex">
							<div class="col-md-3">
								<div class="shadow-1 p-2 bg-primary-100 rounded overflow-hidden position-relative text-white mb-2">
									{{-- where status != empty --}}
									<div data-toggle="tooltip" title data-original-title="Jumlah Pengajuan Verifikasi Wajib Tanam-Produksi">
										<div class="d-flex">
											<h5 class="d-block l-h-n m-0 fw-500 mr-1" id="ajucommit">0</h5>
											<span>RIPH</span>
										</div>
										<h5 class="d-block l-h-n m-0 fw-500">
											{{-- sum wajib tanam --}}
											0.00 ha
										</h5>
										<span class="small">Pengajuan</span>
									</div>
									<i class="fal fa-download position-absolute pos-right pos-bottom opacity-30 mb-n1 mr-n1" style="font-size:3rem"></i>
								</div>
							</div>
							<div class="col-md-3">
								{{-- where onlinestatus = 1 and onfarmstatus = empty --}}
								<div class="shadow-1 p-2 bg-primary-200 rounded overflow-hidden position-relative text-white mb-2">
									<div data-toggle="tooltip" title data-original-title="Jumlah RIPH yang sedang diverifikasi">
										<div class="d-flex">
											<h5 class="d-block l-h-n m-0 fw-500 mr-1" id="inverifcount">0</h5>
											<span>RIPH</span>
										</div>
										<h5 class="d-block l-h-n m-0 fw-500">
											{{-- sum wajib tanam --}}
											0.00 ha
										</h5>
										<span class="small">Dalam Proses</span>
									</div>
									<i class="fal fa-hourglass position-absolute pos-right pos-bottom opacity-30 mb-n1 mr-n1" style="font-size:3rem"></i>
								</div>
							</div>
							<div class="col-md-3">
								{{-- where onfarmstatus != empty --}}
								<div class="shadow-1 p-2 bg-primary-300 rounded overflow-hidden position-relative text-white mb-2">
									<div data-toggle="tooltip" title data-original-title="Jumlah RIPH yang telah diverifikasi">
										<div class="d-flex">
											<h5 class="d-block l-h-n m-0 fw-500 mr-1" id="verifiedcount">0</h5>
											<span>RIPH</span>
										</div>
										<h5 class="d-block l-h-n m-0 fw-500">
											{{-- sum wajib tanam --}}
											0.00 ha
										</h5>
										<span class="small">Terverifikasi</span>
									</div>
									<i class="fal fa-check-circle position-absolute pos-right pos-bottom opacity-30 mb-n1 mr-n1" style="font-size:3rem"></i>
								</div>
							</div>
							<div class="col-md-3">
								<div class="shadow-1 p-2 bg-primary-500 rounded overflow-hidden position-relative text-white mb-2">
									{{-- where status != empty --}}
									<div data-toggle="tooltip" title data-original-title="Jumlah RIPH Lunas Wajib Tanam-Produksi">
										<div class="d-flex">
											<h5 class="d-block l-h-n m-0 fw-500 mr-1" id="lunas">0</h5>
											<span>RIPH</span>
										</div>
										<h5 class="d-block l-h-n m-0 fw-500">
											{{-- sum wajib tanam --}}
											0.00 ha
										</h5>
										<span class="small">LUNAS</span>
									</div>
									<i class="fal fa-award position-absolute pos-right pos-bottom opacity-30 mb-n1 mr-n1" style="font-size:3rem"></i>
								</div>
							</div>
						</div><hr>
						<table class="table table-bordered table-hover table-sm w-100" id="verifprogress">
							<thead>
								<th>Nomor Pengajuan</th>
								<th>Nama Perusahaan</th>
								<th>Nomor RIPH</th>
								<th>Data</th>
								<th>Lapangan</th>
								<th>Lunas</th>
							</thead>
							<tbody>

							</tbody>
						</table>
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
				}]
			});

			// Create the "Status" select element and add the options
			var selectStatus = $('<select>')
				.attr('id', 'selectverifprogressStatus')
				.addClass('custom-select custom-select-sm col-3 mr-2')
				.on('change', function() {
				var status = $(this).val();
				table.column(6).search(status).draw();
				});

			$('<option>').val('').text('Semua Status').appendTo(selectStatus);
			$('<option>').val('1').text('Sudah Terbit').appendTo(selectStatus);
			$('<option>').val('2').text('Belum Terbit').appendTo(selectStatus);

			// Add the select elements before the first datatable button in the second table
			$('#verifprogress_wrapper .dt-buttons').before(selectStatus);
		});
</script>
<script>
	$(document).ready(function () {
		// Get the largest periodetahun value
		var largestPeriodetahun = Math.max.apply(Math, $('#periodetahun option').map(function () {
			return $(this).val();
		}).get());

		// Set the largest periodetahun as the default selected value
		$('#periodetahun').val(largestPeriodetahun);

		// Trigger the change event on page load
		$('#periodetahun').trigger('change');

		$('#periodetahun').on('change', function () {
			var periodetahun = $(this).val();
			var url = '/api/getApiDashboardDatabyYear/' + periodetahun;

			if (periodetahun == '') return;
			if (periodetahun == 'all') {
				url = '/api/getAPIMonitoringDataAll';
			}

			$.get(url, function (data) {
				$('#total_commit').text(data.total_commit);
				$('#ajucommit').text(data.ajucommit);
				$('#inverifcount').text(data.inverifcount);
				$('#verifiedcount').text(data.verifiedcount);
				$('#lunas').text(data.lunas);
				$('#total_import').text(data.total_import.toLocaleString('en-US'));
				$('#total_poktan').text(data.total_poktan);
				$('#total_volume').text(data.total_volume.toLocaleString('en-US'));
				$('#total_luastanam').text(data.total_luastanam.toLocaleString('en-US'));
				$('#luasverif').text(data.luasverif.toLocaleString('en-US'));
				$('#volumeverif').text(data.volumeverif.toLocaleString('en-US'));

				var wajibProduksi = (data.total_import * 0.05);
				$('#wajibProduksi').text(wajibProduksi.toLocaleString('en-US', { maximumFractionDigits: 2 }));

				var wajibTanam = (data.total_import*0.05/6);
				$('#wajibTanam').text(wajibTanam.toLocaleString('en-US', { maximumFractionDigits: 2 }));
				var realisasiTanam = (data.total_luastanam / (data.total_import*0.05/6)*100);
				$('#realisasiTanam').text(realisasiTanam.toLocaleString('en-US', { maximumFractionDigits: 2 }));
				$('#naschartTanam').attr('data-percent', realisasiTanam);
				$('#naschartTanam').attr('data-original-title', realisasiTanam  + '% dari kewajiban');
				var $chartTanam = $('#naschartTanam');
				$chartTanam.data('easyPieChart').update(realisasiTanam);

				var verifTanam = (data.luasverif / (data.total_import*0.05/6)*100);
				$('#verifTanam').text(verifTanam.toLocaleString('en-US', { maximumFractionDigits: 2 }));
				$('#naschartTanamVerif').attr('data-percent', verifTanam);
				$('#naschartTanamVerif').attr('data-original-title', verifTanam  + '% dari kewajiban');
				var $chartTanam = $('#naschartTanamVerif');
				$chartTanam.data('easyPieChart').update(verifTanam);

				var realisasiProduksi = (data.total_volume / (data.total_import*0.05)*100).toFixed(2);
				$('#realisasiProduksi').text(realisasiProduksi.toLocaleString('en-US', { maximumFractionDigits: 2 }));
				$('#naschartProduksi').attr('data-percent', realisasiProduksi);
				$('#naschartProduksi').attr('data-original-title', realisasiProduksi + '% dari kewajiban');
				var $chartProduksi = $('#naschartProduksi');
				$chartProduksi.data('easyPieChart').update(realisasiProduksi);

				var verifProduksi = (data.volumeverif / (data.total_import*0.05)*100);
				$('#verifProduksi').text(verifProduksi.toLocaleString('en-US', { maximumFractionDigits: 2 }));
				$('#naschartProduksiVerif').attr('data-percent', verifProduksi);
				$('#naschartProduksiVerif').attr('data-original-title', verifProduksi  + '% dari kewajiban');
				var $chartTanam = $('#naschartProduksiVerif');
				$chartTanam.data('easyPieChart').update(verifProduksi);

				// Build table for pengajuanv2s
				var tableBody = $("#verifprogress tbody");
				tableBody.empty(); // Clear previous table data

				$.each(data.pengajuanV2s, function (index, pengajuan) {
					var row = $("<tr></tr>");
					var nomorPengajuan = $("<td></td>").text(pengajuan.no_pengajuan);
					var namaPerusahaan = $("<td></td>").text(pengajuan.commitment.user.data_user.company_name);
					var nomorRIPH = $("<td></td>").text(pengajuan.no_ijin);
					// var dataCell = $("<td></td>").text(pengajuan.onlinestatus);

					var dataCell = $('<td class="text-center"></td>').html(function() {
						if (!pengajuan.status) {
							return '<span class="badge badge-xs badge-warning"><i class="fal fa-exclamation-circle mr-1"></i>Belum diajukan</span>';
						} else if (!pengajuan.onlinestatus) {
							return '<span class="badge badge-xs badge-primary"><i class="fal fa-check-circle mr-1"></i>Diajukan</span>';
						} else if (pengajuan.onlinestatus === '1') {
							return '<span class="badge badge-xs badge-success"><i class="fal fa-check-circle mr-1"></i>Selesai</span>';
						} else if (pengajuan.onlinestatus === '2') {
							return '<span class="badge badge-xs badge-danger"><i class="fal fa-ban mr-1"></i>Tidak Sesuai</span>';
						}
					});

					// var lapanganCell = $("<td></td>").text(pengajuan.onfarmstatus);

					var lapanganCell = $('<td class="text-center"></td>').html(function() {
							if (!pengajuan.status && !pengajuan.onlinestatus && !pengajuan.onfarmstatus) {
								return '<span class="badge badge-xs badge-warning"><i class="fal fa-exclamation-circle mr-1"></i>Belum diajukan</span>';
							} else if (pengajuan.status && !pengajuan.onlinestatus && !pengajuan.onfarmstatus) {
								return '<span class="badge badge-xs badge-info"><i class="fal fa-hourglass mr-1"></i>Menunggu</span>';
							} else if (pengajuan.status && pengajuan.onlinestatus === '1' && !pengajuan.onfarmstatus) {
								return '<span class="badge badge-xs badge-info"><i class="fal fa-hourglass mr-1"></i>Menunggu</span>';
							} else if (pengajuan.status && pengajuan.onlinestatus === '2' && !pengajuan.onfarmstatus) {
								return '<span class="badge badge-xs badge-secondary"><i class="fal fa-times-circle mr-1"></i>Batal Periksa</span>';
							} else if (pengajuan.status && pengajuan.onlinestatus === '1' && pengajuan.onfarmstatus === '1') {
								return '<span class="badge badge-xs badge-success"><i class="fal fa-check-circle mr-1"></i>Selesai</span>';
							} else if (pengajuan.status && pengajuan.onlinestatus === '1' && pengajuan.onfarmstatus === '2') {
								return '<span class="badge badge-xs badge-danger"><i class="fal fa-ban mr-1"></i>Tidak Sesuai</span>';
							}
						});

					// var lunasCell = $("<td></td>").text(pengajuan.status); // Update with appropriate data

					var lunasCell = $('<td></td>').html(function() {
							if (!pengajuan.status && !pengajuan.onlinestatus && !pengajuan.onfarmstatus) {
								return '<span class="badge badge-xs badge-warning"><i class="fal fa-exclamation-circle mr-1"></i>Belum diajukan</span>';
							} else if (pengajuan.status && pengajuan.onlinestatus === '2' && !pengajuan.onfarmstatus) {
								return '<span class="badge badge-xs badge-secondary"><i class="fal fa-times-circle mr-1"></i>Batal Periksa</span>';
							} else if (pengajuan.status === '6' && pengajuan.onlinestatus === '1' && pengajuan.onfarmstatus === '1') {
								return '<span class="badge badge-xs badge-success"><i class="fal fa-file-certificate mr-1"></i>SKL Terbit</span>';
							} else if (pengajuan.onlinestatus === '1' && pengajuan.onfarmstatus === '2') {
								return '<span class="badge badge-xs badge-secondary"><i class="fal fa-times-circle mr-1"></i>Batal Periksa</span>';
							} else {
								return '<span class="badge badge-xs badge-info"><i class="fal fa-hourglass mr-1"></i>Menunggu</span>';
							}
						});

					row.append(nomorPengajuan, namaPerusahaan, nomorRIPH, dataCell, lapanganCell, lunasCell);
					tableBody.append(row);
				});
			});
		});
	});
</script>

@endsection
