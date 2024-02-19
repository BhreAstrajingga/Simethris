@extends('layouts.admin')
@section('styles')
<link rel="stylesheet" media="screen, print" href="{{ asset('css/miscellaneous/lightgallery/lightgallery.bundle.css') }}">
{{-- <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script> --}}

@endsection

@section('content')
{{-- @include('partials.breadcrumb') --}}
@include('partials.subheader')
@include('partials.sysalert')
@can('commitment_show')

	@php
		$npwp = str_replace(['.', '-'], '', $npwpCompany);
	@endphp
	<div class="row">
		<div class="col-12 mb-3">
			<div class="panel-tag fade show bg-white border-warning m-0 l-h-m-n">
				<div class="d-flex align-items-center">
					<i class="fas fa-info mr-1"></i>
					<div class="flex-1">
						<small><span class="mr-1 fw-700">Informasi!</span>Jika setelah mengunggah, foto yang Anda unggah tidak muncul di kolom tampilan, cobalah untuk menyegarkan halaman (refresh/reload. ctrl+F5)</small>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-6">
			<div class="panel" id="panel-tanam">
				<div class="panel-hdr">
					<h2>
						Realisasi Tanam <span class="fw-300">
							<i>Bukti/Foto Pendukung</i>
						</span>
					</h2>
					<div class="panel-toolbar">
						@include('partials.globaltoolbar')
					</div>
				</div>
				<div class="panel-container show">
					@if ($lokasi->fototanam->count() < 4)
						<div class="panel-content">
							<form method="post" action="{{route('admin.task.dropZoneTanam')}}" class="dropzone needsclick" style="min-height: 4rem;" id="dropzone-tanam" enctype="multipart/form-data" data-count="{{$fotoTanams->count()}}">
								{{-- @csrf
								@method('PUT') --}}
								<input type="hidden" name="form_action" value="form1">
								<input type="hidden" name="npwp_company" value="{{$pks->npwp}}">
								<input type="hidden" name="no_ijin" value="{{$pks->no_ijin}}">
								<input type="hidden" name="periode" value="{{$pks->commitment->periodetahun}}">
								<input type="hidden" name="poktan_id" value="{{$pks->poktan_id}}">
								<input type="hidden" name="pks_id" value="{{$pks->id}}">
								<input type="hidden" name="anggota_id" value="{{$anggota->anggota_id}}">
								<input type="hidden" name="lokasi_id" value="{{$anggota->id}}">
								<input type="hidden" name="lokasiId" value="{{$lokasi->id}}"> {{-- id table data_realisasi --}}
								<div class="dz-message needsclick">
									<i class="fal fa-cloud-upload text-muted mb-3"></i> <br>
									<span class="text-uppercase">Drop foto di sini atau klik untuk mengunggah.</span>
									<br>
									<span class="fs-sm text-muted">Unggah foto-foto sebagai bukti pelaksanaan realisasi tanam. Maksimum 4 foto, ukuran maksimum masing-masing berkas kurang dari 2mb.</span>
								</div>
							</form><hr class="m-h-l-n-0">
						</div>
					@endif
					<div class="panel-content">
						<div class="row row-cols-1 row-cols-md-4">
							@foreach ($fotoTanams as $foto)
							<div class="col mb-4">
								<div class="card shadow-2" style="width: 100%; padding-top: 100%; position: relative; overflow: hidden;">
									<div class="card-image" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-image: url('{{ asset('storage/uploads/'.$filenpwp.'/'.$pks->commitment->periodetahun.'/'.$foto->filename) }}'); background-size: cover; background-repeat: no-repeat; background-position: center;"></div>
									<form action="{{route('admin.task.deleteFotoTanam', $foto->id)}}" method="post" style="position: absolute; top: 0; right: 0; margin: 10px;">
										@csrf
										@method('DELETE')
										<a href="{{ asset('storage/uploads/'.$filenpwp.'/'.$pks->commitment->periodetahun.'/'.$foto->filename) }}" target="_blank" class="mr-1 btn btn-warning btn-xs btn-icon waves-effect waves-themed" data-toggle="tooltip" data-original-title="Layar Penuh">
											<i class="fal fa-expand"></i>
										</a>
										<button class="btn btn-icon btn-danger btn-xs waves-effect waves-themed" type="submit" data-toggle="tooltip" data-original-title="Hapus foto ini"><i class="fal fa-trash"></i></button>
									</form>
								</div>
							</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-6">
			<div class="panel" id="panel-produksi">
				<div class="panel-hdr">
					<h2>
						Realisasi Produksi <span class="fw-300">
							<i>Bukti/Foto Pendukung</i>
						</span>
					</h2>
					<div class="panel-toolbar">
						@include('partials.globaltoolbar')
					</div>
				</div>
				<div class="panel-container show">
					@if ($lokasi->fotoproduksi->count() < 4)
						<div class="panel-content">
							<form method="post" action="{{route('admin.task.dropZoneProduksi')}}" class="dropzone needsclick" style="min-height: 4rem;" id="dropzone-produksi" enctype="multipart/form-data" data-count="{{$fotoProduksis->count()}}">
								{{-- @csrf --}}
								{{-- @method('PUT') --}}
								<input type="hidden" name="form_action" value="form1">
								<input type="hidden" name="npwp_company" value="{{$pks->npwp}}">
								<input type="hidden" name="no_ijin" value="{{$pks->no_ijin}}">
								<input type="hidden" name="periode" value="{{$pks->commitment->periodetahun}}">
								<input type="hidden" name="poktan_id" value="{{$pks->poktan_id}}"> {{-- id table masterpoktan --}}
								<input type="hidden" name="pks_id" value="{{$pks->id}}"> {{-- id table pks --}}
								<input type="hidden" name="anggota_id" value="{{$anggota->anggota_id}}"> {{-- id table masteranggotas --}}
								<input type="hidden" name="lokasi_id" value="{{$anggota->id}}"> {{-- id table lokasis --}}
								<input type="hidden" name="lokasiId" value="{{$lokasi->id}}"> {{-- id table data_realisasi --}}
								<div class="dz-message needsclick">
									<i class="fal fa-cloud-upload text-muted mb-3"></i> <br>
									<span class="text-uppercase">Drop foto di sini atau klik untuk mengunggah.</span>
									<br>
									<span class="fs-sm text-muted">Unggah foto-foto sebagai bukti pelaksanaan realisasi produksi. Maksimum 4 foto, ukuran maksimum masing-masing berkas kurang dari 2mb.</span>
								</div>
							</form> <hr class="m-h-l-n-0">
						</div>
					@endif
					<div class="panel-content">
						<div class="row row-cols-1 row-cols-md-4">
							@foreach ($fotoProduksis as $foto)
							<div class="col mb-4">
								<div class="card shadow-2" style="width: 100%; padding-top: 100%; position: relative; overflow: hidden;">
									<div class="card-image" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-image: url('{{ asset('storage/uploads/'.$filenpwp.'/'.$pks->commitment->periodetahun.'/'.$foto->filename) }}'); background-size: cover; background-repeat: no-repeat; background-position: center;"></div>
									<form action="{{route('admin.task.deleteFotoProduksi', $foto->id)}}" method="post" style="position: absolute; top: 0; right: 0; margin: 10px;">
										@csrf
										@method('DELETE')
										<a href="{{ asset('storage/uploads/'.$filenpwp.'/'.$pks->commitment->periodetahun.'/'.$foto->filename) }}" target="_blank" class="mr-1 btn btn-warning btn-xs btn-icon waves-effect waves-themed" data-toggle="tooltip" data-original-title="Layar Penuh">
											<i class="fal fa-expand"></i>
										</a>
										<button class="btn btn-icon btn-danger btn-xs waves-effect waves-themed" type="submit" data-toggle="tooltip" data-original-title="Hapus foto ini"><i class="fal fa-trash"></i></button>
									</form>
								</div>
							</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endcan

