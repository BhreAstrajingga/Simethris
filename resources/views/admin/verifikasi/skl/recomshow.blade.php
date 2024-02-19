@extends('layouts.admin')
@section ('styles')
<style>
	/* Remove outer border from the entire DataTable */
	.dataTables_wrapper {
		border: none;
	}

	/* Remove cell borders within the DataTable */
	table.dataTable td,
	table.dataTable th {
		border: none;
	}

	/* Remove the header border */
	table.dataTable thead th {
		border-bottom: none;
	}

	/* Remove the footer border (if applicable) */
	table.dataTable tfoot th {
		border-top: none;
	}
</style>
@endsection
@section('content')
{{-- @include('partials.breadcrumb') --}}
	@include('partials.subheader')
	@include('partials.sysalert')
	{{-- @can('skl_access') --}}
		@php
			$npwp = str_replace(['.', '-'], '', $commitment->npwp);
		@endphp
		<div class="row">
			<div class="col-12">
				<div class="text-center">
					<i class="fal fa-badge-check fa-3x subheader-icon"></i>
					<h2 class="display-5 d-block l-h-n m-0 fw-500 mb-2">{{$importir->company_name}}</h2>
					<div class="row justify-content-center">
						<p class="lead">Penanggungjawab: {{$importir->name}}</p>
					</div>
				</div>
				<div id="panel-1" class="panel">
					<div class="panel-container show">
						<div class="panel-content">
							<table class="table table-hover table-sm w-100" style="border: none; border-top:none; border-bottom:none;" id="dataSummary">
								<thead>
									<th  style="width: 32%"> </th>
									<th style="width: 1%"> </th>
									<th> </th>
								</thead>
								<tbody>
									<tr>
										<td class="text-uppercase fw-500 h6">
											Ringkasan Umum
										</td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td class="text-muted">Perusahaan</td>
										<td>:</td>
										<td class="fw-500" id="company">
										</td>
									</tr>
									<tr>
										<td class="text-muted">Nomor Ijin (RIPH)</td>
										<td>:</td>
										<td class="fw-500" id="noIjin">
										</td>
									</tr>
									<tr>
										<td class="text-muted">Periode</td>
										<td>:</td>
										<td class="fw-500" id="periode">
										</td>
									</tr>
									<tr class="bg-primary-50" style="height: 20px; opacity: 0.15">
										<td></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td class="text-uppercase fw-500 h6">
											Ringkasan Kewajiban dan Realisasi
										</td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td class="text-muted">Luas Wajib Tanam</td>
										<td>:</td>
										<td class="fw-500" id="wajibTanam">
										</td>
									</tr>
									<tr>
										<td class="text-muted">Realisasi Tanam</td>
										<td>:</td>
										<td class="fw-500" id="realisasiTanam">
										</td>
									</tr>
									<tr>
										<td class="text-muted">Jumlah Lokasi Tanam/Spasial</td>
										<td>:</td>
										<td class="fw-500" id="hasGeoloc">
										</td>
									</tr>
									<tr>
										<td class="text-muted">Volume Wajib Produksi</td>
										<td>:</td>
										<td class="fw-500" id="wajibProduksi">
										</td>
									</tr>
									<tr>
										<td class="text-muted">Realisasi Tanam</td>
										<td>:</td>
										<td class="fw-500" id="realisasiProduksi">
										</td>
									</tr>
									<tr class="bg-primary-50" style="height: 20px; opacity: 0.15">
										<td></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td class="text-uppercase fw-500 h6">
											Ringkasan Kemitraan
										</td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td class="text-muted">Jumlah Kelompok Tani Mitra</td>
										<td>:</td>
										<td class="fw-500" id="countPoktan">
										</td>
									</tr>
									<tr>
										<td class="text-muted">Jumlah Anggota Kelompok Tani Mitra</td>
										<td>:</td>
										<td class="fw-500" id="countAnggota">
										</td>
									</tr>
									<tr>
										<td class="text-muted">Jumlah Perjanjian (PKS) diunggah</td>
										<td>:</td>
										<td class="fw-500" id="countPks">
										</td>
									</tr>
									<tr class="bg-primary-50" style="height: 20px; opacity: 0.15">
										<td></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td class="text-uppercase fw-500 h6">
											Ringkasan Hasil Verifikasi
										</td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td class="text-uppercase fw-500">A. VERIFIKASI TANAM</td>
										<td>:</td>
										<td class="fw-500" id=""></td>
									</tr>
									<tr>
										<td class="text-muted pl-4">Nota Dinas Verifikasi Tanam</td>
										<td>:</td>
										<td class="fw-500" id="ndhprt"></td>
									</tr>
									<tr>
										<td class="text-muted pl-4">Berita Acara Pemeriksaan Tanam</td>
										<td>:</td>
										<td class="fw-500" id="batanam"></td>
									</tr>
									<tr>
										<td class="text-muted pl-4">Tanggal Pengajuan</td>
										<td>:</td>
										<td class="fw-500" id="avtDate"></td>
									</tr>
									<tr>
										<td class="text-muted pl-4">Tanggal Pemeriksaan</td>
										<td>:</td>
										<td class="fw-500" id="avtVerifAt"></td>
									</tr>
									<tr>
										<td class="text-muted pl-4">Metode Pemeriksaan</td>
										<td>:</td>
										<td class="fw-500" id="avtMetode"></td>
									</tr>
									<tr>
										<td class="text-muted pl-4">Catatan Pemeriksaan</td>
										<td>:</td>
										<td class="fw-500" id="avtNote"></td>
									</tr>
									<tr>
										<td class="text-muted pl-4">Hasil Pemeriksaan (Status)</td>
										<td>:</td>
										<td class="fw-500" id="avtStatus"></td>
									</tr>
									<tr>
										<td class="text-uppercase fw-500">B. VERIFIKASI PRODUKSI</td>
										<td>:</td>
										<td class="fw-500" id=""></td>
									</tr>
									<tr>
										<td class="text-muted pl-4">Nota Dinas Verifikasi Produksi</td>
										<td>:</td>
										<td class="fw-500" id="ndhprp"></td>
									</tr>
									<tr>
										<td class="text-muted pl-4">Berita Acara Pemeriksaan Produksi</td>
										<td>:</td>
										<td class="fw-500" id="baproduksi"></td>
									</tr>
									<tr>
										<td class="text-muted pl-4">Tanggal Pengajuan</td>
										<td>:</td>
										<td class="fw-500" id="avpDate"></td>
									</tr>
									<tr>
										<td class="text-muted pl-4">Tanggal Pemeriksaan</td>
										<td>:</td>
										<td class="fw-500" id="avpVerifAt"></td>
									</tr>
									<tr>
										<td class="text-muted pl-4">Metode Pemeriksaan</td>
										<td>:</td>
										<td class="fw-500" id="avpMetode"></td>
									</tr>
									<tr>
										<td class="text-muted pl-4">Catatan Pemeriksaan</td>
										<td>:</td>
										<td class="fw-500" id="avpNote"></td>
									</tr>
									<tr>
										<td class="text-muted pl-4">Hasil Pemeriksaan (Status)</td>
										<td>:</td>
										<td class="fw-500" id="avpStatus"></td>
									</tr>
									<tr>
										<td class="text-uppercase fw-500">C. PENERBITAN SKL</td>
										<td>:</td>
										<td class="fw-500" id=""></td>
									</tr>
									<tr>
										<td class="text-muted pl-4">Tanggal Pengajuan</td>
										<td>:</td>
										<td class="fw-500" id="avsklDate"></td>
									</tr>
									<tr>
										<td class="text-muted pl-4">Tanggal Rekomendasi</td>
										<td>:</td>
										<td class="fw-500" id="avsklVerifAt"></td>
									</tr>
									<tr>
										<td class="text-muted pl-4">Direkomendasikan Oleh</td>
										<td>:</td>
										<td class="fw-500" id="submitBy"></td>
									</tr>
									<tr>
										<td class="text-muted pl-4">Nomor SKL</td>
										<td>:</td>
										<td class="fw-500" id="noSkl"></td>
									</tr>
									<tr>
										<td class="text-muted pl-4">Tanggal Terbit</td>
										<td>:</td>
										<td class="fw-500" id="publishedDate"></td>
									</tr>
									<tr>
										<td class="text-muted pl-4">Catatan Pemeriksaan</td>
										<td>:</td>
										<td class="fw-500" id="avsklNote"></td>
									</tr>
									<tr>
										<td class="text-muted pl-4">Tanggal Disetujui</td>
										<td>:</td>
										<td class="fw-500" id="approvedAt"></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<div class="card-footer d-flex justify-content-between">
						<div> </div>
						<div class="ml-auto">
							<a class="btn btn-sm btn-info" href="{{route('verification.skl.recomendations')}}" role="button"><i class="fal fa-undo text-align-center mr-1"></i> Kembali</a>
							@if (empty($skl->skl_upload))
								<a class="btn btn-sm btn-danger" href="{{route('verification.skl.recomendation.draft', $skl->id)}}" role="button"><i class="fal fa-file-certificate text-align-center mr-1"></i> Lihat Draft SKL</a>
							@else
								<a class="btn btn-sm btn-info" href="{{route('verification.skl.recomendation.draft', $skl->id)}}" role="button"><i class="fal fa-award text-align-center mr-1"></i> Lihat SKL</a>
							@endif
						</div>
					</div>
				</div>
			</div>
		</div>

		{{-- modal view doc --}}
		<div class="modal fade" id="viewDocs" tabindex="-1" role="dialog" aria-labelledby="document" aria-hidden="true">
			<div class="modal-dialog modal-dialog-right" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">
							Berkas <span class="fw-300"><i>lampiran </i></span>
						</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body embed-responsive embed-responsive-16by9">
						<iframe class="embed-responsive-item" src="" width="100%"  frameborder="0"></iframe>
					</div>
				</div>
			</div>
		</div>
	{{-- @endcan --}}
