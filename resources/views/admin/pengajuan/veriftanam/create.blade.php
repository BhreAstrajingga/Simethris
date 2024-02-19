@extends('layouts.admin')
@section('styles')
<style>
	a {
		text-decoration: none !important;
	}
</style>
@endsection
@section('content')
{{-- @include('partials.breadcrumb') --}}
@include('partials.subheader')

@can('pengajuan_create')
@php
	$npwp = str_replace(['.', '-'], '', $commitment->npwp);
@endphp
<div class="row">
	<div class="col-12">
		<div class="text-center">
			<i class="fal fa-badge-check fa-3x subheader-icon"></i>
			<h2>Ringkasan Data</h2>
			<div class="row justify-content-center">
				<p class="lead">Ringkasan data pengajuan verifikasi tanam.</p>
			</div>
		</div>
		<div class="panel" id="panel-1">
			<div class="panel-container card-header show">
				<div class="row d-flex justify-content-between">
					<div class="form-group col-md-4">
						<label class="form-label" for="no_ijin">Nomor RIPH</label>
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text">
									<i class="fal fa-file-invoice"></i>
								</span>
							</div>
							<input type="text" class="form-control form-control-sm bg-white" id="no_ijin" value="{{$commitment->no_ijin}}" disabled="">
						</div>
						<span class="help-block">Nomor Ijin RIPH.</span>
					</div>
					<div class="form-group col-md-4">
						<label class="form-label" for="no_hs">Komoditas</label>
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text">
									<i class="fal fa-file-invoice"></i>
								</span>
							</div>
							<input type="text" class="form-control form-control-sm bg-white" id="no_ijin" value="{{$commitment->no_hs}}" disabled="">
						</div>
						<span class="help-block">Kode dan nama Komoditas Produk import.</span>
					</div>
					<div class="form-group col-md-2 col-sm-6">
						<label class="form-label" for="tgl_ijin">Tanggal Ijin</label>
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text">
									<i class="fal fa-calendar-day"></i>
								</span>
							</div>
							<input type="text" class="form-control form-control-sm bg-white" id="tgl_ijin" value="{{ date('d-m-Y', strtotime($commitment->tgl_ijin)) }}" disabled="">
						</div>
						<span class="help-block">Tanggal mulai berlaku.</span>
					</div>
					<div class="form-group col-md-2 col-sm-6">
						<label class="form-label" for="tgl_akhir">Tanggal Berakhir</label>
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text">
									<i class="fal fa-calendar-day"></i>
								</span>
							</div>
							<input type="text" class="form-control form-control-sm bg-white" id="tgl_akhir" value="{{ date('d-m-Y', strtotime($commitment->tgl_akhir)) }}" disabled="">
						</div>
						<span class="help-block">Tanggal berakhir RIPH.</span>
					</div>
				</div>
			</div>
			<div class="panel-container show">
				<div class="panel-content">
					<table class="table table-striped table-bordered w-100" id="mainCheck">
						<thead>
							<th class="text-muted text-uppercase">Data</th>
							<th class="text-muted text-uppercase">Kewajiban</th>
							<th class="text-muted text-uppercase">Realisasi</th>
							<th class="text-muted text-uppercase">Status</th>
						</thead>
						<tbody>
							<tr>
								<td class="text-muted">
									<span class="fw-700 h6">Komitmen Wajib Tanam</span><br>
									<span class="help-block">Komitmen wajib tanam yang telah dipenuhi hingga saat ini</span>
								</td>
								<td class="text-right">
									{{ number_format($commitment->luas_wajib_tanam, 2) }} ha
								</td>
								<td class="text-right">
									{{ number_format($total_luastanam, 2) }} ha
								</td>
								<td>
									@if ($total_luastanam >= $commitment->luas_wajib_tanam)
										<i class="fas fa-check text-success"></i>
										<i>Terpenuhi</i>
									@else
										<i class="fa fa-exclamation-circle text-warning"></i>
										<i>Kurang</i>
									@endif
								</td>
							</tr>
							<tr>
								<td class="text-muted">
									<span class="fw-700 h6">Kelompok Tani & PKS</span><br>
									<span class="help-block">Jumlah kelompok tani yang didaftarkan pada aplikasi SIAPRIPH.</span>
								</td>
								<td class="text-right">
									{{ $countPoktan }} Poktan
								</td>
								<td class="text-right">
									{{ $countPks }} PKS
								</td>
								<td>
									@if ($countPks == $countPoktan)
										<i class="fas fa-check text-success"></i>
										<i>Sesuai</i>
									@else
										<i class="fa fa-exclamation-circle text-warning"></i>
										<i>Tidak Sesuai</i>
									@endif
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div id="panel-3" class="panel">
			<div class="panel-hdr">
				<h2>Data Perjanjian Kerjasama</h2>
				<div class="panel-toolbar">
					<span class="help-block">Perjanjian Kerjasama Kemitraan antara Importir dengan Kelompoktani Mitra</span>
				</div>
			</div>
			<div class="panel-container show">
				<div class="panel-content">
					<table id="pksCheck" class="table table-bordered table-striped w-100">
						<thead class="card-header">
							<tr>
								<th class="text-uppercase text-muted">Perjanjian</th>
								<th class="text-uppercase text-muted">Kelompoktani</th>
								<th class="text-uppercase text-muted">Tanggal Mulai</th>
								<th class="text-uppercase text-muted">Tanggal Akhir</th>
								<th class="text-uppercase text-muted">Dokumen</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($commitment->pks as $pksmitra)
							<tr>
								<td>{{$pksmitra->no_perjanjian}}</td>
								<td>{{$pksmitra->masterpoktan->nama_kelompok}}</td>
								<td>{{$pksmitra->tgl_perjanjian_start}}</td>
								<td>{{$pksmitra->tgl_perjanjian_end}}</td>
								<td>
									@if($pksmitra->berkas_pks)
										<a href="#" data-toggle="modal" data-target="#viewDocs"
											data-doc="{{ url('storage/uploads/'. $npwp . '/' . $commitment->periodetahun .'/'. $pksmitra->berkas_pks) }}">
											<i class="fas fa-check text-success mr-1"></i>
											Lihat Dokumen
										</a>
									@else
										<span class="text-danger"><i class="fas fa-times-circle mr-1"></i>Tidak Ada</span>
									@endif
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div id="panel-4" class="panel">
			<div class="panel-hdr">
				<h2>Data Lokasi Tanam</h2>
				<div class="panel-toolbar">
					<span class="help-block">Lokasi Tanam dan Volume Produksi.</span>
				</div>
			</div>
			<div class="panel-container show">
				<div class="panel-content">
					<table id="lokasi-table" class="table table-sm table-bordered table-striped w-100">
						<thead>
							<tr>
								<th>Kelompoktani</th>
								<th hidden>ID</th>
								<th>Nama Lokasi</th>
								<th hidden>Anggota Id</th>
								<th>Pengelola</th>
								<th class="text-center">Luas Tanam</th>
								<th class="text-center" hidden>Produksi</th>
								<th>Data Spasial</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
		<div id="panel-5" class="panel">
			<form action="{{route('admin.task.commitment.avt.store', $commitment->id)}}" method="post" enctype="multipart/form-data">
				@csrf
				<div class="card-footer text-right">
					<a href="javascript:void(0);" class="btn btn-sm btn-default" onclick="cancelBtn();" >
						<i class="fas fa-undo text-align-center mr-1"></i> Batalkan
					</a>
					<button class="btn btn-sm btn-primary" type="submit">
						<i class="fas fa-upload text-align-center mr-1"></i> Ajukan
					</button>
				</div>
			</form>
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

