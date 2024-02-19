@extends('layouts.admin')
@section('content')
	{{-- @include('partials.breadcrumb') --}}
	@include('partials.subheader')
	@can('online_access')
		@include('partials.sysalert')
		<div class="row">
			<div class="col-12">
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
										<input type="text" class="form-control form-control-sm" id="no_pengajuan"
											value="{{$commitmentcheck->no_pengajuan}}" disabled>
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
										<input type="text" class="form-control form-control-sm" id="no_ijin"
											value="{{$commitmentcheck->no_ijin}}" disabled>
									</div>
									<span class="help-block">Nomor Pengajuan Verifikasi.</span>
								</div>
								<div class="form-group col-md-4">
									<label class="form-label" for="statusVerif">Tanggal Pengajuan</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text">
												<i class="fal fa-calendar-day"></i>
											</span>
										</div>
										<input type="text" class="form-control form-control-sm" id="created_at"
											value="{{$commitmentcheck->pengajuan->created_at}}" disabled>
									</div>
									<span class="help-block">Tanggal pengajuan permohonan verifikasi oleh Pelaku Usaha.</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="card-deck">
					<div id="panel-2" class="panel card col-lg-5">
						<div class="panel-hdr">
							<h2>Data Komitmen (RIPH)</h2>
							<div>
								@include('partials.globaltoolbar')
							</div>
						</div>
						<div class="panel-container show">
							<div class="panel-content">
								<ul class="list-group row">
									<li class="list-group-item d-flex justify-content-between align-items-center">
										<span class="text-muted">Perusahaan</span>
										<span>{{$commitment->user->data_user->company_name}}</span>
									</li>
									<li class="list-group-item d-flex justify-content-between align-items-center">
										<span class="text-muted">Periode</span>
										<span>{{$commitment->periodetahun}}</span>
									</li>
									<li class="list-group-item d-flex justify-content-between align-items-center">
										<span class="text-muted">Tanggal Terbit</span>
										<span>{{ date('d/m/Y', strtotime($commitment->tgl_ijin)) }}</span>
									</li>
									<li class="list-group-item d-flex justify-content-between align-items-center">
										<span class="text-muted">Tanggal Berakhir</span>
										<span>{{ date('d/m/Y', strtotime($commitment->tgl_akhir)) }}</span>
									</li>
									<li class="list-group-item d-flex justify-content-between align-items-center">
										<span class="text-muted">Komoditas</span>
										<span>{{$commitment->no_hs}}</span>
									</li>
									<li class="list-group-item d-flex justify-content-between align-items-center">
										<span class="text-muted">Volume RIPH</span>
										<span>{{ number_format($commitment->volume_riph, 2, '.', ',') }} ton</span>
									</li>
									<li class="list-group-item d-flex justify-content-between align-items-center">
										<span class="text-muted">Wajib Tanam</span>
										<span>{{ number_format($commitment->volume_riph * 0.05/6, 2, '.', ',') }} ha</span>
									</li>
									<li class="list-group-item d-flex justify-content-between align-items-center">
										<span class="text-muted">Wajib Produksi</span>
										<span>{{ number_format($commitment->volume_riph * 0.05, 2, '.', ',') }} ton</span>
									</li>
									<li class="list-group-item d-flex justify-content-between align-items-center">
										<span class="text-muted">Kebutuhan Benih</span>
										<span>{{ number_format($commitment->volume_riph * 0.05/6*0.8, 2, '.', ',') }} ton</span>
									</li>
									<li class="list-group-item d-flex justify-content-between align-items-center">
										<span class="text-muted">Stok Benih Mandiri</span>
										<span>{{ number_format($commitment->stok_mandiri, 2, '.', ',') }} ton</span>
									</li>
									<li class="list-group-item d-flex justify-content-between align-items-center">
										<span class="text-muted">Benih Dari Penangkar</span>
										<span>{{ number_format($commitment->volume_riph * 0.05/6*0.8 - $commitment->stok_mandiri, 2, '.', ',') }} ton</span>
									</li>
									<li class="list-group-item d-flex justify-content-between align-items-center">
										<span class="text-muted">Pupuk Organik</span>
										<span>{{ number_format($commitment->pupuk_organik, 2, '.', ',') }} kg</span>
									</li>
									<li class="list-group-item d-flex justify-content-between align-items-center">
										<span class="text-muted">NPK</span>
										<span>{{ number_format($commitment->npk, 2, '.', ',') }} kg</span>
									</li>
									<li class="list-group-item d-flex justify-content-between align-items-center">
										<span class="text-muted">Dolomit</span>
										<span>{{ number_format($commitment->dolomit, 2, '.', ',') }} kg</span>
									</li>
									<li class="list-group-item d-flex justify-content-between align-items-center">
										<span class="text-muted">ZA</span>
										<span>{{ number_format($commitment->za, 2, '.', ',') }} kg</span>
									</li>
									<li class="list-group-item d-flex justify-content-between align-items-center">
										<span class="text-muted">Mulsa</span>
										<span>{{ number_format($commitment->mulsa, 2, '.', ',') }} kg</span>
									</li>
									<li class="list-group-item d-flex justify-content-between align-items-center">
										<span class="text-muted">Bagi Hasil</span>
										<span>{{$commitment->poktan_share}}% Poktan : {{ number_format(100-$commitment->poktan_share, 2, '.', ',') }}% Importir</span>
									</li>
								</ul>
								<div class="row" hidden>
								</div>
							</div>
						</div>
					</div>
					<div id="panel-3" class="panel card">
						<div class="panel-hdr">
							<h2>Kelengkapan Berkas</h2>
							<div class="panel-toolbar">
								@include('partials.globaltoolbar')
							</div>
						</div>
						<div class="panel-container show">
							<div class="alert alert-info border-0 mb-0">
								<div class="d-flex align-item-center">
									<i class="fal fa-info-circle mr-1"></i>
									<div class="flex-1">
										<span>Berikut ini adalah berkas-berkas kelengkapan yang diunggah oleh Pelaku Usaha.</span>
									</div>
								</div>
							</div>
							<form action="{{route('verification.data.commitmentcheck.store', $commitmentcheck->id)}}" method="POST">
								@csrf
								@method('PUT')
								<div class="panel-content">
									<div class="table mb-3">
										<table class="table table-striped table-bordered w-100" id="attchCheck">
											<thead class="card-header">
												<tr>
													<th class="text-uppercase text-muted">Form</th>
													<th hidden class="text-uppercase text-muted">Nama Berkas</th>
													<th class="text-uppercase text-muted">Tindakan</th>
													<th class="text-uppercase text-muted">Hasil Periksa</th>
												</tr>
											</thead>
											<tbody>
												@php
													$npwp = str_replace(['.', '-'], '', $commitment->npwp);
												@endphp
												<tr class="align-items-center">
													<td>Penerbitan RIPH</td>
													<td hidden>
														@if ($commitment->formRiph)
															<span class="text-primary">{{ $commitment->formRiph }}</span>
														@else
															<span class="text-danger"><i class="fas fa-times-circle mr-1"></i>Tidak Ada</span>
														@endif
													</td>
													<td>
														@if($commitment->formRiph)
															<a href="#" data-toggle="modal" data-target="#viewDocs"
																data-doc="{{ asset('storage/uploads/'.$npwp.'/'.$commitment->periodetahun.'/'.$commitment->formRiph) }}">
																<i class="fas fa-search mr-1"></i>
																Periksa Dokumen
															</a>
														@else
															<span class="text-danger"><i class="fas fa-times-circle mr-1"></i>Tidak Ada</span>
														@endif
													</td>
													<td>
														<select type="text" id="formRiph" name="formRiph" class="form-control form-control-sm">
															<option hidden>- pilih status periksa</option>
															<option value="Sesuai" {{ $commitmentcheck && $commitmentcheck->formRiph == 'Sesuai' ? 'selected' : '' }}>Sesuai</option>
															<option value="Tidak Sesuai" {{ $commitmentcheck && $commitmentcheck->formRiph == 'Tidak Sesuai' ? 'selected' : '' }}>Tidak Sesuai</option>

														</select>
													</td>
												</tr>
												<tr>
													<td>Form SPTJM</td>
													<td hidden>
														@if ($commitment->formSptjm)
															<span class="text-primary">{{ $commitment->formSptjm }}</span>
														@else
															<span class="text-danger"><i class="fas fa-times-circle mr-1"></i>Tidak Ada</span>
														@endif
													</td>
													<td>
														@if ($commitment->formSptjm)
															<a href="#" data-toggle="modal" data-target="#viewDocs" data-doc="{{ asset('storage/uploads/'.$npwp.'/'.$commitment->periodetahun.'/'.$commitment->formSptjm) }}">
																<i class="fas fa-search mr-1"></i>
																Periksa Dokumen
															</a>
														@else
															<span class="text-danger"><i class="fas fa-times-circle mr-1"></i>Tidak Ada</span>
														@endif
													</td>
													<td>
														<select type="text" id="formSptjm" name="formSptjm" class="form-control form-control-sm">
															<option hidden value="">- pilih status periksa</option>
															<option value="Sesuai" {{ $commitmentcheck && $commitmentcheck->formSptjm == 'Sesuai' ? 'selected' : '' }}>Sesuai</option>
															<option value="Tidak Sesuai" {{ $commitmentcheck && $commitmentcheck->formSptjm == 'Tidak Sesuai' ? 'selected' : '' }}>Tidak Sesuai</option>
														</select>
													</td>
												</tr>
												<tr>
													<td>Logbook</td>
													<td hidden>
														@if ($commitment->logbook)
															<span class="text-primary">{{ $commitment->logbook }}</span>
														@else
															<span class="text-danger"><i class="fas fa-times-circle mr-1"></i>Tidak Ada</span>
														@endif
													</td>
													<td>
														@if ($commitment->logbook)
															<a href="#" data-toggle="modal" data-target="#viewDocs" data-doc="{{ asset('storage/uploads/'.$npwp.'/'.$commitment->periodetahun.'/'.$commitment->logbook) }}">
																<i class="fas fa-search mr-1"></i>
																Periksa Dokumen
															</a>
														@else
															<span class="text-danger"><i class="fas fa-times-circle mr-1"></i>Tidak Ada</span>
														@endif
													</td>
													<td>
														<select type="text" id="logbook" name="logbook" class="form-control form-control-sm">
															<option hidden value="">- pilih status periksa</option>
															<option value="Sesuai" {{ $commitmentcheck && $commitmentcheck->logbook == 'Sesuai' ? 'selected' : '' }}>Sesuai</option>
															<option value="Tidak Sesuai" {{ $commitmentcheck && $commitmentcheck->logbook == 'Tidak Sesuai' ? 'selected' : '' }}>Tidak Sesuai</option>
														</select>
													</td>
												</tr>
												<tr>
													<td>Form RT</td>
													<td hidden>
														@if ($commitment->formRt)
															<span class="text-primary">{{ $commitment->formRt }}</span>
														@else
															<span class="text-danger"><i class="fas fa-times-circle mr-1"></i>Tidak Ada</span>
														@endif
													</td>
													<td>
														@if ($commitment->formRt)
															<a href="#" data-toggle="modal" data-target="#viewDocs" data-doc="{{ asset('storage/uploads/'.$npwp.'/'.$commitment->periodetahun.'/'.$commitment->formRt) }}">
																<i class="fas fa-search mr-1"></i>
																Periksa Dokumen
															</a>
														@else
															<span class="text-danger"><i class="fas fa-times-circle mr-1"></i>Tidak Ada</span>
														@endif
													</td>
													<td>
														<select type="text" id="formRt" name="formRt" class="form-control form-control-sm">
															<option hidden value="">- pilih status periksa</option>
															<option value="Sesuai" {{ $commitmentcheck && $commitmentcheck->formRt == 'Sesuai' ? 'selected' : '' }}>Sesuai</option>
															<option value="Tidak Sesuai" {{ $commitmentcheck && $commitmentcheck->formRt == 'Tidak Sesuai' ? 'selected' : '' }}>Tidak Sesuai</option>
														</select>
													</td>
												</tr>
												<tr>
													<td>Form RTA</td>
													<td hidden>
														@if ($commitment->formRta)
															<span class="text-primary">{{ $commitment->formRta }}</span>
														@else
															<span class="text-danger"><i class="fas fa-times-circle mr-1"></i>Tidak Ada</span>
														@endif
													</td>
													<td>
														@if ($commitment->formRta)
															<a href="#" data-toggle="modal" data-target="#viewDocs" data-doc="{{ asset('storage/uploads/'.$npwp.'/'.$commitment->periodetahun.'/'.$commitment->formRta) }}">
																<i class="fas fa-search mr-1"></i>
																Periksa Dokumen
															</a>
														@else
															<span class="text-danger"><i class="fas fa-times-circle mr-1"></i>Tidak Ada</span>
														@endif
													</td>
													<td>
														<select type="text" id="formRta" name="formRta" class="form-control form-control-sm">
															<option hidden value="">- pilih status periksa</option>
															<option value="Sesuai" {{ $commitmentcheck && $commitmentcheck->formRta == 'Sesuai' ? 'selected' : '' }}>Sesuai</option>
															<option value="Tidak Sesuai" {{ $commitmentcheck && $commitmentcheck->formRta == 'Tidak Sesuai' ? 'selected' : '' }}>Tidak Sesuai</option>
														</select>
													</td>
												</tr>
												<tr>
													<td>Form RPO</td>
													<td hidden>
														@if ($commitment->formRpo)
															<span class="text-primary">{{ $commitment->formRpo }}</span>
														@else
															<span class="text-danger"><i class="fas fa-times-circle mr-1"></i>Tidak Ada</span>
														@endif
													</td>
													<td>
														@if ($commitment->formRpo)
															<a href="#" data-toggle="modal" data-target="#viewDocs" data-doc="{{ asset('storage/uploads/'.$npwp.'/'.$commitment->periodetahun.'/'.$commitment->formRpo) }}">
																<i class="fas fa-search mr-1"></i>
																Periksa Dokumen
															</a>
														@else
															<span class="text-danger"><i class="fas fa-times-circle mr-1"></i>Tidak Ada</span>
														@endif
													</td>
													<td>
														<select type="text" id="formRpo" name="formRpo" class="form-control form-control-sm">
															<option hidden value="">- pilih status periksa</option>
															<option value="Sesuai" {{ $commitmentcheck && $commitmentcheck->formRpo == 'Sesuai' ? 'selected' : '' }}>Sesuai</option>
															<option value="Tidak Sesuai" {{ $commitmentcheck && $commitmentcheck->formRpo == 'Tidak Sesuai' ? 'selected' : '' }}>Tidak Sesuai</option>
														</select>
													</td>
												</tr>
												<tr>
													<td>Form LA</td>
													<td hidden>
														@if ($commitment->formLa)
															<span class="text-primary">{{ $commitment->formLa }}</span>
														@else
															<span class="text-danger"><i class="fas fa-times-circle mr-1"></i>Tidak Ada</span>
														@endif
													</td>
													<td>
														@if ($commitment->formLa)
															<a href="#" data-toggle="modal" data-target="#viewDocs" data-doc="{{ asset('storage/uploads/'.$npwp.'/'.$commitment->periodetahun.'/'.$commitment->formLa) }}">
																<i class="fas fa-search mr-1"></i>
																Periksa Dokumen
															</a>
														@else
															<span class="text-danger"><i class="fas fa-times-circle mr-1"></i>Tidak Ada</span>
														@endif
													</td>
													<td>
														<select type="text" id="formLa" name="formLa" name="formLa" class="form-control form-control-sm">
															<option hidden value="">- pilih status periksa</option>
															<option value="Sesuai" {{ $commitmentcheck && $commitmentcheck->formLa == 'Sesuai' ? 'selected' : '' }}>Sesuai</option>
															<option value="Tidak Sesuai" {{ $commitmentcheck && $commitmentcheck->formLa == 'Tidak Sesuai' ? 'selected' : '' }}>Tidak Sesuai</option>
														</select>
													</td>
												</tr>
											</tbody>
										</table>
									</div><hr>
									<div>
										<div class="form-group">
											<label for="">Catatan Pemeriksaan</label>
											<textarea class="form-control form-control-sm" name="note" id="note" rows="5">{{ old('note', $commitmentcheck ? $commitmentcheck->note : '') }}</textarea>
											<small id="helpId" class="text-muted">Berikan catatan hasil pemeriksaan.</small>
										</div>
									</div>
								</div>
								<div class="card-footer d-flex justify-content-between align-items-center">
									<div class="help-block">
									</div>
									<div class="">
										<button class="btn btn-sm btn-info"><i class="fal fa-undo mr-1"></i> Batal</button>
										<button class="btn btn-sm btn-warning" type="submit"><i class="fal fa-save mr-1"></i>Simpan</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
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
	@endcan
@endsection

@section('scripts')
	@parent
	<script>
		$(document).ready(function() {
			$('#viewDocs').on('shown.bs.modal', function (e) {
				var docUrl = $(e.relatedTarget).data('doc');
				$('iframe').attr('src', docUrl);
			});
		});
	</script>
@endsection
