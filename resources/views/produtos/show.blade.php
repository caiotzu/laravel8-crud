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
                <h1>Detalhes do Produto</h1>
            </div>
            <div class="card-body">
                <table class="table table-striped table-responsive-lg">
                    <tbody>
                        <tr>
                            <th style="width: 25%;">Produto</th>
                            <td>{{ isset($produto) ? $produto->descricao : '' }}</td>
                        </tr>
                        <tr>
                            <th style="width: 25%;">valor</th>
                            <td>R$ {{ isset($produto) ? number_format($produto->valor, 2, ',', '.') : '' }}</td>
                        </tr>
                        <tr>
                            <th style="width: 25%;">Código de Barras</th>
                            <td>{{ isset($produto) ? $produto->codBarras : '' }}</td>
                        </tr>
                        <tr>
                            <th style="width: 25%;">Data de Cadastro</th>
                            <td>{{ isset($produto) ? ( implode('/', array_reverse( explode('-', explode(' ', $produto->created_at)[0]))).' '.explode(' ', $produto->created_at)[1]) : '' }}</td>
                        </tr>
                    </tbody>
                </table>
                <hr />
                <div class="row" >
                    <div class="col-12" style="text-align: center;">
                        <a href="{{ route('produtos.edit', ['id' => $produto->id]) }}" class="btn btn-primary">Editar</a>
                        <a href="/pedidos" type="submit" class="btn btn-secondary">Voltar</a>
                    </div>
                </div>
               
            </div>
        </div>
    </div>
@endsection