@extends('layouts.admin')
@section('content')
	@include('partials.breadcrumb')
	@include('partials.subheader')

	@can('online_access')
		@include('partials.sysalert')
		<div class="row d-flex justify-content-between">
			<div class="col-md-4">
				<div class="panel">
					<div class="panel-hdr">
						<h2>Ringkasan Verifikasi</h2>
					</div>
					<div class="form-group">
						<ul class="list-group list-group-flush">
							<li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
								<label class="col-form-label">Tahap Verifikasi</label>
								@if ($verifikasi->status === '1')
									<span class="badge btn-xs btn-primary">Pengajuan</span>
								@elseif($verifikasi->status === '2' || $verifikasi->status === '3')
									<span class="badge btn-xs btn-info">Data</span>
								@elseif($verifikasi->status === '4' || $verifikasi->status === '5')
									<span class="badge btn-xs btn-warning">Lapangan</span>
								@elseif($verifikasi->status === '6' || $verifikasi->status === '7')
									<span class="badge btn-xs btn-danger">Penerbitan SKL</span>
								@endif
							</li>
							<li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
								<label class="col-form-label">Status Verifikasi</label>
								@if (empty($verifikasi->status))
									<span class="badge btn-xs btn-default">Belum diajukan</span>
								@elseif ($verifikasi->status === '1')
									<span class="badge btn-xs btn-success">Proses</span>
								@elseif ($verifikasi->status === '2')
									<span class="badge btn-xs btn-success">Selesai</span>
								@elseif($verifikasi->onlinestatus === '3')
									<span class="badge btn-xs btn-danger">Perbaikan</span>
								@elseif($verifikasi->onlinestatus === '4')
									<span class="badge btn-xs btn-success">Selesai</span>
								@elseif($verifikasi->onlinestatus === '5')
									<span class="badge btn-xs btn-danger">Perbaikan</span>
								@elseif($verifikasi->onlinestatus === '6')
									<span class="badge btn-xs btn-info">Rekomendasi SKL</span>
								@elseif($verifikasi->onlinestatus === '7')
									<span class="badge btn-xs btn-success">SKL Terbit</span>
								@endif
							</li>
							<li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
								<label class="col-form-label">Nomor RIPH</label>
								<span>{{$verifikasi->no_ijin}}</span>
							</li>
							<li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
								<div class="me-auto">
									<div class="col-form-label">No. Pengajuan</div>
									<span>{{$verifikasi->no_pengajuan}}</span>
								</div>
							</li>
							<li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
								<label class="col-form-label">Tanggal Pengajuan</label>
								<span>{{ $verifikasi->created_at->format('d-m-Y') }}</span>
							</li>
							<li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
								<label class="col-form-label">Verifikasi Tanam</label>
								@if (empty($verifikasi->luas_verifikasi))
									belum diverifikasi lapangan
								@else
									<span>{{$verifikasi->luas_verif}} ha</span>
								@endif
							</li>
							<li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
								<label class="col-form-label">Verifikasi Produksi</label>
								@if (empty($verifikasi->volume_verif))
									belum diverifikasi lapangan
								@else
									<span>{{$verifikasi->volume_verif}} ton</span>
								@endif
							</li>
							<li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
								<div class="me-auto">
									<div>Catatan</div>
									@if (request()->is('verification/data*'))
										<span>{{$verifikasi->onlinenote}}</span>
									@elseif(request()->is('verification/data*'))
										<span>{{$verifikasi->onfarmnote}}</span>
									@endif
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-md-8">
				<div class="panel" id="lampiran">
					<div class="panel-hdr">
						<h2>Pemeriksaan Berkas</h2>
						<div>
							<a href="{{route('verification.data.check', $verifikasi->id)}}"
								class="btn btn-xs btn-info">
								Kembali
							</a>
						</div>
					</div>
					<div class="panel-container show">
						<div class="panel-content">
							<table class="table table-striped table-bordered table-hover w-100" id="tblLampiran">
								<thead>
									<th>Data</th>
									<th>Detail</th>
									<th>Status</th>
								</thead>
								<tbody>
									<tr>
										<td>Wajib Tanam</td>
										<td class="text-right">{{$verifikasi->luas_verif}} ha</td>
										<td>
											@if ($verifikasi->luas_verif >= $verifikasi->commitment->volume_riph*0.05)
												<span class="badge btn-xs btn-icon btn-success" title="Terpenuhi">
													<i class="fa fa-check-circle"></i>
												</span>
												<span class="d-none d-print-block text-success fw-500">Terpenuhi</span>
											@else
												<span class="badge btn-xs btn-icon btn-danger" title="Tidak terpenuhi">
													<i class="fa fa-exclamation-circle"></i>
												</span>
												<span class="d-none d-print-block text-success fw-500">Tidak terpenuhi</span>
											@endif
										</td>
									</tr>
									<tr>
										<td>Wajib Produksi</td>
										<td class="text-right">{{$verifikasi->volume_verif}} ton</td>
										<td>
											@if ($verifikasi->volume_verif >= $verifikasi->commitment->volume_riph*0.05/6)
												<span class="badge btn-xs btn-icon btn-success" title="Terpenuhi">
													<i class="fa fa-check-circle"></i>
												</span>
												<span class="d-none d-print-block text-success fw-500">Terpenuhi</span>
											@else
												<span class="badge btn-xs btn-icon btn-danger" title="Tidak terpenuhi">
													<i class="fa fa-exclamation-circle"></i>
												</span>
												<span class="d-none d-print-block text-success fw-500">Tidak terpenuhi</span>
											@endif
										</td>
									</tr>
									<tr>
										<td>Berkas RIPH</td>
										<td>{{$verifikasi->commitment->formRiph}}</td>
										<td>
											@if ($commitment->formRiph === 'Sesuai')
												<span class="badge btn-xs btn-icon btn-success" title="Sesuai">
													<i class="fa fa-check-circle"></i>
												</span>
												<span class="d-none d-print-block text-success fw-500">Sesuai</span>
											@elseif ($commitment->formRiph === 'Tidak Sesuai')
												<span class="badge btn-xs btn-icon btn-danger" title="Tidak Sesuai">
													<i class="fa fa-exclamation-circle"></i>
												</span>
												<span class="d-none d-print-block text-danger fw-500">Tidak Sesuai</span>
											@endif
										</td>
									</tr>
									<tr>
										<td>Berkas SPTJM</td>
										<td>{{$verifikasi->commitment->formSptjm}}</td>
										<td>
											@if ($commitment->formSptjm === 'Sesuai')
												<span class="badge btn-xs btn-icon btn-success" title="Sesuai">
													<i class="fa fa-check-circle"></i>
												</span>
												<span class="d-none d-print-block text-success fw-500">Sesuai</span>
											@elseif ($commitment->formSptjm === 'Tidak Sesuai')
												<span class="badge btn-xs btn-icon btn-danger" title="Tidak Sesuai">
													<i class="fa fa-exclamation-circle"></i>
												</span>
												<span class="d-none d-print-block text-danger fw-500">Tidak Sesuai</span>
											@endif
										</td>
									</tr>
									<tr>
										<td>Berkas Logbook</td>
										<td>{{$verifikasi->commitment->logbook}}</td>
										<td>
											@if ($commitment->logbook === 'Sesuai')
												<span class="badge btn-xs btn-icon btn-success" title="Sesuai">
													<i class="fa fa-check-circle"></i>
												</span>
												<span class="d-none d-print-block text-success fw-500">Sesuai</span>
											@elseif ($commitment->logbook === 'Tidak Sesuai')
												<span class="badge btn-xs btn-icon btn-danger" title="Tidak Sesuai">
													<i class="fa fa-exclamation-circle"></i>
												</span>
												<span class="d-none d-print-block text-danger fw-500">Tidak Sesuai</span>
											@endif
										</td>
									</tr>
									<tr>
										<td>Berkas Rencana Tanam</td>
										<td>{{$verifikasi->commitment->formRt}}</td>
										<td>
											@if ($commitment->formRt === 'Sesuai')
												<span class="badge btn-xs btn-icon btn-success" title="Sesuai">
													<i class="fa fa-check-circle"></i>
												</span>
												<span class="d-none d-print-block text-success fw-500">Sesuai</span>
											@elseif ($commitment->formRt === 'Tidak Sesuai')
												<span class="badge btn-xs btn-icon btn-danger" title="Tidak Sesuai">
													<i class="fa fa-exclamation-circle"></i>
												</span>
												<span class="d-none d-print-block text-danger fw-500">Tidak Sesuai</span>
											@endif
										</td>
									</tr>
									<tr>
										<td>Berkas Realisasi Tanam</td>
										<td>{{$verifikasi->commitment->formRta}}</td>
										<td>
											@if ($commitment->formRta === 'Sesuai')
												<span class="badge btn-xs btn-icon btn-success" title="Sesuai">
													<i class="fa fa-check-circle"></i>
												</span>
												<span class="d-none d-print-block text-success fw-500">Sesuai</span>
											@elseif ($commitment->formRta === 'Tidak Sesuai')
												<span class="badge btn-xs btn-icon btn-danger" title="Tidak Sesuai">
													<i class="fa fa-exclamation-circle"></i>
												</span>
												<span class="d-none d-print-block text-danger fw-500">Tidak Sesuai</span>
											@endif
										</td>
									</tr>
									<tr>
										<td>Berkas Realisasi Produksi</td>
										<td>{{$verifikasi->commitment->formRpo}}</td>
										<td>
											@if ($commitment->formRpo === 'Sesuai')
												<span class="badge btn-xs btn-icon btn-success" title="Sesuai">
													<i class="fa fa-check-circle"></i>
												</span>
												<span class="d-none d-print-block text-success fw-500">Sesuai</span>
											@elseif ($commitment->formRpo === 'Tidak Sesuai')
												<span class="badge btn-xs btn-icon btn-danger" title="Tidak Sesuai">
													<i class="fa fa-exclamation-circle"></i>
												</span>
												<span class="d-none d-print-block text-danger fw-500">Tidak Sesuai</span>
											@endif
										</td>
									</tr>
									<tr>
										<td>Berkas Laporan Akhir</td>
										<td>{{$verifikasi->commitment->formLa}}</td>
										<td>
											@if ($commitment->formLa === 'Sesuai')
												<span class="badge btn-xs btn-icon btn-success" title="Sesuai">
													<i class="fa fa-check-circle"></i>
												</span>
												<span class="d-none d-print-block text-success fw-500">Sesuai</span>
											@elseif ($commitment->formLa === 'Tidak Sesuai')
												<span class="badge btn-xs btn-icon btn-danger" title="Tidak Sesuai">
													<i class="fa fa-exclamation-circle"></i>
												</span>
												<span class="d-none d-print-block text-danger fw-500">Tidak Sesuai</span>
											@endif
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="panel" id="pks">
					<div class="panel-hdr">
						<h2>Pemeriksaan PKS</h2>
					</div>
					<div class="panel-container show">
						<div class="panel-content">
							<table class="table table-striped table-bordered table-hover w-100" id="tblPks">
								<thead>
									<th>Data</th>
									<th>Kelompok Tani</th>
									<th>Status</th>
								</thead>
								<tbody>
									@foreach ($pksmitras as $pksmitra)
									<tr>
										<td>{{$pksmitra->pks->no_perjanjian}}</td>
										<td>{{$pksmitra->pks->masterpoktan->nama_kelompok}}</td>
										<td>
											@if($pksmitra->status === '2')
												<span class="badge btn-xs btn-icon btn-success" title="Selesai">
													<i class="fa fa-check-circle"></i>
												</span>
												<span class="d-none d-print-block text-success fw-500">Selesai</span>
											@elseif($pksmitra->status === '3')
												<span class="badge btn-xs btn-icon btn-danger" title="Perbaikan">
													<i class="fa fa-exclamation-circle"></i>
												</span>
												<span class="d-none d-print-block text-danger fw-500">Perbaikan Data</span>
											@endif
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="panel" id="realisasi">
					<div class="panel-hdr">
						<h2>Pemeriksaan Lokasi</h2>
					</div>
					<div class="panel-container show">
						<div class="panel-content">
							<table class="table table-striped table-bordered table-hover w-100" id="tblRealisasi">
								<thead>
									<th>Data</th>
									<th>Detail</th>
									<th>Status</th>
								</thead>
								<tbody>
									@foreach($onfarms as $onfarm)
									<tr>
										<td>{{$onfarm->lokasi->nama_lokasi}}</td>
										<td>
											{{$onfarm->luas_verif}} ha<br>
											{{$onfarm->volume_verif}} ton
										</td>
										<td>
											@if($onfarm->onfarmstatus)
												@if ($onfarm->onfarmstatus === 'Selesai')
													<span class="badge btn-xs btn-icon btn-success" title="Selesai dan sesuai">
														<i class="fa fa-check-circle"></i>
													</span>
													<span class="d-none d-print-block text-success fw-500">Selesai dan Sesuai</span>
												@elseif($onfarm->onfarmstatus === 'Perbaikan')
													<span class="badge btn-xs btn-icon btn-danger" title="Perbaikan">
														<i class="fa fa-exclamation-circle"></i>
													</span>
													<span class="d-none d-print-block text-danger fw-500">Tidak terpenuhi</span>
												@endif
											@else
												@if ($onfarm->onlinestatus === 'Selesai')
													<span class="badge btn-xs btn-icon btn-success" title="Selesai dan sesuai">
														<i class="fa fa-check-circle"></i>
													</span>
													<span class="d-none d-print-block text-success fw-500">Selesai dan Sesuai</span>
												@elseif($onfarm->onlinestatus === 'Perbaikan')
													<span class="badge btn-xs btn-icon btn-danger" title="Perbaikan">
														<i class="fa fa-exclamation-circle"></i>
													</span>
													<span class="d-none d-print-block text-danger fw-500">Tidak terpenuhi</span>
												@endif
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
			$('#tblLampiran').dataTable({
			responsive: true,
			lengthChange: true,
			dom:
				"<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'fl><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'B>>" +
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

			$('#tblPks').dataTable({
			responsive: true,
			lengthChange: true,
			dom:
				"<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'fl><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'B>>" +
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
			$('#tblRealisasi').dataTable({
			responsive: true,
			lengthChange: true,
			dom:
				"<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'fl><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'B>>" +
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
		});
	</script>
@endsection
