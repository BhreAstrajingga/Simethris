@extends('layouts.admin')
@section('styles')
<style>
	.img-cropped {
    object-fit: cover;
    object-position: center center;
    width: 70px;
    height: 70px;
}
</style>
@endsection
@section('content')
{{-- @include('partials.breadcrumb') --}}
@include('partials.subheader')
@can('feeds_access')
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
    @elseif ($message = Session::get('success'))
        <div class="alert alert-danger">
            <div class="d-flex flex-start w-100">
                <div class="mr-2 hidden-md-down">
                    <span class="icon-stack icon-stack-lg">
                        <i class="base base-7 icon-stack-3x opacity-100 color-success-500"></i>
                        <i class="base base-7 icon-stack-2x opacity-100 color-success-300 fa-flip-vertical"></i>
                        <i class="fas fa-times icon-stack-1x opacity-100 color-white"></i>
                    </span>
                </div>
                <div class="d-flex flex-fill">
                    <div class="flex-fill">
                        <span class="h5">Error</span>
                        <p>
                            {{ $message }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    @else
    @endif
    {{-- available articles --}}

    <div class="row">
        <div class="col-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>
                        <i class="subheader-icon fal fa-ballot-check mr-1"></i>Artike| 
                        <span class="fw-300"><i>Berita</i></span>
                    </h2>
                    <div class="panel-toolbar">
                        @can('feeds_create')
                        <a href="{{ route('admin.posts.create') }}"
                            class="mr-1 btn btn-primary btn-xs"><i class="fal fa-plus mr-1"></i>
                            Artikel Baru
                        </a>
                        @endcan
                        @include('partials.globaltoolbar')
                    </div>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <div class="table-responsive">
                            <table id="templateFeed" class="table table-sm table-hover table-striped table-bordered  dt-feeds w-100">
                                <thead class="thead-dark">
                                    <th hidden>created at</th>
                                    <th style="width: 50%">Title</th>
                                    <th>Status</th>
                                    <th class="text-center">Action</th>
                                </thead>
                                <tbody>
                                    @foreach ($posts as $post)
                                        <tr>
                                            <td hidden>{{ $post->created_at }}</td>
                                            <td>
                                                <a href="{{ route('admin.posts.show', $post->id) }}" class="fs-lg fw-500 mr-2">
                                                    {{ $post->title }}
                                                </a>
                                                <div>
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
                                            </td>
                                            <td>
                                                <div>
                                                    @if (!empty($post->published_at))
                                                        <a class="badge btn-sm btn-success text-white"
                                                            title="telah dipublikasikan">Published</a>
                                                    @else
                                                        <a class="badge btn-sm btn-warning text-white"
                                                            title="belum dipublikasikan">Unpublished</a>
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="d-flex align-items-center">
                                                @can('feeds_edit')
                                                    <a href="{{ route('admin.posts.edit', $post->id) }}"
                                                        class="badge btn-sm btn-info btn-icon mr-1" role="button"
                                                        title="Ubah Artikel">
                                                        <i class="fal fa-edit"></i>
                                                    </a>
                                                @endcan
                                                @can('feeds_delete')
                                                    <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-sm btn-danger btn-icon"
                                                            title="hapus Artikel">
                                                            <i class="fal fa-trash-alt"></i>
                                                        </button>
                                                    </form>
                                                @endcan
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
    </div>

    @if (\Auth::user()->roleaccess == '1')
    {{-- deleted articles --}}
        <div class="row">
            <div class="col-md-12">
                <div id="panel-1" class="panel">
                    <div class="panel-hdr">
                        <h2>
                            <i class="subheader-icon fal fa-ballot-check mr-1"></i>Deleted Articles |
                            <span class="fw-300 ml-1"><i>Daftar Artikel dihapus.</i></span>
                        </h2>
                        <div class="panel-toolbar">
                            @include('partials.globaltoolbar')
                        </div>
                    </div>

                    
                    <div class="panel-container show">
                        <div class="panel-content">
                            <div class="table">
                                <div class="table dataTables_wrapper dt-bootstrap4">
                                    <table id="deleted_feeds" class="table table-sm table-bordered table-striped table-hover ajaxTable datatable deleted_feeds w-100">
                                        <thead class="thead-dark">
                                            <th style="width: 50%">title</th>
                                            <th style="width: 20%">Deleted at</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($delposts as $post)
                                                <tr>
                                                    <td>
                                                        
                                                        {{ $post->title }}
                                                        
                                                        <div>
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
                                                    </td>
                                                    <td>{{ $post->deleted_at }}</td>
                                                    <td>
                                                        <div>
                                                            @if (!empty($post->published_at))
                                                                <a class="badge btn-sm btn-success text-white"
                                                                    title="telah dipublikasikan">Published</a>
                                                            @else
                                                                <a class="badge btn-sm btn-warning text-white"
                                                                    title="belum dipublikasikan">Unpublished</a>
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td>
                                                        @can('feeds_delete')
                                                            <form action="{{ route('admin.posts.restore', $post->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('put')
                                                                <button type="submit" class="btn btn-sm btn-warning btn-icon"
                                                                    title="hapus Artikel">
                                                                    <i class="fal fa-undo"></i>
                                                                </button>
                                                            </form>
                                                        @endcan
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
            </div>
        </div>
    @endif
@endcan
@endsection

@section('scripts')
@parent
    <script>
        $(function() {
            $.fn.dataTable.ext.errMode = function ( settings, helpPage, message ) { 
                toastr.options.timeOut = 10000;
                toastr.options = {
                    positionClass: 'toast-top-full-width'
                };

                toastr.error( 'Gagal mengambil data');
            };

            
            // initialize datatable
            $('#templateFeed').dataTable({
                buttons: [],
                processing: true,
                serverSide: false,
                retrieve: true,
                aaSorting: [],
                lengthChange: false,
                
                dom:
                    "<'row'<'col-sm-12 col-md-2'l><'col-sm-12 col-md-8 d-flex'B><'col-sm-12 col-md-2 d-flex justify-content-end'f>>" +
					"<'row'<'col-sm-12 col-md-12'tr>>" +
					"<'row'<'col-sm-12 col-md-6'i><'col-sm-12 col-md-6'p>>",
                
                orderCellsTop: true,
                order: [[ 0, 'desc' ]],
                pageLength: 15,
            });

        
    
            $('#deleted_feeds').dataTable({
                responsive: true,
                lengthChange: false,
                pageLength: 5,
                order: [
                    [0, 'asc']
                ],
                dom:
                    "<'row'<'col-sm-12 col-md-2'l><'col-sm-12 col-md-8 d-flex'B><'col-sm-12 col-md-2 d-flex justify-content-end'f>>" +
                    "<'row'<'col-sm-12 col-md-12'tr>>" +
                    "<'row'<'col-sm-12 col-md-6'i><'col-sm-12 col-md-6'p>>",
                buttons: [
                    
                ]
            });
        });
    </script>
        
@endsection
