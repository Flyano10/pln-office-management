<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operasional extends Model
{
    use HasFactory;

    protected $table = 'operasional';

    protected $fillable = [
        'kantor_id',
        'jumlah_pegawai',
        'divisi_departemen',
        'pic_nama',
        'nomor_kontak',
        'jam_operasional',
        'keamanan',
        'catatan_tambahan'
    ];

    protected $casts = [
        'keamanan' => 'array'
    ];

    public function kantor()
    {
        return $this->belongsTo(PlnOffice::class, 'kantor_id');
    }
}
