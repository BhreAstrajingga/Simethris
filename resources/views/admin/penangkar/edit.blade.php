@extends('layouts.admin')
@section('content')
{{-- @include('partials.breadcrumb') --}}
@include('partials.subheader')
@include('partials.sysalert')
@can('poktan_access')
<div class="row">
	<div class="col-12">
		<div class="panel" id="panel-1">
			<div class="panel-hdr">
				<h2>
					Ubah Data Penangkar
				</h2>
				<div class="panel-toolbar">
					@include('partials.globaltoolbar')
				</div>
			</div>
			<div class="panel-container show">
				<form method="POST" action="{{ route('admin.task.masterpenangkar.update', $masterpenangkar->id)}}"
					enctype="multipart/form-data">
					@csrf
					@method('PUT')
					<div class="panel-content">
						<div class="row d-flex justify-content between align-items-center">
							<div class="col-lg-4 mb-3">
								<div class="form-group">
									<label class="form-label" for="nama_lembaga">Nama Lembaga</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text" id="nama_lembaga">
												<i class="fal fa-industry-alt"></i>
											</span>
										</div>
										<input type="text" class="form-control " id="nama_lembaga" name="nama_lembaga" 
											value="{{old('nama_lembaga', $masterpenangkar->nama_lembaga)}}"
											placeholder="contoh: CV. Benih Bawang" required>
									</div>
									<div class="help-block">
										Nama lembaga penangkar benih.
									</div>
								</div>
							</div>
							<div class="col-lg-4 mb-3">
								<div class="form-group">
									<label class="form-label" for="nama_pimpinan">Nama pimpinan</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text" id="nama_pimpinan">
												<i class="fal fa-user"></i>
											</span>
										</div>
										<input type="text" class="form-control " id="nama_pimpinan" name="nama_pimpinan" value="{{old
											('nama_pimpinan', $masterpenangkar->nama_pimpinan)}}"
											placeholder="contoh: Ahmad Sobari" required>
									</div>
									<div class="help-block">
										Nama pimpinan lembaga penangkar benih.
									</div>
								</div>
							</div>
							<div class="col-lg-4 mb-3">
								<div class="form-group">
									<label class="form-label" for="hp_pimpinan">Nomor Kontak</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text" id="hp_pimpinan">
												<i class="fal fa-mobile-android"></i>
											</span>
										</div>
										<input type="text" class="form-control " id="hp_pimpinan" name="hp_pimpinan" placeholder="contoh: 08121234567890" required>
									</div>
									<div class="help-block">
										Nomor kontak penangkar yang masih aktif.
									</div>
								</div>
							</div>
							<div class="col-12 mb-3">
								<div class="form-group">
									<label class="form-label" for="hp_pimpinan">Alamat</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text" id="alamat"><i class="fal fa-map-marker-alt"></i></span>
										</div>
										<input type="text" class="form-control " id="alamat" name="alamat" value="{{$masterpenangkar->alamat}}">
									</div>
									<div class="help-block">
										Alamat lengkap lembaga penangkar.
									</div>
								</div>
							</div>
							<div class="col-md-6 mb-3">
								<div class="form-group">
									<label class="form-label" for="provinsi">Provinsi</label>
									<div class="input-group">
										<select class="form-control custom-select select2-prov"
										name="provinsi_id" id="provinsi_id" required>
											{{-- <option value="{{ isset($masterpenangkar) ? $masterpenangkar->provinsi->provinsi_id : '' }}">
												{{ isset($masterpenangkar) ? $masterpenangkar->provinsi->provinsi_id. '. ' .  $masterpenangkar->provinsi->nama   : 'Load Record' }}
											</option> --}}
										</select>
									</div>
								</div>
							</div>
							<div class="col-md-6 mb-3">
								<div class="form-group">
									<label class="form-label" for="kabupaten">Kabupaten/Kota</label>
									<div class="input-group">
										<select class="select2-kab form-control" id="kabupaten_id" name="kabupaten_id" required>
											<option value="{{ isset($masterpenangkar) ? $masterpenangkar->kabupaten->kabupaten_id : '' }}">
												{{ isset($masterpenangkar) ? $masterpenangkar->kabupaten->kabupaten_id. '. ' .  $masterpenangkar->kabupaten->nama_kab   : 'Load Record' }}
											</option>
										</select>
									</div>
								</div>
							</div>
							<div class="col-md-6 mb-3">
								<div class="form-group">
									<label class="form-label" for="kabupaten">Kecamatan</label>
									<div class="input-group">
										<select class="select2-kab form-control" id="kecamatan_id" name="kecamatan_id" required>
											<option value="{{ isset($masterpenangkar) ? $masterpenangkar->kecamatan_id : '' }}">
												{{ isset($masterpenangkar) ? $masterpenangkar->kecamatan_id. '. ' . 
												$masterpenangkar->kecamatan->nama_kecamatan   : 'Load Record' }}
											</option>
										</select>
									</div>
								</div>
							</div>
							<div class="col-md-6 mb-3">
								<div class="form-group">
									<label class="form-label" for="kabupaten">Desa/kelurahan</label>
									<div class="input-group">
										<select class="select2-kab form-control" id="kelurahan_id" name="kelurahan_id" required>
											<option value="{{ isset($masterpenangkar) ? $masterpenangkar->kelurahan_id : '' }}">
												{{ isset($masterpenangkar) ? $masterpenangkar->kelurahan_id. '. ' . 
												$masterpenangkar->desa->nama_desa   : 'Load Record' }}
											</option>
										</select>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="card-footer">
						<div class="d-flex justify-content-end align-itmes-center">
							<div></div>
							<div>
								<button class="btn btn-primary btn-sm" role="button" type="submit">
									<i class="fal fa-save"></i>
									Simpan
								</button>
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

//ajax wilayah
<script>
	$(document).ready(function() {
		$(".select2-prov").select2({
			placeholder: "--Pilih Provinsi",
		});
		const $provinsiSelect = $('#provinsi_id');
		const oldValue = '{{ isset($masterpenangkar) ? $masterpenangkar->provinsi_id : '' }}';
		// Populate the provinsi select element with the fetched data
		$.get('/api/getAllProvinsi/', function(data) {
			// Clear the provinsi select element
			$provinsiSelect.empty().append('<option value=""></option>');
			// Populate the provinsi select element with the fetched data
			$.each(data, function(key, value) {
				$provinsiSelect.append('<option value="' + value.provinsi_id + '">' + value.provinsi_id + ' - ' + value.nama + '</option>');
			});
			// Set the selected value, if available
			$provinsiSelect.val(oldValue);
		});
	});
</script>


<script>
	$(document).ready(function() {
		$(".select2-kab").select2({
			placeholder: "--Pilih Kabupaten",
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
				$kecamatanSelect.empty().append('<option value=""></option>');
				$desaSelect.empty().append('<option value=""></option>');
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
	});
</script>

<script>
	$(document).ready(function() {
		$(".select2-kec").select2({
			placeholder: "--Pilih Kecamatan",
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
	});
</script>

<script>
	$(document).ready(function() {
		$(".select2-des").select2({
			placeholder: "--Pilih Desa/kelurahan",
		});
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