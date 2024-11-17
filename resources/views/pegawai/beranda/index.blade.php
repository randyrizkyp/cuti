@extends('pegawai.templates.main')
@section('content')
<?php
use Carbon\Carbon;
Carbon::setLocale('id');
?>
<!--app-content open-->
<div class="main-content app-content mt-5">
    <div class="side-app">
        <!-- CONTAINER -->
        <div class="main-container container-fluid">                   
            <!-- Row -->
            <div class="row">
                <div class="col-lg-12 col-sm-6"> 
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title text-primary"><i class="fa-solid fa-circle-info text-primary"></i> Informasi Tentang Cuti Anda Pada Tahun {{$tahun_s}}</h3>
                        </div>
                        <div class="example  mt-5">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xl-12">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
                                        <div class="card overflow-hidden">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <div class="mt-2">
                                                        <h6 class="">Cuti Yang Disetujui</h6>
                                                        <h2 class="mb-0 number-font">{{$t_setujui}} Hari</h2>
                                                    </div>
                                                    <div class="ms-auto">
                                                        <div class="chart-wrapper mt-1">
                                                            <i class="fa-solid fa-file-circle-check fa-3x mt-2 text-success"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
                                        <div class="card overflow-hidden">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <div class="mt-2">
                                                        <h6 class="">Cuti Menunggu Persetujuan</h6>
                                                        <h2 class="mb-0 number-font">{{$t_pengajuan}} Berkas</h2>
                                                    </div>
                                                    <div class="ms-auto">
                                                        <div class="chart-wrapper mt-1">
                                                            <i class="fa-solid fa-file-circle-exclamation check fa-3x mt-2 text-warning"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
                                        <div class="card overflow-hidden">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <div class="mt-2">
                                                        <h6 class="">Cuti Ditolak</h6>
                                                        <h2 class="mb-0 number-font">{{$t_ditolak}} Hari</h2>
                                                    </div>
                                                    <div class="ms-auto">
                                                        <div class="chart-wrapper mt-1">
                                                            <i class="fa-solid fa-file-circle-xmark fa-3x mt-2 text-danger"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
                                        <div class="card overflow-hidden">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <div class="mt-2">
                                                        <h6 class="">Sisa Cuti Tahunan Anda</h6>
                                                        <h2 class="mb-0 number-font">{{$sisa_cuti}} Hari</h2>
                                                    </div>
                                                    <div class="ms-auto">
                                                        <div class="chart-wrapper mt-1">
                                                            <i class="fa-solid fa-calendar fa-3x mt-2 text-info"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                            <div class="example  mt-5">
                                <div class="text-center"><b>Riwayat Pengajuan Cuti</b></div>
                                <div class="table-responsive">
                                    <div id="basic-datatable_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                                        <table class="table table-bordered text-nowrap border-bottom dataTable no-footer" id="basic-datatable" role="grid" aria-describedby="basic-datatable_info">
                                            <thead>
                                                <tr role="row">
                                                    <th style="width: 5%">No.</th>
                                                    <th style="width: 15%">Tanggal Pengajuan</th>
                                                    <th style="width: 15%">Jenis Cuti</th>                                                    
                                                    <th style="width: 15%">Tanggal Cuti</th>
                                                    <th style="width: 25%">Catatan</th>
                                                    <th style="width: 15%">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($cuti as $ct)
                                                <tr>
                                                    <td class="sorting_1">{{$loop->iteration}}</td>
                                                    <td class="text-center">{{($ct->created_at)->format('d/m/Y')}}</td>
                                                    <td>
                                                        @if($ct->jeniscuti == 1)
                                                            Cuti Tahunan <span class="badge bg-info">{{$ct->jmlhari}} Hari</span>
                                                        @elseif ($ct->jeniscuti == 2)
                                                            Cuti Besar <span class="badge bg-info">{{$ct->jmlhari}} Hari</span>
                                                        @elseif ($ct->jeniscuti == 3)
                                                            Cuti Sakit <span class="badge bg-info">{{$ct->jmlhari}} Hari</span>
                                                        @elseif ($ct->jeniscuti == 4)
                                                            Cuti Melahirkan <span class="badge bg-info">{{$ct->jmlhari}} Hari</span>
                                                        @elseif ($ct->jeniscuti == 5)
                                                            Cuti Karena Alasan Penting <span class="badge bg-info">{{$ct->jmlhari}} Hari</span>
                                                        @else
                                                            Cuti di luar Tanggungan Negara <span class="badge bg-info">{{$ct->jmlhari}} Hari</span>
                                                        @endif
                                                    </td>                                                    
                                                    <td class="text-center"> {{$ct->tglmulai}} </td>
                                                    <td class="text-center"> {{$ct->catatan}} </td>
                                                    <td class="text-center">
                                                        @if($ct->status == 'draft')
                                                            <button type="button" class="btn btn-warning"  data-bs-toggle="modal" data-bs-target="#detail{{$ct->id_cuti}}"><i class="fa-solid fa-circle-info"></i> Draft</button>
                                                        @elseif($ct->status == 'pengajuan' || $ct->status == 'penandatanganan')
                                                            <button type="button" class="btn btn-info"  data-bs-toggle="modal" data-bs-target="#detail{{$ct->id_cuti}}"><i class="fa-solid fa-circle-info"></i> Pengajuan</button>
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
            </div>        
        </div>
    </div>
