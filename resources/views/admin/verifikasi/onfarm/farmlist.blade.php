@extends('layouts.admin')
@section('content')
	{{-- @include('partials.breadcrumb') --}}
	@include('partials.subheader')

	@can('onfarm_access')
		@include('partials.sysalert')
		@php
			$npwp = str_replace(['.', '-'], '', $verifikasi->npwp);
			$noIjin = str_replace(['.','/'], '', $verifikasi->no_ijin);
		@endphp
		<div class="row">
			<div class="col-12">
				<div id="panel-1" class="panel">
					<div class="panel-container show">
						<div class="panel-content">
							<div class="row d-flex justify-content-between">
								<div class="form-group col-md-4">
									<label class="form-label" for="no_pengajuan">Nomor Pengajuan</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text">
												<i class="fal fa-file-invoice"></i>
											</span>
										</div>
										<input type="text" class="form-control form-control-sm" id="no_pengajuan"
											value="{{$verifikasi->no_pengajuan}}" disabled>
									</div>
									<span class="help-block">Nomor Pengajuan Verifikasi.</span>
								</div>
								<div class="form-group col-md-4">
									<label class="form-label" for="no_ijin">Nomor RIPH</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text">
												<i class="fal fa-file-invoice"></i>
											</span>
										</div>
										<input type="text" class="form-control form-control-sm" id="no_ijin"
											value="{{$verifikasi->no_ijin}}" disabled>
									</div>
									<span class="help-block">Nomor RIPH.</span>
								</div>
								<div class="form-group col-md-4">
									<label class="form-label" for="statusVerif">Tanggal Pengajuan</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text">
												<i class="fal fa-calendar-day"></i>
											</span>
										</div>
										<input type="text" class="form-control form-control-sm" id="created_at"
											value="{{$verifikasi->created_at}}" disabled>
									</div>
									<span class="help-block">Tanggal pengajuan pemeriksaan.</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="panel" id="panel-2">
					<div class="panel-container show">
						<div class="panel-content">
							<table id="dataPengajuan" class="table table-sm table-bordered table-striped w-100">
								<thead>
									<tr>
										<th>No. Perjanjian</th>
										<th width="15%">Nama Lokasi</th>
										<th>Nama Pengelola</th>
										<th>NIK Pengelola</th>
										<th>Luas Verif</th>
										<th>Vol. Verif</th>
										<th>Tanggal Selesai</th>
										<th>Status</th>
										<th>Tindakan</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($onfarms as $onfarm)
										<tr>
											<td>{{$onfarm->lokasi->pks->no_perjanjian}}</td>
											<td>{{$onfarm->lokasi->nama_lokasi}}</td>
											<td>{{$onfarm->masteranggota->nama_petani}}</td>
											<td>{{$onfarm->masteranggota->ktp_petani}}</td>
											<td class="{{ $onfarm->luas_verif ? 'text-right' : 'text-center' }}">
												@if ($onfarm->luas_verif)
													{{$onfarm->luas_verif}} ha
												@endif
											</td>
											<td class="{{ $onfarm->volume_verif ? 'text-right' : 'text-center' }}">
												@if ($onfarm->volume_verif)
													{{$onfarm->volume_verif}} ton
												@endif
											</td>
											<td>@if($onfarm->onfarmverif_at){{ date('d-m-Y', strtotime($onfarm->onfarmverif_at)) }}@endif</td>
											<td class="text-center">
												@if ($onfarm->onfarmstatus ==='Selesai')
													<span class="badge btn-xs btn-icon btn-success" data-toggle="tooltip" title data-original-title="Pemeriksaan telah selesai">
														<i class="fal fa-check-circle"></i>
													</span>
													<span hidden>1</span>
												@elseif ($onfarm->onfarmstatus ==='Perbaikan')
													<span class="badge btn-xs btn-icon btn-danger" data-toggle="tooltip" title data-original-title="Perbaikan data">
														<i class="fal fa-exclamation-circle"></i>
													</span>
													<span hidden>2</span>
												@else
													<span class="badge btn-xs btn-icon btn-warning" data-toggle="tooltip" title data-original-title="Belum diperiksa/diukur/diinput/selesai">
														<i class="fal fa-hourglass"></i>
													</span>
													<span hidden>3</span>
												@endif
											</td>
											<td>
												<a href="{{route('verification.onfarm.farmcheck', [$noIjin, $onfarm->anggota_id])}}"
													title data-toggle="tooltip" data-original-title="Input Data Pemeriksaan"
													class="badge btn-xs btn-icon btn-primary">
													<i class="fal fa-map-marker-edit"></i>
												</a>
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div id="panel-3" class="panel">
					<div class="panel-hdr">
						<h2>BA. Verifikasi Lapangan</h2>
					</div>
					<div class="panel-container show">
						<form action="{{route('verification.onfarm.update', $verifikasi->id)}}" method="POST" enctype="multipart/form-data">
							@csrf
							@method('PUT')
							<div class="panel-content">
								<div class="row d-flex justify-content-between mb-3">
									<input type="text" name="npwp" value="{{$npwp}}" hidden>
									<input type="text" name="noIjin" value="{{$noIjin}}" hidden>
									<div class="form-group col-md-4">
										<label for="">Luas Verifikasi (ha)</label>
										<input name="luas_verif" id="luas_verif"class="form-control" required value="{{ old('luas_verif', $verifikasi ? $verifikasi->luas_verif : '') }}"
										placeholder="wajib tanam: {{ number_format($verifikasi->commitment->volume_riph*0.05/6,2,',', '.')}}"/>
										<span class="help-block">
											Perkiraan total luas yang direalisasikan oleh Pelaku Usaha.
										</span>
									</div>
									<div class="form-group col-md-4">
										<label for="">Volume Verifikasi (ton)</label>
										<input name="volume_verif" id="volume_verif"class="form-control" required value="{{ old('volume_verif', $verifikasi ? $verifikasi->volume_verif : '') }}" placeholder="wajib produksi: {{$verifikasi->commitment->volume_riph*0.05}}" />
										<span class="help-block">
											Perkiraan total panen yang direalisasikan oleh Pelaku Usaha.
										</span>
									</div>
									<div class="form-group col-md-4">
										<label class="">
											Berkas Berita Acara.
											@if (!empty($verifikasi->baonfarm))
											<a class="ml-1" href="" target="blank">(Lihat Berkas Berita Acara)</a>
											@endif
										</label>
										<div class="custom-file input-group">
											<input type="file" class="custom-file-input" id="customControlValidation7"
												name="baonfarm" id="baonfarm" value="{{ old('baonfarm', $verifikasi ? $verifikasi->baonfarm : '') }}">
											<label class="custom-file-label" for="customControlValidation7">
												@if (!empty($verifikasi->onfarmattch))
												{{ old('baonfarm', $verifikasi ? $verifikasi->baonfarm : '') }}
												@else
												Pilih berkas...
												@endif
											</label>
										</div>
										<span class="help-block">Unggah Dokumen Pendukung. Ekstensi pdf ukuran maks 4mb.</span>
									</div>
									<div class="form-group col-md-12">
										<label for="">Catatan Hasil Pemeriksaan</label>
										<textarea name="onfarmnote" id="onfarmnote" rows="3" class="form-control " required>{{ old('onfarmnote', $verifikasi ? $verifikasi->onfarmnote : '') }}</textarea>
									</div>
									<div class="form-group col-md-4">
										<label for="">Metode Verifikasi</label>
										<select name="metode" id="metode" class="custom-select">
											<option value="" hidden>--pilih metode</option>
											<option value="Onsite" {{ old('metode', $verifikasi ? $verifikasi->metode : '') == 'Onsite' ? 'selected' : '' }}>Onsite</option>
											<option value="Wawancara" {{ old('metode', $verifikasi ? $verifikasi->metode : '') == 'Wawancara' ? 'selected' : '' }}>Wawancara</option>
										</select>
										<small id="helpId" class="text-muted">Metode verifikasi yang diterapkan.</small>
									</div>
									<div class="form-group col-md-4">
										<label for="">Status Verifikasi</label>
										<select class="custom-select" name="onfarmstatus" id="onfarmstatus">
											<option value="" hidden>-- pilih status</option>
											<option value="4" {{ old('onfarmstatus', $verifikasi ? $verifikasi->onfarmstatus : '') == '1' ? 'selected' : '' }}>Selesai</option>
											<option value="5" {{ old('onfarmstatus', $verifikasi ? $verifikasi->onfarmstatus : '') == '2' ? 'selected' : '' }}>Perbaikan Data</option>
										</select>
									</div>
									<div class="form-group col-md-4">
										<label class="">Konfirmasi</label>
										<div class="input-group">
											<input type="text" class="form-control" placeholder="ketik username Anda di sini" id="validasi" name="validasi"required>
											<div class="input-group-append">
												<button class="btn btn-danger" type="submit" onclick="return validateInput()">
													<i class="fas fa-save text-align-center mr-1"></i>Simpan
												</button>
											</div>
										</div>
										<span class="help-block">Dengan ini kami menyatakan verifikasi pada bagian ini telah SELESAI.</span>
									</div>
								</div>
							</div>
						</form>
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
			// Initialize datatable dataPengajuan
			var table = $('#dataPengajuan').DataTable({
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
			var selectStatus = $('<select>')
				.attr('id', 'selectdataPengajuanStatus')
				.addClass('custom-select custom-select-sm col-3 mr-2')
				.on('change', function() {
					var status = $(this).val();
					table.column(7).search(status).draw();
				});

			$('<option>').val('').text('Semua Status').appendTo(selectStatus);
			$('<option>').val('1').text('Selesai').appendTo(selectStatus);
			$('<option>').val('2').text('Perbaikan').appendTo(selectStatus);
			$('<option>').val('3').text('Belum Periksa').appendTo(selectStatus);

			// Add the select element before the first datatable button in the second table
			$('#dataPengajuan_wrapper .dt-buttons').before(selectStatus);
		});
	</script>
@endsection

