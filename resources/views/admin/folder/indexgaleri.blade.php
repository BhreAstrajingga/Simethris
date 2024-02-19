@extends('layouts.admin')
@section('content')
<link rel="stylesheet" media="screen, print" href="{{ asset('css/miscellaneous/lightgallery/lightgallery.bundle.css') }}">

{{-- @include('partials.breadcrumb') --}}
{{-- @include('partials.subheader') --}}
@can('galeri_access')

<div class="row">
    <div class="col-md-12">
        <div id="panel-1" class="panel">
            
            <div class="panel-hdr">
                <h2>
                    <i class="subheader-icon fal fa-images mr-1"></i>GALERI DOKUMENTASI
                </h2>
                <div class="panel-toolbar">
                    @include('partials.globaltoolbar')
                </div>
            </div>
            
            <div class="panel-container show">
                <div class="panel-content">
                    <div id="js-lightgallery">
                        @foreach ($data_berkas as $item)
                            <a class="gallery-item" href="{{ $item['fullpath'] }}" data-sub-html="{{ $item['berkas'] }}">
                                <img class="img-responsive" src="{{ $item['fullpath'] }}" alt="{{ $item['berkas'] }}">
                            </a>    
                        @endforeach
                        
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endcan
@endsection

@section('scripts')
<script src="{{ asset('js/miscellaneous/lightgallery/lightgallery.bundle.js') }}"></script>

@parent
<script>
	
	$(document).ready(function() {
        var $initScope = $('#js-lightgallery');
        if ($initScope.length) {
            $initScope.justifiedGallery({
                border: -1,
                rowHeight: 150,
                margins: 8,
                waitThumbnailsLoad: true,
                randomize: false,
            }).on('jg.complete', function() {
                $initScope.lightGallery({
                    thumbnail: true,
                    animateThumb: true,
                    showThumbByDefault: true,
                });
            });
        };
        $initScope.on('onAfterOpen.lg', function(event) {
            $('body').addClass("overflow-hidden");
        });
        $initScope.on('onCloseAfter.lg', function(event) {
            $('body').removeClass("overflow-hidden");
        });
    });

</script>


@endsection

