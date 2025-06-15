<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caso extends Model
{
    use HasFactory;

    protected $fillable = [
        'paciente_nome',
        'idade',
        'sexo',
        'data_registro',
        'hospital_id',
        'estado',
    ];

    public function hospital()
    {
        return $this->belongsTo(Hospital::class);
    }
}
