@extends('layouts.admin')
@section('content')
	{{-- @include('partials.breadcrumb') --}}
	@include('partials.subheader')
	@include('partials.sysalert')
	@can('pks_access')
		<div class="row">
			@php
				$npwp = str_replace(['.', '-'], '', $commitment->npwp);
			@endphp
			<div class="col-12">
				<div class="card-deck">
					<div class="card col-lg-4" id="panel-2">
						<div class="panel-hdr">
							<h2>Lampiran</h2>
						</div>
						@if ($saprodi->file)
							<div class="panel-container show card-body embed-responsive embed-responsive-16by9">
								<iframe class="embed-responsive-item"
									src="{{ asset('storage/uploads/'.$npwp.'/'.$commitment->periodetahun.'/pks/saprodi/'.$saprodi->file) }}" width="100%" frameborder="0">
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
					<div class="card col-lg-8" id="panel-1">
						<div class="panel-hdr">
							<h2>
								DAFTAR BANTUAN <span class="fw-300 hidden-sm-down"><i>Kegiatan Usaha Tani</i></span>
							</h2>
						</div>
						<div class="panel-container show">
							<form action="{{ route('admin.task.saprodi.update', ['pksId' => $saprodi->pks_id, 'id' => $saprodi->id]) }}
								" method="post" enctype="multipart/form-data">
								@csrf
								@method('put')
								<div class="panel-content">
									<div class="form-group">
										<label class="form-label" for="tanggal_saprodi">Tanggal</label>
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text fs-xl"><i class="fal fa-calendar-alt"></i></span>
											</div>
											<input type="date" name="tanggal_saprodi" id="tanggal_saprodi" class="form-control" value="{{old('tanggal_saprodi', ($saprodi->tanggal_saprodi))}}">
										</div>
										<span class="help-block">Tanggal pelaksanaan (penyerahan atau pembelian bantuan).</span>
									</div>
									<div class="row">
										<div class="form-group col-md-6 col-sm-12">
											<label class="form-label" for="kategori">Kategori</label>
											<div class="input-group">
												<div class="input-group-prepend">
													<span class="input-group-text"><i class="fal fa-tasks-alt"></i></span>
												</div>
												<select type="text" id="kategori" name="kategori" class="form-control" placeholder="pilih kategori">
													<option hidden>- pilih kategori</option>
													<option value="Barang" {{ old('kategori', $saprodi->kategori) === 'Barang' ? 'selected' : '' }}>Barang</option>
													<option value="Uang" {{ old('kategori', $saprodi->kategori) === 'Uang' ? 'selected' : '' }}>Uang</option>
													</select>

											</div>
											<span class="help-block">Kategori bantuan</span>
										</div>
										<div class="form-group col-md-6 col-sm-12">
											<label class="form-label" for="jenis">Jenis</label>
											<div class="input-group">
												<div class="input-group-prepend">
													<span class="input-group-text"><i class="fal fa-tasks-alt"></i></span>
												</div>
												<select type="text" id="jenis" name="jenis" class="form-control" placeholder="pilih jenis">
													<option {{ old('jenis', $saprodi->jenis) === 'Uang' ? 'selected' : '' }}>Uang</option>
													<option {{ old('jenis', $saprodi->jenis) === 'Alsintan' ? 'selected' : '' }}>Alsintan</option>
													<option {{ old('jenis', $saprodi->jenis) === 'Benih' ? 'selected' : '' }}>Benih</option>
													<option {{ old('jenis', $saprodi->jenis) === 'Pupuk' ? 'selected' : '' }}>Pupuk</option>
													<option {{ old('jenis', $saprodi->jenis) === 'Pengendali' ? 'selected' : '' }}>Pengendali</option>
													<option {{ old('jenis', $saprodi->jenis) === 'Sarana' ? 'selected' : '' }}>Sarana</option>
													<option {{ old('jenis', $saprodi->jenis) === 'Prasarana' ? 'selected' : '' }}>Prasarana</option>
													<option {{ old('jenis', $saprodi->jenis) === 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
													</select>

											</div>
											<span class="help-block">Jenis bantuan</span>
										</div>
										<div class="form-group col-7">
											<label class="form-label" for="volume">Volume</label>
											<div class="input-group">
												<div class="input-group-prepend">
													<span class="input-group-text"><i class="fal fa-box-full"></i></span>
												</div>
												<input type="number" id="volume" name="volume" class="form-control" placeholder="volume/banyak/jumlah barang" value="{{old('volume', ($saprodi->volume))}}">
											</div>
											<span class="help-block">volume</span>
										</div>
										<div class="form-group col-5">
											<label class="form-label" for="satuan">satuan</label>
											<div class="input-group">
												<div class="input-group-prepend">
													<span class="input-group-text">abc</span>
												</div>
												<input type="text" id="satuan" name="satuan" class="form-control" placeholder="unit.." aria-label="unit" aria-describedby="unit" value="{{old('satuan', ($saprodi->satuan))}}">
											</div>
											<span class="help-block">satuan barang</span>
										</div>
									</div>
									<div class="row">
										<div class="form-group col-md-5 col-sm-12">
											<label class="form-label" for="harga">Harga</label>
											<div class="input-group">
												<div class="input-group-prepend">
													<span class="input-group-text">Rp</span>
												</div>
												<input type="number" id="harga" name="harga" class="form-control" placeholder="price per unit" aria-label="price per unit" aria-describedby="price" value="{{old('harga', ($saprodi->harga))}}">
											</div>
											<span class="help-block">harga per satuan barang</span>
										</div>
										<div class="form-group col-md-7 col-sm-12">
											<label class="form-label" for="total">Total Nilai</label>
											<div class="input-group">
												<div class="input-group-prepend">
													<span class="input-group-text">Rp</span>
												</div>
												<input type="number" id="total" name class="form-control fw-600" placeholder="autocalculate" aria-label="Total Amount" aria-describedby="amount" hidden >
												<input type="text" id="formattedTotal" class="form-control fw-600" placeholder="autocalculate" aria-label="Formatted Total Amount" aria-describedby="formattedAmount" disabled>
											</div>
											<span class="help-block">Total nilai bantuan</span>
										</div>
									</div>
									<div class="form-group">
										<label class="form-label">Dokumentasi</label>
										<div class="custom-file input-group">
											<input type="file" accept=".jpg, .png" id="file" name="file" class="custom-file-input" id="customControlValidation7" value="{{old('file', ($saprodi->file))}}">
											<label class="custom-file-label" for="customControlValidation7">{{$saprodi->file}}</label>
										</div>
										<span class="help-block">Dokumentasi bantuan. Berkas berekstensi jpg atau pdf.</span>
									</div>
								</div>
								<div class="card-footer text-right">
									<button type="button" class="btn btn-sm btn-warning" data-dismiss="modal">Batal</button>
									<button type="submit" class="btn btn-sm btn-primary">Rekam</button>
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
	$(document).ready(function() {
	  // Function to calculate and update the total
	  function calculateTotal() {
		var volume = parseFloat($('#volume').val());
		var harga = parseFloat($('#harga').val());

		// Check for valid numbers
		if (isNaN(volume) || isNaN(harga)) {
		  $('#total').val(0).addClass('text-danger');
		  $('#formattedTotal').val(0).addClass('text-danger');
		} else {
		  var total = volume * harga;
		  $('#total').val(total.toFixed(2)).removeClass('text-danger');
		  $('#formattedTotal').val(formatNumber(total)).removeClass('text-danger');
		}
	  }

	  // Bind the input events to recalculate the total
	  $('#volume, #harga').on('input', calculateTotal);

	  // Function to format number with thousand separator
	  function formatNumber(number) {
		return number.toLocaleString('en-US');
	  }
	  // Trigger input event to calculate total on page load
	  $('#volume, #harga').trigger('input');
	});
</script>

@endsection
