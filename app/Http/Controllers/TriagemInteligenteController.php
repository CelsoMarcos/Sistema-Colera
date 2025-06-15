<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Barryvdh\DomPDF\Facade\Pdf; // Importa a biblioteca PDF no topo

class TriagemInteligenteController extends Controller
{
   public function triar(Request $request)
{
    // Validação dos dados recebidos
    $dados = $request->validate([
        'nome_completo' => 'required|string|max:255',
        'numero_bi' => 'required|string|unique:pacientes',
        'telefone' => 'required|string',
        'sexo' => 'required|in:Masculino,Feminino,Outro',
        'provincia_id' => 'required|exists:provincias,id',
        'sintomas' => 'required|array|min:1',
        'documento' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048' // Valida o tipo e tamanho
    ]);

    // Sintomas chave para definir o estado
    $sintomasChave = ['diarreia', 'vomito', 'febre', 'desidratacao', 'caibras'];
    $sintomasInformados = array_map('strtolower', $dados['sintomas']);
    $comuns = array_intersect($sintomasChave, $sintomasInformados);
    $estado = count($comuns) >= 2 ? 'Suspeito' : 'Descartado';

    // Upload do documento (caso tenha sido enviado)
    $caminhoDocumento = null;
    if ($request->hasFile('documento')) {
        $caminhoDocumento = $request->file('documento')->store('documentos', 'public');
    }

    // Criação do paciente
    $paciente = Paciente::create([
        'nome_completo' => $dados['nome_completo'],
        'numero_bi' => $dados['numero_bi'],
        'telefone' => \Crypt::encryptString($dados['telefone']),
        'sexo' => $dados['sexo'],
        'provincia_id' => $dados['provincia_id'],
        'sintomas' => json_encode($dados['sintomas']),
        'estado' => $estado,
        'documento' => $caminhoDocumento
    ]);

    // Geração do QR Code
    $dadosQR = [
        'nome' => $paciente->nome_completo,
        'BI' => $paciente->numero_bi,
        'telefone' => $dados['telefone'],
        'estado' => $estado
    ];

    $qrCode = base64_encode(
        \QrCode::format('png')->size(200)->generate(json_encode($dadosQR))
    );

    return response()->json([
        'mensagem' => 'Paciente triado com sucesso',
        'paciente' => $paciente,
        'documento_url' => $caminhoDocumento ? asset('storage/' . $caminhoDocumento) : null,
        'qr_code_base64' => $qrCode
    ]);
}
public function gerarFichaPDF($id)
{
    // Busca o paciente com a província
    $paciente = Paciente::with('provincia')->findOrFail($id);

    // Descriptografa o telefone
    $telefone = \Crypt::decryptString($paciente->telefone);

    // Prepara os dados para passar à view
    $dados = [
        'nome_completo' => $paciente->nome_completo,
        'numero_bi'     => $paciente->numero_bi,
        'telefone'      => $telefone,
        'sexo'          => $paciente->sexo,
        'provincia'     => $paciente->provincia->nome ?? 'N/A',
        'estado'        => $paciente->estado,
        'sintomas'      => json_decode($paciente->sintomas, true),
        'qr_code'       => base64_encode(
            \QrCode::format('png')->size(120)->generate(json_encode([
                'nome' => $paciente->nome_completo,
                'BI' => $paciente->numero_bi,
                'telefone' => $telefone,
                'estado' => $paciente->estado
            ]))
        )
    ];

    // Gera o PDF usando uma view personalizada
    $pdf = Pdf::loadView('pdf.ficha-paciente', $dados);

    // Retorna o PDF para download
    return $pdf->download("Ficha_{$paciente->nome_completo}.pdf");
}

}
