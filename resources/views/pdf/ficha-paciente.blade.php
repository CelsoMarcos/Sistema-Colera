<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Ficha do Paciente</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 14px; }
        h2 { text-align: center; }
        table { width: 100%; margin-top: 20px; }
        td { padding: 5px; }
        .qr { text-align: center; margin-top: 30px; }
    </style>
</head>
<body>
    <h2>Ficha do Paciente Triado</h2>
    <table>
        <tr><td><strong>Nome:</strong></td><td>{{ $nome_completo }}</td></tr>
        <tr><td><strong>BI:</strong></td><td>{{ $numero_bi }}</td></tr>
        <tr><td><strong>Telefone:</strong></td><td>{{ $telefone }}</td></tr>
        <tr><td><strong>Sexo:</strong></td><td>{{ $sexo }}</td></tr>
        <tr><td><strong>Província:</strong></td><td>{{ $provincia }}</td></tr>
        <tr><td><strong>Estado:</strong></td><td>{{ $estado }}</td></tr>
        <tr>
            <td><strong>Sintomas:</strong></td>
            <td>
                <ul>
                    @foreach($sintomas as $sintoma)
                        <li>{{ ucfirst($sintoma) }}</li>
                    @endforeach
                </ul>
            </td>
        </tr>
    </table>

    <div class="qr">
        <p><strong>QR Code</strong></p>
        <img src="data:image/png;base64,{{ $qr_code }}" alt="QR Code">
    </div>
</body>
</html>
