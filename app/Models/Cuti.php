<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuti extends Model
{
    use HasFactory;
    protected $fillable = [
        'nip', 'tahun','tanggal', 'jeniscuti', 'jmlhari', 'tglmulai', 'tglselesai', 'alasancuti', 'alamatcuti', 'telepon','masa_kerja','jabatan',
        'atasannip', 'namaatasan','validasiatasan','pejabatnip','dokumen','dokumencuti','status', 'catatan', 'no_surat'
    ];

}
