<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlnOffice extends Model
{
    use HasFactory;

    protected $fillable = [
        'office_id',
        'office_name',
        'address',
        'city',
        'province',
        'office_type',
        'parent_office',
        'latitude',
        'longitude'
    ];

    protected $casts = [
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8'
    ];

    public function getOfficeTypeNameAttribute()
    {
        $types = [
            'Pusat' => 'Kantor Pusat',
            'SBU' => 'SBU',
            'KP' => 'Kantor Perwakilan'
        ];
        return $types[$this->office_type] ?? $this->office_type;
    }

    public function parentOffice()
    {
        return $this->belongsTo(PlnOffice::class, 'parent_office');
    }

    public function childOffices()
    {
        return $this->hasMany(PlnOffice::class, 'parent_office');
    }

    public function gedungs()
    {
        return $this->hasMany(Gedung::class, 'kantor_id');
    }

    public function operasionals()
    {
        return $this->hasMany(Operasional::class, 'kantor_id');
    }
}
