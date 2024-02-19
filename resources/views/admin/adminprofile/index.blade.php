@extends('layouts.admin')
@section('content')
@include('partials.subheader')
@include('partials.sysalert')
<div class="row">
	<div class="col-12">
		<div id="panel-1" class="panel panel-lock show" data-panel-sortable data-panel-close data-panel-collapsed>
			<form action="{{ route('admin.profile.pejabat.store') }}" method="POST" enctype="multipart/form-data">
				@csrf
				<div class="panel-container show">
					<div class="panel-content">
						<div class="row mb-3">
							<div class="col-12">
								<div class="form-group">
									<label class="required" for="name">{{ trans('cruds.user.fields.name') }}<sup class="text-danger"> *</sup></label>
									<input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="nama" id="nama" value="{{ old('name', $user->name) }}" required>
									@if($errors->has('name'))
										<div class="invalid-feedback">
											{{ $errors->first('name') }}
										</div>
									@endif
									<span class="help-block">{{ trans('cruds.user.fields.name_helper') }}</span>
								</div>
							</div>
						</div>
						<div class="row mb-3">
							<div class="col-md-4">
								<div class="form-group">
									<label class="" for="nip">Nomor Induk Pegawai<sup class="text-danger"> *</sup></label>
									<input class="form-control {{ $errors->has('nip') ? 'is-invalid' : '' }}" type="text" name="nip" id="nip" value="{{ old('nip', $data_admin->nip ?? '') }}" required>
									@if($errors->has('nip'))
										<div class="invalid-feedback">
											{{ $errors->first('nip') }}
										</div>
									@endif
									<span class="help-block">Isi dengan Nomor Induk Pegawai Anda.</span>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="required" for="jabatan">Jabatan<sup class="text-danger"> *</sup></label>
									<input class="form-control {{ $errors->has('jabatan') ? 'is-invalid' : '' }}" type="text" name="jabatan" id="jabatan" value="{{ old('jabatan', $data_admin->jabatan ?? '') }}" required>
									@if($errors->has('jabatan'))
										<div class="invalid-feedback">
											{{ $errors->first('jabatan') }}
										</div>
									@endif
									<span class="help-block">isi data jabatan.</span>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="">Scan Tandatangan</label>
									<div class="custom-file input-group">
										<input type="file" accept=".jpg, png" class="custom-file-input" name="sign_img" id="sign_img" value="{{ old('sign_img', optional($data_admin)->sign_img) }}">
										<label class="custom-file-label" for="sign_img">{{ old('sign_img', $data_admin ? $data_admin->sign_img : 'Pilih berkas') }}</label>
									</div>
									@if ($data_admin->sign_img)
										<a href="#" class="help-block" data-toggle="modal" data-target="#viewDocs" data-doc="{{ asset('storage/uploads/dataadmin/'.$data_admin->sign_img) }}">
											<i class="fas fa-search mr-1"></i>
											Lihat Scan tandatangan.
										</a>
									@else
										<span class="help-block">Unggah hasil pindah tandatangan Anda. Berkas JPG atau PNG, max 2Mb.</span>
									@endif
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-4 col-md-5">

							</div>
							<div class="col-lg-8 col-md-7" hidden>
								<div class="form-group">
									<label class="required" for="digital_sign">Tandatangan Digital (API KEY)</label>
									<input class="form-control {{ $errors->has('digital_sign') ? 'is-invalid' : '' }}" type="text" name="digital_sign" id="digital_sign" value="{{ old('digital_sign', $data_admin->digital_sign ?? '') }}" disabled="">
									@if($errors->has('digital_sign'))
										<div class="invalid-feedback">
											{{ $errors->first('digital_sign') }}
										</div>
									@endif
									<span class="help-block">API Key untuk tandatangan digital Anda (BSN). <span class="text-danger">Sementara belum tersedia.</span></span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="card-footer d-flex justify-content-between align-items-center">
					<div></div>
					<div class="form-group">
						<a class="btn btn-danger  waves-effect waves-themed btn-sm mr-2" href="{{ route('admin.users.index') }}">
							{{ trans('global.cancel') }}
						</a>
						<button class="btn btn-primary  waves-effect waves-themed btn-sm mr-2" type="submit">
							{{ trans('global.save') }}
						</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
{{-- modal view doc --}}
<div class="modal fade" id="viewDocs" tabindex="-1" role="dialog" aria-labelledby="document" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">
					Berkas <span class="fw-300"><i>Tandatangan </i></span>
				</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<img src="" width="100%"  frameborder="0" id="scanTtd">
			</div>
		</div>
	</div>
</div>


@endsection
@section('scripts')
	@parent
	<script>
		$(document).ready(function() {
			$('#viewDocs').on('shown.bs.modal', function (e) {
				var docUrl = $(e.relatedTarget).data('doc');
				$('#scanTtd').attr('src', docUrl);
			});
		});
	</script>
@endsection
