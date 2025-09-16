<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Gedung;
use App\Models\RealisasiKontrak;

class Kontrak extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_perjanjian',
        'no_perjanjian_pihak1',
        'no_perjanjian_pihak2',
        'tanggal_mulai',
        'tanggal_selesai',
        'sbu',
        'ruang_lingkup',
        'asset_owner',
        'peruntukan',
        'alamat',
        'status',
        'gedung_id',
    ];

    public function gedung()
    {
        return $this->belongsTo(Gedung::class);
    }

    public function realisasiKontraks()
    {
        return $this->hasMany(RealisasiKontrak::class);
    }
}
