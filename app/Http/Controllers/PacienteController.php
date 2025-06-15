<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use Illuminate\Http\Request;

class PacienteController extends Controller
{
   public function __construct()
{
    // ✅ Apenas protege métodos sensíveis
    $this->middleware('auth:sanctum')->only(['index', 'store', 'update', 'destroy']);

    $this->middleware('permission:registar_pacientes', ['only' => ['store']]);
    $this->middleware('permission:editar_todos_pacientes', ['only' => ['update', 'destroy']]);
    $this->middleware('permission:alterar_estado_paciente', ['only' => ['atualizarEstado']]);

}
// 🟦 Verifica o estado do paciente com base no número de BI
public function verificarEstadoPorBI($bi)
{
    // Procura o paciente pelo número de BI
    $paciente = Paciente::where('numero_bi', $bi)->first();

    if (!$paciente) {
        // 🟥 Se não encontrar, retorna erro
        return response()->json([
            'mensagem' => 'Paciente não encontrado.'
        ], 404);
    }

    // 🟩 Retorna o estado (ex: Suspeito, Confirmado, Descartado)
    return response()->json([
        'nome_completo' => $paciente->nome_completo,
        'estado' => $paciente->estado
    ]);
}


    // ✅ Validação do número de BI e telefone individualmente
    public function validarTelefoneENumeroBI(Request $request)
    {
        $request->validate([
            'numero_bi' => 'required|unique:pacientes|regex:/^\d{9}[A-Z]{2}\d{3}$/',
            'telefone' => 'required|regex:/^9[123456]\d{7}$/'
        ]);

        return response()->json([
            'mensagem' => 'Número de BI e telefone válidos!'
        ]);
    }

    // ✅ Lista todos os pacientes com sua província
    public function index()
    {
        $pacientes = \App\Models\Paciente::with('provincia')->latest()->get();
        return response()->json($pacientes);
    }

    // ✅ Regista um novo paciente
    public function store(Request $request)
    {
        $dados = $request->validate([
            'nome_completo' => 'required|string|max:255',
            'numero_bi' => 'required|string|unique:pacientes',
            'telefone' => 'required|string',
            'sexo' => 'required|in:Masculino,Feminino,Outro',
            'provincia_id' => 'required|exists:provincias,id',
            'sintomas' => 'required|string',
            'estado' => 'required|in:Suspeito,Confirmado,Descartado'
        ]);

        $paciente = Paciente::create($dados);

        return response()->json($paciente, 201);
    }

    // ✅ Detalhes de um paciente específico
    public function show(Paciente $paciente)
    {
        return $paciente->load('provincia');
    }

    // ✅ Atualiza dados de um paciente
    public function update(Request $request, Paciente $paciente)
    {
        $dados = $request->validate([
            'nome_completo' => 'sometimes|string|max:255',
            'numero_bi' => 'sometimes|string|unique:pacientes,numero_bi,' . $paciente->id,
            'telefone' => 'sometimes|string',
            'estado' => 'sometimes|in:Suspeito,Confirmado,Descartado'
        ]);

        $paciente->update($dados);

        return response()->json($paciente);
    }

    // ✅ Apaga um paciente
    public function destroy(Paciente $paciente)
    {
        $paciente->delete();
        return response()->json(null, 204);
    }
    /**
 * Lista pacientes filtrados por estado: Suspeito, Confirmado ou Descartado
 */
public function listarPorEstado($estado)
{
    // Lista de estados permitidos
    $estadosValidos = ['Suspeito', 'Confirmado', 'Descartado'];

    if (!in_array($estado, $estadosValidos)) {
        return response()->json([
            'erro' => 'Estado inválido. Use: Suspeito, Confirmado ou Descartado.'
        ], 400);
    }

    // Buscar pacientes com o estado informado
    $pacientes = Paciente::where('estado', $estado)
        ->with('provincia')
        ->latest()
        ->get();

    return response()->json($pacientes);
}
/**
 * Atualiza apenas o estado de um paciente.
 * Requer permissão: atualizar_estado_paciente
 */
public function atualizarEstado(Request $request, $id)
{
    // Verifica se o usuário tem permissão
    if (!auth()->user()->can('alterar_estado_paciente')) {
        return response()->json([
            'mensagem' => 'Você não tem permissão para atualizar o estado do paciente.'
        ], 403);
    }

    // Valida se o estado enviado é válido
    $dados = $request->validate([
        'estado' => 'required|in:Suspeito,Confirmado,Descartado'
    ]);

    // Busca o paciente
    $paciente = Paciente::find($id);

    if (!$paciente) {
        return response()->json([
            'mensagem' => 'Paciente não encontrado.'
        ], 404);
    }

    // Atualiza o estado
    $paciente->estado = $dados['estado'];
    $paciente->save();

    return response()->json([
        'mensagem' => 'Estado do paciente atualizado com sucesso!',
        'paciente' => $paciente
    ]);
}


    
}
