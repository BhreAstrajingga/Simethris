@extends('layouts.admin')
@section('content')
{{-- @include('partials.breadcrumb') --}}
@include('partials.subheader')
@include('partials.sysalert')
<div class="row">
	<div class="col-12">
		<div class="panel" id="panel-1">
			<div class="panel-container show">
				<form method="POST" action="{{ route('admin.template.store')}}"
					enctype="multipart/form-data">
					@csrf
					<div class="panel-content">
						<div class="row d-flex justify-content between align-items-center">
							<div class="col-lg-4 mb-3">
								<div class="form-group">
									<label class="form-label" for="nama_lembaga">Nama Form</label>
									<div class="input-group">
										<input type="text" class="form-control " id="berkas" name="berkas" placeholder="misal: form-RT" required>
									</div>
									<div class="help-block">
										Nama form template.
									</div>
								</div>
							</div>
							<div class="col-lg-4 mb-3">
								<div class="form-group">
									<label class="form-label" for="nama_lembaga">Nama Berkas</label>
									<div class="input-group">
										<input type="text" class="form-control " id="nama_berkas" name="nama_berkas" placeholder="misal: Form Rencana Tanam" required>
									</div>
									<div class="help-block">
										Nama berkas.
									</div>
								</div>
							</div>
							<div class="col-lg-4 mb-3">
								<div class="form-group">
									<label class="form-label" for="lampiran">Unggah Berkas</label>
									<div class="input-group">
										<div class="custom-file">
											<input type="file" accept=".docx, .pdf" class="custom-file-input" id="lampiran" name="lampiran" aria-describedby="lampiran" required>
											<label class="custom-file-label" for="lampiran">
												pilih berkas
											</label>
										</div>
									</div>
									<span class="help-block">Unggah contoh berkas template.</span>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-12">
								<div class="form-group">
									<label class="form-label" for="nama_lembaga">Deskripsi/Keterangan</label>
									<div class="input-group">
										<textarea type="text" class="form-control " id="deskripsi" name="deskripsi" required></textarea>
									</div>
									<div class="help-block">
										Deskripsi atau keterangan untuk berkas yang diunggah tersebut.
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
@endsection
