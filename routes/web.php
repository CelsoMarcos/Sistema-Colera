<?php
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\TriagemInteligenteController;
use App\Http\Controllers\AmbulanciaController;
use App\Http\Controllers\CasoController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::post('/v1/triagem', [TriagemInteligenteController::class, 'triar']);
Route::get('/ver-qrcode', function () {
    return QrCode::size(300)->generate('Conteúdo do QR Code');
});
Route::apiResource('pacientes', PacienteController::class);
Route::post('/validar-campos', [PacienteController::class, 'validarTelefoneENumeroBI']);
Route::get('/login', function () {
    return response()->json(['mensagem' => 'Autenticação necessária. Página de login ainda em construção.'], 401);
})->name('login');


Route::get('/ambulancias', [AmbulanciaController::class, 'index'])->name('ambulancias.index');
Route::get('/ambulancias/create', [AmbulanciaController::class, 'create'])->name('ambulancias.create');
Route::post('/ambulancias', [AmbulanciaController::class, 'store'])->name('ambulancias.store');

Route::get('/ambulancias', [AmbulanciaController::class, 'showList'])->name('ambulancias.index');
Route::get('/ambulancias/create', [AmbulanciaController::class, 'create'])->name('ambulancias.create');
Route::post('/ambulancias', [AmbulanciaController::class, 'store'])->name('ambulancias.store');

Route::get('/casos', [CasoController::class, 'index'])->name('casos.index');
Route::get('/casos/create', [CasoController::class, 'create'])->name('casos.create');
Route::post('/casos', [CasoController::class, 'store'])->name('casos.store');
Route::get('/dashboard/estatisticas', [DashboardController::class, 'estatisticas']);
