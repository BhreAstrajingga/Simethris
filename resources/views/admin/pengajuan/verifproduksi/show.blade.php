@extends('layouts.admin')
@section('content')
	{{-- @include('partials.breadcrumb') --}}
	@include('partials.subheader')
	{{-- @can('online_access') --}}
		@include('partials.sysalert')
		<div class="row" id="contentToPrint">
			@php
				$npwp = str_replace(['.', '-'], '', $commitment->npwp);
			@endphp
			<div class="col-12">
				<div class="text-center">
					<i class="fal fa-badge-check fa-3x subheader-icon"></i>
					<h2>Ringkasan Data</h2>
					<div class="row justify-content-center">
						<p class="lead">Anda melakukan permohonan pengajuan verifikasi produksi pada {{ date('D, d M Y', strtotime($verifikasi->created_at)) }}.</p>
					</div>
				</div>
				<div id="panel-1" class="panel">
					<div class="panel-container show">
						<div class="panel-content">
							<div class="row d-flex justify-content-between">
								<div class="form-group col-md-4">
									<label class="form-label" for="no_pengajuan">Nomor Pengajuan</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text">
												<i class="fal fa-file-invoice"></i>
											</span>
										</div>
										<input type="text" class="form-control form-control-sm" id="no_pengajuan" name="no_pengajuan"
											value="{{$verifikasi->no_pengajuan}}" disabled>
									</div>
									<span class="help-block">Nomor Pengajuan Verifikasi.</span>
								</div>
								<div class="form-group col-md-4">
									<label class="form-label" for="no_ijin">Nomor RIPH</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text">
												<i class="fal fa-file-invoice"></i>
											</span>
										</div>
										<input type="text" class="form-control form-control-sm" id="no_ijin" value="{{$verifikasi->no_ijin}}" name="no_ijin" disabled>
									</div>
									<span class="help-block">Nomor Ijin RIPH.</span>
								</div>
								<div class="form-group col-md-4">
									<label class="form-label" for="created_at">Tanggal Pengajuan</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text">
												<i class="fal fa-calendar-day"></i>
											</span>
										</div>
										<input type="text" class="form-control form-control-sm" id="created_at" name="created_at"
											value="{{$verifikasi->created_at}}" disabled>
									</div>
									<span class="help-block">Tanggal Pengajuan</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<ul class="nav nav-tabs" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" data-toggle="tab" href="#panel-2" role="tab" aria-selected="true">Ringkasan Data Pengajuan</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#panel-3" role="tab" aria-selected="true">Kelengkapan Berkas</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#panel-4" role="tab" aria-selected="true">Perjanjian Kemitraan (PKS)</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#panel-5" role="tab" aria-selected="true">Data Lokasi Tanam</a>
					</li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane fade active show" id="panel-2" role="tabpanel" aria-labelledby="panel-2">
						<div class="panel" id="panel-2">
							<div class="panel-container show">
								<div class="panel-content">
									<table class="table table-bordered table-hover table-striped table-sm w-100" id="summaryData">
										<thead class="thead-themed">
											<th>Deskripsi</th>
											<th>Ringkasan Data</th>
											<th></th>
										</thead>
										<tbody>
											<tr>
												<td>Kelompok Tani</td>
												<td class="text-right">{{$countPoktan}}</td>
												<td>Poktan</td>
											</tr>
											<tr>
												<td>PKS diunggah</td>
												<td class="text-right">{{$countPks}}</td>
												<td>PKS</td>
											</tr>
											<tr>
												<td>Jumlah Anggota</td>
												<td class="text-right">{{$countAnggota}}</td>
												<td>Anggota</td>
											</tr>
											<tr>
												<td>Spasial</td>
												<td class="text-right">{{$hasGeoloc}}</td>
												<td>Titik</td>
											</tr>
											<tr>
												<td>Luas Wajib Tanam</td>
												<td class="text-right">{{ number_format($commitment->luas_wajib_tanam, 2, '.', ',') }}</td>
												<td>hektar</td>
											</tr>
											<tr class="{{ ($total_luastanam < $commitment->luas_wajib_tanam) ? 'text-danger' : '' }}">
												<td>Luas Realisasi Tanam</td>
												<td class="text-right">{{ number_format($total_luastanam, 2, '.', ',') }}</td>
												<td>hektar</td>
											</tr>
											<tr>
												<td>Volume Wajib Produksi</td>
												<td class="text-right">{{ number_format($commitment->volume_produksi, 2, '.', ',') }}</td>
												<td>ton</td>
											</tr>
											<tr class="{{ ($total_volume < $commitment->volume_produksi) ? 'text-danger' : '' }}">
												<td>Volume Realisasi Produksi</td>
												<td class="text-right">{{ number_format($total_volume, 2, '.', ',') }}</td>
												<td>ton</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<div class="tab-pane fade" id="panel-3" role="tabpanel" aria-labelledby="panel-3">
						<div id="panel-3" class="panel">
							<div class="panel-container show">
								<div class="panel-content">
									<table class="table table-striped table-bordered table-sm w-100" id="attchCheck">
										<thead class="thead-themed">
											<tr>
												<th class="text-uppercase text-muted">Form</th>
												<th class="text-uppercase text-muted">Berkas</th>
												<th class="text-uppercase text-muted">Hasil Periksa</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>
													@if ($userDocs->sptjm)
														<a href="#" data-toggle="modal" data-target="#viewDocs" data-doc="{{ asset('storage/uploads/'.$npwp.'/'.$commitment->periodetahun.'/'.$userDocs->sptjm) }}">
															Surat Pertanggungjawaban Mutlak
														</a>
													@else
														<span>Surat Pertanggungjawaban Mutlak</span>
													@endif
												</td>
												<td>
													<span>{{$userDocs->sptjm}}</span>
												</td>
												<td class="text-center text-uppercase">
													@if ($userDocs->sptjmcheck)
														<span class="{{ $userDocs->sptjmcheck !== 'sesuai' ? 'text-danger' : 'text-success' }}">{{ $userDocs->sptjmcheck }}</span>
													@else
														<span class="text-danger text-center">Tidak ada data</span>
													@endif
												</td>
											</tr>
											<tr>
												<td>
													@if ($userDocs->spvp)
														<a href="#" data-toggle="modal" data-target="#viewDocs" data-doc="{{ $userDocs->spvp ? asset('storage/uploads/'.$npwp.'/'.$commitment->periodetahun.'/'.$userDocs->spvp) : '' }}">
															Surat Pengajuan Verifikasi Produksi
														</a>
													@else
														<span>Surat Pengajuan Verifikasi Produksi</span>
													@endif
												</td>
												<td>
													<span>{{$userDocs->spvp}}</span>
												</td>
												<td class="text-center text-uppercase">
													@if ($userDocs->spvpcheck)
														<span class="{{ $userDocs->spvpcheck !== 'sesuai' ? 'text-danger' : 'text-success' }}">{{ $userDocs->spvpcheck }}</span>
													@else
														<span class="text-danger text-center">Tidak ada data</span>
													@endif
												</td>
											</tr>
											<tr>
												<td>
													@if ($userDocs->rpo)
														<a href="#" data-toggle="modal" data-target="#viewDocs" data-doc="{{ asset('storage/uploads/'.$npwp.'/'.$commitment->periodetahun.'/'.$userDocs->rpo) }}">
															Form Realisasi Produksi
														</a>
													@else
														<span>Form Realisasi Produksi</span>
													@endif
												</td>
												<td>
													<span>{{$userDocs->rpo}}</span>
												</td>
												<td class="text-center text-uppercase">
													@if ($userDocs->rpocheck)
														<span class="{{ $userDocs->rpocheck !== 'sesuai' ? 'text-danger' : 'text-success' }}">{{ $userDocs->rpocheck }}</span>
													@else
														<span class="text-danger text-center">Tidak ada data</span>
													@endif
												</td>
											</tr>
											<tr>
												<td>
													@if ($userDocs->sphproduksi)
														<a href="#" data-toggle="modal" data-target="#viewDocs" data-doc="{{ asset('storage/uploads/'.$npwp.'/'.$commitment->periodetahun.'/'.$userDocs->sphproduksi) }}">
															Form SPH-SBS (Produksi)
														</a>
													@else
														<span>Form SPH-SBS (Produksi)</span>
													@endif
												</td>
												<td>
													<span>{{$userDocs->sphproduksi}}</span>
												</td>
												<td class="text-center text-uppercase">
													@if ($userDocs->sphproduksicheck)
														<span class="{{ $userDocs->sphproduksicheck !== 'sesuai' ? 'text-danger' : 'text-success' }}">{{ $userDocs->sphproduksicheck }}</span>
													@else
														<span class="text-danger text-center">Tidak ada data</span>
													@endif
												</td>
											</tr>
											<tr>
												<td>
													@if ($userDocs->spdsp)
														<a href="#" data-toggle="modal" data-target="#viewDocs" data-doc="{{ asset('storage/uploads/'.$npwp.'/'.$commitment->periodetahun.'/'.$userDocs->spdsp) }}">
															Pengantar Dinas telah selesai Produksi
														</a>
													@else
														<span>Pengantar Dinas telah selesai Produksi</span>
													@endif
												</td>
												<td>
													<span>{{$userDocs->spdsp}}</span>
												</td>
												<td class="text-center text-uppercase">
													@if ($userDocs->spdspcheck)
														<span class="{{ $userDocs->spdspcheck !== 'sesuai' ? 'text-danger' : 'text-success' }}">{{ $userDocs->spdspcheck }}</span>
													@else
														<span class="text-danger text-center">Tidak ada data</span>
													@endif
												</td>
											</tr>
											<tr>
												<td>
													@if ($userDocs->logbookproduksi)
														<a href="#" data-toggle="modal" data-target="#viewDocs" data-doc="{{ asset('storage/uploads/'.$npwp.'/'.$commitment->periodetahun.'/'.$userDocs->logbookproduksi) }}">
															Logbook (s.d produksi)
														</a>
													@else
														<span>Logbook (s.d produksi)</span>
													@endif
												</td>
												<td>
													<span>{{$userDocs->logbookproduksi}}</span>
												</td>
												<td class="text-center text-uppercase">
													@if ($userDocs->logbookproduksicheck)
														<span class="{{ $userDocs->logbookproduksicheck !== 'sesuai' ? 'text-danger' : 'text-success' }}">{{ $userDocs->logbookproduksicheck }}</span>
													@else
														<span class="text-danger text-center">Tidak ada data</span>
													@endif
												</td>
											</tr>
											<tr>
												<td>
													@if ($userDocs->formLa)
														<a href="#" data-toggle="modal" data-target="#viewDocs" data-doc="{{ asset('storage/uploads/'.$npwp.'/'.$commitment->periodetahun.'/'.$userDocs->formLa) }}">
															Laporan Akhir
														</a>
													@else
														<span>Laporan Akhir</span>
													@endif
												</td>
												<td>
													<span>{{$userDocs->formLa}}</span>
												</td>
												<td class="text-center text-uppercase fw-500">
													@if ($userDocs->formLacheck)
														<span class="{{ $userDocs->formLacheck !== 'sesuai' ? 'text-danger' : 'text-success' }}">{{ $userDocs->formLacheck }}</span>
													@else
														<span class="text-danger text-center">Tidak ada data</span>
													@endif
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<div class="tab-pane fade" id="panel-4" role="tabpanel" aria-labelledby="panel-4">
						<div id="panel-4" class="panel">
							<div class="panel-container show">
								<div class="panel-content">
									<table class="table table-striped table-bordered table-sm w-100" id="pksCheck">
										<thead class="thead-themed">
											<tr>
												<th class="text-uppercase text-muted">Nomor Perjanjian</th>
												<th class="text-uppercase text-muted">Kelompok Tani</th>
												<th class="text-uppercase text-muted">Masa Berlaku</th>
												<th class="text-uppercase text-muted">Status</th>
											</tr>
										</thead>
										<tbody>
											@foreach ($pkss as $pks)
												<tr>
													<td>
														@if($pks->berkas_pks)
															<a href="#" data-toggle="modal" data-target="#viewDocs" data-doc="{{ $pks->berkas_pks ? asset('storage/uploads/'.$npwp.'/'.$commitment->periodetahun.'/'.$pks->berkas_pks) : '' }}">
																{{$pks->no_perjanjian}}
															</a>
														@endif
													</td>
													<td>{{$pks->masterpoktan->nama_kelompok}}</td>
													<td>
														{{$pks->tgl_perjanjian_start}} s.d
														{{$pks->tgl_perjanjian_end}}
													</td>
													<td>
														{{$pks->status}}
													</td>
												</tr>
											@endforeach
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<div class="tab-pane fade" id="panel-5" role="tabpanel" aria-labelledby="panel-5">
						<div id="panel-5" class="panel">
							{{-- <div class="panel-hdr">
								<h2>Data Lokasi Tanam</h2>
							</div> --}}
							<div class="panel-container show">
								<div class="panel-content">
									<table class="table table-striped table-bordered table-sm w-100" id="dataTable">
										<thead>
											<th class="text-uppercase text-muted">Kelompoktani</th>
											<th class="text-uppercase text-muted">Nama Lokasi</th>
											<th class="text-uppercase text-muted">Pengelola</th>
											<th class="text-uppercase text-muted">Luas</th>
										</thead>
										<tbody>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-12">
			</div>
		</div>

		{{-- modal view doc --}}
		<div class="modal fade" id="viewDocs" tabindex="-1" role="dialog" aria-labelledby="document" aria-hidden="true">
			<div class="modal-dialog modal-dialog-right" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">
							Berkas <span class="fw-300"><i>lampiran </i></span>
						</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body embed-responsive embed-responsive-16by9">
						<iframe class="embed-responsive-item" src="" width="100%"  frameborder="0"></iframe>
					</div>
				</div>
			</div>
		</div>
	{{-- @endcan --}}
