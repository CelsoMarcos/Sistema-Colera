@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Casos de Cólera</h1>

    @if (session('sucesso'))
        <div class="alert alert-success">{{ session('sucesso') }}</div>
    @endif

    <a href="{{ route('casos.create') }}" class="btn btn-primary mb-3">Cadastrar Novo Caso</a>

    <table class="table">
        <thead>
            <tr>
                <th>Paciente</th>
                <th>Idade</th>
                <th>Sexo</th>
                <th>Data</th>
                <th>Estado</th>
                <th>Hospital</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($casos as $caso)
                <tr>
                    <td>{{ $caso->paciente_nome }}</td>
                    <td>{{ $caso->idade }}</td>
                    <td>{{ $caso->sexo }}</td>
                    <td>{{ $caso->data_registro }}</td>
                    <td>{{ $caso->estado }}</td>
                    <td>{{ $caso->hospital->nome }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
