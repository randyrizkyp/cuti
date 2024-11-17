@extends('pegawai.templates.main')
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
                                          <td>Nama, NIP</td>
                                          <td>Cuti</td>
                                          <td>File</td>
                                          <td>Status</td>                                                                                                                          
                                          <td width="50px">Opsi</td>
                                       </tr>
                                 </thead>
                                 <tbody>
                                       @foreach($cuti as $dt)
                                       <tr>
                                          <td>{{ $loop->iteration }}</td>   
                                          <td>{{ $dt->nama }}<br>{{ $dt->nip }}</td>
                                          <td>
                                             @if ($dt->jeniscuti == 1)
                                             Cuti Tahunan <span class="badge bg-info">{{ $dt->jmlhari }} Hari</span>
                                             @elseif($dt->jeniscuti == 2)
                                             Cuti Besar <span class="badge bg-info">{{ $dt->jmlhari }} Hari</span>
                                             @elseif($dt->jeniscuti == 3)
                                             Cuti Sakit <span class="badge bg-info">{{ $dt->jmlhari }} Hari</span>
                                             @elseif($dt->jeniscuti == 4)
                                             Cuti Melahirkan <span class="badge bg-info">{{ $dt->jmlhari }} Hari</span>
                                             @elseif($dt->jeniscuti == 5)
                                             Cuti Karena Alasan Penting <span class="badge bg-info">{{ $dt->jmlhari }} Hari</span>
                                             @elseif($dt->jeniscuti == 6)
                                             Cuti di luar Tanggungan Negara <span class="badge bg-info">{{ $dt->jmlhari }} Hari</span>
                                             @endif
                                          </td>
                                          <td>@if($dt->dokumen)<a class="btn btn-primary btn-sm" title="Lihat File" target="_blank" href="/{{ $dt->dokumen }}"><i class="fa fa-file"></i> Lihat File</a>@endif</td>
                                          <td>{{ $dt->status }}</td>                                                                                    
                                          <td class="text-center text-nowrap">
                                             <a class="btn btn-success btn-sm" href="/detailbawahan/{{ $dt->nip }}"><i class="fa fa-search"></i> Detail</a>                                                                                          
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