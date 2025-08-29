@extends('admin.templates.main')
@section('content')
<!--app-content open-->
<div class="main-content app-content mt-5">
   <div class="side-app">        
      <div class="main-container container-fluid">                                    
         
         <div class="row">               
                  <div class="card">
                     <div class="card-header">                     
                        <div class="col-lg-8">
                           <form class="form-horizontal" action="/searchrekap" method="POST" enctype="multipart/form-data">
                              @csrf
                              <div class="row">
                                 <div class="col">
                                    <label class="mt-2">Tahun : </label>
                                       <span>
                                          <select name="tahun" class="form-control form-select">
                                             <option value="" selected>Pilih Semua</option>
                                             <option value="2023" {{$tahun == 2023 ? 'selected' : ''}}>2023</option>
                                             <option value="2024" {{$tahun == 2024 ? 'selected' : ''}}>2024</option>
                                             <option value="2025" {{$tahun == 2025 ? 'selected' : ''}}>2025</option>
                                          </select>
                                       </span>
                                 </div>
                                  <div class="col">
                                    <label class="mt-2">Bulan : </label>
                                    <span>
                                       <select name="bulan" class="form-control form-select">
                                       <option value="" selected>Pilih Semua</option>
                                       <option value="1" {{$bulan == 1 ? 'selected' : ''}}>Januari</option>
                                       <option value="2" {{$bulan == 2 ? 'selected' : ''}}>Februari</option>
                                       <option value="3" {{$bulan == 3 ? 'selected' : ''}}>Maret</option>
                                       <option value="4" {{$bulan == 4 ? 'selected' : ''}}>April</option>
                                       <option value="5" {{$bulan == 5 ? 'selected' : ''}}>Mei</option>
                                       <option value="6" {{$bulan == 6 ? 'selected' : ''}}>Juni</option>
                                       <option value="7" {{$bulan == 7 ? 'selected' : ''}}>Juli</option>
                                       <option value="8" {{$bulan == 8 ? 'selected' : ''}}>Agustus</option>
                                       <option value="9" {{$bulan == 9 ? 'selected' : ''}}>September</option>
                                       <option value="10" {{$bulan == 10 ? 'selected' : ''}}>Oktober</option>
                                       <option value="11" {{$bulan == 11 ? 'selected' : ''}}>November</option>
                                       <option value="12" {{$bulan == 12 ? 'selected' : ''}}>Desember</option>
                                    </select>
                                    </span>
                                 </div>
                                 <div class="col">
                                    <label class="mt-2">Jenis Cuti : </label>
                                    <span>
                                       <select name="jenis_cuti" class="form-control form-select">
                                       <option value="" selected>Pilih Semua</option>
                                       <option value="1" {{$jenis_cuti == 1 ? 'selected' : ''}}>Cuti Tahunan</option>
                                       <option value="2" {{$jenis_cuti == 2 ? 'selected' : ''}}>Cuti Besar</option>
                                       <option value="3" {{$jenis_cuti == 3 ? 'selected' : ''}}>Cuti Sakit</option>
                                       <option value="4" {{$jenis_cuti == 4 ? 'selected' : ''}}>Cuti Melahirkan</option>
                                       <option value="5" {{$jenis_cuti == 5 ? 'selected' : ''}}>Cuti Kareana Alasan Penting</option>
                                    </select>
                                    </span>
                                 </div>
                                 
                                 <div class="col">
                                    <button class="btn btn-md btn-primary mt-6" type="submit"><i class="fa fa-search"></i> Cari Rekap</button>
                                 </div>     
                              </div> 
                           </form>       
                        </div>     
                        <div class="col-lg-4">
                           <form class="form-horizontal" action="/export-excel" method="GET" enctype="multipart/form-data">
                              @csrf      
                              <input type="hidden" name="tahun" value="{{$tahun}}">
                              <input type="hidden" name="jenis_cuti" value="{{$jenis_cuti}}">
                              <input type="hidden" name="bulan" value="{{$bulan}}">
                              <button class="btn btn-md btn-success pull-right" type="submit"><i class="fa fa-file-excel-o"></i> Download</button>
                           </form>   
                        </div>                                          
                     </div>
                        
                        
                     
                     <div class="card-body">
                           <div class="table-responsive">
                              <table class="table table-striped table-bordered" id="basic-datatable">
                                 <thead>
                                       <tr>
                                          <td width="10px">No</td>                                          
                                          <td>Nama</td>
                                          <td>Cuti</td>
                                          <td>Tahun</td>                                          
                                          <td>Status</td>
                                          <td>Atasan Langsung</td>
                                          <td>PYBMC</td>                                                                                    
                                       </tr>
                                 </thead>
                                 <tbody>                                       
                                       @foreach($rekap as $dt)
                                       <tr>
                                          <td>{{ $loop->iteration }}</td>
                                          <td>{{ $dt->nama }}</td>
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
                                             <br>
                                             {{ $dt->nip }}
                                             <br>
                                              {{ $dt->tglmulai }} s.d {{$dt->tglselesai}}
                                          </td>
                                          <td class="text-center">{{$dt->tahun}}</td>                                          
                                          <td class="text-center">
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
                                             @elseif($dt->status == 'tms')
                                                <span class="badge bg-danger-transparent rounded-pill text-danger p-2 px-3">ditolak</span><br>                                                
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