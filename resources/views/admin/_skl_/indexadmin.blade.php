@extends('layouts.admin')
@section('content')
{{-- @include('partials.breadcrumb') --}}
{{-- @include('partials.subheader') --}}
@can('admin_SKL_access')
<div class="row">
    <div class="col-lg-12">
        <div id="panel-1" class="panel">
            <div class="panel-hdr">
                <h2>
                    Daftar SKL
                </h2>
                <div class="panel-toolbar">
                    @include('partials.globaltoolbar')
                </div>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <div class="col-lg-12">
                        <div class="mb-2">
                            <ul class="nav nav-pills" role="tablist">
                                <li class="nav-item"><a class="btn-sm nav-link active" data-toggle="pill" href="#queue"><i class="fas fa-clock mr-1"></i>Verification Queue</a></li>
                                <li class="nav-item"><a class="btn-sm nav-link" data-toggle="pill" href="#failed"><i class="fas fa-times mr-1"></i>SKl Failed</a></li>
                                <li class="nav-item"><a class="btn-sm nav-link" data-toggle="pill" href="#verified"><i class="fas fa-check mr-1"></i>SKl Issued (by submission)</a></li>
                                <li class="nav-item"><a class="btn-sm nav-link" data-toggle="pill" href="#backdate"><i class="fas fa-check mr-1"></i>SKl Issued (non submission)</a></li>
                            </ul>
                        </div>
                        <div class="tab-content py-3">
                            <div class="tab-pane fade active show" id="queue" role="tabpanel">
                                <div id="panel-1" class="panel">
                                    <div class="panel-container show">
                                        <div class="panel-content">
                                            <div class="table">
                                                <table id="queue_tbl" class="table table-sm table-bordered table-hover table-striped w-100">
                                                    <thead class="bg-warning-50">
                                                        <tr>
                                                            <th id="">No. Pengajuan</th>
                                                            <th id="">Nama Perusahaan</th>
                                                            <th id="">No. RIPH</th>
                                                            <th id="">Tanggal diajukan</th>
                                                            <th>Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>API No. Pengajuan</td>
                                                            <td>API Nama Perusahaan</td>
                                                            <td>API No. RIPH</td>
                                                            <td>API Time stamp pengajuan</td>
                                                            <td>API STATUS</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-900"><a href="#">No. Pengajuan</a></td>
                                                            <td>Nama Perusahaan</td>
                                                            <td>No. RIPH</td>
                                                            <td>31-03-2022</td>
                                                            <td class="text-center">
                                                                <a href="javascript:void(0);" class="badge btn-sm btn-warning">
                                                                    <i class="fa fa-clock mr-1"></i>
                                                                    Proccess
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="failed" role="tabpanel">
                                <div id="panel-2" class="panel">
                                    <div class="panel-container show">
                                        <div class="panel-content">
                                            <div class="table">
                                                <table id="failed_tbl" class="table table-sm table-bordered table-hover table-striped w-100">
                                                    <thead class="bg-warning-50">
                                                        <tr>
                                                            <th id="">No. Pengajuan</th>
                                                            <th id="">Nama Perusahaan</th>
                                                            <th id="">No. RIPH</th>
                                                            <th id="">Tanggal diajukan</th>
                                                            <th>Status</th>
                                                            <th>Hasil</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>API No. Pengajuan</td>
                                                            <td>API Nama Perusahaan</td>
                                                            <td>API No. RIPH</td>
                                                            <td>API Time stamp pengajuan</td>
                                                            <td>API STATUS</td>
                                                            <td>API Hasil</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-900"><a href="#">No. Pengajuan</a></td>
                                                            <td>Nama Perusahaan</td>
                                                            <td>No. RIPH</td>
                                                            <td>31-03-2022</td>
                                                            <td class="text-center">
                                                                <a href="javascript:void(0);" class="badge btn-sm btn-success">
                                                                    <i class="fa fa-check mr-1"></i>
                                                                    Perbaikan
                                                                </a>
                                                            </td>
                                                            <td class="text-center">
                                                                <a href="javascript:void(0);" class="badge btn-sm btn-danger">
                                                                    <i class="fas fa-times mr-1"></i>
                                                                    Failed
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="verified" role="tabpanel">
                                <div id="panel-3" class="panel">
                                    <div class="panel-container show">
                                        <div class="panel-content">
                                            <div class="table">
                                                <table id="verified_tbl" class="table table-sm table-bordered table-hover table-striped w-100">
                                                    <thead class="bg-warning-50">
                                                        <tr>
                                                            <th id="">No. Pengajuan</th>
                                                            <th id="">Nama Perusahaan</th>
                                                            <th id="">No. RIPH</th>
                                                            <th id="">Tanggal diajukan</th>
                                                            <th>Status</th>
                                                            <th>Hasil</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>API No. Pengajuan</td>
                                                            <td>API Nama Perusahaan</td>
                                                            <td>API No. RIPH</td>
                                                            <td>API Time stamp pengajuan</td>
                                                            <td>API STATUS</td>
                                                            <td>API Hasil</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-900"><a href="#">No. Pengajuan</a></td>
                                                            <td>Nama Perusahaan</td>
                                                            <td>No. RIPH</td>
                                                            <td>31-03-2022</td>
                                                            <td class="text-center">
                                                                <a href="javascript:void(0);" class="badge btn-sm btn-success">
                                                                    <i class="fa fa-check mr-1"></i>
                                                                    Lunas
                                                                </a>
                                                            </td>
                                                            <td class="text-center">
                                                                <a href="#" class="badge btn-sm btn-success">
                                                                    <i class="fas fa-award mr-1"></i>
                                                                    Issued
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="backdate" role="tabpanel">
                                <div id="panel-3" class="panel">
                                    <div class="panel-container show">
                                        <div class="panel-content">
                                            <div class="table">
                                                <table id="backdate_tbl" class="table table-sm table-bordered table-hover table-striped w-100">
                                                    <thead class="bg-warning-50">
                                                        <tr>
                                                            <th id="">No. RIPH</th>
                                                            <th id="">Nama Perusahaan</th>
                                                            <th id="">Tanggal diajukan</th>
                                                            <th>Status</th>
                                                            <th>Hasil</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>API No. RIPH</td>
                                                            <td>API Nama Perusahaan</td>
                                                            <td>API Time stamp date_created</td>
                                                            <td>API STATUS</td>
                                                            <td>API Hasil</td>
                                                        </tr>
                                                        <tr>
                                                            <td><a href="#" class="fw-900">No. RIPH</a></td>
                                                            <td>Nama Perusahaan</td>
                                                            <td>31-03-2022</td>
                                                            <td class="text-center">
                                                                <a href="javascript:void(0);" class="badge btn-sm btn-success">
                                                                    <i class="fa fa-check mr-1"></i>
                                                                    Lunas
                                                                </a>
                                                            </td>
                                                            <td class="text-center">
                                                                <a href="#" class="badge btn-sm btn-success">
                                                                    <i class="fas fa-award mr-1"></i>
                                                                    Issued
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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

</script>
@endsection
