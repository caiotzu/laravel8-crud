@csrf
<div class="row">
    
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
        <label class="control-label">Cliente <span style="color: #f00;">*</span></label>
        <select name="cliente_id" class="form-control select2">
        @if(isset($clientes))
            @foreach($clientes as $cliente)
                @if(isset($pedido) && $pedido->cliente_id == $cliente->id)
                    <option value="{{ $cliente->id }}" selected>{{ $cliente->nome }}</option>
                @else
                    <option value="{{ $cliente->id }}" {{ old('cliente_id') == $cliente->id ? 'selected' : '' }} >{{ $cliente->nome }}</option>
                @endif
            @endforeach
        @else
            <option value="">Nenhuma cliente encontrado</option>
        @endif
        </select>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
        <label class="control-label">Produto <span style="color: #f00;">*</span></label>
        <select name="produto_id" class="form-control select2">
        @if(isset($produtos))
            @foreach($produtos as $produto)
                @if(isset($pedido) && $pedido->produto_id == $produto->id)
                    <option value="{{ $produto->id }}" selected>{{ $produto->descricao }}</option>
                @else
                    <option value="{{ $produto->id }}" {{ old('produto_id') == $produto->id ? 'selected' : '' }}>{{ $produto->descricao }}</option>
                @endif
            @endforeach
        @else
            <option value="">Nenhuma produto encontrado</option>
        @endif
        </select>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
        <label class="control-label">status <span style="color: #f00;">*</span></label>
        <select name="status" class="form-control select2">
            <option value="Em Aberto" {{ !isset($pedido) ? 'selected' : '' }} {{ isset($pedido) && $pedido->status == 'Em Aberto' ? 'selected' : '' }} {{ old('status') == 'Em Aberto' ? 'selected' : '' }} >Em Aberto</option>
            <option value="Pago" {{ isset($pedido) && $pedido->status == 'Pago' ? 'selected' : ''}} {{ old('status') == 'Pago' ? 'selected' : '' }}>Pago</option>
            <option value="Cancelado" {{ isset($pedido) && $pedido->status == 'Cancelado' ? 'selected' : ''}} {{ old('status') == 'Cancelado' ? 'selected' : '' }}>Cancelado</option>
        </select>
    </div>

    <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-4">
        <label >Quantidade do produto <span style="color: #f00;">*</span> </label>
        <input type="text" name="quantidade_produto" class="form-control" value="{{ old('quantidade_produto', isset($pedido) ? $pedido->quantidade_produto : '') }}">
    </div>

    <div class="col-12">
        <div class="form-check col-12">
            <input class="form-check-input" type="checkbox" id="desconto" name="desconto" @if(isset($pedido) && $pedido->desconto) checked @endif>
            <label class="form-check-label" for="desconto">
                Pedido possiu desconto ?
            </label>
        </div>
    </div>

</div>

<div class="row" id="div_desconto" @if(!isset($pedido) || $pedido->desconto == false) style="display:none;" @endif >
    <div class="form-group col-xs-12 col-sm-12 col-md-6 col-lg-4">
        <label >Valor Desconto</label>
        <input type="text" name="valor_desconto" class="form-control money" value="{{ old('valor_desconto', isset($pedido) ? $pedido->valor_desconto : '') }}" maxlength="11">
    </div>
</div>


<hr />
<div class="row">
    <div class="col-12" style="text-align: center;">
        <button type="submit" class="btn btn-primary">Salvar</button>
        <a href="/pedidos" type="submit" class="btn btn-secondary">Cancelar</a>
    </div>
</div>

@section('js')
	<script type="text/javascript" src="{{ URL::asset('js/pedido/custom.js') }}"></script>
@endsection