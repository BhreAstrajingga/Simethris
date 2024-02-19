@extends('layouts.admin')
@section('content')
{{-- @include('partials.breadcrumb') --}}
	@include('partials.subheader')
	@include('partials.sysalert')
	{{-- @can('create_skl_access') --}}
		<div class="row">
			<div class="col-lg-12">
				<div id="panel-1" class="panel">
					<div class="panel-container show">
						<div class="panel-content">
							<div class="table">
								<table id="recomTable" class="table table-sm table-bordered table-hover table-striped w-100">
									<thead>
										<tr>
											<th>No. SKL</th>
											<th>No. RIPH</th>
											<th>Pelaku Usaha</th>
											<th>Pemohon</th>
											<th>Tanggal</th>
											<th>Tindakan</th>
										</tr>
									</thead>
									<tbody>
										@foreach ($recomends as $recomend)
											<tr>
												<td>{{$recomend->no_skl}}</td>
												<td>{{$recomend->no_ijin}}</td>
												<td>{{$recomend->datauser->company_name}}</td>
												<td class="text-center">
													@php
														$user = \App\Models\User::find($recomend->submit_by);
													@endphp
													{{ $user ? $user->name : 'User Not Found' }}
												</td>
												<td class="text-center">{{$recomend->created_at}}</td>
												<td class="text-center">
													@if($recomend->approved_by)
														<a href="{{route('verification.skl.published', $recomend->id)}}" class="btn btn-xs btn-success btn-icon">
															<i class="fal fa-award"></i>
														</a>
													@else
														<a href="{{route('verification.skl.recomendation.show', $recomend->id)}}" class="btn btn-xs btn-warning btn-icon">
															<i class="fal fa-file-search">
															</i>
														</a>
													@endif
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
	{{-- @endcan --}}
@endsection

@section('scripts')
@parent
<script>
	$(document).ready(function()
	{
		// initialize datatable
		$('#recomTable').dataTable(
		{
			responsive: true,
			lengthChange: false,
			order: [[1, 'desc']],
			// rowGroup: {
				// dataSrc: 0
			// },
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
				}
			]
		});

	});
</script>
@endsection
