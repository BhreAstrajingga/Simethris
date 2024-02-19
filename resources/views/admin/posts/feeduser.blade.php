@extends('layouts.admin')
@section('content')
    {{-- @include('partials.breadcrumb') --}}
    @include('partials.subheader')

    <div class="" data-title="System Alert"
        data-intro="Ini adalah Panel yang berisi informasi atau pemberitahuan penting untuk Anda." data-step="1">
        @include('partials.sysalert')</div>

    <div class="row">
        <div class="col-md-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>
                        <i class="subheader-icon fal fa-ballot-check mr-1"></i>Articles
                    </h2>
                    <div class="panel-toolbar">
                        {{-- for toolbar panel --}}
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
                            <span>Anda dapat melihat berita dan informasi terbaru yang dikirimkan oleh Administrator di
                                sini.</span>
                        </div>
                    </div>
                </div>
                <div class="panel-container show">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped w-100" id="dt_feeds">
                            <tbody>
                                @foreach ($someposts as $post)
                                    <tr>
                                        <td hidden></td>
                                        <td style="width: 70%">
                                            <div class="col-md">
                                                <div class="p-1">
                                                    <div class="d-flex flex-column">
                                                        <div class="row align-items-center">
                                                            <div class="col-3">
                                                                <div class="d-flex justify-content-left">
                                                                    @if (is_null($post->img_cover))
                                                                        <img src="{{ asset('/img/image-solid.svg') }}"
                                                                            class="" style="width:100%"
                                                                            alt="">
                                                                    @else
                                                                        <img src="{{ asset(old('img_cover', 'img/posts_img/' . $post->img_cover)) }}"
                                                                            class="" style="width:100%"
                                                                            alt="">
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-9">
                                                                <div class="mb-0">
                                                                    <a href="{{ route('admin.posts.show', $post->id) }}"
                                                                        class="fs-lg fw-500 mr-2">
                                                                        <span class="d-inline-block text-truncate"
                                                                            style="max-width:400px">
                                                                            {{ $post->title }}
                                                                        </span>
                                                                    </a>
                                                                </div>
                                                                <div class="d-flex align-items-center">
                                                                    <span class="d-inline-block text-truncate"
                                                                        style="max-width:400px">
                                                                        {{ $post->body }}
                                                                    </span>
                                                                </div>
                                                                <div class="text-muted fs-xs">
                                                                    created by:
                                                                    <span class="fw-700 mr-1 text-info">
                                                                        {{ $post->user->name }}
                                                                    </span>
                                                                    <span>on
                                                                        <i class="fal fa-calendar-day mr-1"></i>
                                                                        {{ $post->created_at }}
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                {{-- bagaimana cara menampilkan Nama kategori berdasarkan id lalu diberikan warna sesuai dengan id --}}
                                                <a class="badge btn-sm btn-primary text-white"
                                                    title="Kategori Artikel">{{ $post->category->name }}</a>
                                                @if ($post->is_published == '1')
                                                    <a class="badge btn-sm btn-success text-white"
                                                        title="telah dipublikasikan">Published</a>
                                                @else
                                                    <a class="badge btn-sm btn-warning text-white"
                                                        title="belum dipublikasikan">Unpublished</a>
                                                @endif
                                                @if (\Auth::user()->roleaccess == '1')
                                                    <a href="{{ route('admin.posts.edit', $post->id) }}"
                                                        class="badge btn-sm btn-info" role="button" title="Ubah Artikel"><i
                                                            class="fal fa-edit"></i>
                                                        Edit</a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<!-- @parent -->
<!-- start script for this page -->
@section('scripts')
@endsection
