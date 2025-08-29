<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<title>{{ $title }}</title>
<link rel="shortcut icon" type="image/x-icon" href="/storage/assets/images/logo/waykanan.png">
{{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> --}}
<link id="style" href="{{ public_path('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

<style>
   hr {
      border: none;
      margin-top: 0px;
      height: 5px;
      color: #000000; 
      background-color: #000000;
   }
   
   .page-break{
      page-break-after: auto|always|avoid|left|right|initial|inherit;
   }
   
   </style>
</head>

<body>
                  
@if($jenis_kop == 'sekda')
<div id="kopsekda">
   <div class="row">
      <div class="col-md-12 mb-2">
         <img src="{{ public_path('storage/image/kopdinas.jpg') }}">
      </div>      
   </div>
</div>
@elseif($jenis_kop == 'dinas')
<div id="kopdinas">
   <div class="row">
      <div class="col-md-12 mb-2">
         <img src="{{ public_path('storage/image/kopdinas.jpg') }}" height="123px">
      </div>      
   </div>
</div>
@elseif($jenis_kop == 'garuda')
<div id="kopgaruda">   
   <div class="col-md-12 mt-3">
      &nbsp;
   </div>
</div>
@endif


<div class="col-md-12 text-center">
   <span style="font-size: 19px; font-family: Calibri; font-weight: 700; text-decoration: underline;">Surat {{ $jenis_cuti }}</span><br>
   <span id="no_surat" style="font-size: 16px; font-family: Calibri;">Nomor : 800/&emsp;&nbsp;&emsp;&nbsp;&emsp;&nbsp;&emsp;/124/{{ $tahun }}</span>
</div>

