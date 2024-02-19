@extends('layouts.admin')
@section('content')
{{-- @include('partials.breadcrumb') --}}
@include('partials.subheader')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
				<div class="card">
					<div class="card-footer">
						<div class="text-center mb-3 pt-3">
							<h1 class="fs-xxl text-uppercase">{{ $post->title }}</h1>
							<span class="text-xs">
								<span class="text-muted">Posted by: </span>
								<span class="fw-500">{{ $post->user->name }}</span> |
								<span class="text-muted">{{ $post->created_at }}</span> |
								<span class="fw-500">{{ $post->category->name }}</span> |
								@if ($post->priority == 1)
									<a href="javascript:void()" class="badge btn-sm btn-danger">
										URGENT!!
									</a> |
								@elseif($post->priority == 2)
									<a href="javascript:void()" class="badge btn-sm btn-warning">
										High
									</a> |
								@elseif($post->priority == 3)
									<a href="javascript:void()" class="badge btn-sm btn-info">
										Moderate
									</a> |
								@elseif($post->priority == 4)
									<a href="javascript:void()" class="badge btn-sm btn-success">
										low
									</a>
								@else
									<a href="javascript:void()" class="badge btn-sm btn-secondary">
										No Priority
									</a> |
								@endif
								500 <i class="fa fa-eye"></i> |
								150 <i class="fa fa-star text-warning"></i>
							</span>
						</div>
					</div>
				</div>
				@if (is_null($post->img_cover))
					<span></span>
				@else
					<img src="{{ url('storage/img/post_img/' . $post->img_cover) }}" class="card-img-top"
						alt="Card image cap">
				@endif
				<div class="card-body p-5" style="text-align:justify">
					@if (is_null($post->exerpt))
					@else
					<div class="panel-tag mb-3">
						<i class="fs-xl text-monospace">"{{ $post->exerpt }}"</i>
					</div>
					@endif
					{!! $post->body !!}
				</div>
				<div class="card-footer d-flex flex-row justify-content-center p-5">
					<span class="mr-1">Give Star to this Post:</span>
					<span>
						@auth
							@if(Auth::user()->starred->contains($post->id))
								<form action="{{ route('admin.posts.unstar', $post->id) }}" method="POST">
								@csrf
								@method('DELETE')
								<button type="submit" class="btn btn-outline-warning btn-icon border-0 btn-xs"><i class="fs-lg fas fa-star"></i></button>
								</form>
							@else
								<form action="{{ route('admin.posts.star', $post->id) }}" method="POST">
								@csrf
								<button type="submit" class="btn btn-outline-warning btn-icon border-0 btn-xs"><i class="fs-lg fal fa-star"></i></button>
								</form>
							@endif
						@endauth
					</span>
					
				</div>
			</div>
        </div>
    </div>
@endsection
<!-- @parent -->
<!-- start script for this page -->
@section('scripts')
@endsection
