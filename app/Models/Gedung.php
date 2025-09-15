<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gedung extends Model
{
    use HasFactory;

    protected $table = 'gedung';

    protected $fillable = [
        'kantor_id',
        'luas_bangunan',
        'jumlah_lantai',
        'jumlah_ruangan',
        'fasilitas_utama',
        'status_gedung',
    ];

    public function kantor()
    {
        return $this->belongsTo(PlnOffice::class, 'kantor_id');
    }

    public function kontrak()
    {
        return $this->hasOne(Kontrak::class, 'gedung_id');
    }
}
