@extends('layouts.admin')
@section('content')
{{-- @include('partials.breadcrumb') --}}
@include('partials.subheader')
@can('commitment_access')
@include('partials.sysalert')
<div class="row">
	<div class="col-12">
		<div class="panel" id="panel-1">
			<div class="panel-container show">
				<div class="panel-content">
					<table id="datatable" class="table table-bordered table-hover table-striped table-sm w-100">
						<thead>
							<th>No. RIPH</th>
							<th>Tahun</th>
							<th>Tgl. Terbit</th>
							<th>Tgl. Akhir</th>
							<th>Vol. RIPH</th>
							<th>Kewajiban</th>
							<th>Tindakan</th>
						</thead>
						<tbody>
							@foreach ($commitments as $commitment)
							<tr>
								<td>
									<a href="{{ route('admin.task.commitment.show', $commitment->id) }}" title="Lihat Data Komitmen" target="_blank">
										{{$commitment->no_ijin}}
									</a>
								</td>
								<td>{{$commitment->periodetahun}}</td>
								<td>{{$commitment->tgl_ijin}}</td>
								<td>{{$commitment->tgl_akhir}}</td>
								<td>{{ number_format($commitment->volume_riph, 2, ',','.') }} ton</td>
								<td>
									<div class="row">
										<div class="col-3">
											Luas
										</div>
										<div class="col-9">
											{{ number_format($commitment->volume_riph * 0.05/6, 2, ',','.') }} ha
										</div>
									</div>
									<div class="row">
										<div class="col-3">
											Volume
										</div>
										<div class="col-9">
											{{ number_format($commitment->volume_riph * 0.05, 2, ',','.') }} ton
										</div>
									</div>
								</td>
								<td class="text-center">
									<a href="{{ route('admin.task.commitment.realisasi', $commitment->id) }}"
										class="btn btn-icon btn-xs btn-primary" data-toggle="tooltip"
										title data-original-title="Laporan Realisasi Tanam dan Produksi">
										<i class="fal fa-edit"></i>
									</a>
									{{-- tanam --}}
									@if ($pksFileCount == $pksCount)
										@if (!empty($commitment->userDocs->sptjm) && !empty($commitment->userDocs->spvt) && !empty($commitment->userDocs->rta))
											@if(empty($commitment->status) )
												<a href="{{ route('admin.task.commitment.avt', $commitment->id) }}"
													class="btn btn-xs btn-danger btn-icon" data-toggle="tooltip"
													title data-original-title="Ajukan Verifikasi Tanam">
													<i class="fal fa-upload"></i>
												</a>
											@elseif(in_array($commitment->ajutanam->status, ['1']))
												<span class="btn btn-xs btn-info btn-icon" data-toggle="tooltip"
												title data-original-title="Verifikasi tanam telah diajukan">
													<i class="fal fa-inbox-out"></i>
												</span>
											@elseif(in_array($commitment->ajutanam->status, ['2']))
												<span class="btn btn-xs btn-info btn-icon" data-toggle="tooltip"
												title data-original-title="Verifikasi berkas tahap 1 selesai">
													<i class="fal fa-inbox-in"></i>
												</span>
											@elseif(in_array($commitment->ajutanam->status, ['3']))
												<span class="btn btn-xs btn-primary btn-icon" data-toggle="tooltip"
												title data-original-title="Verifikasi berkas/data PKS selesai">
													<i class="fal fa-inbox-in"></i>
												</span>
											@elseif(in_array($commitment->ajutanam->status, ['4']))
												<span class="btn btn-xs btn-success btn-icon" data-toggle="tooltip"
												title data-original-title="Verifikasi Tanam selesai.">
													<i class="fal fa-check"></i>
												</span>
											@endif
										@endif
									@endif
									{{-- produksi --}}
									@if ($pksFileCount == $pksCount)
										@if (!empty($commitment->userDocs->sptjm) && !empty($commitment->userDocs->spvp) && !empty($commitment->userDocs->rpo))
											@if ($commitment->sumVolume >= $commitment->minThresholdProd)
												@if(empty($commitment->ajuproduksi->status))
													<a href="{{ route('admin.task.commitment.avp', $commitment->id) }}"
													class="btn btn-xs btn-warning btn-icon" data-toggle="tooltip"
													title data-original-title="Ajukan Verifikasi Produksi">
														<i class="fal fa-upload"></i>
													</a>
												@elseif($commitment->ajuproduksi->status === '5')
													<span class="btn btn-xs btn-info btn-icon" data-toggle="tooltip"
													title data-original-title="Verifikasi produksi telah diajukan">
														<i class="fal fa-inbox-out"></i>
													</span>
												@elseif($commitment->ajuproduksi->status === '6' || $commitment->status === '7')
													<span class="btn btn-xs btn-info btn-icon" data-toggle="tooltip"
													title data-original-title="Dalam proses pemeriksaan.">
														<i class="fal fa-inbox-out"></i>
													</span>
												@elseif($commitment->ajuproduksi->status === '8')
													<span class="btn btn-xs btn-success btn-icon" data-toggle="tooltip"
													title data-original-title="Verifikasi Produksi telah selesai.">
														<i class="fal fa-check"></i>
													</span>
												@elseif($commitment->ajuproduksi->status === '9')
													<a href="{{ route('admin.task.commitment.avp', $commitment->id) }}"
														class="btn btn-xs btn-danger btn-icon" data-toggle="tooltip"
														title data-original-title="Perbaiki data dan laporan. Lalu ajukan verifikasi ulang">
														<i class="fal fa-file-certificate"></i>
													</a>
												@else
												@endif
											@endif
										@endif
									@endif
									@if($commitment->ajuproduksi->status === '8' && empty($commitment->ajuskl->status))
										ajukan
									@elseif($commitment->ajuskl->status === '10')
										diajukan
									@elseif($commitment->ajuskl->status === '11')
										diperiksa
									@elseif($commitment->ajuskl->status === '12')
										Rekomendasi
									@elseif($commitment->ajuskl->status === '14')
										Terbit
									@elseif($commitment->ajuskl->status === '15')
										Perbaikan
									@endif
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
					{{-- Modal Create Commitment --}}
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
		var table = $('#datatable').DataTable({
			responsive: true,
			lengthChange: false,
			dom:
				"<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'<'select'>>>" + // Move the select element to the left of the datatable buttons
				"<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'f><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'B>>" +
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

		// Get the unique values of the "Year" column
		var years = table.column(1).data().unique().sort();

		// Create the select element and add the options
		var select = $('<select>')
			.addClass('custom-select custom-select-sm col-3 mr-2')
			.on('change', function() {
				var year = $.fn.dataTable.util.escapeRegex($(this).val());
				table.column(1).search(year ? '^' + year + '$' : '', true, false).draw();
			});

		$('<option>').val('').text('Semua Tahun').appendTo(select);
		$.each(years, function(i, year) {
			$('<option>').val(year).text(year).appendTo(select);
		});

		// Add the select element before the first datatable button
		$('.dt-buttons').before(select);
	});
</script>

@endsection
