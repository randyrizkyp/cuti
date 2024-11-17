@extends('kassubag.templates.main')
@section('content')

<div class="main-content app-content mt-5">
   <div class="side-app">        
      <div class="main-container container-fluid">                                    
         
         <div class="row row-sm">
               <div class="col-lg-12">

                  <div class="card">
                     <div class="card-header">
                           PNS Yang Diusulkan Pensiun
                     </div>

                     <form class="form-horizontal form-bordered" action="/insertpensiun" method="POST" enctype="multipart/form-data">
                     @csrf
                     <div class="card-body">                        
                        <div class="row mb-4">
                           <label class="col-md-3 form-label" style="text-align: right">NIP</label>
                           <div class="col-md-7">
                              <input type="text" class="form-control" name="nip" value="{{ $pegawai->nip }}" readonly>
                           </div>
                        </div>

                        <div class="row mb-4">
                           <label class="col-md-3 form-label" style="text-align: right">Nama</label>
                           <div class="col-md-7">
                              <input type="text" class="form-control" value="{{ $pegawai->nama }}" readonly>
                           </div>
                        </div>        
                        
                        <div class="row mb-4">
                           <label class="col-md-3 form-label" style="text-align: right">Golongan Ruang / Pangkat</label>
                           <div class="col-md-7">
                              <input type="text" class="form-control" value="{{ $pegawai->pangkat }}" readonly>
                           </div>
                        </div>

                        <div class="row mb-4">
                           <label class="col-md-3 form-label" style="text-align: right">Jabatan</label>
                           <div class="col-md-7">
                              <input type="text" class="form-control" value="{{ $pegawai->jabatan }}" readonly>
                           </div>
                        </div>

                        <div class="row mb-4">
                           <label class="col-md-3 form-label" style="text-align: right">Unit Kerja</label>
                           <div class="col-md-7">
                              <input type="text" class="form-control" value="{{ $pegawai->unit_kerja }}" readonly>
                           </div>
                        </div>

                        <div class="row mb-4">
                           <label class="col-md-3 form-label" style="text-align: right">Unit Kerja</label>
                           <div class="col-md-7">
                              <input type="text" class="form-control" value="{{ $pegawai->unit_kerja }}" readonly>
                           </div>
                        </div>

                        <div class="row mb-4">
                           <label class="col-md-3 form-label" style="text-align: right">TMT CPNS</label>
                           <div class="col-md-3">
                              <input type="date" class="form-control" name="tmtcpns" required oninvalid="this.setCustomValidity('Mohon isi TMT CPNS')" oninput="setCustomValidity('')">
                           </div>
                        </div>

                        <div class="row mb-4">
                           <label class="col-md-3 form-label" style="text-align: right">Pendidikan Pada Saat Diangkat CPNS</label>
                           <div class="col-md-7">
                              <input type="text" class="form-control" name="pendidikan_diangkat" required oninvalid="this.setCustomValidity('Mohon isi Pendidikan Saat CPNS')" oninput="setCustomValidity('')">
                           </div>
                        </div>

                        <div class="row mb-4">
                           <label class="col-md-3 form-label" style="text-align: right">Tahun Lulus</label>
                           <div class="col-md-3">
                              <input type="text" class="form-control" name="tahunlulus" required oninvalid="this.setCustomValidity('Mohon isi Tahun Lulus')" oninput="setCustomValidity('')">
                           </div>
                        </div>
                        
                        <div class="row mb-4">
                           <label class="col-md-3 form-label" style="text-align: right">Gaji Pokok (Rp.)</label>
                           <div class="col-md-3">
                              <input type="number" class="form-control" name="gajipokok" required oninvalid="this.setCustomValidity('Mohon isi Gaji Pokok')" oninput="setCustomValidity('')">
                           </div>
                        </div>                        
                        
                        <div class="row mb-4">
                           <label class="col-md-3 form-label" style="text-align: right">Masa Kerja Sebelum Diangkat CPNS</label>                           
                           <div class="col-md-7">
                              <div class="row">
                                 <div class="col-md-5">
                                    <select class="form-control select2 form-select" name="mk_tahun" required oninvalid="this.setCustomValidity('Mohon pilih Masa Kerja Tahun')" oninput="setCustomValidity('')">                                                                                        
                                       <option value="0 Tahun">0 Tahun</option>
                                       <option value="1 Tahun">1 Tahun</option>
                                       <option value="2 Tahun">2 Tahun</option>
                                       <option value="3 Tahun">3 Tahun</option>
                                       <option value="4 Tahun">4 Tahun</option>
                                       <option value="5 Tahun">5 Tahun</option>
                                       <option value="6 Tahun">6 Tahun</option>
                                       <option value="7 Tahun">7 Tahun</option>
                                       <option value="8 Tahun">8 Tahun</option>
                                       <option value="9 Tahun">9 Tahun</option>
                                       <option value="10 Tahun">10 Tahun</option>
                                       <option value="11 Tahun">11 Tahun</option>
                                       <option value="12 Tahun">12 Tahun</option>
                                       <option value="13 Tahun">13 Tahun</option>
                                       <option value="14 Tahun">14 Tahun</option>
                                       <option value="15 Tahun">15 Tahun</option>
                                       <option value="16 Tahun">16 Tahun</option>
                                       <option value="17 Tahun">17 Tahun</option>
                                       <option value="18 Tahun">18 Tahun</option>
                                       <option value="19 Tahun">19 Tahun</option>
                                       <option value="20 Tahun">20 Tahun</option>
                                       <option value="21 Tahun">21 Tahun</option>
                                       <option value="22 Tahun">22 Tahun</option>
                                       <option value="23 Tahun">23 Tahun</option>
                                       <option value="24 Tahun">24 Tahun</option>
                                       <option value="25 Tahun">25 Tahun</option>
                                       <option value="26 Tahun">26 Tahun</option>
                                       <option value="27 Tahun">27 Tahun</option>
                                       <option value="28 Tahun">28 Tahun</option>
                                       <option value="29 Tahun">29 Tahun</option>
                                       <option value="30 Tahun">30 Tahun</option>
                                       <option value="31 Tahun">31 Tahun</option>
                                       <option value="32 Tahun">32 Tahun</option>
                                       <option value="33 Tahun">33 Tahun</option>
                                       <option value="34 Tahun">34 Tahun</option>
                                       <option value="35 Tahun">35 Tahun</option>
                                       <option value="36 Tahun">36 Tahun</option>
                                       <option value="37 Tahun">37 Tahun</option>
                                       <option value="38 Tahun">38 Tahun</option>
                                       <option value="39 Tahun">39 Tahun</option>
                                       <option value="40 Tahun">40 Tahun</option>
                                    </select>
                                 </div>
                                 <div class="col-md-5">
                                    <select class="form-control select2 form-select" name="mk_bulan" required oninvalid="this.setCustomValidity('Mohon pilih Masa Kerja Bulan')" oninput="setCustomValidity('')">                                                                                        
                                       <option value="0 Bulan">0 Bulan</option>
                                       <option value="1 Bulan">1 Bulan</option>
                                       <option value="2 Bulan">2 Bulan</option>
                                       <option value="3 Bulan">3 Bulan</option>
                                       <option value="4 Bulan">4 Bulan</option>
                                       <option value="5 Bulan">5 Bulan</option>
                                       <option value="6 Bulan">6 Bulan</option>
                                       <option value="7 Bulan">7 Bulan</option>
                                       <option value="8 Bulan">8 Bulan</option>
                                       <option value="9 Bulan">9 Bulan</option>
                                       <option value="10 Bulan">10 Bulan</option>
                                       <option value="11 Bulan">11 Bulan</option>
                                       <option value="12 Bulan">12 Bulan</option>
                                    </select>
                                 </div>
                              </div>
                           </div>
                        </div>
                        

                        <div class="row mb-4">
                           <label class="col-md-3 form-label" style="text-align: right">Masa Kerja KP Terakhir</label>                           
                           <div class="col-md-7">
                              <div class="row">
                                 <div class="col-md-5">
                                    <select class="form-control select2 form-select" name="mk_kp_tahun" required oninvalid="this.setCustomValidity('Mohon pilih Masa Kerja KP Tahun')" oninput="setCustomValidity('')">                                                                                        
                                       <option value="0 Tahun">0 Tahun</option>
                                       <option value="1 Tahun">1 Tahun</option>
                                       <option value="2 Tahun">2 Tahun</option>
                                       <option value="3 Tahun">3 Tahun</option>
                                       <option value="4 Tahun">4 Tahun</option>
                                       <option value="5 Tahun">5 Tahun</option>
                                       <option value="6 Tahun">6 Tahun</option>
                                       <option value="7 Tahun">7 Tahun</option>
                                       <option value="8 Tahun">8 Tahun</option>
                                       <option value="9 Tahun">9 Tahun</option>
                                       <option value="10 Tahun">10 Tahun</option>
                                       <option value="11 Tahun">11 Tahun</option>
                                       <option value="12 Tahun">12 Tahun</option>
                                       <option value="13 Tahun">13 Tahun</option>
                                       <option value="14 Tahun">14 Tahun</option>
                                       <option value="15 Tahun">15 Tahun</option>
                                       <option value="16 Tahun">16 Tahun</option>
                                       <option value="17 Tahun">17 Tahun</option>
                                       <option value="18 Tahun">18 Tahun</option>
                                       <option value="19 Tahun">19 Tahun</option>
                                       <option value="20 Tahun">20 Tahun</option>
                                       <option value="21 Tahun">21 Tahun</option>
                                       <option value="22 Tahun">22 Tahun</option>
                                       <option value="23 Tahun">23 Tahun</option>
                                       <option value="24 Tahun">24 Tahun</option>
                                       <option value="25 Tahun">25 Tahun</option>
                                       <option value="26 Tahun">26 Tahun</option>
                                       <option value="27 Tahun">27 Tahun</option>
                                       <option value="28 Tahun">28 Tahun</option>
                                       <option value="29 Tahun">29 Tahun</option>
                                       <option value="30 Tahun">30 Tahun</option>
                                       <option value="31 Tahun">31 Tahun</option>
                                       <option value="32 Tahun">32 Tahun</option>
                                       <option value="33 Tahun">33 Tahun</option>
                                       <option value="34 Tahun">34 Tahun</option>
                                       <option value="35 Tahun">35 Tahun</option>
                                       <option value="36 Tahun">36 Tahun</option>
                                       <option value="37 Tahun">37 Tahun</option>
                                       <option value="38 Tahun">38 Tahun</option>
                                       <option value="39 Tahun">39 Tahun</option>
                                       <option value="40 Tahun">40 Tahun</option>
                                    </select>
                                 </div>
                                 <div class="col-md-5">
                                    <select class="form-control select2 form-select" name="mk_kp_bulan" required oninvalid="this.setCustomValidity('Mohon pilih Masa Kerja KP Bulan')" oninput="setCustomValidity('')">                                                                                        
                                       <option value="0 Bulan">0 Bulan</option>
                                       <option value="1 Bulan">1 Bulan</option>
                                       <option value="2 Bulan">2 Bulan</option>
                                       <option value="3 Bulan">3 Bulan</option>
                                       <option value="4 Bulan">4 Bulan</option>
                                       <option value="5 Bulan">5 Bulan</option>
                                       <option value="6 Bulan">6 Bulan</option>
                                       <option value="7 Bulan">7 Bulan</option>
                                       <option value="8 Bulan">8 Bulan</option>
                                       <option value="9 Bulan">9 Bulan</option>
                                       <option value="10 Bulan">10 Bulan</option>
                                       <option value="11 Bulan">11 Bulan</option>
                                       <option value="12 Bulan">12 Bulan</option>
                                    </select>
                                 </div>
                              </div>
                           </div>
                        </div>                       


                        <div class="row mb-4">
                           <label class="col-md-3 form-label" style="text-align: right">Masa Kerja PNS</label>                           
                           <div class="col-md-7">
                              <div class="row">
                                 <div class="col-md-5">
                                    <select class="form-control select2 form-select" name="mk_pns_tahun" required oninvalid="this.setCustomValidity('Mohon pilih Masa Kerja PNS Tahun')" oninput="setCustomValidity('')">                                                                                        
                                       <option value="0 Tahun">0 Tahun</option>
                                       <option value="1 Tahun">1 Tahun</option>
                                       <option value="2 Tahun">2 Tahun</option>
                                       <option value="3 Tahun">3 Tahun</option>
                                       <option value="4 Tahun">4 Tahun</option>
                                       <option value="5 Tahun">5 Tahun</option>
                                       <option value="6 Tahun">6 Tahun</option>
                                       <option value="7 Tahun">7 Tahun</option>
                                       <option value="8 Tahun">8 Tahun</option>
                                       <option value="9 Tahun">9 Tahun</option>
                                       <option value="10 Tahun">10 Tahun</option>
                                       <option value="11 Tahun">11 Tahun</option>
                                       <option value="12 Tahun">12 Tahun</option>
                                       <option value="13 Tahun">13 Tahun</option>
                                       <option value="14 Tahun">14 Tahun</option>
                                       <option value="15 Tahun">15 Tahun</option>
                                       <option value="16 Tahun">16 Tahun</option>
                                       <option value="17 Tahun">17 Tahun</option>
                                       <option value="18 Tahun">18 Tahun</option>
                                       <option value="19 Tahun">19 Tahun</option>
                                       <option value="20 Tahun">20 Tahun</option>
                                       <option value="21 Tahun">21 Tahun</option>
                                       <option value="22 Tahun">22 Tahun</option>
                                       <option value="23 Tahun">23 Tahun</option>
                                       <option value="24 Tahun">24 Tahun</option>
                                       <option value="25 Tahun">25 Tahun</option>
                                       <option value="26 Tahun">26 Tahun</option>
                                       <option value="27 Tahun">27 Tahun</option>
                                       <option value="28 Tahun">28 Tahun</option>
                                       <option value="29 Tahun">29 Tahun</option>
                                       <option value="30 Tahun">30 Tahun</option>
                                       <option value="31 Tahun">31 Tahun</option>
                                       <option value="32 Tahun">32 Tahun</option>
                                       <option value="33 Tahun">33 Tahun</option>
                                       <option value="34 Tahun">34 Tahun</option>
                                       <option value="35 Tahun">35 Tahun</option>
                                       <option value="36 Tahun">36 Tahun</option>
                                       <option value="37 Tahun">37 Tahun</option>
                                       <option value="38 Tahun">38 Tahun</option>
                                       <option value="39 Tahun">39 Tahun</option>
                                       <option value="40 Tahun">40 Tahun</option>
                                    </select>
                                 </div>
                                 <div class="col-md-5">
                                    <select class="form-control select2 form-select" name="mk_pns_bulan" required oninvalid="this.setCustomValidity('Mohon pilih Masa Kerja PNS Bulan')" oninput="setCustomValidity('')">                                                                                        
                                       <option value="0 Bulan">0 Bulan</option>
                                       <option value="1 Bulan">1 Bulan</option>
                                       <option value="2 Bulan">2 Bulan</option>
                                       <option value="3 Bulan">3 Bulan</option>
                                       <option value="4 Bulan">4 Bulan</option>
                                       <option value="5 Bulan">5 Bulan</option>
                                       <option value="6 Bulan">6 Bulan</option>
                                       <option value="7 Bulan">7 Bulan</option>
                                       <option value="8 Bulan">8 Bulan</option>
                                       <option value="9 Bulan">9 Bulan</option>
                                       <option value="10 Bulan">10 Bulan</option>
                                       <option value="11 Bulan">11 Bulan</option>
                                       <option value="12 Bulan">12 Bulan</option>
                                    </select>
                                 </div>
                              </div>
                           </div>
                        </div>

                        <div class="row mb-4">
                           <label class="col-md-3 form-label" style="text-align: right">Masa Kerja Pensiun</label>                           
                           <div class="col-md-7">
                              <div class="row">
                                 <div class="col-md-5">
                                    <select class="form-control select2 form-select" name="mk_pensiun_tahun" required oninvalid="this.setCustomValidity('Mohon pilih Masa Kerja Pensiun Tahun')" oninput="setCustomValidity('')">                                                                                        
                                       <option value="0 Tahun">0 Tahun</option>
                                       <option value="1 Tahun">1 Tahun</option>
                                       <option value="2 Tahun">2 Tahun</option>
                                       <option value="3 Tahun">3 Tahun</option>
                                       <option value="4 Tahun">4 Tahun</option>
                                       <option value="5 Tahun">5 Tahun</option>
                                       <option value="6 Tahun">6 Tahun</option>
                                       <option value="7 Tahun">7 Tahun</option>
                                       <option value="8 Tahun">8 Tahun</option>
                                       <option value="9 Tahun">9 Tahun</option>
                                       <option value="10 Tahun">10 Tahun</option>
                                       <option value="11 Tahun">11 Tahun</option>
                                       <option value="12 Tahun">12 Tahun</option>
                                       <option value="13 Tahun">13 Tahun</option>
                                       <option value="14 Tahun">14 Tahun</option>
                                       <option value="15 Tahun">15 Tahun</option>
                                       <option value="16 Tahun">16 Tahun</option>
                                       <option value="17 Tahun">17 Tahun</option>
                                       <option value="18 Tahun">18 Tahun</option>
                                       <option value="19 Tahun">19 Tahun</option>
                                       <option value="20 Tahun">20 Tahun</option>
                                       <option value="21 Tahun">21 Tahun</option>
                                       <option value="22 Tahun">22 Tahun</option>
                                       <option value="23 Tahun">23 Tahun</option>
                                       <option value="24 Tahun">24 Tahun</option>
                                       <option value="25 Tahun">25 Tahun</option>
                                       <option value="26 Tahun">26 Tahun</option>
                                       <option value="27 Tahun">27 Tahun</option>
                                       <option value="28 Tahun">28 Tahun</option>
                                       <option value="29 Tahun">29 Tahun</option>
                                       <option value="30 Tahun">30 Tahun</option>
                                       <option value="31 Tahun">31 Tahun</option>
                                       <option value="32 Tahun">32 Tahun</option>
                                       <option value="33 Tahun">33 Tahun</option>
                                       <option value="34 Tahun">34 Tahun</option>
                                       <option value="35 Tahun">35 Tahun</option>
                                       <option value="36 Tahun">36 Tahun</option>
                                       <option value="37 Tahun">37 Tahun</option>
                                       <option value="38 Tahun">38 Tahun</option>
                                       <option value="39 Tahun">39 Tahun</option>
                                       <option value="40 Tahun">40 Tahun</option>
                                    </select>
                                 </div>
                                 <div class="col-md-5">
                                    <select class="form-control select2 form-select" name="mk_pensiun_bulan" required oninvalid="this.setCustomValidity('Mohon pilih Masa Kerja Pensiun Bulan')" oninput="setCustomValidity('')">                                                                                        
                                       <option value="0 Bulan">0 Bulan</option>
                                       <option value="1 Bulan">1 Bulan</option>
                                       <option value="2 Bulan">2 Bulan</option>
                                       <option value="3 Bulan">3 Bulan</option>
                                       <option value="4 Bulan">4 Bulan</option>
                                       <option value="5 Bulan">5 Bulan</option>
                                       <option value="6 Bulan">6 Bulan</option>
                                       <option value="7 Bulan">7 Bulan</option>
                                       <option value="8 Bulan">8 Bulan</option>
                                       <option value="9 Bulan">9 Bulan</option>
                                       <option value="10 Bulan">10 Bulan</option>
                                       <option value="11 Bulan">11 Bulan</option>
                                       <option value="12 Bulan">12 Bulan</option>
                                    </select>
                                 </div>
                              </div>
                           </div>
                        </div>

                        <div class="row mb-4">
                           <label class="col-md-3 form-label" style="text-align: right">CLTN</label>                           
                           <div class="col-md-7">
                              <div class="row">
                                 <div class="col-md-5">
                                    <select class="form-control select2 form-select" name="cltn_tahun" required oninvalid="this.setCustomValidity('Mohon pilih CLTN Tahun')" oninput="setCustomValidity('')">                                                                                        
                                       <option value="0 Tahun">0 Tahun</option>
                                       <option value="1 Tahun">1 Tahun</option>
                                       <option value="2 Tahun">2 Tahun</option>
                                       <option value="3 Tahun">3 Tahun</option>
                                       <option value="4 Tahun">4 Tahun</option>
                                       <option value="5 Tahun">5 Tahun</option>
                                       <option value="6 Tahun">6 Tahun</option>
                                       <option value="7 Tahun">7 Tahun</option>
                                       <option value="8 Tahun">8 Tahun</option>
                                       <option value="9 Tahun">9 Tahun</option>
                                       <option value="10 Tahun">10 Tahun</option>
                                       <option value="11 Tahun">11 Tahun</option>
                                       <option value="12 Tahun">12 Tahun</option>
                                       <option value="13 Tahun">13 Tahun</option>
                                       <option value="14 Tahun">14 Tahun</option>
                                       <option value="15 Tahun">15 Tahun</option>
                                       <option value="16 Tahun">16 Tahun</option>
                                       <option value="17 Tahun">17 Tahun</option>
                                       <option value="18 Tahun">18 Tahun</option>
                                       <option value="19 Tahun">19 Tahun</option>
                                       <option value="20 Tahun">20 Tahun</option>                                       
                                    </select>
                                 </div>
                                 <div class="col-md-5">
                                    <select class="form-control select2 form-select" name="cltn_bulan" required oninvalid="this.setCustomValidity('Mohon pilih CLTN Bulan')" oninput="setCustomValidity('')">                                                                                        
                                       <option value="0 Bulan">0 Bulan</option>
                                       <option value="1 Bulan">1 Bulan</option>
                                       <option value="2 Bulan">2 Bulan</option>
                                       <option value="3 Bulan">3 Bulan</option>
                                       <option value="4 Bulan">4 Bulan</option>
                                       <option value="5 Bulan">5 Bulan</option>
                                       <option value="6 Bulan">6 Bulan</option>
                                       <option value="7 Bulan">7 Bulan</option>
                                       <option value="8 Bulan">8 Bulan</option>
                                       <option value="9 Bulan">9 Bulan</option>
                                       <option value="10 Bulan">10 Bulan</option>
                                       <option value="11 Bulan">11 Bulan</option>
                                       <option value="12 Bulan">12 Bulan</option>
                                    </select>
                                 </div>
                              </div>
                           </div>
                        </div>

                        <div class="row mb-4">
                           <label class="col-md-3 form-label" style="text-align: right">TMT Pensiun</label>
                           <div class="col-md-3">
                              <input type="date" class="form-control" name="tmt_pensiun" required oninvalid="this.setCustomValidity('Mohon isi TMT Pensiun')" oninput="setCustomValidity('')">
                           </div>
                        </div>

                        <div class="row mb-4">
                           <label class="col-md-3 form-label" style="text-align: right">Diusulkan Pangkat Pengabdian</label>
                           <div class="col-md-3">
                              <select class="form-control select2 form-select" name="pangkat_pengabdian" required oninvalid="this.setCustomValidity('Mohon pilih Pangkat Pengabdian')" oninput="setCustomValidity('')">                                                                                        
                                 <option value="F">Tidak</option>
                                 <option value="T">Ya</option>                                
                              </select>
                           </div>
                        </div>

                        <div class="col-md-12 pb-4 pt-4">
                           <hr style="border: 1px solid gray">
                           <label class="col-md-3 form-label">Alamat Saat Ini</label>                           
                        </div>

                        <div class="row mb-4">
                           <label class="col-md-3 form-label" style="text-align: right">Alamat (Lama)</label>
                           <div class="col-md-7">
                              <textarea class="form-control" name="alamat_lama" rows="2" required oninvalid="this.setCustomValidity('Mohon isi Alamat Lama')" oninput="setCustomValidity('')"></textarea>
                           </div>
                        </div>

                        <div class="row mb-4">
                           <label class="col-md-3 form-label" style="text-align: right">Kecamatan (Lama)</label>
                           <div class="col-md-4">
                              <input type="text" class="form-control" name="kecamatan_lama" required oninvalid="this.setCustomValidity('Mohon isi Kecamatan Lama')" oninput="setCustomValidity('')">
                           </div>
                        </div>

                        <div class="row mb-4">
                           <label class="col-md-3 form-label" style="text-align: right">Kabupaten (Lama)</label>
                           <div class="col-md-4">
                              <input type="text" class="form-control" name="kabupaten_lama" required oninvalid="this.setCustomValidity('Mohon isi Kabupaten Lama')" oninput="setCustomValidity('')">
                           </div>
                        </div>

                        <div class="row mb-4">
                           <label class="col-md-3 form-label" style="text-align: right">Provinsi (Lama)</label>
                           <div class="col-md-4">
                              <input type="text" class="form-control" name="provinsi_lama" required oninvalid="this.setCustomValidity('Mohon isi Provinsi Lama')" oninput="setCustomValidity('')">
                           </div>
                        </div>

                        <div class="row mb-4">
                           <label class="col-md-3 form-label" style="text-align: right">Kode Pos (Lama)</label>
                           <div class="col-md-2">
                              <input type="text" class="form-control" name="kodepos_lama" required oninvalid="this.setCustomValidity('Mohon isi Kode Pos Lama')" oninput="setCustomValidity('')">
                           </div>
                        </div>

                        <div class="col-md-12 pb-4 pt-4">
                           <hr style="border: 1px solid gray">
                           <label class="col-md-3 form-label">Alamat Pada Saat Pensiun</label>                           
                        </div>

                        <div class="row mb-4">
                           <label class="col-md-3 form-label" style="text-align: right">Alamat (Baru)</label>
                           <div class="col-md-7">
                              <textarea class="form-control" name="alamat_baru" rows="2" required oninvalid="this.setCustomValidity('Mohon isi Alamat Baru')" oninput="setCustomValidity('')"></textarea>
                           </div>
                        </div>

                        <div class="row mb-4">
                           <label class="col-md-3 form-label" style="text-align: right">Kecamatan (Baru)</label>
                           <div class="col-md-4">
                              <input type="text" class="form-control" name="kecamatan_baru" required oninvalid="this.setCustomValidity('Mohon isi Kecamatan Baru')" oninput="setCustomValidity('')">
                           </div>
                        </div>

                        <div class="row mb-4">
                           <label class="col-md-3 form-label" style="text-align: right">Kabupaten (Baru)</label>
                           <div class="col-md-4">
                              <input type="text" class="form-control" name="kabupaten_baru" required oninvalid="this.setCustomValidity('Mohon isi Kabupaten Baru')" oninput="setCustomValidity('')">
                           </div>
                        </div>

                        <div class="row mb-4">
                           <label class="col-md-3 form-label" style="text-align: right">Provinsi (Baru)</label>
                           <div class="col-md-4">
                              <input type="text" class="form-control" name="provinsi_baru" required oninvalid="this.setCustomValidity('Mohon isi Provinsi Baru')" oninput="setCustomValidity('')">
                           </div>
                        </div>

                        <div class="row mb-4">
                           <label class="col-md-3 form-label" style="text-align: right">Kode Pos (Baru)</label>
                           <div class="col-md-2">
                              <input type="text" class="form-control" name="kodepos_baru" required oninvalid="this.setCustomValidity('Mohon isi Kode Pos Baru')" oninput="setCustomValidity('')">
                           </div>
                        </div>

                        <div class="col-md-12 pb-4 pt-4">
                           <hr style="border: 1px solid gray">                           
                        </div>

                        <div class="row mb-4">
                           <label class="col-md-3 form-label" style="text-align: right">Pejabat Kepegawaian Instansi</label>
                           <div class="col-md-7">
                              <input type="text" class="form-control" value="Martahan Samosir SSTP, MPA" readonly>
                           </div>
                        </div>   

                  </div>

                  <div class="card-footer">
                     <button type="reset" class="btn ripple btn-danger offset-3">Batal</button>
                     <button type="submit" class="btn btn-primary">Simpan</button>
                  </div>
                  </form>

               </div>
            </div>
         </div>                      
      </div>        
   </div>
</div>

@endsection