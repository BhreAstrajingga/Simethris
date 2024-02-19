@extends('layouts.admin')
@section('content')
{{-- @include('partials.breadcrumb') --}}
{{-- @include('partials.subheader') --}}
@can('berkas_access')

<div class="row">
    <div class="col-md-12">
        <div id="panel-1" class="panel">
            
            <div class="panel-hdr">
                <h2>
                    Berkas-berkas <span class="fw-300"><i>Unggahan</i></span>
                </h2>
                <div class="panel-toolbar">
                    @include('partials.globaltoolbar')
                </div>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <div class="table-responsive">
                        <table id="myfiles" class="table table-sm table-hover table-striped table-bordered w-100">
                            <thead>
                                <tr>
                                    <th>Berkas</th>
                                    <th>Nama Berkas</th>
                                    <th>Tanggal diunggah</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                @foreach ($data_berkas as $item)
                                    <tr>
                                        <td>{{ $item['berkas'] }}</td>
                                        <td><a href="{{ $item['fullpath'] }}">{{ $item['filename'] }}</a></td>
                                        <td>{{ $item['date_updated'] }}</td>
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
@endcan
@endsection

@section('scripts')
@parent
<script>
	
	$(document).ready(function() {
        // initialize datatable
        $('#myfiles').dataTable({
            pagingType: 'full_numbers',
            responsive: true,
            lengthChange: true,
            pageLength: 10,
            order: [
                [0, 'asc']
            ],
            dom:
                
                "<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'f><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'B>>" +
                "<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            buttons: []
        });

    });

</script>


@endsection

