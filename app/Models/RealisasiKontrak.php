<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kontrak;

class RealisasiKontrak extends Model
{
    use HasFactory;

    protected $fillable = [
        'kontrak_id',
        'no_pihak1',
        'no_pihak2',
        'tanggal_realisasi',
        'jenis_kompensasi',
        'deskripsi',
        'nilai_kompensasi',
        'lokasi',
        'alamat',
        'dokumen',
    ];

    public function kontrak()
    {
        return $this->belongsTo(Kontrak::class);
    }
}
