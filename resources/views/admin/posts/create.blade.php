@extends('layouts.admin')
@section('styles')
<link rel="stylesheet" media="screen, print" href="{{ asset('css/formplugins/summernote/summernote-bs4.css') }}">
@endsection
@section('content')
{{-- @include('partials.breadcrumb') --}}
@include('partials.subheader')


@can('feeds_create')
	<form method="post" action="{{ route('admin.posts.store') }}" enctype="multipart/form-data">
		@csrf
		<div class="row d-flex">
			<div class="col-lg-8">
				{{-- input judul artikal --}}
				<div class="form-group">
					<input type="text" name="title" id="title"
						class="form-control custom-form-control panel-hdr fw-500 {{ $errors->has('title') ? 'is-invalid' : '' }}" placeholder="Post Title" value="{{ old('title', '') }}"
						aria-describedby="title" required>
					@if($errors->has('title'))
						<div class="invalid-feedback">
							{{ $errors->first('title') }}
						</div>
					@endif
					<small id="title" class="text-muted">{{ __('Isikan judul artikel.') }}</small>
				</div>
				{{-- end input judul --}}

				{{-- article content input --}}
				<textarea name="summernoteInput" class="summernote" required></textarea>
				{{-- <textarea class='summernote text-wrap ' id='body' name='body'></textarea> --}}
				{{-- end article input --}}

				{{-- exerpt input --}}
				<div class="panel mt-3" id="panel-1">
					<div class="panel-hdr">
						<h2>Exerpt</h2>
						<div class="panel-toolbar">
							<a href="javascript:void(0);"
								class="mr-1 btn btn-success btn-xs btn-icon waves-effect waves-themed"
								data-action="panel-collapse" title="Tampil/Sembunyi Panel">
								<i class="fal fa-minus"></i>
							</a>
						</div>
					</div>
					<div class="panel-container collapse">
						<div class="panel-content">
							<textarea class="form-control" placeholder="type exerpt here" id="exerpt" name="exerpt" rows="2"></textarea>
						</div>
					</div>
				</div>

				{{-- <div id="panel-1" class="panel">
					<div class="panel-hdr">
						<h2>
							Artikel/berita | <span class="fw-300"><i>Tambah</i></span>
						</h2>
						<div class="panel-toolbar">
							<div class="form-group">
								<button class="btn btn-success  waves-effect waves-themed btn-sm mr-2 btnsave" type="submit">
									{{ trans('global.save') }}
								</button>
								<a class="btn btn-danger  waves-effect waves-themed btn-sm mr-2" href="{{ route('admin.posts.index') }}">
									{{ trans('global.cancel') }}
								</a>
							</div>
						</div>
					</div>
					<div class="panel-container show">
						<div class="panel-content">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="required" for="title">{{ __('Judul artikel') }}<span class="text-danger">*</span></label>
										<input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', '') }}" required>
										@if($errors->has('title'))
											<div class="invalid-feedback">
												{{ $errors->first('title') }}
											</div>
										@endif
										<span class="help-block">{{ __('Isikan judul artikel.') }}</span>
									</div>

									<div class="form-group row">
										<div class="col-md-12">
											<label class="form-label" for="body">{{ __('Isi artikel') }} <span class="text-danger">*</span></label>
											<textarea name="summernoteInput" class="summernote"></textarea>
											<div class="help-block">{{ __('Tuliskan artikel anda disini.') }}</div>
										</div>
									</div>

								</div>
								<div class="col-md-12 mt-3">
									<div class="d-flex mb-3">
										<span class="mr-auto">
											<div class="form-group">
												<div class="custom-control custom-switch" data-toggle="tooltip" title
													data-original-title="Aktif/deaktivasi artikel ini untuk seluruh pengguna">
													<input type="checkbox" class="custom-control-input" id="is_active" name="is_active">
													<label class="custom-control-label" for="is_active">Draft / Publish</label>
												</div>
											</div>
										</span>
									</div>

									<div class="form-group">
										<label class="form-label" for="tags">Tags</label>
										<div class="input-group input-group-sm input-group-multi-transition">
											<input type="text" class="form-control form-control-sm" aria-label="" name="tags" id="tags"
												placeholder="tambahkan tag.." value="">
										</div>
										<span class="help-block">Tag untuk artikel ini.</span>
									</div>

								</div>
							</div>
						</div>
					</div>
				</div> --}}
			</div>
			<div class="col-lg-4">
				<div class="card">
					<div class="card-header">
						<div class="card-title h6 fs-sm">Publish</div>
					</div>
					<div class="card-body">
						<div class="form-group">
							<div class="custom-file">
								<input type="file" accept=".jpg" class="form-control form-control-sm" id="img_cover" name="img_cover"
									aria-describedby="image">
								<label class="custom-file-label" for="img_cover"></label>
							</div>
							<span class="help-block">add image for this article</span>
						</div>
						<div class="form-group">
							<select class="form-control select2-priority" name="priority" id="priority">
								<option value="">Pilih Priority</option>
								<option value="1">Urgent</option>
								<option value="2">High</option>
								<option value="3">Moderate</option>
								<option value="4">Low</option>
							</select>
							<span class="help-block">pilih kategori yang telah disediakan.</span>
						</div>
						<div class="form-group">
							<select class="form-control select2-placeholder" name="category" id="category">
								<option value="">Pilih Category</option>
								@foreach ($categories as $category)
									<option value="{{ $category->id }}">{{ $category->name }}</option>
								@endforeach
							</select>
							<span class="help-block">pilih kategori yang telah disediakan.</span>
						</div>
						<div class="form-group">
							<select class="form-control form-control-sm select2-user" name="author" id="author">
								<option value="">Pilih Author</option>
								@foreach ($users as $user)
									<option value="{{ $user->id }}">{{ $user->name }}</option>
								@endforeach
							</select>
							<span class="help-block">pilih Author yang telah disediakan.</span>
						</div>
						<div class="form-group">
							<input type="text" class="form-control form-control-sm"
							name="tags" id="tags" placeholder="Tambahkan tags" value=" {{ old('tags', '') }} " >
							<span class="help-block">Berikan Tags untuk artikel ini.</span>
						</div>
					</div>
					<div class="card-footer d-flex justify-content-between">
						<div class="custom-control custom-switch">
							<input type="checkbox" class="custom-control-input" id="draft" name="draft">
							<label class="custom-control-label" for="draft" id="statusDraft">Draft</label>
						</div>
						<button class="btn btn-primary btn-xs waves-effect waves-themed mr-2 btnsave" id="saveBtn"
							type="submit">Simpan Draft</button>
					</div>
				</div>
				<div class="card mt-3">
					<div class="card-header">
						<div class="card-title h6 fs-sm">Post Settings</div>
					</div>
					<div class="card-body">
						<div class="form-group">
							<div class="custom-control custom-switch">
								<input type="checkbox" class="custom-control-input" id="visibility" name="visibility">
								<label class="custom-control-label" for="visibility" id="visibilityLabel">Visibility</label>
							</div>
							<span class="help-block" id="visibilityHelp">Change the visibility of this post</span>
						</div>
						<div class="form-group">
							<div class="custom-control custom-switch">
								<input type="checkbox" class="custom-control-input" id="is_active" name="is_active">
								<label class="custom-control-label" for="is_active" id="is_activeLabel">Visibility</label>
							</div>
							<span class="help-block" id="is_activeHelp">Change the visibility of this post</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
