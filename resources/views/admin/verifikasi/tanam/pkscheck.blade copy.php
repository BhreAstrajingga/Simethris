@extends('layouts.admin')
@section('styles')
@endsection
@section('content')
	@include('partials.breadcrumb')
	@include('partials.subheader')
	@can('online_access')
		@include('partials.sysalert')
		<div class="row d-flex">
			@php
				$npwp = str_replace(['.', '-'], '', $commitment->npwp);
			@endphp
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
											name="no_ijin" value="{{$verifikasi->no_ijin}}" disabled>
									</div>
									<span class="help-block">Nomor Pengajuan Verifikasi.</span>
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
											value="{{ date('d-m-Y', strtotime($verifikasi->created_at)) }}" disabled>
									</div>
									<span class="help-block">Status Pemeriksaan</span>
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
						@if ($pks->berkas_pks)
							<div class="panel-container show card-body embed-responsive embed-responsive-16by9">
								<iframe class="embed-responsive-item"
									src="{{ asset('storage/uploads/'.$npwp.'/'.$commitment->periodetahun.'/'.$pks->berkas_pks) }}" width="100%" frameborder="0">
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
												{{$pks->no_perjanjian}}
											</span>
										</li>
										<li class="list-group-item d-flex justify-content-between align-items-center">
											<span class="text-muted">Kelompoktani</span>
											<span class="fw-500">
												{{$pks->masterpoktan->nama_kelompok}}
											</span>
										</li>
										<li class="list-group-item d-flex justify-content-between align-items-center">
											<span class="text-muted">Berlaku sejak</span>
											<span class="fw-500">
												{{$pks->tgl_perjanjian_start}}
											</span>
										</li>
										<li class="list-group-item d-flex justify-content-between align-items-center">
											<span class="text-muted">Berakhir pada</span>
											<span class="fw-500">
												{{$pks->tgl_perjanjian_end}}
											</span>
										</li>
										<li class="list-group-item d-flex justify-content-between align-items-center">
											<span class="text-muted">Luas Rencana</span>
											<span class="fw-500">
												{{$pks->luas_rencana}} ha
											</span>
										</li>
										<li class="list-group-item d-flex justify-content-between align-items-center">
											<span class="text-muted">Varietas</span>
											<span class="fw-500">
												@if ($pks->varietas_tanam)
													@php
														$varietas = \App\Models\Varietas::findOrFail($pks->varietas_tanam);
														$nama_varietas = $varietas->nama_varietas;
													@endphp
													{{$nama_varietas}}
												@endif
											</span>
										</li>
										<li class="list-group-item d-flex justify-content-between align-items-center">
											<span class="text-muted">Periode Tanam</span>
											<span class="fw-500">
												{{$pks->periode_tanam}}
											</span>
										</li>
										<li class="list-group-item d-flex justify-content-between align-items-center">
											<span class="text-muted">Lokasi Perjanjian</span>
											<span class="fw-500 text-right">
												<div class="row flex-column text-uppercase">
													@php
														$desa = \App\Models\MasterDesa::where('kelurahan_id', $pks->masterpoktan->id_kelurahan)->value('nama_desa');

														$kecamatan = \App\Models\MasterKecamatan::where('kecamatan_id', $pks->masterpoktan->id_kecamatan)->value('nama_kecamatan');

														$kabupaten = \App\Models\MasterKabupaten::where('kabupaten_id', $pks->masterpoktan->id_kabupaten)->value('nama_kab');

														$provinsiId = substr($pks->masterpoktan->id_kabupaten, 0, 2);
														$provinsi = \App\Models\MasterProvinsi::where('provinsi_id', $provinsiId)->value('nama');
													@endphp
													<span>Desa/Kel. {{$desa}} - Kec. {{$kecamatan}}</span>
													<span>{{$kabupaten}} - {{$provinsi}}</span>
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
							<form action="{{route('verification.data.pkscheck.store', $pks->poktan_id)}}" method="POST" enctype="multipart/form-data">
								@csrf
								<div class="panel-container show">
									<div class="panel-content">
										<input type="text" name="pks_id" value="{{$pks->id}}" hidden>
										<input type="text" name="poktan_id" value="{{$pks->poktan_id}}" hidden>
										<input type="text" name="commitmentcheck_id" value="{{$commitmentcheck->id}}" hidden>
										<input type="text" name="pengajuan_id" value="{{$verifikasi->id}}" hidden>
										<input type="text" name="no_ijin" value="{{$verifikasi->no_ijin}}" hidden>
										<input type="text" name="npwp" value="{{$verifikasi->npwp}}" hidden>
										<div class="form-group">
											<label for="">Catatan Pemeriksaan</label>
											<textarea class="form-control form-control-sm" name="note" id="note" rows="3" required></textarea>
											<small id="helpId" class="text-muted">Berikan catatan atau keterangan hasil pemeriksaan.</small>
										</div>
										<div class="form-group">
											<label for="">Status Pemeriksaan</label>
											<select type="text" id="status" name="status" class="form-control form-control-sm" required>
												<option hidden value="">- pilih status periksa</option>
												<option value="2">Selesai</option>
												<option value="3">Perbaikan</option>
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
