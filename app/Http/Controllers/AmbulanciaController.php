<?php

namespace App\Http\Controllers;

use App\Models\Ambulancia;
use App\Models\Hospital;
use Illuminate\Http\Request;

class AmbulanciaController extends Controller
{
    // ✅ API: Listar todas as ambulâncias (JSON)
    public function index()
    {
        // Retorna os dados em formato JSON para APIs
        return Ambulancia::with('hospital')->get();
    }

    // ✅ FRONTEND: Listar ambulâncias com Blade
    public function showList()
    {
        $ambulancias = Ambulancia::with('hospital')->get();
        return view('ambulancias.index', compact('ambulancias'));
    }

    // ✅ FRONTEND: Formulário de cadastro
    public function create()
    {
        $hospitais = Hospital::all();
        return view('ambulancias.create', compact('hospitais'));
    }

    // ✅ API + FORM: Cadastrar nova ambulância
    public function store(Request $request)
    {
        $dados = $request->validate([
            'nome' => 'required|string|max:255',
            'matricula' => 'required|string|unique:ambulancias',
            'hospital_id' => 'required|exists:hospitals,id',
            'status' => 'required|in:Disponível,Ocupada,Indisponível,Em Atendimento,Manutenção',
            'localizacao' => 'nullable|string|max:255'
        ]);

        $ambulancia = Ambulancia::create($dados);

        // Retorna JSON se for API
        if ($request->expectsJson()) {
            return response()->json([
                'mensagem' => 'Ambulância registrada com sucesso!',
                'ambulancia' => $ambulancia
            ], 201);
        }

        // Ou redireciona no caso do frontend
        return redirect()->route('ambulancias.index')->with('success', 'Ambulância registrada com sucesso!');
    }

    // ✅ API: Atualizar ambulância
    public function update(Request $request, Ambulancia $ambulancia)
    {
        $dados = $request->validate([
            'nome' => 'sometimes|string|max:255',
            'matricula' => 'sometimes|string|unique:ambulancias,matricula,' . $ambulancia->id,
            'hospital_id' => 'sometimes|exists:hospitals,id',
            'status' => 'sometimes|in:Disponível,Ocupada,Indisponível,Em Atendimento,Manutenção',
            'localizacao' => 'nullable|string|max:255'
        ]);

        $ambulancia->update($dados);

        return response()->json([
            'mensagem' => 'Ambulância atualizada com sucesso!',
            'ambulancia' => $ambulancia
        ]);
    }

    // ✅ API: Deletar ambulância
    public function destroy(Ambulancia $ambulancia)
    {
        $ambulancia->delete();

        return response()->json(['mensagem' => 'Ambulância removida com sucesso.']);
    }
}
