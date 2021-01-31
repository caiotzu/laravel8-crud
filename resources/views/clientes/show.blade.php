@extends('layouts.app')

@section('content')
    <div class="container">
          @if ($errors->any())
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                <h1>Detalhes do Cliente</h1>
            </div>
            <div class="card-body">
                <table class="table table-striped table-responsive-lg">
                    <tbody>
                        <tr>
                            <th style="width: 25%;">Nome</th>
                            <td>{{ isset($cliente) ? $cliente->nome : '' }}</td>
                        </tr>
                        <tr>
                            <th style="width: 25%;">CPF</th>
                            <td>{{ isset($cliente) ? $cliente->cpf : '' }}</td>
                        </tr>
                        <tr>
                            <th style="width: 25%;">Email</th>
                            <td>{{ isset($cliente) ? $cliente->email : '' }}</td>
                        </tr>
                        <tr>
                            <th style="width: 25%;">Data de Cadastro</th>
                            <td>{{ isset($cliente) ? ( implode('/', array_reverse( explode('-', explode(' ', $cliente->created_at)[0]))).' '.explode(' ', $cliente->created_at)[1]) : '' }}</td>
                        </tr>
                    </tbody>
                </table>
                <hr />
                <div class="row" >
                    <div class="col-12" style="text-align: center;">
                        <a href="{{ route('clientes.edit', ['id' => $cliente->id]) }}" class="btn btn-primary">Editar</a>
                        <a href="/pedidos" type="submit" class="btn btn-secondary">Voltar</a>
                    </div>
                </div>
               
            </div>
        </div>
    </div>
@endsection