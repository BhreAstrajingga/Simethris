@extends('layouts.admin')
@section('content')
{{-- @include('partials.breadcrumb') --}}
@include('partials.subheader')

@can('pengajuan_access')
<div class="row">
	<div class="col-12">
		<div class="panel" id="panel-1">
			<div class="panel-hdr">
				<h2>
					Pengajuan Verifikasi
				</h2>
				<div class="panel-toolbar">
					@include('partials.globaltoolbar')
				</div>
			</div>
			<div class="panel-container show">
				<div class="panel-content">
					<table class="table table-hover table-striped table-bordered table-sm" id="datatable">
						<thead class="thead-themed">
							<th>Verifikasi</th>
							<th>No. Riph</th>
							<th>Tanggal Pengajuan</th>
							<th>Tanggal Status</th>
							<th>Status Terakhir</th>
							<th>Tindakan</th>
						</thead>
						<tbody>
							{{-- verifikasi tanam --}}
							@foreach ($verifTanams as $verifTanam)
								<tr>
									<td class="text-center"><span class="badge badge-success">Tanam</span></td>
									<td>{{$verifTanam->no_ijin}}</td>
									<td>{{$verifTanam->created_at}}</td>
									<td>{{$verifTanam->updated_at}}</td>
									<td class="text-center">
										@if($verifTanam->status === '1')
											<span class="badge btn-xs btn-info" data-toggle="tooltip" title data-original-title="Verifikasi Sudah diajukan">Diajukan</span>
										@elseif($verifTanam->status === '2')
											<span class="badge btn-xs btn-info" data-toggle="tooltip" title data-original-title="Proses pemeriksaan berkas">Berkas</span>
										@elseif($verifTanam->status === '3')
											<span class="badge btn-xs btn-info" data-toggle="tooltip" title data-original-title="Proses pemeriksaan PKS">PKS</span>
										@elseif($verifTanam->status >= '4')
											<span class="badge btn-xs btn-success" data-toggle="tooltip" title data-original-title="Verifikasi data tanam selesai">Selesai</span>
										@endif
									</td>
									<td class="text-center">
										<a href="{{route('admin.task.pengajuan.tanam.show', $verifTanam->id)}}"
											class="btn btn-xs btn-icon btn-primary"
											data-toggle="tooltip" title data-original-title="Lihat data pengajuan">
											<i class="fa fa-file-invoice"></i>
										</a>
									</td>
								</tr>
							@endforeach
							{{-- verifikasi produksi --}}
							@foreach ($verifProduksis as $verifProduksi)
								<tr>
									<td class="text-center"><span class="badge badge-warning">Produksi</span></td>
									<td>{{$verifProduksi->no_ijin}}</td>
									<td>{{$verifProduksi->created_at}}</td>
									<td>{{$verifProduksi->updated_at}}</td>
									<td class="text-center">
										@if($verifProduksi->status === '1')
											<span class="badge btn-xs btn-info" data-toggle="tooltip" title data-original-title="Verifikasi Sudah diajukan">Diajukan</span>
										@elseif($verifProduksi->status === '2')
											<span class="badge btn-xs btn-info" data-toggle="tooltip" title data-original-title="Proses pemeriksaan berkas">Berkas</span>
										@elseif($verifProduksi->status === '3')
											<span class="badge btn-xs btn-info" data-toggle="tooltip" title data-original-title="Proses pemeriksaan PKS">PKS</span>
										@elseif($verifProduksi->status === '4')
											<span class="badge btn-xs btn-success" data-toggle="tooltip" title data-original-title="Verifikasi data tanam selesai">Selesai</span>
										@elseif($verifProduksi->status === '5')
											<span class="badge btn-xs btn-danger" title="Data laporan perlu diperbaiki">Perbaikan</span>
										@endif
									</td>
									<td class="text-center">
										<a href="{{route('admin.task.submission.show', $verifProduksi->id)}}"
											class="btn btn-xs btn-icon btn-primary"
											data-toggle="tooltip" title data-original-title="Lihat data pengajuan">
											<i class="fa fa-file-invoice"></i>
										</a>
										@if ($verifProduksi->status)

										@endif
										@if ($verifProduksi->status === '4')
											<a href="javascript:void(0)" class="btn btn-icon btn-primary btn-xs" title="Ajukan penerbitan SKL" data-toggle="modal" data-target="#modelId">
												<i class="fal fa-file-certificate"></i>
											</a>
										@endif

										<!-- Modal -->
										<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
											<div class="modal-dialog" role="document">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title">Modal title</h5>
															<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																<span aria-hidden="true">&times;</span>
															</button>
													</div>
													<div class="modal-body">
														Body
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
														<button type="button" class="btn btn-primary">Save</button>
													</div>
												</div>
											</div>
										</div>
									</td>
								</tr>
							@endforeach
							{{-- verifikasi skl --}}
							@foreach ($verifSkls as $verifSkl)
								<tr>
									<td class="text-center"><span class="badge badge-primary">SKL</span></td>
									<td>{{$verifSkl->no_ijin}}</td>
									<td>{{$verifSkl->created_at}}</td>
									<td>{{$verifSkl->updated_at}}</td>
									<td class="text-center">
										@if($verifSkl->status === '10')
											<span class="badge btn-xs btn-info" data-toggle="tooltip" title data-original-title="Penerbitan SKL sudah diajukan">Diajukan</span>
										@elseif($verifSkl->status === '11')
											<span class="badge btn-xs btn-info" data-toggle="tooltip" title data-original-title="Proses pemeriksaan berkas">Berkas</span>
										@elseif($verifSkl->status === '12')
											<span class="badge btn-xs btn-info" data-toggle="tooltip" title data-original-title="Proses Rekomendasi">Rekomendasi</span>
										@elseif($verifSkl->status === '14')
											<span class="badge btn-xs btn-success" data-toggle="tooltip" title data-original-title="Verifikasi data tanam selesai">Terbit</span>
										@elseif($verifSkl->status === '15')
											<span class="badge btn-xs btn-danger" title="Data laporan perlu diperbaiki">Perbaikan</span>
										@endif
									</td>
									<td class="text-center">
										<a href=""
											class="btn btn-xs btn-icon btn-primary"
											data-toggle="tooltip" title data-original-title="Lihat data pengajuan">
											<i class="fa fa-file-invoice"></i>
										</a>
										@if ($verifSkl->status)

										@endif
										@if ($verifSkl->status === '8')
											<a href="javascript:void(0)" class="btn btn-icon btn-primary btn-xs" title="Ajukan penerbitan SKL" data-toggle="modal" data-target="#modelId">
												<i class="fal fa-file-certificate"></i>
											</a>
										@endif
							@endforeach
						</tbody>
					</table>
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
	$('#datatable').dataTable(
		{
			responsive: true,
			lengthChange: false,
			order:[],
			dom:
				"<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'f><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'lB>>" +
				"<'row'<'col-sm-12'tr>>" +
				"<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'>>",
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
		}
	);

	$('#verifProduksi').dataTable(
		{
			responsive: true,
			lengthChange: false,
			order:[],
			dom:
				"<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'f><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'lB>>" +
				"<'row'<'col-sm-12'tr>>" +
				"<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'>>",
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
		}
	);
});

</script>

@endsection
