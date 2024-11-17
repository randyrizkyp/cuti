@extends('pegawai.templates.main')
@section('css')
<style>
    .button {        
        color: white;
        padding: 35px 20px;
        text-align: center;
        text-decoration: none;
        font-size: 14px;
    }
</style>
@endsection

@section('content')

<div class="main-content app-content mt-0">
    <div class="side-app">
        <div class="main-container container-fluid mt-4">

            <div class="card">                                         
                <div class="card-body">                    
                   

                        <div class="col-md-12">
                            
                            <div class="card">
                                <div class="card-body">
                                    
                                    <div class="table-responsive">
                                        <table class="table border text-nowrap text-md-nowrap table-striped mb-0">
                                            <tbody>
                                                <tr>
                                                    <td style="font-weight: bold; width: 20%;">Nama Lengkap</td>
                                                    <td>: Ferdy Ramadhan, S.Kom.</td>
                                                </tr>
                                                <tr>
                                                    <td style="font-weight: bold; width: 20%;">NIP</td>
                                                    <td>: 19950202 202012 1 008</td>
                                                </tr>
                                                <tr>
                                                    <td style="font-weight: bold; width: 20%;">Pangkat</td>
                                                    <td>: Penata Muda, III.a</td>
                                                </tr>
                                                <tr>
                                                    <td style="font-weight: bold; width: 20%;">Jabatan</td>
                                                    <td>: Pengelola Teknologi Informasi</td>
                                                </tr>
                                                <tr>
                                                    <td style="font-weight: bold; width: 20%;">Unit Organisasi</td>
                                                    <td>: Dinas Komunikasi dan Informatika</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="panel panel-primary mt-4">
                                        <div class="tab-menu-heading">
                                            <div class="tabs-menu">                                                
                                                <ul class="nav panel-tabs panel-secondary" style="padding:0; margin:0;">
                                                    <li class="col-md-4 text-center"><a style="border: 1px solid #ddd;" href="#tab1" class="active" data-bs-toggle="tab">Riwayat Hukuman Disiplin</a></li>
                                                    {{-- <li class="col-md-4 text-center"><a style="border: 1px solid #ddd;" href="#tab2" data-bs-toggle="tab">Riwayat Sidak</a></li> --}}
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="panel-body tabs-menu-body" style="border: 1px solid #ddd;">
                                            <div class="tab-content">
                                                <div class="tab-pane active" id="tab1">
                                                    <div class="table-responsive">
                                                        <table class="table border text-nowrap text-md-nowrap table-striped mb-0">
                                                            <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Nomor Surat</th>
                                                                    <th>Tanggal Surat</th>
                                                                    <th>Deskripsi</th>
                                                                    <th>File Dokumen</th>                                                                    
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>1</td>
                                                                    <td>813.2.3/156/V/39-LU/2023</td>
                                                                    <td>20 Oktober 2023</td>
                                                                    <td>Hukuman Disiplin tentang</td>
                                                                    <td>-</td>
                                                                </tr>
                                                                
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="tab-pane" id="tab2">
                                                    <div class="table-responsive">
                                                        <table class="table border text-nowrap text-md-nowrap table-striped mb-0">
                                                            <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Tingkat Pendidikan</th>
                                                                    <th>Pendidikan</th>
                                                                    <th>Nama Sekolah/Universitas/Institut</th>                                                                    
                                                                    <th>Nomor Ijazah</th>
                                                                    <th>Tahun Lulus</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>1</td>
                                                                    <td>S-1/Sarjana</td>
                                                                    <td>S-1 Teknik Informatika</td>
                                                                    <td>Universitas Teknokrat Indonesia</td>
                                                                    <td>1220/G.11/V.a/2017</td>
                                                                    <td>2017</td>
                                                                </tr>                                                                
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="tab-pane" id="tab3">
                                                    <div class="table-responsive">
                                                        <table class="table border text-nowrap text-md-nowrap table-striped mb-0">
                                                            <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Jenis Jabatan</th>
                                                                    <th>Instansi</th>
                                                                    <th>Unit Organisasi</th>
                                                                    <th>Jabatan Fungsional</th>
                                                                    <th>TMT Jabatan</th>
                                                                    <th>Nomor SK</th>
                                                                    <th>Tanggal SK</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>1</td>
                                                                    <td>Jabatan Fungsional Umum</td>
                                                                    <td>Pemerintah Kab. Lampung Utara</td>
                                                                    <td>Infrastruktur dan Keamanan Teknologi Informasi dan Komunikasi - Dinas Komunikasi dan Informatika</td>
                                                                    <td>Pengelola Teknologi Informasi</td>
                                                                    <td>30/11/2020</td>
                                                                    <td>AG-21806000059</td>
                                                                    <td>30/11/2020</td>
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
</div>

@endsection