<div class="col-md-12 mt-2" style="padding-left: 10px; padding-right: 40px;">

   <table border="0" cellspacing="0" cellpadding="0" style="font-size: 14px;">      
      <tr>
         <td style="vertical-align: text-top;">
            <table border="0" cellspacing="0" cellpadding="0">
               <tr>
                  <td width="95%" style="vertical-align: text-top;">1.</td>                  
               </tr>            
            </table>    
         </td>
         <td style="padding-left: 10px;">
            <table border="0" cellspacing="0" cellpadding="0">               
               <tr>                                          
                  <td style="text-align: justify;">Diberikan {{$jenis_cuti}} untuk tahun {{$tahun}} kepada Pegawai Negeri Sipil :</th>
               </tr>                           
            </table>
         </td>
      </tr>
   </table>

   <table border="0" cellspacing="0" cellpadding="0" style="font-size: 14px; padding-left: 22px;">
      <tr>
         <td style="vertical-align: text-top;">
            <table border="0" cellspacing="0" cellpadding="0">
               <tr>
                  <td width="95%" style="vertical-align: text-top;">Nama</td>
                  <td width="5%" style="vertical-align: text-top; padding-left: 40px;">:</td>
               </tr>            
            </table>    
         </td>
         <td style="padding-left: 10px;">
            <table border="0" cellspacing="0" cellpadding="0">               
               <tr>                        
                  <td width="20px" style="vertical-align: text-top">&nbsp;</td>
                  <td id="untuk1" style="text-align: justify;">{{ $nama }}</th>
               </tr>                           
            </table>
         </td>
      </tr>
   </table>



   @if ($jenis_kop == 'sekda')
   
   <table align="right" style="width:45%; font-size: 14px; padding-top: 20px;">
      <tr>
         <td width="110px" style="vertical-align: text-top">DITETAPKAN DI</td>
         <td width="5px" style="vertical-align: text-top">:</td>
         <td style="vertical-align: text-top" align="right">Kotabumi</td>
      </tr>
      <tr>
         <td width="110px" style="vertical-align: text-top">PADA TANGGAL</td>
         <td width="5px" style="vertical-align: text-top">:</td>
         <td style="vertical-align: text-top;" align="right">{{ $tgl }}</td>
      </tr>
      <tr>
         <td colspan="3" style="margin-top: 0px;"><hr style="height: 3px !important;"></td>
      </tr>     
      <tr>
         <td colspan="3" style="vertical-align: text-top; font-weight: 600;" class="text-center">SEKRETARIS DAERAH</td>
      </tr>
      <tr>
         <td colspan="3" style="padding-top: 70px; vertical-align: text-top; font-weight: 600; text-decoration: underline;" class="text-center">Drs. Lekok M.M</td>
      </tr>      
      <tr>
         <td colspan="3" style="vertical-align: text-top;" class="text-center">NIP. 196511251986031005</td>
      </tr>
   </table>   
   
   @elseif ($jenis_kop == 'dinas')
   
      <table align="right" style="width:45%; font-size: 14px; padding-top: 20px;">
         <tr>
            <td width="110px" style="vertical-align: text-top">DITETAPKAN DI</td>
            <td width="5px" style="vertical-align: text-top">:</td>
            <td style="vertical-align: text-top" align="right">Kotabumi</td>
         </tr>
         <tr>
            <td width="110px" style="vertical-align: text-top">PADA TANGGAL</td>
            <td width="5px" style="vertical-align: text-top">:</td>
            <td style="vertical-align: text-top;" align="right">{{ $tgl }}</td>
         </tr>
         <tr>
            <td colspan="3" style="margin-top: 0px;"><hr style="height: 3px !important;"></td>
         </tr>
         <tr>
            <td colspan="3" style="vertical-align: text-top; font-weight: 600;" class="text-center">KEPALA</td>
         </tr>
         <tr>
            <td colspan="3" style="vertical-align: text-top; font-weight: 600;" class="text-center">BADAN KEPEGAWAIAN DAN PENGEMBANGAN SUMBER DAYA MANUSIA</td>
         </tr>
         <tr>
            <td colspan="3" style="vertical-align: text-top; font-weight: 600;" class="text-center">KABUPATEN LAMPUNG UTARA,</td>
         </tr> 
         <tr>
            <td colspan="3" style="padding-top: 80px; vertical-align: text-top; font-weight: 600; text-decoration: underline;" class="text-center">Martahan Samosir S.STP, MPA</td>
         </tr>         
         <tr>
            <td colspan="3" style="vertical-align: text-top;" class="text-center">NIP. 196511251986031005</td>
         </tr>
      </table>   

   @elseif ($jenis_kop == 'garuda')

      <table align="right" style="width:45%; font-size: 14px; padding-top: 20px;">
         <tr>
            <td width="110px" style="vertical-align: text-top">DITETAPKAN DI</td>
            <td width="5px" style="vertical-align: text-top">:</td>
            <td style="vertical-align: text-top" align="right">KOTABUMI</td>
         </tr>
         <tr>
            <td width="110px" style="vertical-align: text-top">PADA TANGGAL</td>
            <td width="5px" style="vertical-align: text-top">:</td>
            <td style="vertical-align: text-top;" align="right">{{ $tgl }}</td>
         </tr>
         <tr>
            <td colspan="3" style="margin-top: 0px;"><hr style="height: 3px !important;"></td>
         </tr>
         <tr>
            <td colspan="3" style="vertical-align: text-top; font-weight: 600;" class="text-center">BUPATI LAMPUNG UTARA</td>
         </tr>                
         <tr>
            <td colspan="3" style="padding-top: 80px; vertical-align: text-top; font-weight: 600; text-decoration: underline;" class="text-center">Aswarodi</td>
         </tr>                
      </table>
   
   @endif

</div>
            

<table border="0" cellspacing="0" cellpadding="0" align="left" style="width:45%; font-size: 12px; padding-left: 40px;">
   <tr>
      <td style="vertical-align: text-top; font-weight: 600;">Tembusan :</td>      
   </tr>            
</table>    
<table border="0" cellspacing="0" cellpadding="0" align="left" style="width:45%; font-size: 12px; padding-left: 40px;">   
   <tr>                        
      <td style="vertical-align: text-top"><span>1. Penjabat Bupati Lampung Utara</span></td>
      <td style="vertical-align: text-top"><span>2. Sekretaris Daerah Kabupaten Lampung Utara</span></td>
      <td style="vertical-align: text-top"><span>3. Kepala BKPSDM Kabupaten Lampung Utara</span></td>
      <td style="vertical-align: text-top"><span>4. Kepala BPKAD Kabupaten Lampung Utara</span></td>
   </tr>   
</table>


   



<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>