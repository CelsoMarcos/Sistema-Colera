<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class GabineteMunicipal extends Model
{
    protected $fillable = [
    'nome',
    'municipio',
    'provincia_id',
    'gabinete_provincial_id',
];


    // Relacionamento: um gabinete municipal pertence a um gabinete provincial
    public function gabineteProvincial()
    {
        return $this->belongsTo(GabineteProvincial::class);
    }
}
