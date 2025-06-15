@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Cadastrar Novo Caso de Cólera</h1>

    <form action="{{ route('casos.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Nome do Paciente</label>
            <input type="text" name="paciente_nome" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Idade</label>
            <input type="number" name="idade" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Sexo</label>
            <select name="sexo" class="form-control" required>
                <option value="Masculino">Masculino</option>
                <option value="Feminino">Feminino</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Data de Registro</label>
            <input type="date" name="data_registro" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Estado do Paciente</label>
            <select name="estado" class="form-control" required>
                <option value="Estável">Estável</option>
                <option value="Crítico">Crítico</option>
                <option value="Recuperado">Recuperado</option>
                <option value="Falecido">Falecido</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Hospital</label>
            <select name="hospital_id" class="form-control" required>
                @foreach ($hospitais as $hospital)
                    <option value="{{ $hospital->id }}">{{ $hospital->nome }}</option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-success">Salvar</button>
    </form>
</div>
@endsection
