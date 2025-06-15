@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Lista de Ambulâncias</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('ambulancias.create') }}" class="btn btn-primary mb-3">Cadastrar Nova Ambulância</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Matrícula</th>
                <th>Hospital</th>
                <th>Status</th>
                <th>Localização</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ambulancias as $amb)
            <tr>
                <td>{{ $amb->nome }}</td>
                <td>{{ $amb->matricula }}</td>
                <td>{{ $amb->hospital->nome }}</td>
                <td>{{ $amb->status }}</td>
                <td>{{ $amb->localizacao }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
