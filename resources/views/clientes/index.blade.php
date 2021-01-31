@extends('layouts.app')
@section('content')
    <div class="container" id="contentMain">

        @if(isset($_GET['msg']))
            <div class="alert alert-success">
               <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <ul>
                    <li>{{$_GET['msg']}}</li>
                </ul>
            </div>
        @endif

        @if(session('successMsg'))
            <div class="alert alert-success">
               <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <ul>
                    <li>{{session('successMsg')}}</li>
                </ul>
            </div>
        @endif

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
                <h1>Listagem de Clientes
                    <a href="{{ route('clientes.create') }}" style="float: right;">
                        <button class="btn btn-primary">Cadastrar</button>
                    </a>

                    <a href="#" style="float: right; margin-right: 15px; display: none" name="btnExcluirAll">
                        <button class="btn btn-danger">Excluir selecionados da página</button>
                    </a>
                </h1>
            </div>
            <div class="card-body table-responsive-lg">  
                <table id="dataTable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th style="text-align: center;">#</th>
                            <th>Nome</th>
                            <th>CPF</th>
                            <th>E-mail</th>
                            <th>Data Cadastro</th>
                            <th>Editar</th>
                            <th>Excluir</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($clientes) > 0)
                            @foreach($clientes as $cliente)
                                <tr>
                                    <td style="text-align: center;">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" name="checkCliente_{{$cliente->id}}">
                                        </div>
                                    </td>
                                    <td>{{ $cliente->nome }}</td>
                                    <td>{{ preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $cliente->cpf) }}</td>
                                    <td>{{ $cliente->email }}</td>
                                    <td>{{ implode('/', array_reverse( explode('-', explode(' ', $cliente->created_at)[0]))).' '.explode(' ', $cliente->created_at)[1] }}</td>
                                    <td>
                                        <a href="{{ route('clientes.edit', ['id' => $cliente->id]) }}" class="btn btn-primary">Editar</a>
                                    </td>
                                    <td>
                                        <form action="{{ route('clientes.destroy', ['id' => $cliente->id]) }}" method="post">
                                            @csrf
                                            <input type="hidden" name="_method" value="delete">
                                            <button type="submit" class="btn btn-danger" name="btnExcluir" data-nome="{{ $cliente->nome }}">Excluir</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr style="text-align: center;">
                                <td colspan="7">Nenhum registro encontrado</td>
                            </tr>
                        @endif
                    
                    </tbody>
                </table>

            </div>

        </div>
    </div>
  

@endsection

@section('js')
	<script type="text/javascript" src="{{ URL::asset('js/cliente/custom.js') }}"></script>
@endsection