@endsection

@section('scripts')
@parent
<script>
	$(document).ready(function() {
		$('#viewDocs').on('shown.bs.modal', function (e) {
			var docUrl = $(e.relatedTarget).data('doc');
			$('iframe').attr('src', docUrl);
		});

		$('#dataSummary').DataTable({
			responsive: true,
			"ordering": false,
			lengthChange: false,
			pageLength: -1,
			dom:
			"<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'B>>" +
			"<'row'<'col-sm-12'tr>>" +
			"<'row'<'col-sm-12 col-md-5'><'col-sm-12 col-md-7'>>",
			buttons: [
				{
					extend: 'excelHtml5',
					text: '<i class="fa fa-file-excel"></i>',
					titleAttr: 'Ekspor data ke MS. Excel',
					className: 'btn-outline-success btn-xs btn-icon ml-3 mr-1'
				},
				{
					extend: 'print',
					text: '<i class="fa fa-print"></i>',
					titleAttr: 'Cetak halaman data.',
					className: 'btn-outline-primary btn-xs btn-icon mr-1'
				},
				@if(empty($skl->skl_upload))
					{
						text: '<i class="fal fa-file-certificate mr-1"></i> Lihat Draft',
						titleAttr: 'Lihat Draft SKL',
						className: 'btn btn-info btn-xs',
						action: function () {
							// Replace 'to_somewhere' with your actual route and $key->id with the parameter value
							window.location.href = '{{route('verification.skl.recomendation.draft', $skl->id)}}';
						}
					},
				@endif
			],
		});

		$.ajax({
			url: '{{ route("verification.data.summary", $verifikasi->id) }}',
			type: 'GET',
			dataType: 'json',
			success: function (data) {
				$("#company").text(data.company);
				$("#npwp").text(data.npwp);
				$("#noIjin").text(data.noIjin);
				$("#countPoktan").text(data.countPoktan + ' Kelompok');
				$("#countPks").text(data.countPks + ' berkas');
				$("#countAnggota").text(data.countAnggota + ' anggota');
				$("#avtDate").text(data.avtDate);
				$("#avtVerifAt").text(data.avtVerifAt);
				$("#avtMetode").text(data.avtMetode);
				$("#avtNote").text(data.avtNote);

				$("#avpDate").text(data.avpDate);
				$("#avpVerifAt").text(data.avpVerifAt);
				$("#avpMetode").text(data.avpMetode);
				$("#avpNote").text(data.avpNote);

				$("#avsklDate").text(data.avsklDate);
				$("#avsklVerifAt").text(data.avsklVerifAt);
				$("#avsklMetode").text(data.avsklMetode);
				$("#avsklNote").text(data.avsklNote);
				$('#noSkl').text(data.noSkl);
				$('#publishedDate').text(data.publishedDate);
				// Assuming data.approvedAt is a valid date string, for example, '2023-10-27'
				if (data.approvedAt === null) {
					$('#approvedAt').text('Belum disetujui');
				} else {
					var date = new Date(data.approvedAt);
					var formattedDate = date.getDate() + '-' + (date.getMonth() + 1) + '-' + date.getFullYear();
					$('#approvedAt').text(formattedDate);
				}
				$('#submitBy').text(data.submitBy);

				var formattedPeriode = 'Tahun ' + (data.periode);
				$("#periode").text(formattedPeriode);

				var formattedWajibTanam = parseFloat(data.wajibTanam).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,') + ' ha';
				var formattedRealisasiTanam = parseFloat(data.realisasiTanam).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,') + ' ha';
				var formattedWajibProduksi = parseFloat(data.wajibProduksi).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,') + ' ton';
				var formattedRealisasiProduksi = parseFloat(data.realisasiProduksi).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,') + ' ton';
				var formattedHasGeoLoc = parseFloat(data.hasGeoloc).toFixed(0).replace(/\d(?=(\d{3})+\.)/g, '$&,') + ' titik';

				if (data.ndhprt === null){
					var ndTanam = '';
				}else if(data.ndhprt !== null){
					var ndTanam = data.ndhprt;
				}

				if (data.batanam === null){
					var baTanam = '';
				}else if(data.batanam !== null){
					var baTanam = data.batanam;
				}

				$("#ndhprt").html('<a href="#" data-toggle="modal" data-target="#viewDocs" data-doc="' + data.ndhprtLink + '">' + ndTanam + '</a>');
				$("#batanam").html('<a href="#" data-toggle="modal" data-target="#viewDocs" data-doc="' + data.batanamLink + '">' + baTanam + '</a>');
				$("#ndhprp").html('<a href="#" data-toggle="modal" data-target="#viewDocs" data-doc="' + data.ndhprpLink + '">' + data.ndhprp + '</a>');
				$("#baproduksi").html('<a href="#" data-toggle="modal" data-target="#viewDocs" data-doc="' + data.baproduksiLink + '">' + data.baproduksi + '</a>');

				$("#ndhpskl").html('<a href="#" data-toggle="modal" data-target="#viewDocs" data-doc="' + data.ndhpsklLink + '">' + data.ndhpskl + '</a>');
				$("#baskls").html('<a href="#" data-toggle="modal" data-target="#viewDocs" data-doc="' + data.basklsLink + '">' + data.baskls + '</a>');

				$("#wajibTanam").text(formattedWajibTanam);
				$("#realisasiTanam").text(formattedRealisasiTanam);
				$("#wajibProduksi").text(formattedWajibProduksi);
				$("#realisasiProduksi").text(formattedRealisasiProduksi);
				$("#hasGeoloc").text(formattedHasGeoLoc);

				if (data.avtStatus === null) {
					// Handle case when avtStatus doesn't match any of the above conditions
					$("#avtStatus").text('Belum/Tidak mengajuka verifikasi').addClass("text-danger text-uppercase fw-500").append('<i class="fas fa-times ml-1"></i>');
				} else if (data.avtStatus === '1' || data.avtStatus === '2' || data.avtStatus === '3') {
					$("#avtStatus").text('Belum memenuhi syarat').addClass("text-danger text-uppercase fw-500").append('<i class="fas fa-times ml-1"></i>');
				} else if (data.avtStatus === '4') {
					$("#avtStatus").text('Memenuhi Syarat').addClass("text-success text-uppercase fw-500").append('<i class="fas fa-check ml-1"></i>');
				} else {
					// Handle case when avtStatus doesn't match any of the above conditions
					$("#avtStatus").text('Belum memenuhi syarat').addClass("text-danger text-uppercase fw-500").append('<i class="fas fa-times ml-1"></i>');
				}

				if (data.avpStatus === '1' || data.avpStatus === '2' || data.avpStatus === '3') {
					$("#avpStatus").text('Belum memenuhi syarat').addClass("text-danger text-uppercase fw-500").append('<i class="fas fa-times ml-1"></i>');
				} else if (data.avpStatus === '4') {
					$("#avpStatus").text('Memenuhi Syarat').addClass("text-success text-uppercase fw-500").append('<i class="fas fa-check ml-1"></i>');
				} else {
					// Handle case when avpStatus doesn't match any of the above conditions
					$("#avpStatus").text('Belum memenuhi syarat').addClass("text-danger text-uppercase fw-500").append('<i class="fas fa-times ml-1"></i>');
				}

				if (data.avsklStatus === '2') {
					$("#btnSubmit").prop("disabled", false).removeClass("btn-default").addClass("btn-primary").append('<i class="fas fa-check ml-1"></i>');
				} else if (data.avsklStatus === '4') {
					$("#btnSubmit").prop("disabled", false).removeClass("btn-default").addClass("btn-primary").append('<i class="fas fa-check ml-1"></i>');
				} else {
					$("#btnSubmit").prop("disabled", true).removeClass("btn-primary").addClass("btn-default");
				}

				if (parseFloat(data.wajibTanam) > parseFloat(data.realisasiTanam)) {
					$("#realisasiTanam").removeClass("text-success").addClass("text-warning").append('<i class="fa fa-exclamation-circle ml-1"></i>');
				} else {
					$("#realisasiTanam").removeClass("text-warning").addClass("text-success").append('<i class="fas fa-check ml-1"></i>');
				}

				if (parseFloat(data.wajibProduksi) > parseFloat(data.realisasiProduksi)) {
					$("#realisasiProduksi").removeClass("text-success").addClass("text-danger").append('<i class="fas fa-exclamation-circle ml-1"></i>');
				} else {
					$("#realisasiProduksi").removeClass("text-danger").addClass("text-success").append('<i class="fas fa-check ml-1"></i>');
				}
			},
			error: function (xhr, status, error) {
				console.error(xhr.responseText);
			}
		});
	});
</script>
@endsection
