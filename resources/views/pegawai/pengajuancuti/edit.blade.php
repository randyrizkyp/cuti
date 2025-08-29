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
<?php use Carbon\Carbon;
?>
@section('content')

<div class="main-content app-content mt-0">
    <div class="side-app">
        <div class="main-container container-fluid mt-4">
            <div class="card">                                         
                <div class="card-body">                    
                    <h4 class="text-primary"> <b>Data Pengusul</b></h4>
                    <div class="row">
                        <div class="col-xl-6 col-lg-12">
                            <div class="row mb-4">
                                <label class="col-md-2 form-label">Nama</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" readonly value="{{Str::upper(Session::get('nama'))}}">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label class="col-md-2 form-label">NIP</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" readonly value="{{Str::upper(Session::get('nip'))}}">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label class="col-md-2 form-label">Unit Kerja</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" readonly value="{{Str::upper(Session::get('unker'))}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-5">
                            <div class="row mb-4 pe-10">
                                <label class="col-md-4 form-label">Tanggal Pengajuan</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" readonly value="{{ date('d M Y, H:i') }}">
                                </div>
                            </div>
                            <div class="row mb-4 pe-10">
                                <label class="col-md-4 form-label">Sisa Cuti Anda</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" readonly="" value="{{$sisa_cuti}} Hari">
                                </div>
                            </div>
                        </div>
                    </div>                    
                    
                    <form class="form-group mt-5" action="/updatecuti" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row justify-content-between">
                            <div class="col-lg-6 col-sm-6"> 
                                <h4 class="text-primary"> <b>Data Cuti</b></h4>
                                <div class="form-group">
                                    <label class="form-label"><b>Jenis Cuti <sup class="text-red"> *</sup></b></label>
                                    <div class="input-group">
                                        <select name="jeniscuti" id="jeniscuti" onchange="showJenis(this)" oninput="updateEndDate()" class="form-control form-select" required oninvalid="this.setCustomValidity('Mohon Pilih Jenis Cuti')" oninput="setCustomValidity('')">
                                            <option value="" disabled selected>Jenis Cuti.....</option>
                                            <option value="1" {{$draft->jeniscuti == 1 ? 'selected' : ''}}>Cuti Tahunan</option>
                                            <option value="2" {{$draft->jeniscuti == 2 ? 'selected' : ''}}>Cuti Besar</option>
                                            <option value="3" {{$draft->jeniscuti == 3 ? 'selected' : ''}}>Cuti Sakit</option>
                                            <option value="4" {{$draft->jeniscuti == 4 ? 'selected' : ''}}>Cuti Melahirkan</option>
                                            <option value="5" {{$draft->jeniscuti == 5 ? 'selected' : ''}}>Cuti Karena Alasan Penting</option>
                                            <option value="6" {{$draft->jeniscuti == 6 ? 'selected' : ''}}>Cuti di luar Tanggungan Negara</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label"><b>Jumlah Hari <sup class="text-red"> *</sup></b></label>
                                    <div class="input-group">
                                        <input type="number" min="1" pattern="[0-9]*" id="hari" oninput="updateEndDate()" name="jmlhari" class="form-control" aria-describedby="basic-addon2" value="{{ $draft->jmlhari }}" required oninvalid="this.setCustomValidity('Mohon Pilih Jumlah Hari')" oninput="setCustomValidity('')">
                                        <span class="input-group-text" id="basic-addon2">Hari</span>
                                    </div>
                                    <div id="error-message"></div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label"><b>Tanggal Mulai Cuti <sup class="text-red"> *</sup></b></label>
                                    <div class="input-group">
                                        <input type="date" id="mulai_cuti" name="mulai" value="{{ $tgl_mulai }}" oninput="updateEndDate()" class="form-control" required oninvalid="this.setCustomValidity('Mohon Pilih Tanggal Mulai Cuti')" oninput="setCustomValidity('')">
                                        <span class="input-group-text br-0">s.d</span>
                                        <input type="text" class="form-control" name="selesai" value="{{ $draft->tglselesai }}" id="sampai" aria-label="Server" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label"><b>Alasan Cuti</b></label>
                                    <div class="input-group">
                                        <textarea type="text" name="alasan" class="form-control" aria-describedby="basic-addon2" required oninvalid="this.setCustomValidity('Mohon isi Alasan Cuti')" oninput="setCustomValidity('')">{{ $draft->alasancuti }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label"><b>Alamat Pada Saat Cuti</b></label>
                                    <div class="input-group">
                                        <textarea type="text" name="alamat" class="form-control" aria-describedby="basic-addon2" required oninvalid="this.setCustomValidity('Mohon isi Alamat Pada Saat Cuti')" oninput="setCustomValidity('')">{{ $draft->alamatcuti }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label"><b>Nomor Telepon <sup class="text-red"> *</sup></b></label>
                                    <div class="input-group">
                                        <input type="number" name="hp" class="form-control" aria-describedby="basic-addon2" required oninvalid="this.setCustomValidity('Mohon isi Nomor Telepon')" value="{{$draft->telepon}}" oninput="setCustomValidity('')">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Masa Kerja<sup class="text-red"> *</sup></b></label>
                                    <div class="input-group">
                                        <input type="text" name="masa_kerja" value="{{ $draft->masa_kerja }}" class="form-control" aria-describedby="basic-addon2" required oninvalid="this.setCustomValidity('Mohon isi Masa Kerja')" oninput="setCustomValidity('')">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6">
                                <h4 class="text-primary"> <b>Jabatan</b></h4>
                                <div class="form-group">
                                    <label class="form-label">Jabatan<sup class="text-red"> *</sup></b></label>
                                    <select class="form-control form-select" id="jabatan" onchange="showKepala(this)" name="jabatan" oninput="Pejabat()" style="width: 100%" require aria-describedby="basic-addon2" required oninvalid="this.setCustomValidity('Mohon Pilih Atasan Langsung')" oninput="setCustomValidity('')">
                                        <option value="" disabled selected>Pilih Jabatan..</option>
                                        @foreach($jabatan as $jab)
                                            <option value="{{$jab->kd_jab}}" {{$jab->kd_jab == $draft->jabatan ? 'selected' : ''}}>{{$jab->nama_jab}}</option>
                                        @endforeach
                                    </select>
                                </div> 
                                <div id="divatasan" style="display:none;">
                                    <h4 class="text-primary"> <b>Atasan Langsung</b></h4>
                                    <div class="form-group">
                                        <label class="form-label">Nama / NIP Atasan Langsung</label>
                                        <select id="attratasan" class="select_drop" style="width: 100%" require aria-describedby="basic-addon2" oninvalid="this.setCustomValidity('Mohon Pilih Atasan Langsung')" oninput="setCustomValidity('')">
                                            <option value="" disabled selected>Pilih Atasan Langsung..</option>
                                            <option value="1" {{$atasannip == 1 ? 'selected' : ''}}>Lewati..</option>
                                            <!-- @foreach($data_uker as $uker)
                                                @if ($draft->atasannip == 1)
                                                    <option value="1" selected {{$draft->atasannip == 1 ? 'selected' : ''}} >Lewati..</option>
                                                @endif
                                            @endforeach -->
                                            @foreach($data_uker as $uker)
                                                <option value="{{$uker->nip}}" {{$uker->nip == $draft->atasannip ? 'selected' : ''}}>{{$uker->nama}} / {{$uker->nip}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div id="divsekda" style="display:none;">
                                    <h4 class="text-primary"> <b>Atasan Langsung</b></h4>
                                    <div class="form-group">
                                        <label class="form-label">Nama / NIP Kepala Perangkat Daerah</label>
                                        @foreach($pyb as $pb)
                                            @if($pb->kd == 2)
                                                @if($pb->pyb_nip == Session::get('nip'))
                                                    <input value="{{$pyb[0]->namapyb}}" readonly class='form-control'>
                                                @else
                                                    <input value="{{$pb->namapyb}}" readonly class='form-control'>
                                                @endif
                                                    <input id="attSekda" value="{{$pb->pyb_nip}}" type="hidden">
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                <div id="divkepala" style="display:none;">
                                    <h4 class="text-primary"> <b>Kepala Perangkat Daerah</b></h4>
                                    <div class="form-group">
                                        <label class="form-label">Nama / NIP Kepala Perangkat Daerah</label>
                                        <select class="select_drop" id="attrkepalaopd" name="kepalaopd" style="width: 100%" required aria-describedby="basic-addon2" oninvalid="this.setCustomValidity('Mohon Pilih Kepala OPD')" oninput="setCustomValidity('')">
                                            <option value="" disabled selected>Pilih Kepala Perangkat Daerah..</option>
                                            @foreach($data_uker as $uker)
                                                <option value="{{$uker->nip}}" {{$uker->nip == $draft->nipkepala ? 'selected' : ''}}>{{$uker->nama}} / {{$uker->nip}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                

                                <h4 class="text-primary"> <b>Pejabat Yang Berwenang</b></h4>
                                <div class="form-group">
                                    <label class="form-label">Nama / NIP Pejabat Yang Berwenang</label>                                   
                                    <input type="hidden" name="pejabat" id="pejabat" value="{{ $draft->pejabatnip }}" class="form-control" aria-describedby="basic-addon2" readonly>
                                    @foreach($pyb as $pb)
                                        @if ($draft->pejabatnip == $pb->kd)
                                            <input type="text" name="nm_pejabat" id="nm_pejabat" value="{{$pb->namapyb}}" class="form-control" aria-describedby="basic-addon2" readonly>
                                        @endif
                                    @endforeach
                                </div>
                                <div id="dokumenpersetujuan">
                                    <h4 class="text-primary"> <b>Persetujuan Atasan Langsung</b> <button class="btn btn-lg btn-danger btn-sm pull-right" style="font-size:11px;" type="submit" id="button-addon1" onclick="Refresh()" name="submit" value="draft"><i class="fa fa-save"></i> Cetak Form Persetujuan Atasan Langsung</button></h4>                                       
                                    <div class="form-group mt-4">
                                        <label class="form-label"><b>Silahkan Upload Dokumen Persetujuan Atasan Langsung <sup class="text-red"> *</sup></b></label>
                                        <div class="input-group">
                                            <input type="file" name="dokumen" class="form-control text-center" aria-describedby="basic-addon2"><span class="input-group-text"><a class="text-center text-white" data-bs-toggle="modal" data-bs-target="#contoh">Contoh !</a></span>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                
                                <div id="dokumenpendukung" style="display:none;">                                    
                                    <div id="syaratcutisakit" style="display:none;">
                                        <h4 class="text-primary"><b>Dokumen Pendukung Cuti Sakit</b></h4>
                                        <h6>Syarat untuk menambahkan File Dokumen Pendukung Yaitu : </h6>
                                        <h6>
                                            <span><i class="fa-solid fa-circle-check text-success"></i></span> File Harus <b>.pdf</b> dengan ukuran <b>1024kb/1Mb</b> dan dokumen discan dalam <b>1 file</b>.
                                        </h6>
                                        <h6>
                                            <span><i class="fa-solid fa-circle-check text-success"></i></span> Contoh Dokumen yang diupload : <b>Surat Keterangan Dokter, Surat Pengantar</b>.
                                        </h6>
                                    </div>
                                    <div id="syaratcutibesar" style="display:none;">
                                    <h4 class="text-primary"><b>Dokumen Pendukung Cuti Besar</b></h4>
                                        <h6>Syarat untuk menambahkan File Dokumen Pendukung Yaitu : </h6>
                                        <h6>
                                            <span><i class="fa-solid fa-circle-check text-success"></i></span> File Harus <b>.pdf</b> dengan ukuran <b>1024kb/1Mb</b> dan dokumen discan dalam <b>1 file</b>.
                                        </h6>                                          
                                        <h6>
                                            <span><i class="fa-solid fa-circle-check text-success"></i></span> Bukti setoran biaya penyelenggaraan ibadah haji (bagi PNS yang akan melaksanakan ibadah haji)</b>.
                                        </h6>
                                    </div>
                                    <div id="syaratcutimelahirkan" style="display:none;">
                                    <h4 class="text-primary"><b>Dokumen Pendukung Cuti Melahirkan</b></h4>
                                        <h6>Syarat untuk menambahkan File Dokumen Pendukung Yaitu : </h6>
                                        <h6>
                                            <span><i class="fa-solid fa-circle-check text-success"></i></span> File Harus <b>.pdf</b> dengan ukuran <b>1024kb/1Mb</b> dan dokumen discan dalam <b>1 file</b>.
                                        </h6>
                                        <h6>
                                            <span><i class="fa-solid fa-circle-check text-success"></i></span> Contoh Dokumen yang diupload : <b>Surat Keterangan Dokter, Bidan atau Rumah Sakit, Surat Pengantar</b>.
                                        </h6>
                                    </div>
                                    <div id="syaratalasanpenting" style="display:none;">                                            
                                        <h4 class="text-primary"><b>Dokumen Pendukung Cuti Alasan Penting</b></h4>
                                        <h6>Syarat untuk menambahkan File Dokumen Pendukung Yaitu : </h6>
                                        <h6>
                                            <span><i class="fa-solid fa-circle-check text-success"></i></span> File Harus <b>.pdf</b> dengan ukuran <b>1024kb/1Mb</b> dan dokumen discan dalam <b>1 file</b>.
                                        </h6>
                                        <h6>
                                            <span><i class="fa-solid fa-circle-check text-success"></i></span> Contoh Dokumen yang diupload : <b>Surat Keterangan atau diagnosis dokter, Surat Pengantar</b>.
                                        </h6>
                                    </div>
                                    <div id="syaratcltn" style="display:none;">                                            
                                        <h4 class="text-primary"><b>Dokumen Pendukung Cuti di Luar Tanggungan Negara</b></h4>                                                                                        
                                        <ul class="list-style-1" style="padding-left:12px; font-size:13px;">
                                            <li>Mengikuti atau mendampingi suami/ isteri tugas negara/tugas belajar di dalam/luar negeri<br>
                                            (melampirkan surat penugasan atau surat perintah tugas dari pejabat yang berwenang)</li>
                                            <li>Mendampingi suami/isteri bekerja di dalam/luar negeri<br>
                                            (melampirkan surat keputusan atau surat penugasan/pengangkatan dalam jabatan)</li>
                                            <li>Menjalani program untuk mendapatkan keturunan<br>
                                            (melampirkan surat keterangan dokter spesialis)</li>
                                            <li>Mendampingi anak yang berkebutuhan khusus<br>
                                            (melampirkan surat keterangan dokter spesialis)</li>                                                
                                            <li>Mendampingi suami/isteri/anak yang memerlukan perawatan khusus<br>
                                            (melampirkan surat keterangan dokter spesialis)</li>
                                            <li>Mendampingi, merawat orang tua/mertua yang sakit/uzur<br>
                                            (melampirkan surat keterangan dokter)</li>                                                
                                        </ul>                                                                                                                            
                                        <h6 class="mt-4">Syarat untuk menambahkan File Dokumen Pendukung Yaitu : </h6>
                                        <h6>
                                            <span><i class="fa-solid fa-circle-check text-success"></i></span> File Harus <b>.pdf</b> dengan ukuran <b>1024kb/1Mb</b> dan dokumen discan dalam <b>1 file</b>.
                                        </h6>        
                                    </div>
                                    <div class="form-group mt-4">
                                        <label class="form-label"><b>Silahkan Upload Dokumen Pendukung Cuti <sup class="text-red"> *</sup></b></label>
                                        <div class="input-group">
                                            <input type="file" name="dokumenpendukung" class="form-control" aria-describedby="basic-addon2">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="text-center pt-4">
                                    <input type="hidden" name="id" value="{{$draft->id_cuti}}">
                                    <input type="hidden" name="nip" value="{{$draft->nip}}">
                                    <input type="hidden" name="nama" value="{{Str::upper(Session::get('nama'))}}">
                                    <button class="btn btn-lg btn-primary" type="submit" id="button-addon2" name="submit" value="kirim"><i class="fa fa-arrow-circle-right"></i> Kirim Pengajuan</button>
                                </div>
                            </div>
                        </div>
                    </form>                    
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="contoh">
    <div class="modal-dialog modal-dialog-centered text-center modal-md" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Contoh Persetujuan Atasan Langsung</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <p>Dokumen diharapkan untuk di Scan Menggunakan Scanner, tidak diperknankan untuk di foto.</p>
            </div>
            <img src="storage/image/scanner.png">
            <div class="modal-footer">
                <button class="btn btn-light" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

function showKepala(select){
    const divAtasan = document.getElementById('divatasan');
    const divSekda = document.getElementById('divsekda');
    const attAtasan = document.getElementById('attratasan');
    const attSekda = document.getElementById('attSekda');
    const attKepalaopd = document.getElementById('attrkepalaopd');
    if(select.value!="1"){
        document.getElementById('divkepala').style.display = "";
        document.getElementById('divatasan').style.display = "";
        document.getElementById('divsekda').style.display = "none";
        attSekda.removeAttribute('required', 'required');
        attAtasan.setAttribute('required', 'required');
        attAtasan.setAttribute('name', 'atasan');
        attSekda.removeAttribute('name', 'atasan');

    }else{
        document.getElementById('divkepala').style.display = "none";
        document.getElementById('divatasan').style.display = "none";
        document.getElementById('divsekda').style.display = "";
        attAtasan.removeAttribute('required', 'required');
        attSekda.setAttribute('name', 'atasan');
        attAtasan.removeAttribute('name', 'atasan');
        attKepalaopd.removeAttribute('required', 'required');
    }
}

var jabatan = document.getElementById("jabatan");
if(jabatan.value!="1"){
    document.getElementById('divkepala').style.display = "";
    document.getElementById('divatasan').style.display = "";
    document.getElementById('divsekda').style.display = "none";
    document.getElementById('attSekda').removeAttribute('required', 'required');
    document.getElementById('attratasan').setAttribute('required', 'required');
    document.getElementById('attratasan').setAttribute('name', 'atasan');
    document.getElementById('attSekda').removeAttribute('name', 'atasan');

}else{
    document.getElementById('divkepala').style.display = "none";
    document.getElementById('divatasan').style.display = "none";
    document.getElementById('divsekda').style.display = "";
    document.getElementById('attratasan').removeAttribute('required', 'required');
    document.getElementById('attrkepalaopd').removeAttribute('required', 'required');
    document.getElementById('attSekda').setAttribute('name', 'atasan');
    document.getElementById('attratasan').removeAttribute('name', 'atasan');

}

var jeniscuti = document.getElementById("jeniscuti");
    if(jeniscuti.value=="1"){
        document.getElementById('dokumenpersetujuan').style.display = "";
        document.getElementById('dokumenpendukung').style.display = "none";
    }else if(jeniscuti.value=="2"){
        document.getElementById('dokumenpersetujuan').style.display = "";
        document.getElementById('dokumenpendukung').style.display = "";
        document.getElementById('syaratcutibesar').style.display = "";
        document.getElementById('syaratcutisakit').style.display = "none";
        document.getElementById('syaratcutimelahirkan').style.display = "none";
        document.getElementById('syaratalasanpenting').style.display = "none";
        document.getElementById('syaratcltn').style.display = "none";
    }else if(jeniscuti.value=="3"){
        document.getElementById('dokumenpersetujuan').style.display = "";
        document.getElementById('dokumenpendukung').style.display = "";
        document.getElementById('syaratcutisakit').style.display = "";
        document.getElementById('syaratcutibesar').style.display = "none";
        document.getElementById('syaratcutimelahirkan').style.display = "none";
        document.getElementById('syaratalasanpenting').style.display = "none";
        document.getElementById('syaratcltn').style.display = "none";
    }else if(jeniscuti.value=="4"){
        document.getElementById('dokumenpersetujuan').style.display = "";
        document.getElementById('dokumenpendukung').style.display = "";
        document.getElementById('syaratcutimelahirkan').style.display = "";
        document.getElementById('syaratcutisakit').style.display = "none";
        document.getElementById('syaratcutibesar').style.display = "none";        
        document.getElementById('syaratalasanpenting').style.display = "none";
        document.getElementById('syaratcltn').style.display = "none";
    }else if(jeniscuti.value=="5"){
        document.getElementById('dokumenpersetujuan').style.display = "";
        document.getElementById('dokumenpendukung').style.display = "";
        document.getElementById('syaratalasanpenting').style.display = "";
        document.getElementById('syaratcutimelahirkan').style.display = "none";
        document.getElementById('syaratcutisakit').style.display = "none";
        document.getElementById('syaratcutibesar').style.display = "none";                
        document.getElementById('syaratcltn').style.display = "none";
    }else if(jeniscuti.value=="6"){
        document.getElementById('dokumenpersetujuan').style.display = "";
        document.getElementById('dokumenpendukung').style.display = "";
        document.getElementById('syaratcltn').style.display = "";
        document.getElementById('syaratalasanpenting').style.display = "none";
        document.getElementById('syaratcutimelahirkan').style.display = "none";
        document.getElementById('syaratcutisakit').style.display = "none";
        document.getElementById('syaratcutibesar').style.display = "none";                        
    }

function showJenis(select){
    var jeniscuti = document.getElementById("jeniscuti");
    if(jeniscuti.value=="1"){
        document.getElementById('dokumenpersetujuan').style.display = "";
        document.getElementById('dokumenpendukung').style.display = "none";
    }else if(jeniscuti.value=="2"){
        document.getElementById('dokumenpersetujuan').style.display = "";
        document.getElementById('dokumenpendukung').style.display = "";
        document.getElementById('syaratcutibesar').style.display = "";
        document.getElementById('syaratcutisakit').style.display = "none";
        document.getElementById('syaratcutimelahirkan').style.display = "none";
        document.getElementById('syaratalasanpenting').style.display = "none";
        document.getElementById('syaratcltn').style.display = "none";
    }else if(jeniscuti.value=="3"){
        document.getElementById('dokumenpersetujuan').style.display = "";
        document.getElementById('dokumenpendukung').style.display = "";
        document.getElementById('syaratcutisakit').style.display = "";
        document.getElementById('syaratcutibesar').style.display = "none";
        document.getElementById('syaratcutimelahirkan').style.display = "none";
        document.getElementById('syaratalasanpenting').style.display = "none";
        document.getElementById('syaratcltn').style.display = "none";
    }else if(jeniscuti.value=="4"){
        document.getElementById('dokumenpersetujuan').style.display = "";
        document.getElementById('dokumenpendukung').style.display = "";
        document.getElementById('syaratcutimelahirkan').style.display = "";
        document.getElementById('syaratcutisakit').style.display = "none";
        document.getElementById('syaratcutibesar').style.display = "none";        
        document.getElementById('syaratalasanpenting').style.display = "none";
        document.getElementById('syaratcltn').style.display = "none";
    }else if(jeniscuti.value=="5"){
        document.getElementById('dokumenpersetujuan').style.display = "";
        document.getElementById('dokumenpendukung').style.display = "";
        document.getElementById('syaratalasanpenting').style.display = "";
        document.getElementById('syaratcutimelahirkan').style.display = "none";
        document.getElementById('syaratcutisakit').style.display = "none";
        document.getElementById('syaratcutibesar').style.display = "none";                
        document.getElementById('syaratcltn').style.display = "none";
    }else if(jeniscuti.value=="6"){
        document.getElementById('dokumenpersetujuan').style.display = "";
        document.getElementById('dokumenpendukung').style.display = "";
        document.getElementById('syaratcltn').style.display = "";
        document.getElementById('syaratalasanpenting').style.display = "none";
        document.getElementById('syaratcutimelahirkan').style.display = "none";
        document.getElementById('syaratcutisakit').style.display = "none";
        document.getElementById('syaratcutibesar').style.display = "none";                        
    }
}


</script>

<script>
    function Pejabat() {
        const jabatan = parseInt(document.getElementById("jabatan").value);
        const pejabat = document.getElementById("pejabat");
        const pejabat_nip = {{$draft->pejabatnip}};
        const nm_pejabat = document.getElementById("nm_pejabat");
        if (jabatan === 1){
            pejabat.value = '1';        
            nm_pejabat.value = 'Aswarodi';        
        }else if (jabatan === 2){
            pejabat.value = '2'
            nm_pejabat.value = 'Drs. Lekok M.M'
        }else if (jabatan === 3){
            pejabat.value = '3'
            nm_pejabat.value = 'Drs. Lekok M.M'
        }else {
            pejabat.value = '4'
            nm_pejabat.value = 'Martahan Samosir S.STP., M.PA'
        }

    }
    function updateEndDate() {
            // Ambil nilai dari input
        const jumlahHari = parseInt(document.getElementById("hari").value);
        const jeniscuti = document.getElementById("jeniscuti").value;
        const startDate = new Date(document.getElementById("mulai_cuti").value);
        const libur = @json($libur);

        // var numberInput = document.getElementById('hari');
        var errorMessage = document.getElementById('error-message');
        var maxNumber = "{{$sisa_cuti}}"; // Batas maksimum angka

        // Jika nilai melebihi batas maksimum
        if (jeniscuti == 1){
            if (jumlahHari > maxNumber) {
                errorMessage.textContent = "Melebihi Sisa Cuti Tahunan anda sejumlah " + maxNumber + " Hari";
                errorMessage.style.color = "red";
                document.getElementById("button-addon1").disabled = true;
                document.getElementById("button-addon2").disabled = true;
                // numberInput.value = maxNumber;
            } else {
                errorMessage.textContent = ""; // Bersihkan pesan error
                 document.getElementById("button-addon1").disabled = false;
                document.getElementById("button-addon2").disabled = false;
            }
             fetch('/proseslibur', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // Token CSRF untuk keamanan
                },
                body: JSON.stringify({ jumlahHari: jumlahHari, startDate: startDate, libur: libur }) // Mengonversi data menjadi JSON
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('sampai').value = data.tgl_akhir;
                } else {
                    alert('Terjadi kesalahan');
                }
            })
            .catch(error => {
                console.error('Error:', error); // Menangani error
            });
        }else 
            {
                errorMessage.textContent = ""; // Bersihkan pesan error
                 document.getElementById("button-addon1").disabled = false;
                document.getElementById("button-addon2").disabled = false;
                startDate.setDate(startDate.getDate() + (jumlahHari - 1));
                let year = startDate.getFullYear();
                let month = ('0' + (startDate.getMonth() + 1)).slice(-2); // Bulan dimulai dari 0
                let day = ('0' + startDate.getDate()).slice(-2);
                let tanggalAkhir = `${day}/${month}/${year}`;
                document.getElementById('sampai').value = tanggalAkhir;
            }
        
        
            // Kirim data menggunakan fetch
           
        }


          document.getElementById('cetakform').addEventListener('click', function () {
        // Set a timeout to refresh the page after download starts
        setTimeout(function () {
            location.reload(); // Refreshes the page
        }, 2000); // Adjust the timeout duration as needed
    });
</script>

@endsection

