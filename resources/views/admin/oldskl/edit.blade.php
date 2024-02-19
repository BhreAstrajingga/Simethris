@extends('layouts.admin')
@section('content')
{{-- @include('partials.breadcrumb') --}}
	@include('partials.subheader')
	@include('partials.sysalert')
	@can('old_skl_show')
		<div class="row">
			<div class="col-12">
				<div class="panel" id="panel-1">
					<form action="{{route('verification.oldskl.update', $oldskl->id)}}" method="post" onsubmit="return confirm('Data sudah lengkap?')" enctype="multipart/form-data">
						@csrf
						@method('put')
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
												@foreach($datausers as $company)
													<option value="{{ $company->npwp_company }}"{{ old('npwp', $oldskl->npwp) == $company->npwp_company ? ' selected' : '' }}>
														{{ $company->company_name }}
													</option>
												@endforeach
												
												</select>
											</li>
											<li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
												<label for="" class="col-3">Nomor RIPH</label>
												<input type="text" class="form-control form-control-sm" name="no_ijin" id="no_ijin" value="{{ old('no_ijin', $oldskl->no_ijin) }}">
											</li>
											<li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
												<label for="" class="col-3">Periode</label>
												<input type="text" class="form-control form-control-sm" name="periodetahun" id="periodetahun" value="{{ old('periodetahun', $oldskl->periodetahun) }}">
											</li>
											<li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
												<label for="" class="col-3">Nomor SKL</label>
												<input type="text" class="form-control form-control-sm" name="no_skl" id="no_skl" value="{{ old('no_skl', $oldskl->no_skl) }}">
											</li>
										</ul>
									</div>
									<div class="col-md-6">
										<ul class="list-group">
											<li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
												<label for="" class="col-3">Luas tanam</label>
												<input type="number" step="0.01" class="form-control form-control-sm" name="luas_tanam" id="luas_tanam" placeholder="Luas total tanam" value="{{ old('luas_tanam', $oldskl->luas_tanam) }}">
											</li>
											<li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
												<label for="" class="col-3">Volume Produksi</label>
												<input type="number" step="0.01" class="form-control form-control-sm" name="volume" id="volume" placeholder="Volume total produksi" value="{{ old('volume', $oldskl->volume) }}">
											</li>
											<li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
												<label for="" class="col-3">Tanggal Terbit</label>
												<input type="text" class="form-control form-control-sm" name="published_date" id="published_date" value="{{ old('published_date', date('d/m/Y', strtotime($oldskl->published_date))) }}">
											</li>
											<li class="list-group-item list-group-item-action d-flex justify-content-start align-items-center">
												<label for="" class="col-3">Berkas SKL</label>
												@php
													$npwp = str_replace(['.', '-'], '', $oldskl->npwp);
												@endphp
												<div class="custom-file">
													<input type="file" class="custom-file-input" id="inputGroupFile01">
													<label class="custom-file-label" for="inputGroupFile01">{{ old('sklfile', $oldskl->sklfile) }}</label>
												</div>

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
