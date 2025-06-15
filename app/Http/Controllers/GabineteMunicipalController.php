<?php

namespace App\Http\Controllers;

use App\Models\GabineteMunicipal;
use Illuminate\Http\Request;

class GabineteMunicipalController extends Controller
{
    // Lista todos os gabinetes municipais com o gabinete provincial associado
    public function index()
    {
        return GabineteMunicipal::with('gabineteProvincial')->get();
    }

    // Registra um novo gabinete municipal
    public function store(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'municipio' => 'required|string|max:255',
            'gabinete_provincial_id' => 'required|exists:gabinete_provincials,id' // Corrigido aqui
        ]);

        return GabineteMunicipal::create($data);
    }

    // Atualizar um gabinete municipal (opcional)
    public function update(Request $request, GabineteMunicipal $gabineteMunicipal)
    {
        $data = $request->validate([
            'nome' => 'sometimes|string|max:255',
            'municipio' => 'sometimes|string|max:255',
            'gabinete_provincial_id' => 'sometimes|exists:gabinete_provincials,id'
        ]);

        $gabineteMunicipal->update($data);

        return response()->json(['mensagem' => 'Gabinete municipal atualizado com sucesso!']);
    }

    // Remover um gabinete municipal (opcional)
    public function destroy(GabineteMunicipal $gabineteMunicipal)
    {
        $gabineteMunicipal->delete();

        return response()->json(['mensagem' => 'Gabinete municipal removido com sucesso!']);
    }
}
