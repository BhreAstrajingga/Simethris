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
									<thead class="thead-themed">
										<tr>
											<th>No. SKL</th>
											<th>No. RIPH</th>
											<th>Pelaku Usaha</th>
											<th>Tanggal Rekomendasi</th>
											<th>Tanggal disetujui</th>
											<th>Tindakan</th>
										</tr>
									</thead>
									<tbody>
										@foreach ($recomends as $recomend)
											<tr>
												<td>
													{{$recomend->no_skl}}
												</td>
												<td>{{$recomend->no_ijin}}</td>
												<td>{{$recomend->datauser->company_name}}</td>
												<td class="text-center">{{$recomend->created_at}}</td>
												<td class="text-center">{{$recomend->approved_at}}</td>
												<td class="text-center">
													@if (empty($recomend->approved_by))
														<span class="btn btn-xs btn-primary btn-icon" data-toggle="tooltip" data-original-title="Menunggu Persetujuan Pimpinan">
															<i class="fal fa-hourglass-start"></i>
														</span>
													@elseif($recomend->approved_by)
														<a href="{{route('skl.print', $recomend->id)}}" class="btn btn-xs btn-icon btn-danger" data-toggle="tooltip" data-original-title="Telah Disetujui. Segera cetak SKL">
															<i class="fal fa-print"></i>
														</a>
														<button class="btn btn-xs btn-icon btn-warning" type="button" title="Unggah SKL yang telah ditandatangani Pejabat" data-toggle="modal" data-target="#modalUploadSkl{{$recomend->id}}">
															<i class="fas fa-upload text-align-center"></i>
														</button>
													@endif
													@if($recomend->published_date)
														<a href="{{route('verification.skl.published', $recomend->id)}}" class="btn btn-xs btn-success btn-icon">
															<i class="fal fa-award"></i>
														</a>
													{{-- @else
														<a href="{{route('verification.skl.recomendation.show', $recomend->id)}}" class="btn btn-xs btn-warning btn-icon">
															<i class="fal fa-file-search">
															</i>
														</a> --}}
													@endif
												</td>
												{{-- modal upload skl --}}
												<div class="modal fade" id="modalUploadSkl{{$recomend->id}}"
													tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
													<div class="modal-dialog modal-dialog-center" role="document">
														<div class="modal-content">
															<div class="modal-header">
																<div>
																	<h5 class="modal-title" id="myModalLabel">Unggah Berkas SKL</h5>
																	<small id="helpId" class="text-muted">Unggah berkas SKL yang telah ditandatangani oleh Pejabat.</small>
																</div>
																<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																	<span aria-hidden="true">&times;</span>
																</button>
															</div>
															{{-- {{route('verification.skl.sklUpload', $recomend->skl->id)}} --}}
															<form action="{{route('skl.upload', $recomend->id)}}" method="post" enctype="multipart/form-data">
																@csrf
																@method('put')
																<div class="modal-body">
																	<div class="form-group">
																		<label class="">Unggah hasil cetak SKL</label>
																		<div class="custom-file input-group">
																			<input type="file" accept="" class="custom-file-input" name="skl_upload" id="skl_upload">
																			<label class="custom-file-label" for="">Pilih berkas...</label>
																		</div>
																		<span class="help-block">Unggah hasil cetak SKL. Ekstensi pdf ukuran maks 2mb.</span>
																	</div>
																</div>
																<div class="modal-footer">
																	<button type="button" class="btn btn-warning btn-sm"
																		data-dismiss="modal">
																		<i class="fal fa-times-circle text-danger fw-500"></i> Close
																	</button>
																	<button class="btn btn-primary btn-sm" type="submit">
																		<i class="fal fa-upload mr-1"></i>Unggah
																	</button>
																</div>
															</form>
														</div>
													</div>
												</div>
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
