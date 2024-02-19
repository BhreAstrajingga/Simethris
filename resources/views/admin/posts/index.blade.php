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

<div class="row d-flex flex-row">
    <div class="col-md-8">
        <div class="row">
            <div class="card-deck d-flex mb-3">
                @foreach ($posts->slice(0,2) as $post)
                <div class="card">
                    @if (is_null($post->img_cover))
                        <img src="{{$defaultimg}}"alt=""  class="card-img-top img-fluid"
                        alt="Card image cap">
                    @else
                        <img src="{{ url('storage/img/post_img/' . $post->img_cover) }}" class="card-img-top img-fluide"
                            alt="Card image cap">
                    @endif
                    <div class="card-body">
                        <h3 class="text-muted"><a href="{{ route('admin.posts.show', $post->id) }}">{{$post->title}}</a></h3>
                        <div class="opacity-60">
                            <span class="text-muted">Posted by: </span><span class="fw-900">{{$post->user->name}}</span> | {{$post->created_at}}
                        </div>
                        <span class="badge text-white fw-500" style="background-color:{{$post->category->hexcolor}};">{{$post->category->name}}</span>
                        <p class="card-text mt-2">{{$post->exerpt}}</p>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <small class="text-muted">updated at: {{$post->updated_at}}</small>
                        <span>
                            <span><i class="fas fa-eye mr-1 text-warning"></i>{{ $post->view_counter }}</span>
                            <span><i class="fas fa-star mr-1 text-warning"></i>{{ $post->stars_counter }}</span>
                        </span>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="card-deck d-flex mb-3">
                @foreach ($posts->slice(3,2) as $post)
                <div class="card">
                    @if (is_null($post->img_cover))
                        <img src="{{$defaultimg}}"alt=""  class="card-img-top img-fluid"
                        alt="Card image cap">
                    @else
                        <img src="{{ url('storage/img/post_img/' . $post->img_cover) }}" class="card-img-top img-fluide"
                            alt="Card image cap">
                    @endif
                    <div class="card-body">
                        <h3 class="text-muted"><a href="{{ route('admin.posts.show', $post->id) }}">{{$post->title}}</a></h3>
                        <div class="opacity-60">
                            <span class="text-muted">Posted by: </span><span class="fw-900">{{$post->user->name}}</span> | {{$post->created_at}}
                        </div>
                        <span class="badge text-white fw-500" style="background-color:{{$post->category->hexcolor}};">{{$post->category->name}}</span>
                        <p class="card-text mt-2">{{$post->exerpt}}</p>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <small class="text-muted">updated at: {{$post->updated_at}}</small>
                        <span>
                            <span><i class="fas fa-eye mr-1 text-warning"></i>{{ $post->view_counter }}</span>
                            <span><i class="fas fa-star mr-1 text-warning"></i>{{ $post->stars_counter }}</span>
                        </span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="row">
            <div class="col-md-12 mb-5">
                <div class="container">
                    <div class="input-group">
                        <input id="search-input" type="text" class="form-control" placeholder="Search Posts" aria-label="search posts" aria-describedby="search-input">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fal fa-search"></i></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mb-5">
                <div class="container" id="recent-post">
                    <label class="text-muted h4 text-uppercase" for="recent-post" style="opacity: 0.6">Recent Post</label>
                    @foreach ($posts->slice(5,5) as $post)
                    <div class="mb-2">
                        <div style="display: flex; flex: 1 1 auto;">
                            <div class="img-square-wrapper" style="overflow: hidden;">
                                @if (is_null($post->img_cover))
                                    <img src="{{$defaultimg}}" alt="Card image cap" class="rounded img-cropped">
                                @else
                                    <img src="{{ url('storage/img/post_img/' . $post->img_cover) }}"  class="img-cropped rounded"
                                        alt="Card image cap">
                                @endif
                            </div>
                            <div class="col p-2">
                                <div class="d-flex justify-content-between">
                                    <a class="fw-500 h5 text-muted d-block text-truncate" href="{{ route('admin.posts.show', $post->id) }}">{{ $post->title }}</a>
                                </div>
                                <span class="fs-xs">{{ $post->published_at }}</span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <a href="{{ route('admin.allblogs') }}" class="text-right">More Posts...</a>
                </div>
                {{-- <div class="border-bottom border-secondary mt-3"></div> --}}
            </div>
            <div class="col-md-12 mb-5">
                <div class="container" id="categories">
                    <label class="text-muted h4 text-uppercase" for="recent-post" style="opacity: 0.6">Categories</label>
                    @foreach ($categories as $category)
                    <div class="d-flex flex-row align-items-center mb-2">
                        <div class='icon-stack display-4 flex-shrink-0'>
                            <i class="fas fa-square icon-stack-3x opacity-30" style="color:{{$category->hexcolor}}"></i>
                            <i class="fas fa-graduation-cap icon-stack-1x opacity-100" style="color:{{$category->hexcolor}}"></i>
                        </div>
                        <div class="ml-2">
                            <span class="text-muted fw-500">
                                <a href="{{ route('admin.categories.show', $category->id) }}">{{$category->name}}</a>
                            </span>
                        </div>
                    </div>
                    @endforeach
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
