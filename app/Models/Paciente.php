<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;
     protected $fillable = [
        'nome_completo',
        'numero_bi',
        'telefone',
        'sexo',
        'provincia_id',
        'sintomas',
        'estado'
    ];

    protected $casts = [
        'sintomas' => 'array' // Converte automaticamente para array
    ];
    public function provincia()
{
    return $this->belongsTo(Provincia::class);
}
}