@endsection

<!-- start script for this page -->
@section('scripts')
@parent
<script src="{{ asset('js/smartadmin/miscellaneous/lightgallery/lightgallery.bundle.js') }}"></script>
<script>


</script>

<script type="text/javascript">
	var maxFilesValue = {{4-$lokasi->fototanam->count()}}; // Mengambil nilai dari Laravel
	Dropzone.options.dropzoneTanam = {
		maxFilesize: 2, // Maksimum 2MB per berkas
		paramName: 'file',
		params: {
			_token: document.querySelector('meta[name="csrf-token"]').content
		},
		acceptedFiles: '.jpg, .jpeg, .png',
		addRemoveLinks: true,
		maxFiles: maxFilesValue, // Batas jumlah maksimum 4 berkas
		parallelUploads: 1, // Mengizinkan 2 berkas diunggah secara bersamaan
		init: function() {
			this.on("maxfilesexceeded", function(file) {
				alert("No more files please!");
			});

			this.on("addedfile", function() {
				var self = this;
				if (this.files[{{ 4 - $lokasi->fototanam->count() }}]!=null){
					this.removeFile(this.files[0]);
				}
			});

			this.on("success", function(file, response) {
				console.log(response);
				window.location.reload();
			});
		}
	}

	var maxFilesValue = {{4-$lokasi->fotoproduksi->count()}}; // Mengambil nilai dari Laravel
	Dropzone.options.dropzoneProduksi = {
		maxFilesize: 2, // Maksimum 2MB per berkas
		paramName: 'file',
		params: {
			_token: document.querySelector('meta[name="csrf-token"]').content
		},
		acceptedFiles: '.jpg, .jpeg, .png',
		addRemoveLinks: true,
		maxFiles: maxFilesValue, // Batas jumlah maksimum 4 berkas
		parallelUploads: 1, // Mengizinkan 2 berkas diunggah secara bersamaan
		init: function() {
			this.on("maxfilesexceeded", function(file) {
				alert("No more files please!");
			});

			this.on("addedfile", function() {
				var self = this;
				if (this.files[{{ 4 - $lokasi->fotoproduksi->count() }}]!=null){
					this.removeFile(this.files[0]);
				}
			});

			this.on("success", function (file, response) {
				console.log(response);
				window.location.reload();
			});
		}
	}
</script>
@endsection
