@extends('layouts.admin')
@section('content')
{{-- @include('partials.breadcrumb') --}}
{{-- @include('partials.subheader') --}}
@can('template_access')

<div class="row">
    <div class="col-md-12">
        <div id="panel-1" class="panel">
            <div class="panel-hdr">
                <h2>
                    Template<span class="fw-300"><i>Master</i></span>
                </h2>
                <div class="panel-toolbar">
                    @can('template_create')
                        <a class="btn btn-xs btn-primary mr-1 ml-1" href="{{ route('admin.task.template.create') }}"><i class="fal fa-plus mr-1"></i>Template</a>
                    @endcan
                    @include('partials.globaltoolbar')
                </div>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <div class="table-responsive">
                        <table id="templateList" class="table table-sm table-hover table-striped table-bordered w-100">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Berkas</th>
                                    <th>Nama Berkas</th>
                                    <th>Keterangan</th>
                                    <th>Tanggal diunggah</th>
                                    <th>Tindakan</th>
                                </tr>
                            </thead>
                            
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
	
	$(function() 
    {
        $.fn.dataTable.ext.errMode = function ( settings, helpPage, message ) { 
            toastr.options.timeOut = 10000;
            toastr.options = {
                positionClass: 'toast-top-full-width'
            };

            toastr.error( 'Gagal mengambil data');
        };

        let dtButtons = $.extend(true, [
                // {
                //     extend: 'pdfHtml5',
                //     text: 'PDF',
                //     titleAttr: 'Generate PDF',
                //     className: 'btn-outline-danger btn-sm mr-1'
                // },
                // {
                //     extend: 'excelHtml5',
                //     text: 'Excel',
                //     titleAttr: 'Generate Excel',
                //     className: 'btn-outline-success btn-sm mr-1'
                // },
                // {
                //     extend: 'csvHtml5',
                //     text: 'CSV',
                //     titleAttr: 'Generate CSV',
                //     className: 'btn-outline-primary btn-sm mr-1'
                // },
                // {
                //     extend: 'copyHtml5',
                //     text: 'Copy',
                //     titleAttr: 'Copy to clipboard',
                //     className: 'btn-outline-primary btn-sm mr-1'
                // },
                // {
                //     extend: 'print',
                //     text: 'Print',
                //     titleAttr: 'Print Table',
                //     className: 'btn-outline-primary btn-sm'
                // }
        ], $.fn.dataTable.defaults.buttons)
        @can('template_delete')
            let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
            let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('admin.task.template.massDestroy') }}",
                className: 'btn-danger  waves-effect waves-themed  mr-1', 
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
        // initialize datatable
        $('#templateList').dataTable({
            buttons: dtButtons,
            processing: true,
            serverSide: true,
            retrieve: true,
            aaSorting: [],
            columnDefs: [  {
                                orderable: false,
                                className: 'select-checkbox',
                                targets: 0
                            },{
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
            
            ajax: "{{ route('admin.task.template') }}",
            columns: [
                { data: 'placeholder', name: 'placeholder' },
                // { data: 'id', name: 'id',  },
                { data: 'kind', name: 'kind' },
                { data: 'name', name: 'name' },
                { data: 'description', name: 'description' },
                { data: 'created_at', name: 'created_at' },
                { data: 'actions', name: '{{ trans('global.actions') }}', class: 'text-center' }
            ],
            orderCellsTop: true,
            order: [[ 1, 'asc' ]],
            pageLength: 15,
        });

    });

</script>


@endsection

