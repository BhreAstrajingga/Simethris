@extends('layouts.admin')
@section('content')
    {{-- @include('partials.breadcrumb') --}}
    @include('partials.subheader')

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <div class="d-flex flex-start w-100">
                <div class="mr-2 hidden-md-down">
                    <span class="icon-stack icon-stack-lg">
                        <i class="base base-7 icon-stack-3x opacity-100 color-success-500"></i>
                        <i class="base base-7 icon-stack-2x opacity-100 color-success-300 fa-flip-vertical"></i>
                        <i class="fas fa-check icon-stack-1x opacity-100 color-white"></i>
                    </span>
                </div>
                <div class="d-flex flex-fill">
                    <div class="flex-fill">
                        <span class="h5">Success</span>
                        <p>
                            {{ $message }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    @endif


    {{-- <div class="row">
        @foreach ($posts->where('is_deleted', '0') as $post)
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center mb-3">
                        <div class="col-3">
                            <div class="d-flex align-items-center justify-content-center" style="width:100%">
                                @if (is_null($post->img_cover))
                                    <img src="{{ asset('/img/simet.jpg') }}" class="img-thumbnail" alt="">
                                @else
                                    <img src="{{ asset(old('img_cover', 'img/' . $post->img_cover)) }}"
                                        class="img-thumbnail" alt="">
                                @endif
                            </div>
                        </div>
                        <div class="col-9">
                            content
                        </div>

                    </div>
                </div>
            </div>
        @endforeach
    </div> --}}
    <div class="row">
        <div class="col-md-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>
                        <i class="subheader-icon fal fa-ballot-check mr-1"></i>Articles
                    </h2>
                    <div class="panel-toolbar">
                        <!-- this button is visible to Administrator only -->
                        {{-- @if (\Auth::user()->type == 'admin') --}}
                        @can('feeds_create')
                            <a href="{{ route('admin.posts.create') }}"
                                class="mr-1 btn btn-info btn-xs waves-effect waves-themed" role="button" data-toggle="tooltip"
                                data-offset="0,10" data-original-title="Buat Feeds Baru">
                                Feeds Baru
                            </a>
                        @endcan
                        {{-- @endif --}}
                    </div>
                </div>
                {{-- <div class="alert alert-info border-0 mb-1">
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
                </div> --}}
                <div class="panel-container show">
                    <div class="panel-content bg-white">
                        <table class="table table-responsive table-hover w-100 bg-white" id="dt_feeds">
                            <thead hidden>
                                <th></th>
                                <th>title</th>
                                <th>statuses</th>
                            </thead>
                            <tbody>
                                @foreach ($posts as $post)
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
                                                @can('feeds_edit')
                                                    <a href="{{ route('admin.posts.edit', $post->id) }}"
                                                        class="badge btn-sm btn-info" role="button" title="Ubah Artikel"><i
                                                            class="fal fa-edit"></i>
                                                        Edit</a>
                                                @endcan
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
    @if (\Auth::user()->roleaccess == '1')
        <div class="row">
            <div class="col-md-12">
                <div id="panel-1" class="panel">
                    <div class="panel-hdr">
                        <h2>
                            <i class="subheader-icon fal fa-ballot-check mr-1"></i>Deleted Articles |
                            <span class="fw-300 ml-1"><i>Daftar Artikel dihapus.</i></span>
                        </h2>
                        <div class="panel-toolbar">

                        </div>
                    </div>

                    {{-- <div class="alert alert-info border-0 mb-5">
                    <div class="d-flex align-item-center">
                        <div class="alert-icon">
                            <div class="icon-stack icon-stack-sm mr-3 flex-shrink-0">
                                <i class="base base-7 icon-stack-3x opacity-100 color-primary-400"></i>
                                <i class="base base-7 icon-stack-2x opacity-100 color-primary-800"></i>
                                <i class="fa fa-info icon-stack-1x opacity-100 color-white"></i>
                            </div>
                        </div>
                        <div class="flex-1">
                            <span>Daftar Artikel yang telah dihapus.</span>
                        </div>
                    </div>
                </div> --}}
                    <div class="panel-container show">
                        <div class="panel-content bg-white">
                            <table class="table w-100 table-responsive table-hover bg-white" id="deleted_feeds">
                                <thead hidden>
                                    <th></th>
                                    <th>title</th>
                                    <th>statuses</th>
                                </thead>
                                <tbody>

                                    @foreach ($posts->where('is_deleted', '1') as $post)
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
                                                                            <img src="{{ asset(old('img_cover', 'img/' . $post->img_cover)) }}"
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
                                                            class="badge btn-sm btn-info" role="button"
                                                            title="Ubah Artikel"><i class="fal fa-edit"></i>
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
    @endif
@endsection
<!-- @parent -->
<!-- start script for this page -->
@section('scripts')
    <script>
        $(document).ready(function() {
            // initialize datatable
            $('#dt_feeds').dataTable({
                pagingType: 'full_numbers',
                responsive: true,
                lengthChange: false,
                pageLength: 10,
                order: [
                    [0, 'asc']
                ],
                dom:
                    /*	--- Layout Structure 
                    	--- Options
                    	l	-	length changing input control
                    	f	-	filtering input
                    	t	-	The table!
                    	i	-	Table information summary
                    	p	-	pagination control
                    	r	-	processing display element
                    	B	-	buttons
                    	R	-	ColReorder
                    	S	-	Select

                    	--- Markup
                    	< and >				- div element
                    	<"class" and >		- div with a class
                    	<"#id" and >		- div with an ID
                    	<"#id.class" and >	- div with an ID and a class

                    	--- Further reading
                    	https://datatables.net/reference/option/dom
                    	--------------------------------------
                     */
                    "<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'f><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'B>>" +
                    "<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                buttons: [
                    /*{
                    	extend:    'colvis',
                    	text:      'Column Visibility',
                    	titleAttr: 'Col visibility',
                    	className: 'mr-sm-3'
                    },*/
                    {
                        extend: 'pdfHtml5',
                        text: 'PDF',
                        titleAttr: 'Generate PDF',
                        className: 'btn-outline-danger btn-xs mr-1'
                    },
                    {
                        extend: 'excelHtml5',
                        text: 'Excel',
                        titleAttr: 'Generate Excel',
                        className: 'btn-outline-success btn-xs mr-1'
                    },
                    {
                        extend: 'csvHtml5',
                        text: 'CSV',
                        titleAttr: 'Generate CSV',
                        className: 'btn-outline-primary btn-xs mr-1'
                    },
                    {
                        extend: 'copyHtml5',
                        text: 'Copy',
                        titleAttr: 'Copy to clipboard',
                        className: 'btn-outline-primary btn-xs mr-1'
                    },
                    {
                        extend: 'print',
                        text: 'Print',
                        titleAttr: 'Print Table',
                        className: 'btn-outline-primary btn-xs'
                    }
                ]
            });

        });
    </script>
    <script>
        $(document).ready(function() {
            // initialize datatable
            $('#deleted_feeds').dataTable({
                pagingType: 'full_numbers',
                responsive: true,
                lengthChange: false,
                pageLength: 10,
                order: [
                    [0, 'asc']
                ],
                dom:
                    /*	--- Layout Structure 
                    	--- Options
                    	l	-	length changing input control
                    	f	-	filtering input
                    	t	-	The table!
                    	i	-	Table information summary
                    	p	-	pagination control
                    	r	-	processing display element
                    	B	-	buttons
                    	R	-	ColReorder
                    	S	-	Select

                    	--- Markup
                    	< and >				- div element
                    	<"class" and >		- div with a class
                    	<"#id" and >		- div with an ID
                    	<"#id.class" and >	- div with an ID and a class

                    	--- Further reading
                    	https://datatables.net/reference/option/dom
                    	--------------------------------------
                     */
                    "<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'f><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'B>>" +
                    "<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                buttons: [
                    /*{
                    	extend:    'colvis',
                    	text:      'Column Visibility',
                    	titleAttr: 'Col visibility',
                    	className: 'mr-sm-3'
                    },*/
                    {
                        extend: 'pdfHtml5',
                        text: 'PDF',
                        titleAttr: 'Generate PDF',
                        className: 'btn-outline-danger btn-xs mr-1'
                    },
                    {
                        extend: 'excelHtml5',
                        text: 'Excel',
                        titleAttr: 'Generate Excel',
                        className: 'btn-outline-success btn-xs mr-1'
                    },
                    {
                        extend: 'csvHtml5',
                        text: 'CSV',
                        titleAttr: 'Generate CSV',
                        className: 'btn-outline-primary btn-xs mr-1'
                    },
                    {
                        extend: 'copyHtml5',
                        text: 'Copy',
                        titleAttr: 'Copy to clipboard',
                        className: 'btn-outline-primary btn-xs mr-1'
                    },
                    {
                        extend: 'print',
                        text: 'Print',
                        titleAttr: 'Print Table',
                        className: 'btn-outline-primary btn-xs'
                    }
                ]
            });

        });
    </script>
@endsection
