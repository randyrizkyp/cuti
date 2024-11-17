@extends('admin.templates.main')
@section('content')
<!--app-content open-->
<div class="main-content app-content mt-5">
   <div class="side-app">        
      <div class="main-container container-fluid">                                    
         
         <div class="row row-sm">
               <div class="col-lg-12">

                  <div class="card">                     
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
                                          <td width="50px">Opsi</td>
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
                                          <td>
                                             @if($dt->status == 'disetujui')                                       
                                                <span class="badge bg-success-transparent rounded-pill text-success p-2 px-3">{{ $dt->status }}</span><br>                                                
                                             @elseif($dt->status == 'perubahan')
                                                <span class="badge bg-primary-transparent rounded-pill text-primary p-2 px-3">{{ $dt->status }}</span><br>
                                                <span style="font-size: 12px;">Catatan : {{ $dt->catatan }}</span>                                                
                                             @elseif($dt->status == 'ditangguhkan')
                                                <span class="badge bg-warning-transparent rounded-pill text-warning p-2 px-3">{{ $dt->status }}</span><br>
                                                <span style="font-size: 12px;">Catatan : {{ $dt->catatan }}</span>                                                
                                             @elseif($dt->status == 'ditolak')
                                                <span class="badge bg-danger-transparent rounded-pill text-danger p-2 px-3">{{ $dt->status }}</span><br>                                                
                                                <span style="font-size: 12px;">Catatan : {{ $dt->catatan }}</span>
                                             @endif
                                          </td>
                                          <td>{{$dt->namaatasan}}</td>
                                          <td>
                                             @foreach($pyb as $py)
                                                @if ($py->kd == $dt->pejabatnip)
                                                   {{$py->namapyb}}
                                                @endif
                                             @endforeach
                                          </td>
                                          <td class="text-center text-nowrap">
                                             <a class="btn btn-success btn-sm" href="/detailriwayat/{{ $dt->nip }}"><i class="fa fa-search"></i> Detail</a>                                                                                          
                                          </td>
                                       </tr>                                                
                                                                              
                                       <div class="modal fade" id="cetakSK{{ $dt->nip }}">
                                          <div class="modal-dialog modal-lg" role="document">
                                             <div class="modal-content modal-content-demo">
                                                <div class="modal-header">
                                                      <h6 class="modal-title">Cetak SK Pensiun</h6>
                                                      <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                         <span aria-hidden="true">×</span>
                                                      </button>
                                                </div>
                                                <form class="form-horizontal form-bordered" action="/cetaksk" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-body">      
                                                   <input type="hidden" name="nip" value="{{ $dt->nip }}">
                                                   <div class="row">
                                                      <div class="col-md-6">
                                                         <div class="form-group">
                                                            <label>Nomor SK</label>
                                                            <input type="text" name="no_sk" class="form-control" required oninvalid="this.setCustomValidity('Mohon isi Nomor SK')" oninput="setCustomValidity('')">
                                                         </div>
                                                      </div>
                                                      <div class="col-md-6">
                                                         <div class="form-group">
                                                            <label>Nomor Pertek</label>
                                                            <input type="text" name="no_pertek" class="form-control" required oninvalid="this.setCustomValidity('Mohon isi Nomor Pertek')" oninput="setCustomValidity('')">
                                                         </div>
                                                      </div>
                                                   </div>
                                                   
                                                   <div class="row">
                                                      <div class="col-md-6">
                                                         <div class="form-group">
                                                            <label>Tanggal Pertek</label>
                                                            <input type="date" name="tgl_pertek" class="form-control" required oninvalid="this.setCustomValidity('Mohon isi Tanggal Pertek')" oninput="setCustomValidity('')">
                                                         </div>
                                                      </div>
                                                      <div class="col-md-6">
                                                         <div class="form-group">
                                                            <label>Tanggal SK</label>
                                                            <input type="date" name="tgl_sk" class="form-control" required oninvalid="this.setCustomValidity('Mohon isi Tanggal SK')" oninput="setCustomValidity('')">
                                                         </div>
                                                      </div>
                                                   </div>                                                                                          
                                                </div>
                                                <div class="modal-footer">               
                                                <button class="btn ripple btn-danger" data-bs-dismiss="modal" type="button">Batal</button>
                                                <button type="submit" class="btn btn-primary"><i class="fa fa-print"></i> Cetak SK</button>
                                                </div>
                                             </form>
                                             </div>
                                          </div>
                                       </div>


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
<!--app-content closed-->





@endsection

@push('script')

<script>
$(document).ready(function() {
   $("#select_pegawai").select2({
      dropdownParent: $('#addPegawai .modal-content')
   });
});
</script>

@endpush