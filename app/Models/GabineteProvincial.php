<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class GabineteProvincial extends Model
{
    // Define os campos que podem ser preenchidos em massa (mass assignable)
    protected $fillable = ['nome', 'provincia_id'];

    // Relacionamento: um gabinete provincial pertence a uma província
    public function provincia()
    {
        return $this->belongsTo(Provincia::class);
    }

    // Relacionamento: um gabinete provincial tem muitos gabinetes municipais
    public function gabinetesMunicipais()
    {
        return $this->hasMany(GabineteMunicipal::class);
    }
}
