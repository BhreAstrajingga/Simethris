@extends('layouts.admin')
@section('content')
	{{-- @include('partials.breadcrumb') --}}
	@include('partials.subheader')
	@include('partials.sysalert')
	@can('pks_access')
		<div class="row">
			<div class="col-12">
				<div class="panel" id="panel-1">
					<div class="panel-hdr">
						<h2>
							DAFTAR BANTUAN <span class="fw-300 hidden-sm-down"><i>Kegiatan Usaha Tani</i></span>
						</h2>
					</div>
					<div class="alert alert-info border-0 mb-0">
						<div class="d-flex align-item-center">
							<div class="alert-icon">
								<div class="icon-stack icon-stack-sm mr-3 flex-shrink-0">
									<i class="base base-7 icon-stack-3x opacity-100 color-primary-400"></i>
									<i class="base base-7 icon-stack-2x opacity-100 color-primary-800"></i>
									<i class="fa fa-info icon-stack-1x opacity-100 color-white"></i>
								</div>
							</div>
							<div class="flex-1">
								<span>Bagian ini digunakan untuk mencatat/melaporkan data-data bantuan yang diberikan kepada kelompoktani sesuai perjanjian dalam rangka pelaksanaan kegiatan wajib tanam dan produksi.</span>
							</div>
						</div>
					</div>
					<div class="panel-container show">
						<div class="panel-content">
							<!-- datatable start -->
							<table id="dataSaprodi" class="table table-sm table-bordered table-hover table-striped w-100">
								<thead class="thead-dark">
									<tr>
										<th>Tanggal</th>
										<th hidden>Kategori</th>
										<th>Jenis</th>
										<th>Vol</th>
										<th>sat</th>
										<th>harga</th>
										<th>Jumlah</th>
										<th>Tindakan</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($saprodis as $saprodi)
										<tr>
											<td>{{$saprodi->tanggal_saprodi}}</td>
											<td hidden>{{$saprodi->kategori}}</td>
											<td>{{$saprodi->jenis}}</td>
											<td>{{$saprodi->volume}}</td>
											<td>{{$saprodi->satuan}}</td>
											<td>{{number_format($saprodi->harga, 2, ',', '.')}}</td>
											<td>{{number_format($saprodi->volume * $saprodi->harga, 2, ',', '.')}}</td>
											<td class="text-center">
												<form action="{{route('admin.task.saprodi.delete', $saprodi->id)}}" method="post">
													@csrf
													@method('delete')
													<div class="justify-content-between">
														<a class="mr-1 btn btn-icon btn-xs btn-info"
															href="{{ route('admin.task.saprodi.edit', ['pksId' => $saprodi->pks_id, 'id' => $saprodi->id]) }}">
															<i class="fas fa-edit" data-toggle="tooltip" data-offset="0,10" title data-original-title="edit this data"></i>
														</a>
														<button class="btn btn-icon btn-xs btn-danger" role="button" type="submit"
															onclick="return confirm('Are you sure you want to delete this data?');">
															<i class="fas fa-trash" data-toggle="tooltip" data-offset="0,10" title data-original-title="delete this data (with caution)"></i>
														</button>
													</div>
												</form>
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<!-- Modal addSaprodi Right -->
			<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="addSaprodi">
				<div class="modal-dialog modal-dialog-right">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title h4"><i class="subheader-icon fas fa-farm text-info"></i> Rekam data Bantuan</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true"><i class="fal fa-times"></i></span>
							</button>
						</div>
						<form action="{{route('admin.task.saprodi.store', $pks->id)}}" method="post" enctype="multipart/form-data">
							@csrf
							<div class="modal-body">
								<div class="form-group">
									<label class="form-label" for="tanggal_saprodi">Tanggal</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text fs-xl"><i class="fal fa-calendar-alt"></i></span>
										</div>
										<input type="date" name="tanggal_saprodi" id="tanggal_saprodi" class="form-control" placeholder="Task date" aria-label="date">
									</div>
									<span class="help-block">Tanggal pelaksanaan (penyerahan atau pembelian bantuan).</span>
								</div>
								<div class="row">
									<div class="form-group col-md-6 col-sm-12">
										<label class="form-label" for="kategori">Kategori</label>
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text"><i class="fal fa-tasks-alt"></i></span>
											</div>
											<select type="text" id="kategori" name="kategori" class="form-control" placeholder="pilih kategori">
												<option hidden>- pilih kategori</option>
												<option>Barang</option>
												<option>Uang</option>
											</select>
										</div>
										<span class="help-block">Kategori bantuan</span>
									</div>
									<div class="form-group col-md-6 col-sm-12">
										<label class="form-label" for="jenis">Jenis</label>
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text"><i class="fal fa-tasks-alt"></i></span>
											</div>
											<select type="text" id="jenis" name="jenis" class="form-control" placeholder="pilih jenis bantuan">
												<option hidden>- pilih jenis</option>
												<option>Uang</option>
												<option>Alsintan</option>
												<option>Benih</option>
												<option>Pupuk</option>
												<option>Pengendali</option>
												<option>Sarana</option>
												<option>Prasarana</option>
												<option>Lainnya</option>
											</select>
										</div>
										<span class="help-block">Jenis bantuan</span>
									</div>
									<div class="form-group col-7">
										<label class="form-label" for="volume">Volume</label>
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text"><i class="fal fa-box-full"></i></span>
											</div>
											<input type="number" id="volume" name="volume" class="form-control" placeholder="volume/banyak/jumlah barang">
										</div>
										<span class="help-block">volume</span>
									</div>
									<div class="form-group col-5">
										<label class="form-label" for="satuan">satuan</label>
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text">abc</span>
											</div>
											<input type="text" id="satuan" name="satuan" class="form-control" placeholder="unit.." aria-label="unit" aria-describedby="unit">
										</div>
										<span class="help-block">satuan barang</span>
									</div>
								</div>
								<div class="row">
									<div class="form-group col-md-5 col-sm-12">
										<label class="form-label" for="harga">Harga</label>
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text">Rp</span>
											</div>
											<input type="number" id="harga" name="harga" class="form-control" placeholder="price per unit" aria-label="price per unit" aria-describedby="price">
										</div>
										<span class="help-block">harga per satuan barang</span>
									</div>
									<div class="form-group col-md-7 col-sm-12">
										<label class="form-label" for="amount">Total Nilai</label>
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text">Rp</span>
											</div>
											<input type="number" id="total" name class="form-control fw-600" placeholder="autocalculate" aria-label="Total Amount" aria-describedby="amount" hidden >
											<input type="text" id="formattedTotal" class="form-control fw-600" placeholder="autocalculate" aria-label="Formatted Total Amount" aria-describedby="formattedAmount" disabled>

										</div>
										<span class="help-block">Total nilai bantuan</span>
									</div>
								</div>
								<div class="form-group">
									<label class="form-label">Dokumentasi</label>
									<div class="custom-file input-group">
										<input type="file" accept=".jpg, .png" id="file" name="file" class="custom-file-input" id="customControlValidation7">
										<label class="custom-file-label" for="customControlValidation7">pilih berkas...</label>
									</div>
									<span class="help-block">Dokumentasi bantuan. Berkas berekstensi jpg atau png, max 2Mb.</span>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-sm btn-warning" data-dismiss="modal">Batal</button>
								<button type="submit" class="btn btn-sm btn-primary">Rekam</button>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="modal fade delete-example-modal-right" tabindex="-1" role="dialog" aria-hidden="true">
				<div class="modal-dialog modal-dialog-right">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title h4">Delete Data</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true"><i class="fal fa-times"></i></span>
							</button>
						</div>
						<div class="modal-body">
							<div class="alert alert-danger">
								<div class="flex-1">
									<span class="h3">WARNING!</span>
									<br>
									Your current data and all related data will be deleted. Once its deleted, the data cannot be restored. Are you sure want to do this?
								</div>
							</div>
							<div class="form-group">
								<label class="form-label" for="datepicker-modal-3">Date</label>
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text fs-xl"><i class="fal fa-calendar-alt"></i></span>
									</div>
									<input type="text" id="datepicker-modal-3" class="form-control" placeholder="Task date" aria-label="date" aria-describedby="datepicker-modal-3">
								</div>
								<span class="help-block">Activity date.</span>
							</div>
							<div class="form-group">
								<label class="form-label" for="basic-addon1">Activity</label>
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fal fa-tasks-alt"></i></span>
									</div>
									<input type="text" id="basic-addon1" class="form-control" placeholder="Task..." aria-label="Username" aria-describedby="basic-addon1">
								</div>
								<span class="help-block">Activity/Task.</span>
							</div>
							<div class="form-group">
								<label class="form-label" for="basic-addon1">Task Description</label>
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fal fa-align-left"></i></span>
									</div>
									<input type="text" id="basic-addon1" class="form-control" placeholder="Description" aria-label="Username" aria-describedby="basic-addon1">
								</div>
								<span class="help-block">Description.</span>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-sm btn-warning" data-dismiss="modal">Cancel</button>
							<button type="button" class="btn btn-sm btn-danger">Delete</button>
						</div>
					</div>
				</div>
			</div>
			<div class="modal fade foto-example-modal-right" tabindex="-1" role="dialog" aria-hidden="true">
				<div class="modal-dialog modal-dialog-right">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title h4">Documentation Picture</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true"><i class="fal fa-times"></i></span>
							</button>
						</div>
						<div class="modal-body">
							<img src="/img/simet.jpg" class="card-img-top" alt="...">
							<div class="card-body">
								<h5 class="card-title">Encountered Constraint</h5>
								<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content. The pictures attachements are in carousel mode.</p>
								<a href="#" class="btn btn-primary"><i class="fas fa-expand"></i> Enlarge picture</a>
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
		$('#dataSaprodi').dataTable({
			pagingType: 'full_numbers',
			responsive: true,
			lengthChange: false,
			order: [
				[0, 'desc']
			],
			rowGroup: {
				dataSrc: 1
			},
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
				{
					text: '<i class="fa fa-plus"></i>',
					titleAttr: 'Tambah Data Bantuan Saprodi',
					className: 'btn btn-info btn-sm btn-icon ml-2',
					action: function(e, dt, node, config) {
						$('#addSaprodi').modal('show');
					}
				}
			]
		});
	});
</script>

<script>
	$(document).ready(function() {
	  // Function to calculate and update the total
	  function calculateTotal() {
		var volume = parseFloat($('#volume').val());
		var harga = parseFloat($('#harga').val());

		// Check for valid numbers
		if (isNaN(volume) || isNaN(harga)) {
		  $('#total').val(0).addClass('text-danger');
		  $('#formattedTotal').val(0).addClass('text-danger');
		} else {
		  var total = volume * harga;
		  $('#total').val(total.toFixed(2)).removeClass('text-danger');
		  $('#formattedTotal').val(formatNumber(total)).removeClass('text-danger');
		}
	  }

	  // Bind the input events to recalculate the total
	  $('#volume, #harga').on('input', calculateTotal);

	  // Function to format number with thousand separator
	  function formatNumber(number) {
		return number.toLocaleString('en-US');
	  }
	});
</script>
@endsection
