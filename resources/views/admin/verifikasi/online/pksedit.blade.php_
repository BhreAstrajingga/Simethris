@extends('layouts.admin')
@section('styles')


@endsection
@section('content')
	@include('partials.breadcrumb')
	@include('partials.subheader')
	@can('online_access')
		@include('partials.sysalert')
		<div class="row d-flex">
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
											value="{{$verifpks->verifcommit->pengajuanV2->no_pengajuan}}" disabled>
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
											value="{{$verifpks->verifcommit->pengajuanv2->commitmentbackdate->no_ijin}}" disabled>
									</div>
									<span class="help-block">Nomor Ijin RIPH.</span>
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
											value="{{$verifpks->pengajuanV2->created_at}}" disabled>
									</div>
									<span class="help-block">Tanggal pengajuan permohonan dibuat.</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-12">
				<div class="card-deck">
					<div id="panel-2" class="panel card">
						<div class="panel-hdr">
							<h2>
								Lampiran<span class="fw-300"><i>Berkas PKS</i></span>
							</h2>
							<div class="panel-toolbar">
								@include('partials.globaltoolbar')
							</div>
						</div>
						@if ($verifpks->pksmitra->berkas_pks)
							<div class="panel-container show card-body embed-responsive embed-responsive-16by9">
								<iframe class="embed-responsive-item"
									src="{{ url('storage/docs/' . $verifpks->verifcommit->pengajuanv2->commitmentbackdate->periodetahun . '/commitment_'.$verifpks->verifcommit->pengajuanv2->commitmentbackdate->id.'/pks/'.$verifpks->pksmitra->berkas_pks) }}" width="100%" frameborder="0">
								</iframe>
							</div>
						@else
							<div class="panel-container show">
								<div class="panel-content text-center">
									<h3 class="text-danger">Tidak ada berkas dilampirkan</h2>
								</div>
							</div>
						@endif
					</div>
					<div class="col">
						<div class="panel" id="panel-3">
							<div class="panel-hdr">
								<h2>
									Data Perjanjian<span class="fw-300"><i>Kerjasama</i></span>
								</h2>
								<div class="panel-toolbar">
									@include('partials.globaltoolbar')
								</div>
							</div>
							<div class="panel-container show">
								<div class="panel-content">
									<ul class="list-group">
										<li class="list-group-item d-flex justify-content-between align-items-center">
											<span class="text-muted">Nomor Perjanjian</span>
											<span class="fw-500">
												{{$verifpks->pksmitra->no_perjanjian}}
											</span>
										</li>
										<li class="list-group-item d-flex justify-content-between align-items-center">
											<span class="text-muted">Kelompoktani</span>
											<span class="fw-500">
												{{$verifpks->pksmitra->masterkelompok->nama_kelompok}}
											</span>
										</li>
										<li class="list-group-item d-flex justify-content-between align-items-center">
											<span class="text-muted">Berlaku sejak</span>
											<span class="fw-500">
												{{$verifpks->pksmitra->tgl_perjanjian_start}}
											</span>
										</li>
										<li class="list-group-item d-flex justify-content-between align-items-center">
											<span class="text-muted">Berakhir pada</span>
											<span class="fw-500">
												{{$verifpks->pksmitra->tgl_perjanjian_end}}
											</span>
										</li>
										<li class="list-group-item d-flex justify-content-between align-items-center">
											<span class="text-muted">Luas Rencana</span>
											<span class="fw-500">
												{{$verifpks->pksmitra->luas_rencana}} ha
											</span>
										</li>
										<li class="list-group-item d-flex justify-content-between align-items-center">
											<span class="text-muted">Varietas</span>
											<span class="fw-500">
												{{$verifpks->pksmitra->varietas_tanam}}
											</span>
										</li>
										<li class="list-group-item d-flex justify-content-between align-items-center">
											<span class="text-muted">Periode Tanam</span>
											<span class="fw-500">
												{{$verifpks->pksmitra->periode_tanam}}
											</span>
										</li>
										<li class="list-group-item d-flex justify-content-between align-items-center">
											<span class="text-muted">Lokasi Perjanjian</span>
											<span class="fw-500 text-right">
												<div class="row flex-column text-uppercase">
													<span>Desa/Kel. {{$verifpks->pksmitra->desa->nama_desa}} - Kec. {{$verifpks->pksmitra->kecamatan->nama_kecamatan}}</span>
													<span>{{$verifpks->pksmitra->kabupaten->nama_kab}} - {{$verifpks->pksmitra->provinsi->nama}}</span>
												</div>
											</span>
										</li>
									</ul>
									<p></p>
								</div>
							</div>
						</div>
						<div class="panel" id="panel-4">
							<div class="panel-hdr">
								<h2>
									Hasil<span class="fw-300"><i>Pemeriksaan</i></span>
								</h2>
								<div class="panel-toolbar">
									@include('partials.globaltoolbar')
								</div>
							</div>
							<form action="{{route('admin.task.onlinev2.pks.update', $verifpks->id)}}" method="POST" enctype="multipart/form-data">
								@csrf
								@method('PUT')
								<div class="panel-container show">
									<div class="panel-content">
										<div class="form-group">
											<label for="">Catatan Pemeriksaan</label>
											<textarea class="form-control form-control-sm" name="note" id="note" rows="3" required>{{ old('note', $verifpks ? $verifpks->note : '') }}</textarea>
											<small id="helpId" class="text-muted">Berikan catatan hasil pemeriksaan.</small>
										</div>
										<div class="form-group">
											<label for="">Status Pemeriksaan</label>
											<select type="text" id="status" name="status" class="form-control form-control-sm" required>
												<option hidden value="">- pilih status periksa</option>
												<option value="1"
													{{ $verifpks && $verifpks->status == '1' ? 'selected' : '' }}>
													Selesai
												</option>
												<option value="2"
													{{ $verifpks && $verifpks->status == '2' ? 'selected' : '' }}>
													Perbaikan
												</option>
											</select>
											<small id="helpId" class="text-muted">Berikan status hasil pemeriksaan.</small>
										</div>
									</div>
								</div>
								<div class="card-footer">
									<div class="form-group">
										<label class="form-label h6">Konfirmasi</label>
										<div class="input-group">
											<input type="text" class="form-control form-control-sm" placeholder="ketik username Anda di sini" id="validasi" name="validasi"required>
											<div class="input-group-append">
												<a class="btn btn-sm btn-warning" href="" role="button"><i class="fal fa-times text-align-center mr-1"></i> Batalkan</a>
											</div>
											<div class="input-group-append">
												<button class="btn btn-sm btn-primary" type="submit" onclick="return validateInput()">
													<i class="fas fa-upload text-align-center mr-1"></i>Simpan
												</button>
											</div>
										</div>
										<span class="help-block">Dengan ini kami menyatakan verifikasi pada bagian ini telah SELESAI.</span>
									</div>
								</div>
							</form>
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
		function validateInput() {
			// get the input value and the current username from the page
			var inputVal = document.getElementById('validasi').value;
			var currentUsername = '{{ Auth::user()->username }}';
			
			// check if the input is not empty and matches the current username
			if (inputVal !== '' && inputVal === currentUsername) {
				return true; // allow form submission
			} else {
				alert('Isi kolom dengan username Anda!.');
				return false; // prevent form submission
			}
		}
	</script>
@endsection
