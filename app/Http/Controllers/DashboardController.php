<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;
use App\Models\Provincia;

class DashboardController extends Controller
{
    public function estatisticas()
{
    $totalPacientes = Paciente::count();

    $porEstado = Paciente::select('estado', \DB::raw('count(*) as total'))
        ->groupBy('estado')
        ->pluck('total', 'estado');

    // Inicializa as províncias com total 0
    $provincias = \App\Models\Provincia::pluck('nome', 'id');
    $distribuicaoPorProvincia = [];

    foreach ($provincias as $id => $nome) {
        $distribuicaoPorProvincia[$nome] = 0;
    }

    // Conta os pacientes por província e preenche no array
    $pacientesPorProvincia = Paciente::select('provincia_id', \DB::raw('count(*) as total'))
        ->groupBy('provincia_id')
        ->pluck('total', 'provincia_id');

    foreach ($pacientesPorProvincia as $provinciaId => $total) {
        $nome = $provincias[$provinciaId] ?? 'Desconhecida';
        $distribuicaoPorProvincia[$nome] = $total;
    }
ksort($distribuicaoPorProvincia);

    return response()->json([
        'total_pacientes' => $totalPacientes,
        'por_estado' => $porEstado,
        'por_provincia' => $distribuicaoPorProvincia
    ]);
}
}