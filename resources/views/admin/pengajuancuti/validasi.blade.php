@extends('admin.templates.main')

@section('css')
<style>
   th, td {
      padding-top: 5px;
      padding-bottom: 5px;            
   }
</style>
@endsection

@section('content')

<div class="main-content app-content mt-5">
   <div class="side-app">
      <div class="main-container container-fluid">        
         
         <div class="row">
            <div class="col-md-12">
               <div class="card">
                  <div class="card-header">
                        <h4 class="card-title">Validasi Cuti</h4>
                  </div>
                  <div class="card-body">
                        
                        <div class="row">
                           <div class="col-md-6">

                              <table width="100%">
                                 <tr>
                                    <th width="30%">Tanggal Pengajuan</th>
                                    <th width="2%">:</th>
                                    <td width="68%">{{ date('d M Y', strtotime($cuti->tanggal)) }}</td>
                                 </tr>                                                                  
                                 <tr>
                                    <th width="30%">Nama Lengkap</th>
                                    <th width="2%">:</th>
                                    <td width="68%">{{ $cuti->nama }}</td>
                                 </tr>
                                 <tr>
                                    <th width="30%">NIP</th>
                                    <th width="2%">:</th>
                                    <td width="68%">{{ $cuti->nip }}</td>
                                 </tr>
                                 <tr>
                                    <th width="30%">Pangkat/Gol.Ruang/TMT</th>
                                    <th width="2%">:</th>
                                    <td width="68%">{{ $cuti->pangkat }}</td>
                                 </tr>
                                 <tr>
                                    <th width="30%">Unit Kerja</th>
                                    <th width="2%">:</th>
                                    <td width="68%">{{ $cuti->unker }}</td>
                                 </tr>
                                 <tr>
                                    <th width="30%">Unit Organisasi</th>
                                    <th width="2%">:</th>
                                    <td width="68%">{{ $cuti->unor }}</td>
                                 </tr>
                                 <tr>
                                    <th width="30%">Status</th>
                                    <th width="2%">:</th>
                                    <td width="68%">{{ $cuti->status }}</td>
                                 </tr>
                              </table>
                           </div>

                           <div class="col-md-6">       

                              <table width="100%">
                                 <tr>
                                    <th width="30%">Jenis Cuti</th>
                                    <th width="2%">:</th>
                                    <td width="68%">
                                       @if ($cuti->jeniscuti == 1)
                                       Cuti Tahunan
                                       @elseif($cuti->jeniscuti == 2)
                                       Cuti Besar
                                       @elseif($cuti->jeniscuti == 3)
                                       Cuti Sakit
                                       @elseif($cuti->jeniscuti == 4)
                                       Cuti Melahirkan
                                       @elseif($cuti->jeniscuti == 5)
                                       Cuti Karena Alasan Penting
                                       @elseif($cuti->jeniscuti == 6)
                                       Cuti di luar Tanggungan Negara
                                       @endif
                                    </td>
                                 </tr>                                                                  
                                 <tr>
                                    <th width="30%">Jumlah Hari</th>
                                    <th width="2%">:</th>
                                    <td width="68%">{{ $cuti->jmlhari }} Hari</td>
                                 </tr>
                                 <tr>
                                    <th width="30%">Tanggal Mulai</th>
                                    <th width="2%">:</th>
                                    <td width="68%">{{ $cuti->tglmulai }}</td>
                                 </tr>
                                 <tr>
                                    <th width="30%">Tanggal Selesai</th>
                                    <th width="2%">:</th>
                                    <td width="68%">{{ $cuti->tglselesai }}</td>
                                 </tr>
                                 <tr>
                                    <th width="30%">Alasan Cuti</th>
                                    <th width="2%">:</th>
                                    <td width="68%">{{ $cuti->alasancuti }}</td>
                                 </tr>
                                 <tr>
                                    <th width="30%">Alamat Cuti</th>
                                    <th width="2%">:</th>
                                    <td width="68%">{{ $cuti->alamatcuti }}</td>
                                 </tr>
                                 <tr>
                                    <th width="30%">Dokumen Permohonan</th>
                                    <th width="2%">:</th>
                                    <td width="68%">@if($cuti->dokumen)<a class="btn btn-primary btn-sm" title="Lihat File" target="_blank" href="/{{ $cuti->dokumen }}"><i class="fa fa-file"></i> Lihat File</a>@endif</td>
                                 </tr>
                              </table>                                                                                                

                           </div>
                        </div>
                        
                        <div class="form-footer mt-4 offset-5">
                           <a href="/viewpengajuan" class="btn btn-default">Kembali</a>
                           <a class="modal-effect btn btn-success" data-bs-toggle="modal" href="#modalproses">Proses</a>
                           <a class="modal-effect btn btn-primary" data-bs-effect="effect-flip-horizontal" data-bs-toggle="modal" href="#modaldemo8">Submit</a>
                        </div>
                  </div>
               </div>
            </div>
            
            <div class="col-md-12">
               <div class="card">
                  <div class="card-header">
                     <h4 class="card-title">Riwayat Cuti</h4>
                  </div>
                  <div class="card-body">
                     <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="basic-datatable">
                           <thead>
                                 <tr>
                                    <td width="10px">No</td>                                          
                                    <td>Cuti</td>
                                    <td>File</td>
                                    <td>Status</td>
                                    <td>Atasan Langsung</td>
                                    <td>PYBMC</td>                                                                              
                                 </tr>
                           </thead>
                           <tbody>
                                 @foreach($riwayat as $dt)
                                 <tr>
                                    <td>{{ $loop->iteration }}</td>                                                                                   
                                    <td>
                                       @if ($dt->jeniscuti == 1)                                             
                                       Cuti Tahunan <span class="badge bg-info">{{ $dt->jmlhari }} Hari</span>
                                       <br>
                                       {{ $dt->nama }}
                                       <br>
                                       {{ $dt->nip }}
                                       @elseif($dt->jeniscuti == 2)
                                       Cuti Besar <span class="badge bg-info">{{ $dt->jmlhari }} Hari</span>
                                       <br>
                                       {{ $dt->nama }}
                                       <br>
                                       {{ $dt->nip }}
                                       @elseif($dt->jeniscuti == 3)
                                       Cuti Sakit <span class="badge bg-info">{{ $dt->jmlhari }} Hari</span>
                                       <br>
                                       {{ $dt->nama }}
                                       <br>
                                       {{ $dt->nip }}
                                       @elseif($dt->jeniscuti == 4)
                                       Cuti Melahirkan <span class="badge bg-info">{{ $dt->jmlhari }} Hari</span>
                                       <br>
                                       {{ $dt->nama }}
                                       <br>
                                       {{ $dt->nip }}
                                       @elseif($dt->jeniscuti == 5)
                                       Cuti Karena Alasan Penting <span class="badge bg-info">{{ $dt->jmlhari }} Hari</span>
                                       <br>
                                       {{ $dt->nama }}
                                       <br>
                                       {{ $dt->nip }}
                                       @elseif($dt->jeniscuti == 6)
                                       Cuti di luar Tanggungan Negara <span class="badge bg-info">{{ $dt->jmlhari }} Hari</span>
                                       <br>
                                       {{ $dt->nama }}
                                       <br>
                                       {{ $dt->nip }}
                                       @endif
                                    </td>
                                    <td>@if($dt->dokumen)<a class="btn btn-primary btn-sm" title="Lihat File" target="_blank" href="/{{ $dt->dokumen }}"><i class="fa fa-file"></i> Lihat File</a>@endif</td>
                                    <td><span class="badge bg-success-transparent rounded-pill text-success p-2 px-3">{{ $dt->status }}</span></td>
                                    <td>{{$dt->namaatasan}}</td>
                                    <td>
                                       @foreach($pyb as $py)
                                          @if ($py->kd == $dt->pejabatnip)
                                             {{$py->namapyb}}
                                          @endif
                                       @endforeach
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