@endcan
@endsection

<!-- start script for this page -->
@section('scripts')
@parent

{{-- summernote for textarea --}}
    <script src="{{ asset('js/formplugins/summernote/summernote-bs4.js') }}"></script>
    <script>
        $(document).ready(function() {
            //init default
            $('.summernote').summernote(
            {
                height: 200,
                dialogsFade: true,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['fontsize', ['fontsize']],
                    ['fontname', ['fontname']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['table', ['table']],
                    ['insert', ['link']], //['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });

        });
    </script>

{{-- select2 for select option features --}}
    <script>
        $(document).ready(function() {
            $(function() {
                $(".select2-priority").select2({
                    placeholder: "Select Priority",
                    allowClear: true
                });

                $(".select2-placeholder").select2({
                    placeholder: "Select Category",
                    allowClear: true
                });

                $(".select2-user").select2({
                    placeholder: "Select Author",
                    allowClear: true
                });
            });
        });
    </script>

    {{-- radio draft-publish button --}}
    <script>
        const switchBtn = document.querySelector('#draft');
        const status = document.querySelector('#status');
        const saveBtn = document.querySelector('#saveBtn');

        switchBtn.addEventListener('change', function() {
            if (this.checked) {
                statusDraft.innerHTML = "Publish";
                saveBtn.innerHTML = "Publish";
            } else {
                statusDraft.innerHTML = "Draft";
                saveBtn.innerHTML = "Simpan Draft";
            }
        });
    </script>

	<script>
		const visibilitySwitch = document.querySelector('#visibility');
		const visibilityLabel = document.querySelector('#visibilityLabel');
		const visibilityHelp = document.querySelector('#visibilityHelp');

		visibilitySwitch.addEventListener('change', function() {
			if (this.checked) {
				visibilityLabel.innerHTML = "Visible";
				visibilityHelp.innerHTML = "This post will be visible to everyone";
			} else {
				visibilityLabel.innerHTML = "Hidden";
				visibilityHelp.innerHTML = "This post will be hidden from everyone";
			}
		});

	</script>

	<script>
		const is_activeSwitch = document.querySelector('#is_active');
		const is_activeLabel = document.querySelector('#is_activeLabel');
		const is_activeHelp = document.querySelector('#is_activeHelp');

		is_activeSwitch.addEventListener('change', function() {
			if (this.checked) {
				is_activeLabel.innerHTML = "is Active";
				is_activeHelp.innerHTML = "set status ON for is_active column";
			} else {
				is_activeLabel.innerHTML = "is Inactive";
				is_activeHelp.innerHTML = "set status OFF for is_active column";
			}
		});

	</script>
@endsection
