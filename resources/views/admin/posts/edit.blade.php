@extends('layouts.admin')
@section('styles')
<link rel="stylesheet" media="screen, print" href="{{ asset('css/formplugins/summernote/summernote-bs4.css') }}">
@endsection
@section('content')
{{-- @include('partials.breadcrumb') --}}
@include('partials.subheader')

@can('feeds_edit')
<div class="row">
    <div class="col-md-12">
        <form method="post" action="{{ route('admin.posts.update', [$post->id]) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row d-flex">
                <div class="col-lg-8">
				    {{-- input judul artikal --}}
                    <div class="form-group">
                        <input type="text" name="title" id="title"
                            class="fs-xxl form-control custom-form-control panel-hdr fw-500 {{ $errors->has('title') ? 'is-invalid' : '' }}" placeholder="Post Title" value="{{ old('title', $post->title) }}"
                            aria-describedby="title" required>
                        @if($errors->has('title'))
                            <div class="invalid-feedback">
                                {{ $errors->first('title') }}
                            </div>
                        @endif
                        <small id="helptitle" class="text-muted">{{ __('Isikan judul artikel.') }}</small>
                    </div>
                    {{-- end input judul --}}

                    {{-- article content input --}}
                    <textarea name="summernoteInput" class="summernote" required></textarea>
                    {{-- <textarea class='summernote text-wrap ' id='body' name='body'></textarea> --}}
                    {{-- end article input --}}

                    {{-- exerpt input --}}
                    <div class="panel mt-3" id="panel-1">
                        <div class="panel-hdr">
                            <h2>Kutipan | <i>Exerpt</i></h2>
                            <div class="panel-toolbar">
                                <a href="javascript:void(0);"
                                    class="mr-1 btn btn-success btn-xs btn-icon waves-effect waves-themed"
                                    data-action="panel-collapse" title="Tampil/Sembunyi Panel">
                                    <i class="fal fa-minus"></i>
                                </a>
                            </div>
                        </div>
                        <div class="panel-container show">
                            <div class="panel-content">
                                <input type="text" name="exerpt" id="exerpt"
                                    class="form-control custom-form-control"
                                    placeholder="Post Title" value="{{ old('exerpt', $post->exerpt) }}"
                                    aria-describedby="exerpt">
                            </div>
                        </div>
                    </div>

                    {{-- Post statistics --}}
                    <div class="panel mt-2" id="panel-2">
                        <div class="panel-hdr">
                            <h2>
                                Post Statistics
                            </h2>
                        </div>
                        <div class="panel-container show">
                            <div class="panel-content">
                                <div class="d-flex justify-content-between align-items-center small">
                                    <div>
                                        <span>Created at:</span>
                                        <span>{{$post->created_at}}</span>
                                    </div>
                                    <div>
                                        <span>Published at:</span>
                                        <span>{{$post->published_at}}</span>
                                    </div>
                                    <div>
                                        <span>Last update:</span>
                                        <span>{{$post->updated_at}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card" id="card-1">
                        <div class="card-header">Current Post Image</div>
                        @if (is_null($post->img_cover))
                            <img src="{{$defaultimg}}"alt=""  class="card-img-top img-fluid"
                            alt="Card image cap">
                        @else
                            <img src="{{ url('storage/img/post_img/' . $post->img_cover) }}"
                                class="card-img-top img-fluide"
                                alt="Card image cap">
                        @endif
                        <div class="card-body">
                            <div class="form-group">
                                <div class="custom-file">
                                    <input type="file" accept=".jpg" class="form-control form-control-sm" id="img_cover" name="img_cover"
                                        aria-describedby="image" value="{{ old('title', $post->img_cover) }}">
                                    <label class="custom-file-label" for="img_cover">{{ old('title', $post->img_cover) }}</label>
                                </div>
                                <span class="help-block">change post image</span>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-3" id="card-2">
                        <div class="card-header">
                            <div class="card-title h6 fs-sm">Publish</div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="priority">Priority</label>
                                <select class="form-control select2-priority" name="priority" id="priority">
                                    <option value="">Pilih Priority</option>
                                    @foreach(['1' => 'Urgent', '2' => 'High', '3' => 'Moderate', '4' => 'Low'] as $value => $label)
                                        <option value="{{ $value }}" {{ $post->priority == $value ? 'selected' : '' }}>{{ $label }}</option>
                                    @endforeach
                                </select>
                                <span class="help-block">Pilih priority yang telah disediakan.</span>
                            </div>

                            <div class="form-group">
                                <label for="category">Category</label>
                                <select class="form-control select2-placeholder" name="category" id="category">
                                    <option value="">Pilih Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ $post->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <span class="help-block">Pilih kategori yang telah disediakan.</span>
                            </div>

                            <div class="form-group">
                                <select class="form-control form-control-sm select2-user" name="author" id="author">
                                    <option value="">Pilih Author</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}" {{ $post->user_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                    @endforeach
                                </select>
                                <span class="help-block">pilih Author yang telah disediakan.</span>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-sm"
                                name="tags" id="tags" placeholder="Tambahkan tags" value=" {{ old('tags', $post->tags) }} " >
                                <span class="help-block">Berikan Tags untuk artikel ini.</span>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-between">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="draft" name="draft" {{ !empty($post->is_active)  ? 'checked' : '' }}>
                                <label class="custom-control-label" for="draft" id="statusDraft">{{ $post->published_at ? 'Publish' : 'Draft' }}</label>
                            </div>
                            <div>
                                <button class="btn btn-primary btn-xs waves-effect waves-themed mr-2 btnsave"
                                    id="saveBtn" type="submit">
                                    Update
                                </button>
                                <a href="javascript:history.back();"
                                    class="mr-1 btn btn-warning btn-xs waves-effect waves-themed btnBack"
                                    title="Batalkan">Cancel
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-3" id="card-3">
                        <div class="card-header">
                            <div class="card-title h6 fs-sm">Post Settings</div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="visibility" name="visibility" {{ !empty($post->visibility)  ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="visibility" id="visibilityLabel">Visibility</label>
                                </div>
                                <span class="help-block" id="visibilityHelp">Change the visibility of this post</span>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" {{ !empty($post->is_active)  ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="is_active" id="is_activeLabel">Inactive</label>
                                </div>
                                <span class="help-block" id="is_activeHelp">Change the visibility of this post</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>
</div>
@endcan
@endsection

@section('scripts')
@parent
<script src="{{ asset('js/formplugins/summernote/summernote-bs4.js') }}"></script>
    <script>
        $(document).ready(function() {
            //init default
            $('.summernote').summernote(
            {
                height: 515,
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
                    ['insert', ['link']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
            var content = {!! json_encode($post->body) !!};
            $('.summernote').summernote('code', content);

        });
    </script>
    <!-- summernote -->

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
    {{-- <script>
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
    </script> --}}

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
