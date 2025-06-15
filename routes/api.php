<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\ProvinciaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TriagemInteligenteController;
use App\Http\Controllers\AmbulanciaController;



// ...

Route::post('/login', [AuthController::class, 'login']);

// 🟩 Validação de campos antes de criar paciente
Route::post('/validar-campos', [PacienteController::class, 'validarTelefoneENumeroBI']);

// Triagem Inteligente
Route::post('/v1/triagem', [TriagemInteligenteController::class, 'triar']);
// Consulta do estado do paciente por número de BI
Route::get('/v1/paciente/estado/{bi}', [PacienteController::class, 'verificarEstadoPorBI']);
// 🔍 Filtrar pacientes por estado
Route::get('/pacientes/estado/{estado}', [PacienteController::class, 'listarPorEstado']);

Route::middleware('auth:sanctum')->get('/pacientes', function () {
    return \App\Models\Paciente::with('provincia')->get();
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::apiResource('pacientes', PacienteController::class);
    Route::get('provincias', [ProvinciaController::class, 'index']);
    Route::get('dashboard/estatisticas', [DashboardController::class, 'estatisticas']);
    // Atualização de estado do paciente
Route::put('/pacientes/{id}/estado', [PacienteController::class, 'atualizarEstado']);
Route::patch('/pacientes/{id}/estado', [PacienteController::class, 'atualizarEstado']);
Route::middleware('auth:sanctum')->group(function () {
    // Gestão de gabinetes provinciais
    Route::apiResource('gabinetes-provinciais', GabineteProvincialController::class);

    // Gestão de gabinetes municipais
    Route::apiResource('gabinetes-municipais', GabineteMunicipalController::class);
});


});
Route::get('/v1/paciente/{id}/pdf', [TriagemInteligenteController::class, 'gerarFichaPDF']);
Route::middleware('auth:sanctum')->get('/teste-token', function (Request $request) {
    return response()->json([
        'usuario' => $request->user()
    ]);
});

Route::apiResource('ambulancias', AmbulanciaController::class);