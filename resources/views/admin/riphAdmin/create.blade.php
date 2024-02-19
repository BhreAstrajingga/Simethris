@extends('layouts.admin')
@section('content')
{{-- @include('partials.breadcrumb') --}}
@include('partials.subheader')
@include('partials.sysalert')

	<div class="row">
		<div class="col-md-12">
			<div class="panel" id="panel-1">
				<div class="panel-hdr">
					<h2>
						Form Isian
					</h2>
					<div class="panel-toolbar">

					</div>
				</div>
				<div class="alert alert-info border-0 mb-0">
					<div class="d-flex align-item-center">
						<div class="alert-icon">
							<div class="icon-stack icon-stack-sm mr-3 flex-shrink-0">
								<i class="base base-7 icon-stack-3x opacity-100 color-primary-400"></i>
								<i class="base base-7 icon-stack-2x opacity-100 color-primary-800"></i>
								<i class="fa fa-info icon-stack-1x opacity-100 color-white"></i>
							</div>
						</div>
						<div class="flex-1">
							<span>Halaman ini adalah form isian data RIPH yang akan digunakan sebagai parameter rujukan/acuan target yang harus dipenuhi. Data diisi secara periodik tahunan.</span>
						</div>
					</div>
				</div>
				<form action="{{route('admin.riphAdmin.store')}}" method="post">
					@csrf
					<div class="panel-container show">
						<div class="panel-content">
							<div class="row d-flex">
								<div class="col-4 mb-3">
									<div class="form-group">
										<label class="form-label" for="periode">Periode</label>
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text"><i class="fal fa-calendar"></i></span>
											</div>
											<input type="number" class="form-control " name="periode" id="periode" placeholder="tahun RIPH" required>
										</div>
										<div class="help-block">
											Tahun Data RIPH.
										</div>
									</div>
								</div>
								<div class="col-md-4 mb-3">
									<div class="form-group">
										<label class="form-label" for="jumlah_importir">Jumlah Perusahaan</label>
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text" id="jumlah_importir"><i class="fal fa-ruler"></i></span>
											</div>
											<input type="number" class="form-control " id="jumlah_importir" name="jumlah_importir" required>
										</div>
										<div class="help-block">
											Jumlah Pelaku Usaha pemegang RIPH pada periode ini.
										</div>
									</div>
								</div>
								<div class="col-md-4 mb-3">
									<div class="form-group">
										<label class="form-label">Total Volume RIPH (ton)</label>
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text"><i class="fal fa-weight-hanging"></i></span>
											</div>
											<input name="v_pengajuan_import" id="v_pengajuan_import" type="number" class="form-control" placeholder="total volume" required>
										</div>
										<div class="help-block">
											Total volume import dari seluruh RIPH Bawang Putih pada periode ini.
										</div>
									</div>
								</div>
								<div class="col-md-4 mb-3">
									<div class="form-group">
										<label class="form-label" for="v_beban_tanam">Total Komitmen Wajib Tanam (ha)</label>
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text" id="">
													<i class="fal fa-ruler"></i>
												</span>
											</div>
											<input name="v_Komitmen_tanam" id="v_beban_tanam" class="form-control" value="" readonly>
										</div>
										<div class="help-block">
											Total wajib tanam pada periode ini. Formula: (Total Volume RIPH x 5%) / 6.
										</div>
									</div>
								</div>
								<div class="col-md-4 mb-3">
									<div class="form-group">
										<label class="form-label" for="simpleinputInvalid">Total Wajib Produksi (ton)</label>
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text" id="inputGroupPrepend3"><i class="fal fa-balance-scale"></i></span>
											</div>
											<input name="v_beban_produksi" id="v_beban_produksi" type="text" class="form-control" placeholder="autocalculate" readonly>

										</div>
										<div class="help-block">
											Total wajib produksi pada periode ini. Formula: Total Volume RIPH x 5%.
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="card-footer">
						<div class="col-md-4 ml-auto text-right">
							<a href="" class="btn btn-warning btn-sm mt-3">Cancel</a>
							<button type="submit" class="btn btn-primary btn-sm mt-3">Submit</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection
<!-- start script for this page -->
@section('scripts')
<!-- @parent -->

<script>
	$(document).ready(function() {
	  var v_pengajuan_import = $('#v_pengajuan_import');
	  var v_beban_tanam = $('#v_beban_tanam');
	  var v_beban_produksi = $('#v_beban_produksi');

	  // Calculate and set the values of v_beban_tanam and v_beban_produksi inputs
	  function calculate() {
		var v_pengajuan_import_val = parseFloat(v_pengajuan_import.val()) || 0;
		var v_beban_tanam_val = (v_pengajuan_import_val * 0.05 / 6).toFixed(2);
		var v_beban_produksi_val = (v_pengajuan_import_val * 0.05).toFixed(2);

		v_beban_tanam.val(v_beban_tanam_val);
		v_beban_produksi.val(v_beban_produksi_val);
	  }

	  // Call the calculate function when v_pengajuan_import input field changes
	  v_pengajuan_import.on('input', function() {
		calculate();
	  });
	});
</script>


@endsection
