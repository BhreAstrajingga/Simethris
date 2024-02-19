@extends('layouts.admin')
@section('content')
{{-- @include('partials.breadcrumb') --}}
@include('partials.subheader')
@can('template_create')
<div class="row">
    <div class="col-md-12">
        <form method="POST" action="{{ route("admin.task.template.store") }}" enctype="multipart/form-data">
            @csrf
            <div id="panel-1" class="panel" data-title="Panel Data" data-intro="Panel ini berisi data-data" data-step="2">
                <div class="panel-hdr">
                    <h2>
                        Master Template | <span class="fw-300"><i>Tambah</i></span>
                    </h2>
                    <div class="panel-toolbar">
                        <div class="form-group">
                            <button class="btn btn-success  waves-effect waves-themed btn-sm mr-2 btnsave" type="submit">
                                {{ trans('global.save') }}
                            </button>
                            <a class="btn btn-danger  waves-effect waves-themed btn-sm mr-2" href="{{ route('admin.task.template') }}">
                                {{ trans('global.cancel') }}
                            </a>
                        </div>
                    </div>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="required" for="kind">{{ __('Nama Berkas') }} <span class="text-danger">*</span></label>
                                    <input class="form-control {{ $errors->has('kind') ? 'is-invalid' : '' }}" type="text" name="kind" id="kind" value="{{ old('kind', '') }}" required>
                                    @if($errors->has('kind'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('kind') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ __('Nama berkas.') }}</span>
                                </div>

                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="required" for="description">{{ __('Keterangan') }} <span class="text-danger">*</span></label>
                                    <input class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" type="text" name="description" id="description" value="{{ old('description', '') }}" >
                                    @if($errors->has('description'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('description') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ __('Keterangan berkas.') }}</span>
                                </div>
                            </div>
                        </div>

                        <div class='form-group row'>
                            <div class="col-lg-6">
                                <label class="form-label" for="firstname">File <span class="text-danger">*</span></label>
                                <div class="custom-file">
                                    <input type="file" accept=".docx, .pdf" class="custom-file-input" name="fileUnggah" aria-describedby="fileUnggah" >
                                    <label class="custom-file-label" for="fileUnggah"></label>
                                </div>
                                <span class="help-block">Unggah file template.</span>
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
<!-- @parent -->
<!-- start script for this page -->
@section('scripts')
<script src="/js/formplugins/select2/select2.bundle.js"></script>
<script>
    $(document).ready(function() {

    });
</script>
@endsection
