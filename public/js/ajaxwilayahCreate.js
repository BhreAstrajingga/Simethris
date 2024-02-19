
$(document).ready(function() {
	$(".select2-prov").select2({
		placeholder: "--Pilih Provinsi",
	});

	const $provinsiSelect = $('#provinsi_id');
	// Populate the provinsi select element with the fetched data
	$.get('/api/getAllProvinsi/', function(data) {
		// Clear the provinsi select element
		$provinsiSelect.empty().append('<option value=""></option>');
		// Populate the provinsi select element with the fetched data
		$.each(data, function(key, value) {
			$provinsiSelect.append('<option value="' + value.provinsi_id + '">' + value.provinsi_id + ' - ' + value.nama + '</option>');
		});
		// Set the selected value, if available
		$provinsiSelect.val('{{ isset($pksmitra) ? $pksmitra->provinsi->provinsi_id : '' }}');
	});

	$(function() {
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
	// Get the kabupaten select element
	const $kabupatenSelect = $('#kabupaten_id');
	const $kecamatanSelect = $('#kecamatan_id');
	const $desaSelect = $('#kelurahan_id');

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

	// Get the kecamatan select element
	

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