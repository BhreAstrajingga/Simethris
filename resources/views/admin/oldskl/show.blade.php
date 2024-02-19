@extends('layouts.admin')
@section('content')
{{-- @include('partials.breadcrumb') --}}
	@include('partials.subheader')
	@include('partials.sysalert')
	@can('old_skl_show')
		<div class="row">
			<div class="col-12">
				<div class="panel" id="panel-1">
					<div class="panel-container show">
						<div class="panel-content">
							<div class="row d-flex justify-content-between align-items-top">
								<div class="col-md-6">
									<ul class="list-group">
										<li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
											<label for="" class="col-3">Perusahaan</label>
											<input type="text" class="form-control form-control-sm" name="npwp" id="npwp" value="{{$datauser->company_name}}" readonly>
										</li>
										<li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
											<label for="" class="col-3">Nomor RIPH</label>
											<input type="text" class="form-control form-control-sm" name="no_ijin" id="no_ijin" value="{{$oldskl->no_ijin}}" readonly>
										</li>
										<li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
											<label for="" class="col-3">Periode</label>
											<input type="text" class="form-control form-control-sm" name="periodetahun" id="periodetahun" value="{{$oldskl->periodetahun}}" readonly>
										</li>
									</ul>
								</div>
								<div class="col-md-6">
									<ul class="list-group">
										<li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
											<label for="" class="col-3">Nomor SKL</label>
											<input type="text" class="form-control form-control-sm" name="no_skl" id="no_skl" value="{{$oldskl->no_skl}}" readonly>
										</li>
										<li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
											<label for="" class="col-3">Tanggal Terbit</label>
											<input type="text" class="form-control form-control-sm" name="published_date" id="published_date" value="{{ date('d/m/Y', strtotime($oldskl->published_date)) }}" readonly>
										</li>
										<li class="list-group-item list-group-item-action d-flex justify-content-start align-items-center">
											<label for="" class="col-3">Berkas SKL</label>
											@php
												$npwp = str_replace(['.', '-'], '', $oldskl->npwp);
											@endphp
											<a href="{{ asset('storage/uploads/'.$npwp.'/'.$oldskl->periodetahun.'/'.$oldskl->sklfile) }}" target="_blank">
												{{$oldskl->sklfile}}
											</a>
										</li>
									</ul>
								</div>
							</div>
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
        $(function() {
            $("#select2-importir").select2({
                placeholder: "-pilih Perusahaan"
            });
        });
    });
</script>
@endsection
