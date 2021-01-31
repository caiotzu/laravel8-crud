@csrf
<div class="row">
    <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
        <label >Produto <span style="color: #f00;">*</span> </label>
        <input type="text" name="descricao" class="form-control" value="{{ old('descricao', isset($produto) ? $produto->descricao : '') }}" maxlength="100">
    </div>
    <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
        <label >Valor <span style="color: #f00;">*</span></label>
        <input type="text" name="valor" class="form-control money" value="{{ old('valor', isset($produto) ? $produto->valor : '') }}" maxlength="11">
    </div>
    <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
        <label >Código de Barras <span style="color: #f00;">*</span></label>
        <input type="text" name="codBarras" class="form-control"  value="{{ old('codBarras', isset($produto) ? $produto->codBarras : '') }}" maxlength="20">
    </div>
</div>
<hr />
<div class="row" >
    <div class="col-12" style="text-align: center;">
        <button type="submit" class="btn btn-primary">Salvar</button>
        <a href="/produtos" type="submit" class="btn btn-secondary">Cancelar</a>
    </div>
</div>