@endcan
@endsection

@section('scripts')
@parent
<script>
	$(document).ready(function() {
		$('#viewDocs').on('shown.bs.modal', function (e) {
			var docUrl = $(e.relatedTarget).data('doc');
			$('iframe').attr('src', docUrl);
		});
	});
</script>

<script>
	$(document).ready(function() {
		$('#mainCheck').dataTable(
			{
			responsive: true,
			lengthChange: false,
			order:[],
			dom:
				"<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'>>" +
				"<'row'<'col-sm-12'tr>>" +
				"<'row'<'col-sm-12 col-md-5'><'col-sm-12 col-md-7'>>",

		});

		$('#attchCheck').dataTable(
			{
			responsive: true,
			lengthChange: false,
			order:[],
			dom:
				"<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'f><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'lB>>" +
				"<'row'<'col-sm-12'tr>>" +
				"<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'>>",
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
				}
			]
		});

		$('#pksCheck').dataTable(
			{
			responsive: true,
			lengthChange: false,
			order:[],
			dom:
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
				}
			]
		});
		function handleInitComplete() {
			var dataTable = this.api();

			// Get the unique values of the "nama_kelompok" column
			var uniqueValues = dataTable.column(0, { search: 'applied' }).data().unique();

			// Create the select element and add the options
			var select = $('<select>')
				.addClass('custom-select custom-select-sm col-3 mr-2')
				.on('change', function () {
					var kelompok = $.fn.dataTable.util.escapeRegex($(this).val());
					dataTable.column(0).search(kelompok ? '^' + kelompok + '$' : '', true, false).draw();
				});

			// Add the default "Semua Kelompoktani" option
			$('<option>').val('').text('Semua Kelompoktani').appendTo(select);

			// Add options for each unique value
			uniqueValues.each(function (value) {
				$('<option>').val(value).text(value).appendTo(select);
			});

			// Find the target DataTable's container element
			var targetTableContainer = $('#lokasi-table_wrapper'); // Replace with the ID or class of the target DataTable's container

			// Remove any existing select element in the target table container
			targetTableContainer.find('.custom-select.select-filter').remove();

			// Add the select element before the first datatable button in the target table container
			targetTableContainer.find('.dt-buttons').before(select.addClass('select-filter'));
		}


		var lokasiTable = $('#lokasi-table').DataTable({
			processing: true,
			serverSide: true,
			responsive: true,
			ajax: {
				url: "{{ route('admin.task.commitment.avt.lokasi', $commitment->id) }}",
				type: "GET",
			},
			columns: [
				{ data: 'nama_kelompok', name: 'nama_kelompok' },
				// { data: 'id', name: 'id' },
				{ data: 'nama_lokasi', name: 'nama_lokasi' },
				// { data: 'anggota_id', name: 'anggota_id' },
				{ data: 'nama_petani', name: 'nama_petani' },
				{ data: 'luas_tanam', name: 'luas_tanam', class: 'text-right',
					render: function(data, type, row) {
						return data + ' ha';
					}
				},
				// { data: 'volume', name: 'volume', class: 'text-right',
				// 	render: function(data, type, row) {
				// 		return data + ' ton';
				// 	}
				// },
				{ data: 'data_geolokasi', name: 'data_geolokasi' }
			],
			rowGroup: {
				dataSrc: 'nama_kelompok'
			},
			dom:
			"<'row'<'col-sm-12 col-md-6'><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'<'select'>>>" + // Move the select element to the left of the datatable buttons
				"<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'fl><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'B>>" +
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
			],
			initComplete: handleInitComplete
		});
	});
</script>

<script>
	function validateInput() {
		// get the input value and the current username from the page
		var inputVal = document.getElementById('validasi').value;
		var currentUsername = '{{ Auth::user()->username }}';

		// check if the input is not empty and matches the current username
		if (inputVal !== '' && inputVal === currentUsername) {
			return true; // allow form submission
		} else {
			alert('Input validasi harus diisi dan bernilai sama dengan username Anda.');
			return false; // prevent form submission
		}
	}

	//back button
	function cancelBtn() {
		history.go(-1);
	}
</script>

@endsection
