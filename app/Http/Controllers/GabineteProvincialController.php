<?php
namespace App\Http\Controllers;

use App\Models\GabineteProvincial;
use Illuminate\Http\Request;

class GabineteProvincialController extends Controller
{
    // Lista todos os gabinetes provinciais com a província associada
    public function index()
    {
        return GabineteProvincial::with('provincia')->get();
    }

    // Registra um novo gabinete provincial
    public function store(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'provincia_id' => 'required|exists:provincias,id'
        ]);

        return GabineteProvincial::create($data);
    }

    // Outros métodos como show, update, destroy podem ser implementados depois se necessário
}