<div class="modal fade" id="modaldemo8">
   <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content modal-content-demo">
         <div class="modal-header">
               <h6 class="modal-title">Validasi Pengajuan Cuti</h6>
               <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
               </button>
         </div>
         <form class="form-horizontal" action="/validasicuti" method="POST" enctype="multipart/form-data">
         @csrf
         <div class="modal-body">                     
         <div class="col-md-12">
            <input type="hidden" name="id_cuti" value="{{ $cuti->id_cuti }}">
            <input type="hidden" name="nip" value="{{ $cuti->nip }}">
            <div class="row col-md-12">

               <div class="row mb-5">
                  <label class="col-md-2 form-label">Nama PYBMC</label>
                  <div class="col-md-10">
                     <input type="text" class="form-control" value="{{ $cuti->namapyb }}" readonly>
                  </div>
               </div>

               <div class="col-md-3">
                  <label class="custom-control custom-radio">
                     <input type="radio" class="custom-control-input" id="validasi" onclick="terima()" name="validasi" value="terima" checked>
                     <span class="custom-control-label">Disetujui</span>
                  </label>
               </div>
               <div class="col-md-3">
                  <label class="custom-control custom-radio">
                     <input type="radio" class="custom-control-input" id="validasi" onclick="tolak()" name="validasi" value="perubahan">
                     <span class="custom-control-label">Perubahan</span>
                  </label>
               </div>              
               <div class="col-md-3">
                  <label class="custom-control custom-radio">
                     <input type="radio" class="custom-control-input" id="validasi" onclick="tolak()" name="validasi" value="ditangguhkan">
                     <span class="custom-control-label">Ditangguhkan</span>
                  </label>
               </div>
               <div class="col-md-3">
                  <label class="custom-control custom-radio">
                     <input type="radio" class="custom-control-input" id="validasi" onclick="tolak()" name="validasi" value="tidakdisetujui">
                     <span class="custom-control-label">Tidak Disetujui</span>
                  </label>              
               </div>                              

            </div>

            <div class="row mt-4" id="divdokumen">               
               <label for="dokumencuti" class="col-sm-2 col-form-label">Dokumen Cuti</label>
               <div class="col-sm-10">
                  <input type="file" class="form-control" id="dokumencuti" name="dokumencuti" required oninvalid="this.setCustomValidity('Mohon pilih Dokumen Cuti')" oninput="setCustomValidity('')">
               </div>               
            </div>
            <div class="row mt-4" id="divnosurat">               
               <label for="dokumencuti" class="col-sm-2 col-form-label">Nomor Surat</label>
               <div class="col-sm-10">
                  <input type="text" class="form-control" id="no_surat" name="no_surat" required oninvalid="this.setCustomValidity('Mohon Isi Nomor Surat Cuti')" oninput="setCustomValidity('')">
               </div>               
            </div>

            <div class="form-group mt-4">               
               <textarea class="form-control" id="keterangan" name="keterangan" placeholder="Silahkan isi Catatan untuk Pemohon Cuti" rows="4" disabled></textarea>
            </div>
         </div>

         </div>
         <div class="modal-footer">               
         <button class="btn ripple btn-danger" data-bs-dismiss="modal" type="button">Batal</button>
         <button type="submit" class="btn btn-primary">Submit</button>
         </div>
      </form>
      </div>
   </div>