</div>
<!--app-content closed-->
@foreach($cuti as $ct)
<div class="modal fade" id="detail{{$ct->id_cuti}}">
    <div class="modal-dialog modal-dialog-centered text-center modal-lg" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title"><b>Detail Pengajuan</b></h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <table>
                    <tr>
                        <td class="text-start" style="width: 30%"><strong>Nama</strong></td>
                        <td style="width: 10%">:</td>
                        <td class="text-start" style="width: 60%">{{session('nama')}}</td>
                    </tr>
                    <tr>
                        <td class="text-start"><strong>NIP</strong></td>
                        <td>:</td>
                        <td class="text-start"> {{session('nip')}} </td>
                    </tr>
                    <tr>
                        <td class="text-start"><strong>Cuti Yang Diambil</strong></td>
                        <td>:</td>
                        <td class="text-start"> 
                            @if($ct->jeniscuti == 1)
                                Cuti Tahunan
                            @elseif ($ct->jeniscuti == 2)
                                Cuti Besar
                            @elseif ($ct->jeniscuti == 3)
                                Cuti Sakit
                            @elseif ($ct->jeniscuti == 4)
                                Cuti Melahirkan
                            @elseif ($ct->jeniscuti == 5)
                                Cuti Karena Alasan Penting
                            @else
                                Cuti di luar Tanggungan Negara
                            @endif 
                        </td>
                    </tr>
                    <tr>
                        <td class="text-start"><strong>Lama Cuti</strong></td>
                        <td>:</td>
                        <td class="text-start"> {{$ct->jmlhari}} Hari</td>
                    </tr>
                    <tr>
                        <td class="text-start"><strong>Tanggal Cuti</strong></td>
                        <td>:</td>
                        <td class="text-start"> <b>{{Carbon::createFromFormat('d/m/Y', $ct->tglmulai)->translatedFormat('d F Y')}}</b> s.d <b>{{Carbon::createFromFormat('d/m/Y', $ct->tglselesai)->translatedFormat('d F Y')}}</b></td>
                    </tr>
                    <tr>
                        <td class="text-start"><strong>Alasan Cuti</strong></td>
                        <td>:</td>
                        <td class="text-start"> {{$ct->alasancuti}}</td>
                    </tr>
                    <tr>
                        <td class="text-start"><strong>Alamat Selama Cuti</strong></td>
                        <td>:</td>
                        <td class="text-start"> {{$ct->alamatcuti}}</td>
                    </tr>
                    <tr>
                        <td class="text-start"><strong>Telepon</strong></td>
                        <td>:</td>
                        <td class="text-start"> {{$ct->telepon}}</td>
                    </tr>
                    <tr>
                        <td class="text-start"><strong>Atasan Langsung yang Menyetujui</strong></td>
                        <td>:</td>
                        <td class="text-start">
                            @foreach ($data_uker as $uk)
                                @if ($uk->nip == $ct->atasannip)
                                {{$uk->nama}} / {{$ct->atasannip}}
                                @endif
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <td class="text-start"><strong>PyB Memberikan Cuti</strong></td>
                        <td>:</td>
                        <td class="text-start">
                            @if($ct->pejabatnip == '3')
                                {{$pyb[2]->namapyb}}
                            @else
                                @foreach ($pyb as $pb)
                                    @if($ct->pejabatnip == $pb->kd)
                                        {{$pb->namapyb}} / {{$pb->nip}}
                                    @endif
                                @endforeach
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="text-start"><strong>Status Cuti</strong></td>
                        <td>:</td>
                        <td class="text-start">{{$ct->status}}</td>
                    </tr>
                    <tr>
                        <td class="text-start"><strong>Nomor Surat </strong></td>
                        <td>:</td>
                        <td class="text-start">{{$ct->no_surat}}</td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection