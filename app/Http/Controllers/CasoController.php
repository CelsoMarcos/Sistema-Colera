<?php

namespace App\Http\Controllers;

use App\Models\Caso;
use App\Models\Hospital;
use Illuminate\Http\Request;

class CasoController extends Controller
{
    // Listar casos
    public function index()
    {
        $casos = Caso::with('hospital')->get();
        return view('casos.index', compact('casos'));
    }

    // Formulário de cadastro
    public function create()
    {
        $hospitais = Hospital::all();
        return view('casos.create', compact('hospitais'));
    }

    // Armazenar novo caso
    public function store(Request $request)
    {
        $request->validate([
            'paciente_nome' => 'required|string|max:255',
            'idade' => 'required|integer',
            'sexo' => 'required|in:Masculino,Feminino',
            'data_registro' => 'required|date',
            'hospital_id' => 'required|exists:hospitals,id',
            'estado' => 'required|in:Estável,Crítico,Recuperado,Falecido',
        ]);

        Caso::create($request->all());

        return redirect()->route('casos.index')->with('sucesso', 'Caso registrado com sucesso!');
    }
}