</div>

<div class="modal fade" id="modalproses">
   <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content modal-content-demo">
         <div class="modal-header">
               <h6 class="modal-title">Proses Pengajuan Cuti</h6>
               <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
               </button>
         </div>
         <form class="form-horizontal" action="/prosescuti" method="POST" enctype="multipart/form-data">
         @csrf
         <div class="modal-body">                     
         <div class="col-md-12">
            <input type="hidden" name="id_cuti" value="{{ $cuti->id_cuti }}">
            <div class="row col-md-12">
               <div class="row mb-4">
                  <label class="col-md-4 form-label">Nama Admin</label>
                  <div class="col-md-8">
                     <input type="text" class="form-control" value="{{ Session::get('nama') }}" readonly>
                  </div>
               </div>
               <div class="row mb-5">
                  <label class="col-md-4 form-label">Status Pengajuan</label>
                  <div class="col-md-8">
                     <div class="form-check"> 
                        <input class="form-check-input" type="radio" name="status" value="diterima" id="Radio-sm"> 
                        <label class="form-check-label" for="Radio-sm"> Diterima </label>
                      </div>
                     <div class="form-check"> 
                        <input class="form-check-input" type="radio" name="status" value="ditolak" id="Radio-sm"> 
                        <label class="form-check-label" for="Radio-sm"> Ditolak </label> 
                     </div>
                  </div>
               </div>                                       
            </div>            

            <div class="form-group">               
               <textarea class="form-control" id="keterangantolak" name="keterangantolak" placeholder="Silahkan isi Catatan Penolakan Cuti" rows="4"></textarea>
            </div>
         </div>

         </div>
         <div class="modal-footer">                  
            <button class="btn ripple btn-default" data-bs-dismiss="modal" type="button">Batal</button>
            <button type="submit" class="btn btn-success">Simpan</button>            
         </div>
      </form>
      </div>
   </div>
</div>


@endsection

@push('script')

<script>

function tolak() {
   $('#keterangan').removeAttr("disabled");
   $('#dokumencuti').attr('disabled', 'disabled');
   $('#divdokumen').attr('hidden', 'hidden');
   $('#divnosurat').attr('hidden', 'hidden');
}

function terima() {
   $('#keterangan').attr('disabled', 'disabled');
   $('#dokumencuti').removeAttr("disabled");
   $('#divdokumen').removeAttr("hidden");
   $('#divnosurat').removeAttr("hidden");
}



</script>

@endpush