@extends('layouts.admin')
@section('content')
{{-- @include('partials.breadcrumb') --}}
@include('partials.subheader')
@include('partials.sysalert')
@can('varietas_create')
<div class="row">
	<div class="col-12">
		<div class="panel" id="panel-1">
			<div class="panel-hdr">
				<h2>
					Data Varietas Baru
				</h2>
				<div class="panel-toolbar">
					@include('partials.globaltoolbar')
				</div>
			</div>
			<div class="panel-container show">
				<form method="POST" action="{{ route('admin.varietas.store')}}"
					enctype="multipart/form-data">
					@csrf
					<div class="panel-content">
						<div class="row d-flex justify-content between align-items-center">
							<div class="col-lg-12 mb-3">
								<div class="form-group">
									<label class="form-label" for="kode_komoditas">Kode Komoditas</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text" id="kode_komoditas"><i class="fal fa-barcode-read"></i></span>
										</div>
										<input type="text" class="form-control " id="kode_komoditas" name="kode_komoditas" placeholder="kode komoditas hortikultura">
									</div>
									<div class="help-block">
										Kode komoditas.
									</div>
								</div>
							</div>
							<div class="col-lg-12 mb-3">
								<div class="form-group">
									<label class="form-label" for="nama_komoditas">Nama Komoditas</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text" id="nama_komoditas"><i class="fal fa-leaf"></i></span>
										</div>
										<input type="text" class="form-control " id="nama_komoditas" name="nama_komoditas" placeholder="Nama Komoditas">
									</div>
									<div class="help-block">
										Nama Komoditas.
									</div>
								</div>
							</div>
							<div class="col-lg-12 mb-3">
								<div class="form-group">
									<label class="form-label" for="kode_varietas">Kode Varietas</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text" id="kode_varietas"><i class="fal fa-barcode-read"></i></span>
										</div>
										<input type="text" class="form-control " id="kode_varietas" name="kode_varietas" placeholder="kode varietas hortikultura">
									</div>
									<div class="help-block">
										Kode varietas hortikultura.
									</div>
								</div>
							</div>
							<div class="col-lg-12 mb-3">
								<div class="form-group">
									<label class="form-label" for="nama_varietas">Nama Varietas<span class="text-danger">*</span></label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text" id="nama_varietas"><i class="fal fa-seedling"></i></span>
										</div>
										<input type="text" class="form-control " id="nama_varietas" name="nama_varietas" placeholder="Nama Varietas" required>
									</div>
									<div class="help-block">
										Nama Varietas (wajib diisi).
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
<script>
	$(document).ready(function() {
		
	});
</script>


//ajax wilayah
<script>
    $(document).ready(function() {
        var switchElement = $('#status');
        var hiddenElement = $('#statusHidden');

        switchElement.on('change', function() {
            if ($(this).is(':checked')) {
                hiddenElement.val('1'); // Set the hidden field value to 1 when the switch is checked
                $(this).next('label').text('Aktif'); // Change the label text to 'Aktif'
            } else {
                hiddenElement.val('0'); // Set the hidden field value to 0 when the switch is unchecked
                $(this).next('label').text('Tidak Aktif'); // Change the label text to 'Tidak Aktif'
            }
        });
    });
</script>



@endsection