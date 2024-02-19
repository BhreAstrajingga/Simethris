@extends('layouts.admin')
@section('content')
{{-- @include('partials.breadcrumb') --}}
	@include('partials.subheader')
	@include('partials.sysalert')
	@can('old_skl_create')
		<div class="row">
			<div class="col-12">
				<div class="panel" id="panel-1">
					<form action="{{route('verification.oldskl.store')}}" method="post" onsubmit="return confirm('Data sudah lengkap?')" enctype="multipart/form-data">
						@csrf
						<div class="panel-container show">
							<div class="panel-content">
								<div class="row d-flex justify-content-between align-items-top">
									<div class="col-md-6">
										<ul class="list-group">
											<li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
												<label for="" class="col-3">Perusahaan</label>
												<select class="form-control custom-select select2-poktan"
												name="npwp" id="select2-importir" required>
													<option value=""></option>
													@foreach ($datauser as $company)
														<option value="{{$company->npwp_company}}">
															{{$company->company_name}}
														</option>
													@endforeach
												</select>
											</li>
											<li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
												<label for="" class="col-3">Nomor RIPH</label>
												<input type="text" class="form-control form-control-sm" name="no_ijin" id="no_ijin" placeholder="Nomor RIPH">
											</li>
											<li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
												<label for="" class="col-3">Periode</label>
												<input type="number" class="form-control form-control-sm" name="periodetahun" id="periodetahun" placeholder="Tahun terbit RIPH">
											</li>
											<li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
												<label for="" class="col-3">Nomor SKL</label>
												<input type="text" class="form-control form-control-sm" name="no_skl" id="no_skl" placeholder="Nomor SKL">
											</li>
										</ul>
									</div>
									<div class="col-md-6">
										<ul class="list-group">
											<li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
												<label for="" class="col-3">Tanggal Terbit</label>
												<input type="date" class="form-control form-control-sm" name="published_date" id="published_date" placeholder="Tanggal Terbit SKL">
											</li>
											<li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
												<label for="" class="col-3">Luas tanam</label>
												<input type="number" step="0.01" class="form-control form-control-sm" name="luas_tanam" id="luas_tanam" placeholder="Luas total tanam">
											</li>
											<li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
												<label for="" class="col-3">Volume Produksi</label>
												<input type="number" step="0.01" class="form-control form-control-sm" name="volume" id="volume" placeholder="Volume total produksi">
											</li>
											<li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
												<label for="" class="col-3">Unggah SKL</label>
												<input type="file" class="form-control form-control-sm" name="sklfile" id="sklfile" placeholder="sklfile">
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
						<div class="card-header show">
							<div class="d-flex justify-content-between align-item-center">
								<div class="form-group row">
								</div>
								<div>
									<a class="btn btn-sm btn-danger" href="" role="button"><i class="fal fa-times text-align-center mr-1"></i> Batalkan</a>
									<button class="btn btn-sm btn-primary" type="submit">
										<i class="fas fa-save text-align-center mr-1"></i> Simpan
									</button>
								</div>
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
        $(function() {
            $("#select2-importir").select2({
                placeholder: "-pilih Perusahaan"
            });
        });
    });
</script>
@endsection
