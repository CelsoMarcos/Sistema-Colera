@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Cadastrar Ambulância</h2>

    <form action="{{ route('ambulancias.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nome" class="form-label">Nome:</label>
            <input type="text" name="nome" id="nome" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="matricula" class="form-label">Matrícula:</label>
            <input type="text" name="matricula" id="matricula" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="hospital_id" class="form-label">Hospital:</label>
            <select name="hospital_id" id="hospital_id" class="form-control" required>
                <option value="">-- Selecione --</option>
                @foreach($hospitais as $hosp)
                    <option value="{{ $hosp->id }}">{{ $hosp->nome }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status:</label>
            <select name="status" id="status" class="form-control" required>
                <option value="Disponível">Disponível</option>
                <option value="Ocupada">Ocupada</option>
                <option value="Em Atendimento">Em Atendimento</option>
                <option value="Indisponível">Indisponível</option>
                <option value="Manutenção">Manutenção</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="localizacao" class="form-label">Localização:</label>
            <input type="text" name="localizacao" id="localizacao" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Cadastrar</button>
    </form>
</div>
@endsection
