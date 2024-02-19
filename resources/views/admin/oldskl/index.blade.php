@extends('layouts.admin')
@section('content')
{{-- @include('partials.breadcrumb') --}}
@include('partials.subheader')
	@can('old_skl_access')
		@include('partials.sysalert')
		<div class="row">
			<div class="col-lg-12">
				<div id="panel-1" class="panel">
					<div class="panel-container show">
						<div class="panel-content">
							<div class="table">
								<table id="OldSkl" class="table table-sm table-bordered table-hover table-striped w-100">
									<thead>
										<tr>
											@if (Auth::user()->roleaccess === 1)
												<th>Perusahaan</th>
											@endif
											<th>Periode</th>
											<th>Nomor RIPH</th>
											<th>No SKL</th>
											<th>Tanggal Terbit</th>
											<th>Tanggal diunggah</th>
											<th>Tindakan</th>
										</tr>
									</thead>
									<tbody>
										@foreach ($oldskls as $oldskl)
											<tr>
												@if (Auth::user()->roleaccess === 1)
													<td>{{$oldskl->datauser->company_name}}</td>
												@endif
												<td>{{$oldskl->periodetahun}}</td>
												<td>{{$oldskl->no_ijin}}</td>
												<td>{{$oldskl->no_skl}}</td>
												<td class="text-center">{{ date('d-m-Y', strtotime($oldskl->published_date)) }}</td>
												<td class="text-center">{{ date('d-m-Y', strtotime($oldskl->created_at)) }}</td>
												<td class="text-center d-flex justify-content-center">
													@can('old_skl_show')
														@if (Auth::user()->roles[0]->title === 'User')
															<a href="{{route('admin.task.user.oldskl.show', $oldskl->id)}}" class="btn btn-icon btn-primary btn-xs mr-1" title="Lihat">
																<i class="fal fa-file-search"></i>
															</a>
														@else
															<a href="{{route('verification.oldskl.show', $oldskl->id)}}" class="btn btn-icon btn-primary btn-xs mr-1" title="Lihat">
																<i class="fal fa-file-search"></i>
															</a>
														@endif
													@endcan
													@can('old_skl_edit')
														<a href="{{route('verification.oldskl.edit', $oldskl->id)}}" class="btn btn-icon btn-warning btn-xs mr-1" title="Ubah Data">
															<i class="fal fa-edit"></i>
														</a>
													@endcan
													@can('old_skl_delete')
														<form action="{{route('verification.oldskl.delete', $oldskl->id)}}" method="post">
															@csrf
															@method('delete')
															<button class="btn btn-icon btn-danger btn-xs mr-1" type="submit" title="Hapus Data" onclick="return confirm('Anda yakin ingin menghapus data ini?');">
																<i class="fal fa-trash"></i>
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
	@endcan
@endsection

@section('scripts')
@parent

<script>
	$(document).ready(function()
	{
		// initialize tblPenangkar
		$('#OldSkl').dataTable(
		{
			responsive: true,
			lengthChange: false,
			dom:
				"<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'f><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'lB>>" +
				"<'row'<'col-sm-12'tr>>" +
				"<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
			buttons: [
				{
					extend: 'pdfHtml5',
					text: '<i class="fa fa-file-pdf"></i>',
					titleAttr: 'Generate PDF',
					className: 'btn-outline-danger btn-sm btn-icon mr-1'
				},
				{
					extend: 'excelHtml5',
					text: '<i class="fa fa-file-excel"></i>',
					titleAttr: 'Generate Excel',
					className: 'btn-outline-success btn-sm btn-icon mr-1'
				},
				{
					extend: 'csvHtml5',
					text: '<i class="fal fa-file-csv"></i>',
					titleAttr: 'Generate CSV',
					className: 'btn-outline-primary btn-sm btn-icon mr-1'
				},
				{
					extend: 'copyHtml5',
					text: '<i class="fa fa-copy"></i>',
					titleAttr: 'Copy to clipboard',
					className: 'btn-outline-primary btn-sm btn-icon mr-1'
				},
				{
					extend: 'print',
					text: '<i class="fa fa-print"></i>',
					titleAttr: 'Print Table',
					className: 'btn-outline-primary btn-sm btn-icon mr-1'
				},
				
				@can('old_skl_create')
				{
					text: '<i class="fa fa-plus mr-1"></i>SKL',
					titleAttr: 'Rekam Data SKL',
					className: 'btn btn-info btn-xs ml-2',
						action: function(e, dt, node, config) {
							window.location.href = '{{ route('verification.oldskl.create') }}';
						}
				}
					@else
					@endcan
			]
		});

	});
</script>

@endsection

