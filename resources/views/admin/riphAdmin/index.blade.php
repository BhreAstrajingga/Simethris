@extends('layouts.admin')
@section('content')
{{-- @include('partials.breadcrumb') --}}
@include('partials.subheader')
@include('partials.sysalert')
@can('master_riph_access')
<div class="row">
	<div class="col-md-12">
		<form action="{{route('admin.riphAdmin.storefetched')}}" method="post">
			@csrf
			<div class="row align-items-center">
				<div class="form-group col-md-2">
					<label for="" class="col-form-label mr-2">Status:</label>
					<span id="keterangan"></span>
					<input type="text" id="status" name="status" hidden>
				</div>
				<div class="col-md-10">
					<div class="row">
						<div class="form-group col-md-4">
							<label for="">Jumlah RIPH/Perusahaan</label>
							<input type="text" name="importir" id="jumlahPT" class="form-control" placeholder="" aria-describedby="helpId" readonly>
							<small id="helpId" class="text-muted">Help text</small>
						</div>
						<div class="form-group col-md-4">
							<label for="">Total Volume RIPH</label>
							<input type="text" name="volumeRIPH" id="volumeRIPH" class="form-control" placeholder="" aria-describedby="helpId" readonly>
							<small id="helpId" class="text-muted">Help text</small>
						</div>
						<div class="form-group col-md-4">
							<label for="">Pilih Tahun</label>
							<div class="input-group">
								<input id="periodetahun" name="periode" type="text" class="form-control custom-select yearpicker" placeholder="Pilih Tahun" aria-label="Pilih tahun" aria-describedby="basic-addon2">
								<div class="input-group-append">
									<button class="btn btn-primary btn-sm" type="button" id="fetchDataButton" data-toggle="collapse" data-target="#responseData" title="Cari data">
										<i class="fal fa-search"></i></button>
									</button>
									<button class="btn btn-warning btn-sm" title="Simpan data" type="submit">
										<i class="fal fa-save"></i></button>
									</button>
								</div>
							</div>
							<small id="helpId" class="text-muted">Help text</small>
						</div>
					</div>
				</div>
			</div>
		</form>
		<div id="panel-1" class="panel">
			<div class="panel-container show">
				<div class="panel-content">
					<table id="riphList" class="table table-sm table-bordered table-hover table-striped w-100">
						<thead>
							<tr>
								<th>Periode</th>
								<th>Tanggal Update</th>
								<th>Total Vol. RIPH</th>
								<th>Komitmen Tanam (ha)</th>
								<th>Komitmen Produksi (ton)</th>
								<th>Jumlah RIPH</th>
								<th>Jumlah Importir</th>
								<th>Tindakan</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($riph_admin as $riph )
								<tr>
									<td>{{ $riph->periode }}</td>
									<td>{{ $riph->updated_at->format('d/m/Y') }}</td>
									<td>{{ number_format($riph->v_pengajuan_import, 0, ',', '.') }}</td>
									<td>{{ number_format($riph->v_pengajuan_import*0.05/6, 0, ',', '.') }}</td>
									<td>{{ number_format($riph->v_pengajuan_import*0.05, 0, ',', '.') }}</td>
									<td>{{ number_format($riph->jumlah_importir, 0, ',', '.') }}</td>
									<td>(jumlah importir)</td>
									<td>
										<a class="btn btn-xs btn-primary btn-icon waves-effect waves-themed" href="/admin/riphAdmin/{{ $riph->id }}/edit" data-toggle="tooltip" data-offset="0,10" data-original-title="Ubah Data"><i class="fal fa-edit"></i></a>
										<a class="btn btn-xs btn-danger btn-icon waves-effect waves-themed" href="" data-toggle="tooltip" data-offset="0,10" data-original-title="Hapus Data"><i class="fal fa-trash"></i></a>
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
<!-- @parent -->
<!-- start script for this page -->
@section('scripts')

<script>
	$(document).ready(function()
	{
		// initialize tblPenangkar
		$('#riphList').dataTable(
		{
			responsive: true,
			lengthChange: false,
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
				}
			]
		});

	});
</script>




<!-- Include jQuery library -->
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}

<!-- Include the yearpicker script -->
<script>
	$(document).ready(function() {
		// Initialize the year picker
			$('.yearpicker').datepicker({
			format: 'yyyy',
			viewMode: 'years',
			minViewMode: 'years',
			autoclose: true
		});

	  // Handle the button click event
		$('#fetchDataButton').click(function() {
			var tahun = $('#periodetahun').val();
			if (tahun === '') {
				$('#jumlahPT').val('');
				$('#volumeRIPH').val('');
				$('#status').val('');
				$('#keterangan').text('FAIL');
				$('#keterangan').removeClass('text-success').addClass('text-danger fw-500');
				return; // Exit the function
			}
			fetchData(tahun);
		});


	  // Fetch data from Laravel controller using AJAX
	  function fetchData(tahun) {
		$.ajax({
		  url: '{{ route("admin.get.rekap.riph") }}',
		  method: 'GET',
		  data: {
			periodetahun: tahun
		  },
		  success: function(response) {
			// Update the fetched data in the HTML
			$('#jumlahPT').val(response.riph.rekap.jumlah_pt);
			$('#volumeRIPH').val(response.riph.rekap.jumlah_vol);
			$('#status').val(response.keterangan);
			$('#keterangan').text(response.keterangan);
			$('#keterangan').removeClass('text-danger').addClass('text-success fw-500'); // Add success styling
			},
			error: function(xhr) {
			$('#errorMessage').text('Error fetching data. Please try again.');
			console.error(xhr.responseText);
			// Clear the fetched data in the HTML
			$('#jumlahPT').val('');
			$('#volumeRIPH').val('');
			$('#status').val('');
			$('#keterangan').text('Fail to fetch request');
			$('#keterangan').removeClass('text-success').addClass('text-danger fw-500'); // Add error styling
			}
		});
	  }
	});
</script>

@endsection