@endsection

@section('scripts')
	@parent
	<script>
		$(document).ready(function() {
			$('#viewDocs').on('shown.bs.modal', function (e) {
				var docUrl = $(e.relatedTarget).data('doc');
				$('iframe').attr('src', docUrl);
			});

			$(function() {
				$("#pksMitra").select2({
					placeholder: "--Pilih PKS/Poktan",
					dropdownParent:'#selectPks'
				});

				$("#lokasiLahan").select2({
					placeholder: "--Pilih lokasi",
					dropdownParent:'#selectLokasi'
				});
			});

			var tableData = $('#dataTable').DataTable({
				responsive: true,

				lengthChange: true,
				dom:
				"<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'f><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'lB>>" +
				"<'row'<'col-sm-12'tr>>" +
				"<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
				buttons: [
					{
						extend: 'excelHtml5',
						text: '<i class="fa fa-file-excel"></i>',
						titleAttr: 'Generate Excel',
						className: 'btn-outline-success btn-xs btn-icon ml-3 mr-1'
					},
					{
						extend: 'print',
						text: '<i class="fa fa-print"></i>',
						titleAttr: 'Print Table',
						className: 'btn-outline-primary btn-xs btn-icon mr-1'
					}
				],
				columnDefs: [

					// { className: 'text-right', targets: [3] },
					// { className: 'text-center', targets: [4] },
				]
			});

			function updateTableData() {
				$.ajax({
					url: '{{ route("admin.ajutanam.listlokasi", $verifikasi->commitment_id) }}',
					type: 'GET',
					dataType: 'json',
					success: function(response) {

						tableData.clear().draw();
						if (response.lokasis.length > 0) {
							$.each(response.lokasis, function(index, lokasi) { // Update response handling

								var luasTanam = lokasi.luas_tanam;
								var formatter = new Intl.NumberFormat('en-GB', {
									style: 'decimal',
									minimumFractionDigits: 2,
									maximumFractionDigits: 2,
								});
								var LuasTanam = formatter.format(luasTanam);

								var id = lokasi.id;
								var npwp = lokasi.npwp;
								var noIjin = lokasi.no_ijin;
								var poktan = lokasi.poktan;
								var anggota = lokasi.anggota;
								var namaLokasi = lokasi.nama_lokasi;
								var actionBtn = `
									<a href="${lokasi.show}" class="btn btn-xs btn-icon btn-primary" title="Lihat detail">
										<i class="fal fa-search"></i>
									</a>
								`;
								tableData.row.add([poktan, namaLokasi, anggota,LuasTanam]).draw(false);
							});
						}
						tableData.draw(); // Draw the table after adding the rows
					},
					error: function(xhr, status, error) {
						console.error(xhr.responseText);
					}
				});
			}
			updateTableData();
		});
	</script>

	<script>
		function validateInput() {
			// get the input value and the current username from the page
			var inputVal = document.getElementById('validasi').value;
			var currentUsername = '{{ Auth::user()->username }}';

			// check if the input is not empty and matches the current username
			if (inputVal !== '' && inputVal === currentUsername) {
				return true; // allow form submission
			} else {
				alert('Isi kolom Konfirmasi dengan username Anda!.');
				return false; // prevent form submission
			}
		}
	</script>
@endsection
