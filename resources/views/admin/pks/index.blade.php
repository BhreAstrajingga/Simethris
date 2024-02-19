@extends('layouts.admin')
@section('content')
{{-- @include('partials.breadcrumb') --}}
@include('partials.subheader')
@include('partials.sysalert')
@can('pks_access')
<div class="row">
    <div class="col-md-12">
        <div id="panel-1" class="panel" data-title="Panel Data" data-intro="Panel ini berisi data-data" data-step="2">
            <div class="panel-hdr">
                <h2>
                    Daftar<span class="fw-300"><i>PKS</i></span>
                </h2>
                <div class="panel-toolbar">
                    @include('partials.globaltoolbar')
                </div>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <div class="table dataTables_wrapper dt-bootstrap4">
                        <table class="table table-sm table-bordered table-striped table-hover ajaxTable datatable datatable-Riph w-100">
                            <thead class="thead-dark">
                                <tr>
                                    <th ></th>
                                    {{-- <th hidden>ID</th> --}}
                                    <th class="text-center">NPWP</th>
                                    <th class="text-center">No. RIPH</th>
                                    <th class="text-center">No. Perjanjian</th>
                                    <th class="text-center">Tgl. Mulai</th>
                                    <th class="text-center">Tgl. Berakhir</th>
                                    <th class="text-center">Jumlah Anggota</th>
                                    <th class="text-center">Luas Rencana</th>
                                    <th class="text-center">Varietas Tanam</th>
                                    <th class="text-center">Periode Tanam</th>
                                    <th class="text-center">Provinsi</th>
                                    <th class="text-center">Kabupaten</th>
                                    <th class="text-center">Kecamatan</th>
                                    <th class="text-center">Desa</th>
                                    <th class="text-center">Berkas</th>
                                    <th style="width:15%">
                                        {{ trans('global.actions') }}
                                    </th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Page Content -->

@endcan
@endsection

@section('scripts')
@parent
<script>
	
	$(function () 
	{

        $.fn.dataTable.ext.errMode = function ( settings, helpPage, message ) { 
            toastr.options.timeOut = 10000;
            toastr.options = {
                positionClass: 'toast-top-full-width'
            };

            toastr.error( 'Gagal mengambil data');
        };

		let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
        @can('pks_delete')
            let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
            let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('admin.task.pks.massDestroy') }}",
                className: 'btn-danger btn-sm waves-effect waves-themed  mr-1', 
                action: function (e, dt, node, config) {
                var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
                    return entry.id
                });

                if (ids.length === 0) {
                    alert('{{ trans('global.datatables.zero_selected') }}')

                    return
                }

                if (confirm('{{ trans('global.areYouSure') }}')) {
                    $.ajax({
                    headers: {'x-csrf-token': _token},
                    method: 'POST',
                    url: config.url,
                    data: { ids: ids, _method: 'DELETE' }})
                    .done(function () { location.reload() })
                }
                }
            }
            dtButtons.push(deleteButton)
        @endcan
        let dtOverrideGlobals = {
            buttons: dtButtons,
            processing: true,
            serverSide: true,
            retrieve: true,
            responsive: true,
            aaSorting: [],
            columnDefs: [{
                                orderable: false,
                                className: 'select-checkbox',
                                targets: 0
                            },  {
                                orderable: false,
                                searchable: false,
                                targets: -1
                            }
                        ],
            select: {
                        style:    'multi+shift',
                        selector: 'td:first-child'
            },
            dom: 
					"<'row'<'col-sm-12 col-md-2'l><'col-sm-12 col-md-8 d-flex'B><'col-sm-12 col-md-2 d-flex justify-content-end'f>>" +
					"<'row'<'col-sm-12 col-md-12'tr>>" +
					"<'row'<'col-sm-12 col-md-6'i><'col-sm-12 col-md-6'p>>",
            
            ajax: "{{ route('admin.task.pks.index') }}",
            columns: [
                { data: 'placeholder', name: 'placeholder' },
                // { data: 'id', name: 'id',  },
                { data: 'npwp', name: 'npwp' },
                { data: 'no_riph', name: 'no_riph' },
                { data: 'no_perjanjian', name: 'no_perjanjian' },
                { data: 'tgl_perjanjian_start', name: 'tgl_perjanjian_start',class: 'text-center'  },
                { data: 'tgl_perjanjian_end', name: 'tgl_perjanjian_end',class: 'text-center'  },
                { data: 'jumlah_anggota', name: 'jumlah_anggota', class: 'text-right' },
                { data: 'luas_rencana', name: 'luas_rencana', class: 'text-right' },
                { data: 'varietas_tanam', name: 'varietas_tanam' },
                { data: 'periode_tanam', name: 'periode_tanam' },
                { data: 'provinsi', name: 'provinsi' },
                { data: 'kabupaten', name: 'kabupaten' },
                { data: 'kecamatan', name: 'kecamatan' },
                { data: 'desa', name: 'desa' },
                { data: 'berkas_pks', name: 'berkas_pks' },
                { data: 'actions', name: '{{ trans('global.actions') }}', class: 'text-center' }
            ],
            orderCellsTop: true,
            order: [[ 1, 'desc' ]],
            pageLength: 10,
        };
        let table = $('.datatable-Riph').DataTable(dtOverrideGlobals);
        $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
            $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust();
        });
        
        
        
    });
        
</script>


@endsection