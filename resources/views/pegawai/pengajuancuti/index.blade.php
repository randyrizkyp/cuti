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
                                <label class="col-md-3 form-label">Nama</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" readonly value="{{Str::upper(Session::get('nama'))}}">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label class="col-md-3 form-label">NIP</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" readonly value="{{Str::upper(Session::get('nip'))}}">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label class="col-md-3 form-label">Unit Kerja</label>
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
                    <form class="form-group mt-5" action="/submitcuti" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row justify-content-between">
                            <div class="col-lg-6 col-sm-6"> 
                                <h4 class="text-primary"> <b>Data Cuti</b></h4>
                                <div class="form-group">
                                    <label class="form-label"><b>Jenis Cuti <sup class="text-red"> *</sup></b></label>
                                    <div class="input-group">
                                        <select name="jeniscuti" id="jeniscuti" class="form-control form-select" oninput="updateEndDate()" required oninvalid="this.setCustomValidity('Mohon Pilih Jenis Cuti')" oninput="setCustomValidity('')">
                                            <option value="" disabled selected>Jenis Cuti.....</option>
                                            <option value="1">Cuti Tahunan</option>
                                            <option value="2">Cuti Besar</option>
                                            <option value="3">Cuti Sakit</option>
                                            <option value="4">Cuti Melahirkan</option>
                                            <option value="5">Cuti Karena Alasan Penting</option>
                                            <option value="6">Cuti di luar Tanggungan Negara</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label"><b>Jumlah Hari <sup class="text-red"> *</sup></b></label>
                                    <div class="input-group">
                                        <input type="number" pattern="[0-9]*" id="hari" oninput="updateEndDate()" name="jmlhari" class="form-control" aria-describedby="basic-addon2" required oninvalid="this.setCustomValidity('Mohon Pilih Jumlah Hari')" oninput="setCustomValidity('')">
                                        <span class="input-group-text" id="basic-addon2">Hari</span>
                                    </div>
                                    <div id="error-message"></div>

                                </div>
                                <div class="form-group">
                                    <label class="form-label"><b>Tanggal Mulai Cuti <sup class="text-red"> *</sup></b></label>
                                    <div class="input-group">
                                        <input type="date" id="mulai_cuti" name="mulai" value="{{ Carbon::now()->format('d/m/Y') }}" oninput="updateEndDate()" class="form-control" required oninvalid="this.setCustomValidity('Mohon Pilih Tanggal Mulai Cuti')" oninput="setCustomValidity('')">
                                        <span class="input-group-text br-0">s.d</span>
                                        <input type="text" class="form-control" name="selesai" id="sampai" value="{{ Carbon::now()->format('d/m/Y') }}" aria-label="Server" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label"><b>Alasan Cuti</b></label>
                                    <div class="input-group">
                                        <textarea type="text" name="alasan" class="form-control" aria-describedby="basic-addon2" required oninvalid="this.setCustomValidity('Mohon isi Alasan Cuti')" oninput="setCustomValidity('')"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label"><b>Alamat Pada Saat Cuti</b></label>
                                    <div class="input-group">
                                        <textarea type="text" name="alamat" class="form-control" aria-describedby="basic-addon2" required oninvalid="this.setCustomValidity('Mohon isi Alamat Pada Saat Cuti')" oninput="setCustomValidity('')"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label"><b>Nomor Telepon <sup class="text-red"> *</sup></b></label>
                                    <div class="input-group">
                                        <input type="number" name="hp" class="form-control" aria-describedby="basic-addon2" required oninvalid="this.setCustomValidity('Mohon isi Nomor Telepon')" oninput="setCustomValidity('')">
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label class="form-label">Masa Kerja<sup class="text-red"> *</sup></b></label>
                                    <div class="input-group">
                                        <input type="text" name="masa_kerja" class="form-control" aria-describedby="basic-addon2" required oninvalid="this.setCustomValidity('Mohon isi Masa Kerja')" oninput="setCustomValidity('')">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6">
                                <h4 class="text-primary"> <b>Jabatan</b></h4>
                                <div class="form-group">
                                    <label class="form-label">Jabatan<sup class="text-red"> *</sup></b></label>
                                    <select class="form-control form-select" id="jabatan" name="jabatan" oninput="Pejabat()" style="width: 100%" require aria-describedby="basic-addon2" required oninvalid="this.setCustomValidity('Mohon Pilih Atasan Langsung')" oninput="setCustomValidity('')">
                                        <option value="" disabled selected>Pilih Jabatan..</option>
                                        @foreach($jabatan as $jab)
                                            <option value="{{$jab->kd_jab}}">{{$jab->nama_jab}}</option>
                                        @endforeach
                                    </select>
                                </div> 
                                <h4 class="text-primary"> <b>Atasan Langsung</b></h4>
                                <div class="form-group">
                                    <label class="form-label">Nama / NIP Atasan Langsung</label>
                                    <select class="select_drop" name="atasan" style="width: 100%" require aria-describedby="basic-addon2" required oninvalid="this.setCustomValidity('Mohon Pilih Atasan Langsung')" oninput="setCustomValidity('')">
                                        <option value="" disabled selected>Pilih Atasan Langsung..</option>
                                        @foreach($data_uker as $uker)
                                            <option value="{{$uker->nip}}">{{$uker->nama}} / {{$uker->nip}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <h4 class="text-primary"> <b>Pejabat Yang Berwenang</b></h4>
                                <div class="form-group">
                                    <label class="form-label">Nama / NIP Pejabat Yang Berwenang</label>
                                    <input type="hidden" name="pejabat" id="pejabat" class="form-control" aria-describedby="basic-addon2" readonly>
                                    <input type="text" name="nm_pejabat" id="nm_pejabat" class="form-control" aria-describedby="basic-addon2" readonly>
                                </div>
                                <h4 class="text-primary"> <b>Dokumen Cuti</b></h4>
                                    <h6>Syarat untuk menambahkan File Dokumen Pendukung Yaitu : </h6>
                                    <h6>
                                        <span><i class="fa-solid fa-circle-check text-success"></i></span> File Harus <b>.pdf</b> dengan ukuran <b>1024kb/1Mb</b> dan dokumen discan dalam <b>1 file</b>.
                                    </h6>
                                    <h6>
                                        <span><i class="fa-solid fa-circle-check text-success"></i></span> Contoh Dokumen yang diupload : <b>Surat Keterangan Dokter, Surat Pengantar</b>.
                                    </h6>
                                <div class="form-group mt-4">
                                    <label class="form-label"><b>Silahkan Upload Dokumen Cuti <sup class="text-red"> *</sup></b></label>
                                    <div class="input-group">
                                        <input type="file" name="dokumen" class="form-control" aria-describedby="basic-addon2">
                                    </div>
                                </div>
                                <div class="text-center pt-4">
                                    <button class="btn btn-lg btn-danger" type="submit" id="button-addon1" onclick="Refresh()" name="submit" value="draft"><i class="fa fa-save"></i> Cetak Form</button>
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
<script>
        $('#mulai_cuti').fcDatepicker({
            format: 'dd/mm/yyyy', // Mengatur format default ke DD/MM/YYYY
        });
     function Pejabat() {
        const jabatan = parseInt(document.getElementById("jabatan").value);
        const pejabat = document.getElementById("pejabat");
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
                startDate.setDate(startDate.getDate() + jumlahHari);
                let year = startDate.getFullYear();
                let month = ('0' + (startDate.getMonth() + 1)).slice(-2); // Bulan dimulai dari 0
                let day = ('0' + startDate.getDate()).slice(-2);
                let tanggalAkhir = `${day}/${month}/${year}`;
                document.getElementById('sampai').value = tanggalAkhir;
            }
            // Kirim data menggunakan fetch
            
        }
        
</script>
<script>
    function Refresh() {
         setTimeout(function() {
            location.reload(); // Fungsi untuk me-refresh halaman
        }, 2000);
    }
</script>
@endsection

