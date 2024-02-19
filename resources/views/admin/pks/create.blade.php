@extends('layouts.admin')

@section('content')
{{-- @include('partials.breadcrumb') --}}
@include('partials.subheader')
@can('pks_create')
	<div class="row">
		<div class="col">
			<div class="panel" id="panel-2">
				<div class="panel-hdr">
					<h2>
						Data Perjanjian<span class="fw-300"><i>Kerjasama</i></span>
					</h2>
					<div class="panel-toolbar">
						<span class="mr-1">RIPH Nomor:</span>
							<a href="{{route('admin.task.commitments.show', $commitment->id)}}"
								class="fw-500">
								{{$commitment->no_ijin}}
							</a>
						<span>
					</div>
				</div>
				<form action=" {{route('admin.task.pksmitra.store')}}"
					method="POST" enctype="multipart/form-data">
					@csrf
					<div class="panel-container show">
						<div class="panel-content">
							<input type="text" id="commitmentbackdate_id" name="commitmentbackdate_id" value="{{$commitment->id}}" hidden>
							<input type="text" id="no_ijin" name="no_ijin" value="{{$commitment->no_ijin}}" hidden>
							<div class="row d-flex">
								<div class="col-md-6 mb-3">
									<div class="form-group">
										<label class="form-label" for="no_perjanjian">Nomor Perjanjian</label>
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text" id="no_perjanjian">123</span>
											</div>
											<input type="text" class="form-control " id="no_perjanjian" name="no_perjanjian"
												required>
										</div>
										<div class="help-block">
											Nomor Pejanjian Kerjasama dengan Poktan Mitra.
										</div>
									</div>
								</div>
								<div class="col-md-6 mb-3">
									<div class="form-group">
										<label class="form-label" for="master_kelompok_id">Kelompoktani - Pimpinan</label>
										<div class="input-group">
											<select class="form-control custom-select select2-poktan"
											name="master_kelompok_id" id="master_kelompok_id" required>
												@foreach ($masterkelompoks as $poktan)
													<option value="{{$poktan->id}}">
														{{$poktan->id}}. {{$poktan->nama_kelompok}} - {{$poktan->nama_pimpinan}}
													</option>
												@endforeach
											</select>
										</div>
										<div class="help-block">
											Kelompoktani Mitra pelaksanaan wajib tanam-produksi sesuai dokumen PKS.
										</div>
									</div>
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
											<input type="number" class="form-control " name="luas_rencana" id="luas_rencana" >
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
											<div class="input-group-prepend">
												<span class="input-group-text" id="varietas_tanam"><i class="fal fa-seedling"></i></span>
											</div>
											<input type="text" class="form-control " name="varietas_tanam" id="varietas_tanam"
												placeholder="varietas yang akan ditanam" >
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
												<span class="input-group-text" id="varietas"><i class="fal fa-calendar-week"></i></span>
											</div>
											<input type="text" name="periode_tanam" id="periode_tanam"
												class="form-control " placeholder="misal: Jan-Feb" aria-describedby="helpId">
										</div>
										<div class="help-block">
											Periode tanam sesuai dokumen perjanjian.
										</div>
									</div>
								</div>
								<div class="col-md-6 mb-3">
									<div class="form-group">
										<label class="form-label" for="provinsi">Provinsi</label>
										<div class="input-group">
											<select class="select2-prov form-control" id="provinsi_id" name="provinsi_id" required>
												<option value="">--pilih Provinsi--</option>
											  </select>
										</div>
										<div class="help-block">
											Provinsi tempat terjadinya perjanjian.
										</div>
									</div>
								</div>
								<div class="col-md-6 mb-3">
									<div class="form-group">
										<label class="form-label" for="kabupaten">Kabupaten/Kota</label>
										<div class="input-group">
											<select class="select2-kab form-control" id="kabupaten_id" name="kabupaten_id" required>
											</select>
										</div>
										<div class="help-block">
											Pilih Kabupaten tempat terjadinya perjanjian.
										</div>
									</div>
								</div>
								<div class="col-md-6 mb-3">
									<div class="form-group">
										<label class="form-label" for="kecamatan">Kecamatan</label>
										<div class="input-group">
											<select class="select2-kec form-control" id="kecamatan_id" name="kecamatan_id" required>
											</select>
										</div>
										<div class="help-block">
											Pilih Kecamatan tempat terjadinya perjanjian.
										</div>
									</div>
								</div>
								<div class="col-md-6 mb-3">
									<div class="form-group">
										<label class="form-label" for="kelurahan_id">Desa</label>
										<div class="input-group">
											<select class="select2-des form-control" name="kelurahan_id" id="kelurahan_id" required>
											</select>
										</div>
										<div class="help-block">
											Pilih Desa tempat terjadinya perjanjian.
										</div>
									</div>
								</div>
								<div class="col-md-6 mb-3">
									<label class="form-label">Unggah Berkas PKS (Perjanjian Kerjasama)</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text" id="inputGroupPrepend3">PKS</span>
										</div>
										<div class="custom-file">
											<input type="file" accept=".pdf" class="custom-file-input" id="berkas_pks" name="berkas_pks">
											<label class="custom-file-label" for="berkas_pks">Choose file...</label>
										</div>
									</div>
									<div class="help-block">Unggah hasil pemindaian berkas Form-5 dalam bentuk pdf, max 2Mb.</div>
								</div>
							</div>
						</div>
					</div>
					<div class="card-footer">
						<div class="col-md-4 ml-auto text-right">
							<a href="{{route('admin.task.commitments.show', $commitment->id)}}" class="btn btn-warning btn-sm">
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

