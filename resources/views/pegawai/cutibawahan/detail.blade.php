@extends('pegawai.templates.main')

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
                           <h4 class="card-title">Data Cuti Bawahan</h4>
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
                                       <th width="30%">Dokumen Cuti</th>
                                       <th width="2%">:</th>
                                       <td width="68%">@if($cuti->dokumen)<a class="btn btn-primary btn-sm" title="Lihat File" target="_blank" href="/{{ $cuti->dokumen }}"><i class="fa fa-file"></i> Lihat File</a>@endif</td>
                                    </tr>
                                 </table>                                                                                                

                              </div>
                           </div>

                           

                           <div class="form-footer mt-4 text-center">
                              <a href="/cutibawahan" class="btn btn-default">Kembali</a>
                              
                           </div>
                     </div>
                  </div>
               </div>
         </div>
      </div>
   </div>
</div>

<div class="modal fade" id="modaldemo8">
   <div class="modal-dialog modal-dialog-centered text-center" role="document">
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
            <input type="hidden" name="nip" value="{{ $cuti->nip }}">
            <div class="row col-md-12">
               <div class="col-md-3">
                  <label class="custom-control custom-radio">
                     <input type="radio" class="custom-control-input" id="validasi" onclick="terima()" name="validasi" value="terima" checked>
                     <span class="custom-control-label">Disetujui</span>
                  </label>
               </div>              
               <div class="col-md-2">
                  <label class="custom-control custom-radio">
                     <input type="radio" class="custom-control-input" id="validasi" onclick="tolak()" name="validasi" value="tolak">
                     <span class="custom-control-label">ditolak</span>
                  </label>              
               </div> 
            </div>

            <div class="form-group">               
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


@endsection

@push('script')

<script>

function tolak() {
   $('#keterangan').removeAttr("disabled");
}

function terima() {
   $('#keterangan').attr('disabled', 'disabled');
}

$(document).on('click', '#terima', function (e) {
   e.preventDefault();
   var id = $(this).attr('data-id-terima');
   var nip = $(this).attr('data-id-nip');   

   $.ajax({
      type: "POST",
      url: "/terimaberkas",
      data: {
         id: id,
         nip: nip
      },
      success: function(result) {
         location.reload();
      },
      error: function(result) {
         alert('error');
      }
   });
});

$(document).on('click', '#tolak', function (e) {
   e.preventDefault();
   var id = $(this).attr('data-id-tolak');
   var nip = $(this).attr('data-id-nip');   

   $.ajax({
      type: "POST",
      url: "/tolakberkas",
      data: {
         id: id,
         nip: nip
      },
      success: function(result) {
         location.reload();
      },
      error: function(result) {
         alert('error');
      }
   });
});

</script>

@endpush