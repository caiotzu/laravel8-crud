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
                <h1>Listagem de Pedidos 
                    <a href="{{ route('pedidos.create') }}" style="float: right;">
                        <button class="btn btn-primary">Cadastrar</button>
                    </a>
                    <a href="#" style="float: right; margin-right: 15px; display: none" name="btnExcluirAll">
                        <button class="btn btn-danger">Excluir selecionados da página</button>
                    </a>
                </h1>
            </div>
            <div class="card-body table-responsive-lg">
                    
                <table class="table table-striped table-bordered" id="dataTable">
                    <thead>
                        <tr>
                            <th style="text-align: center;">#</th>
                            <th>Cliente</th>
                            <th>Produto</th>
                            <th style="text-align: center;">Qtd. Produto</th>
                            <th>Valor Produto</th>
                            <th>Valor Desconto</th>
                            <th>Total Pedido</th>
                            <th>Status Pedido</th>
                            <th>Data Pedido</th>
                            <th>Editar</th>
                            <th>Excluir</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($pedidos as $pedido)
                        <tr>
                           <td style="text-align: center;">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" name="checkPedido_{{$pedido->id}}">
                                </div>
                            </td>
                            <td><a href="{{ route('clientes.show', ['id' => $pedido->Cliente->id]) }}"> {{ $pedido->Cliente->nome }} </a></td>
                            <td><a href="{{ route('produtos.show', ['id' => $pedido->Produto->id]) }}"> {{ $pedido->Produto->descricao }} </a></td>
                            <td style="text-align: center;">{{ $pedido->quantidade_produto }}</td>
                            <td style="text-align: center;">R$ {{ number_format($pedido->Produto->valor, 2, ',', '.') }}</td>
                            <td style="text-align: center;">R$ {{ number_format($pedido->valor_desconto, 2, ',', '.') }}</td>

                            
                            <td style="text-align: center;">R$ {{ number_format(($pedido->quantidade_produto * $pedido->Produto->valor - $pedido->valor_desconto), 2, ',', '.') }} </td>
                            <td style="text-align: center;">
                                {!! 
                                    $pedido->status == 'Em Aberto' ? 
                                    '<span class="badge badge-info">Em Aberto</span>'
                                    :
                                    ($pedido->status == 'Pago' ?
                                        '<span class="badge badge-success">Pago</span>'
                                        :
                                        '<span class="badge badge-danger">Cancelado</span>'
                                    )
                                !!}
                               
                            </td>      
                            <td>{{ implode('/', array_reverse( explode('-', explode(' ', $pedido->created_at)[0]))).' '.explode(' ', $pedido->created_at)[1] }}</td>
                            <td><a href="{{ route('pedidos.edit', ['id' => $pedido->id]) }}" class="btn btn-primary">Editar</a></td>
                            <td>
                                <form action="{{ route('pedidos.destroy', ['id' => $pedido->id]) }}" method="post">
                                    @csrf
                                    <input type="hidden" name="_method" value="delete">
                                    <button type="submit" class="btn btn-danger" name="btnExcluir">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    
                    </tbody>
                </table>

            </div>

        </div>
    </div>
@endsection

@section('js')
	<script type="text/javascript" src="{{ URL::asset('js/pedido/custom.js') }}"></script>
@endsection