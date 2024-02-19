@extends('layouts.admin')
@section('content')
	{{-- @include('partials.breadcrumb') --}}
	@include('partials.subheader')
	@can('onfarm_access')
		@include('partials.sysalert')
		<div class="row">
			<div class="col-12">
				<div class="panel" id="panel-1">
					<div class="panel-container show">
						<div class="panel-content">
							<table id="dataPengajuan" class="table table-sm table-bordered table-striped w-100">
								<thead>
									<tr>
										<th>No. Pengajuan</th>
										<th>No. RIPH</th>
										<th>Periode</th>
										<th>Tanggal Pengajuan</th>
										<th>Tanggal Verifikasi Data</th>
										<th>Status</th>
										<th>Tindakan</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($verifikasis as $verifikasi)
										<tr>
											<td>{{$verifikasi->no_pengajuan}}</td>
											<td>{{$verifikasi->commitment->no_ijin}}</td>
											<td class="text-center">{{$verifikasi->commitment->periodetahun}}</td>
											<td class="text-center">{{ date('d-m-Y', strtotime($verifikasi->created_at)) }}</td>
											<td class="text-center">{{ date('d-m-Y', strtotime($verifikasi->onlinedate)) }}</td>
											<td class="text-center">
												@if ($verifikasi->status === '2')
													<span class="badge btn-xs btn-icon btn-warning" data-toggle="tooltip"
														data-original-title="Request baru">
														<i class="fa fa-download"></i>
													</span>
													<span hidden>{{$verifikasi->status}}</span>
												@elseif ($verifikasi->status === '4')
													<span class="badge btn-xs btn-icon btn-success" data-toggle="tooltip"
														data-original-title="Selesai">
														<i class="fa fa-check-circle"></i>
													</span>
													<span hidden>{{$verifikasi->status}}</span>
												@elseif ($verifikasi->status === '5')
													<span class="badge btn-xs btn-icon btn-danger" data-toggle="tooltip"
													data-original-title="Perbaikan Data">
														<i class="fa fa-exclamation-circle"></i>
													</span>
													<span hidden>{{$verifikasi->status}}</span>
												@else
													<span class="badge btn-xs btn-icon btn-warning" data-toggle="tooltip"
													data-original-title="Belum (selesai) periksa">
														<i class="fal fa-hourglass"></i>
													</span>
													<span hidden>0</span>
												@endif
											</td>
											<td class="text-center">
												@if($verifikasi->onfarmstatus)
													<a href="{{route('verification.onfarm.show', $verifikasi->id)}}"
														title="Lihat hasil" class="mr-1 btn btn-xs btn-icon btn-info">
														<i class="fal fa-file-search"></i>
													</a>
												@else
													<a href="{{route('verification.onfarm.farmlist', $verifikasi->id)}}" class="btn btn-icon btn-xs btn-primary"
														title="Mulai/Lanjutkan Pemeriksaan">
														<i class="fal fa-file-search"></i>
													</a>
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
		//initialize datatable dataPengajuan
			$('#dataPengajuan').dataTable({
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

				// Get the unique values of the "Year" column
				var table = $('#dataPengajuan').DataTable();
				var years = table.column(2).data().unique().sort();

				// Create the "Year" select element and add the options
				var selectYear = $('<select>')
					.attr('id', 'selectdataPengajuanYear')
					.addClass('custom-select custom-select-sm col-3 mr-2')
					.on('change', function() {
					var year = $.fn.dataTable.util.escapeRegex($(this).val());
					table.column(2).search(year ? '^' + year + '-|'+year+'$' : '', true, false).draw();
					});

				$('<option>').val('').text('Semua Tahun').appendTo(selectYear);
				$.each(years, function(i, year) {
					$('<option>').val(year.substring(0, 4)).text(year.substring(0, 4)).appendTo(selectYear);
				});

				// Create the "Status" select element and add the options
				var selectStatus = $('<select>')
					.attr('id', 'selectdataPengajuanStatus')
					.addClass('custom-select custom-select-sm col-3 mr-2')
					.on('change', function() {
					var status = $(this).val();
					table.column(5).search(status).draw();
					});

				$('<option>').val('').text('Semua Status').appendTo(selectStatus);
				$('<option>').val('2').text('Baru').appendTo(selectStatus);
				$('<option>').val('4').text('Selesai').appendTo(selectStatus);
				$('<option>').val('5').text('Perbaikan').appendTo(selectStatus);
				$('<option>').val('0').text('Belum Periksa').appendTo(selectStatus);

				// Add the select elements before the first datatable button in the second table
				$('#dataPengajuan_wrapper .dt-buttons').before(selectYear, selectStatus);
			});
	</script>
@endsection
