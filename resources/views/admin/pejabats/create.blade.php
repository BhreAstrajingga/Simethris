@extends('layouts.admin')
@section('content')
{{-- @include('partials.breadcrumb') --}}
@include('partials.subheader')
@include('partials.sysalert')
<div class="row">
	<div class="col-12">
		<div class="panel" id="panel-1">
			<div class="panel-hdr">
				<h2>
					Data Penangkar Baru
				</h2>
				<div class="panel-toolbar">
					@include('partials.globaltoolbar')
				</div>
			</div>
			<div class="panel-container show">
				<form method="POST" action="{{ route('admin.pejabat.store')}}"
					enctype="multipart/form-data">
					@csrf
					<div class="panel-content">
						<div class="row d-flex justify-content between align-items-center">
							<div class="col-lg-4 mb-3">
								<div class="form-group">
									<label class="form-label" for="nama_lembaga">Nama Pejabat</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text" id="nama_lembaga"><i class="fal fa-user-tie"></i></span>
										</div>
										<input type="text" class="form-control " id="nama" name="nama" placeholder="Prof. DR. Ir. H. Muhammad Subardi, SH, MSc." required>
									</div>
									<div class="help-block">
										Nama lengkap beserta titel yang disandang.
									</div>
								</div>
							</div>
							<div class="col-lg-4 mb-3">
								<div class="form-group">
									<label class="form-label" for="nama_pimpinan">Nomor Induk Pegawai</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text" id="nip"><i class="fal fa-address-card"></i></span>
										</div>
										<input type="text" class="form-control " id="nip" name="nip" placeholder="nomor induk pegawai" required>
									</div>
									<div class="help-block">
										NIP (Nomor Induk Pegawai) Pejabat.
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