<!-- start script for this page -->
@section('scripts')
@parent

<script>
    $(document).ready(function() {
        $(function() {
            $(".select2-poktan").select2({
                placeholder: "Kelompoktani"
            });
            $(".select2-prov").select2({
                placeholder: "--pilih Provinsi"
            });
            $(".select2-kab").select2({
                placeholder: "--pilih Kabupaten"
            });
            $(".select2-kec").select2({
                placeholder: "--pilih Kecamatan"
            });
            $(".select2-des").select2({
                placeholder: "--pilih Desa/Kelurahan"
            });
        });
    });
</script>




<script>
	$(document).ready(function() {
		const $provinsiSelect = $('#provinsi_id');
		// Populate the provinsi select element with the fetched data
		$.get('/api/getAllProvinsi/', function(data) {
			// Clear the provinsi select element
			$provinsiSelect.empty().append('<option value=""></option>');
			// Populate the provinsi select element with the fetched data
			$.each(data, function(key, value) {
				$provinsiSelect.append('<option value="' + value.provinsi_id + '">' + value.provinsi_id + ' - ' + value.nama + '</option>');
			});
		});
		// Get the kabupaten select element
		const $kabupatenSelect = $('#kabupaten_id');
		// Add an event listener to the provinsi select element
		$('#provinsi_id').on('change', function() {
			const provinsiId = $(this).val();
			if (provinsiId) {
			// Make an AJAX request to fetch the corresponding kabupaten
			$.get('/api/getKabupatenByProvinsi/' + provinsiId, function(data) {
				// Clear the kabupaten select element
				$kabupatenSelect.empty().append('<option value=""></option>');
				// Populate the kabupaten select element with the fetched data
				$.each(data, function(key, value) {
				$kabupatenSelect.append('<option value="' + value.kabupaten_id + '">' + value.kabupaten_id + ' - ' + value.nama_kab + '</option>');
				});
			});
			} else {
			// Clear the kabupaten select element if no provinsi is selected
			$kabupatenSelect.empty().append('<option value=""></option>');
			}
		});

		// Get the kecamatan select element
		const $kecamatanSelect = $('#kecamatan_id');

		// Add an event listener to the provinsi select element
		$('#kabupaten_id').on('change', function() {
			const kabupatenId = $(this).val();
			if (kabupatenId) {
			// Make an AJAX request to fetch the corresponding kabupaten
			$.get('/api/getKecamatanByKabupaten/' + kabupatenId, function(data) {
				// Clear the kabupaten select element
				$kecamatanSelect.empty().append('<option value=""></option>');
				// Populate the kabupaten select element with the fetched data
				$.each(data, function(key, value) {
				$kecamatanSelect.append('<option value="' + value.kecamatan_id + '">' + value.kecamatan_id + ' - '  + value.nama_kecamatan + '</option>');
				});
			});
			} else {
			// Clear the kabupaten select element if no provinsi is selected
			$kecamatanSelect.empty().append('<option value=""></option>');
			}
		});

		// Get the kecamatan select element
		const $desaSelect = $('#kelurahan_id');

		// Add an event listener to the provinsi select element
		$('#kecamatan_id').on('change', function() {
			const kecamatanId = $(this).val();
			if (kecamatanId) {
			// Make an AJAX request to fetch the corresponding kabupaten
			$.get('/api/getDesaByKecamatan/' + kecamatanId, function(data) {
				// Clear the kabupaten select element
				$desaSelect.empty().append('<option value=""></option>');
				// Populate the kabupaten select element with the fetched data
				$.each(data, function(key, value) {
				$desaSelect.append('<option value="' + value.kelurahan_id + '">' + value.kelurahan_id + ' - '  + value.nama_desa + '</option>');
				});
			});
			} else {
			// Clear the kabupaten select element if no provinsi is selected
			$desaSelect.empty().append('<option value=""></option>');
			}
		});
	});
</script>
@endsection
