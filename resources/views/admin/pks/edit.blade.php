@extends('layouts.admin')
@section('content')
{{-- @include('partials.breadcrumb') --}}
@include('partials.subheader')
@include('partials.sysalert')
@can('pks_edit')
	<div class="row">
		<div class="col-md-4">
			<div class="panel" id="panel-1">
				<div class="panel-hdr">
					<h2>
						Informasi<span class="fw-300"><i>Dasar</i></span>
					</h2>
					<div class="panel-toolbar">

					</div>
				</div>
				<div class="panel-container show">
					<div class="panel-content">
						<ul class="list-group mb-3">
							<li class="list-group-item d-flex justify-content-between">
								<div>
									<span class="text-muted">No. RIPH</span>
									<h6 class="fw-500 my-0">{{$pks->no_ijin}}</h6>
								</div>
							</li>
							<li class="list-group-item d-flex justify-content-between">
								<div>
									<span class="text-muted">Kelompoktani Mitra</span>
									<h6 class="fw-500 my-0">{{$pks->masterpoktan->nama_kelompok}}</h6>
								</div>
							</li>
							<li class="list-group-item d-flex justify-content-between">
								<div>
									<span class="text-muted">Kecamatan</span>
									<h6 class="fw-500 my-0">
										@php
											$kecamatan = \App\Models\MasterKecamatan::where('kecamatan_id', $pks->masterpoktan->id_kecamatan)->value('nama_kecamatan');
											echo $kecamatan;
										@endphp
										{{$pks->id_kecamatan}}
									</h6>
								</div>
							</li>
							<li class="list-group-item d-flex justify-content-between">
								<div>
									<span class="text-muted">Desa/Kel</span>
									<h6 class="fw-500 my-0">
										@php
											$desa = \App\Models\MasterDesa::where('kelurahan_id', $pks->masterpoktan->id_kelurahan)->value('nama_desa');
											echo $desa;
										@endphp
									</h6>
								</div>
							</li>
							<li class="list-group-item d-flex justify-content-between">
								<div>
									<span class="text-muted">Jumlah Anggota</span>
									<h6 class="fw-500 my-0">{{$pks->lokasi_count}} <sup>orang</sup></h6>
								</div>
							</li>
							<li class="list-group-item d-flex justify-content-between">
								<div>
									<span class="text-muted">Luas Garapan</span>
									<h6 class="fw-500 my-0">{{ number_format($pks->sum_luaslahan, 2, ',', '.') }}
										<sup>ha</sup></h6>
								</div>
							</li>
							<li class="list-group-item d-flex justify-content-between">
								<div>
									<span class="text-muted">Periode Tanam</span>
									<h6 class="fw-500 my-0">{{$pks->periode_tanam}}</h6>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-8">
			<div class="panel" id="panel-2">
				<div class="panel-hdr">
					<h2>
						Data Perjanjian<span class="fw-300"><i>Kerjasama</i></span>
					</h2>
					<div class="panel-toolbar">

					</div>
				</div>
				<form action=" {{route('admin.task.pks.update', $pks->id)}} " method="POST" enctype="multipart/form-data">
					@csrf
					@method('PUT')
					<div class="panel-container show">
						<div class="panel-content">
							<div class="row d-flex">
								<div class="col-md-6 mb-3">
									<div class="form-group">
										<label class="form-label" for="no_perjanjian">Nomor Perjanjian</label>
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text" id="no_perjanjian">123</span>
											</div>
											<input type="text" class="form-control " id="no_perjanjian" name="no_perjanjian"
												value="{{old('no_perjanjian', $pks->no_perjanjian)}}"
												required>
										</div>
										<div class="help-block">
											Nomor Pejanjian Kerjasama dengan Poktan Mitra.
										</div>
									</div>
								</div>
								<div class="col-md-6 mb-3">
									<label class="form-label">Unggah Berkas PKS (Perjanjian Kerjasama)</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<a href="">
											<span class="input-group-text" id="inputGroupPrepend3">PKS</span>
											</a>
										</div>
										<div class="custom-file">
											<input type="file" accept=".pdf" class="custom-file-input" id="berkas_pks" name="berkas_pks"
											value="{{old('berkas_pks', $pks->berkas_pks)}}">
											<label class="custom-file-label" for="berkas_pks">
												{{ $pks->berkas_pks ? $pks->berkas_pks : 'Pilih file...' }}
											</label>
										</div>
									</div>
									<span class="help-block">
										@php
											$npwp = str_replace(['.', '-'], '', $npwpCompany);
										@endphp
										@if($pks->berkas_pks)
											<a href="{{ asset('storage/uploads/'.$npwp.'/'.$commitment->periodetahun.'/'.$pks->berkas_pks) }}" target="_blank">
												Lihat berkas yang telah diunggah
											</a>
										@else
										Unggah hasil pindai berkas Perjanjian dalam bentuk pdf.
										@endif
									</span>
								</div>
								<div class="col-md-6 mb-3">
									<div class="form-group">
										<label class="form-label">Tanggal perjanjian</label>
										<div class="input-daterange input-group" id="tgl_perjanjian_start" name="tgl_perjanjian_start">
											<div class="input-group-prepend">
												<span class="input-group-text"><i class="fal fa-calendar-day"></i></span>
											</div>
											<input type="date" name="tgl_perjanjian_start" id="tgl_perjanjian_start"
												class="form-control " placeholder="tanggal mulai perjanjian"
												value="{{old('tgl_perjanjian_start', $pks->tgl_perjanjian_start)}}" required
												aria-describedby="helpId">
										</div>
										<div class="help-block">
											Pilih Tanggal perjanjian ditandatangani.
										</div>
									</div>
								</div>
								<div class="col-md-6 mb-3">
									<div class="form-group">
										<label class="form-label">Tanggal berakhir perjanjian</label>
										<div class="input-daterange input-group" id="tgl_perjanjian_end" name="tgl_perjanjian_end">
											<div class="input-group-prepend">
												<span class="input-group-text"><i class="fal fa-calendar-day"></i></span>
											</div>
											<input type="date" name="tgl_perjanjian_end" id="tgl_perjanjian_end"
												class="form-control " placeholder="tanggal akhir perjanjian"
												value="{{old('tgl_perjanjian_end', $pks->tgl_perjanjian_end)}}" required
												aria-describedby="helpId">
										</div>
										<div class="help-block">
											Pilih Tanggal berakhirnya perjanjian.
										</div>
									</div>
								</div>
								<div class="col-md-4 mb-3">
									<div class="form-group">
										<label class="form-label" for="simpleinputInvalid">Luas Rencana (ha)</label>
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text" id="inputGroupPrepend3"><i class="fal fa-ruler"></i></span>
											</div>
											<input type="number" class="form-control " name="luas_rencana" id="luas_rencana"
												value="{{old('luas_rencana', $pks->sum_luaslahan)}}" step="0.01" readonly>
										</div>
										<div class="help-block">
											Jumlah Luas total sesuai dokumen perjanjian.
										</div>
									</div>
								</div>
								<div class="col-md-4 mb-3">
									<div class="form-group">
										<label class="form-label" for="varietas_tanam">Varietas Tanam</label>
										<div class="input-group">
											<select class="form-control custom-select" name="varietas_tanam" id="select2-varietas" required>
												<option value="" hidden></option>
												@foreach($varietass as $varietas)
													<option value="{{ $varietas->id }}"{{ old('varietas_tanam', $pks->varietas_tanam) == $varietas->id ? ' selected' : '' }}>
														{{ $varietas->nama_varietas }}
													</option>
												@endforeach
											</select>

										</div>
										<div class="help-block">
											Varietas ditanam sesuai dokumen perjanjian.
										</div>
									</div>
								</div>
								<div class="col-md-4 mb-3">
									<div class="form-group">
										<label class="form-label" for="periode">Periode Tanam</label>
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text" id=""><i class="fal fa-calendar-week"></i></span>
											</div>
											<input type="text" name="periode_tanam" id="periode_tanam"
												class="form-control " placeholder="misal: Jan-Feb" aria-describedby="helpId"
												value="{{old('periode_tanam', $pks->periode_tanam)}}" required>
										</div>
										<div class="help-block">
											Periode tanam sesuai dokumen perjanjian.
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="card-footer">
						<div class="col-md-4 ml-auto text-right">
							<a href="{{route('admin.task.commitment.realisasi', $commitmentId)}}" class="btn btn-warning btn-sm">
								<i class="fal fa-undo mr-1"></i>Batal
							</a>
							<button class="btn btn-primary btn-sm" type="submit"
								@if ($disabled) disabled @endif>
								<i class="fal fa-save mr-1"></i>Simpan
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
@endcan
@endsection

@section('scripts')
@parent
<script>
    $(document).ready(function() {
        $("#select2-varietas").select2({
            placeholder: "--Pilih Varietas",
        });
	});
</script>
@endsection
