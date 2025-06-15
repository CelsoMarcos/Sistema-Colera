<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ambulancia extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'matricula',
        'hospital_id',
        'status',
        'localizacao'
    ];

    // Relação com Hospital
    public function hospital()
    {
        return $this->belongsTo(Hospital::class);
    }
}
