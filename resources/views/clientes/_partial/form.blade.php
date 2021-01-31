@csrf
<div class="row">
    <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
        <label >Nome <span style="color: #f00;">*</span> </label>
        <input type="text" name="nome" class="form-control" value="{{ old('nome', isset($cliente) ? $cliente->nome : '') }}" maxlength="100">
    </div>
    <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
        <label >CPF <span style="color: #f00;">*</span></label>
        <input type="text" name="cpf" class="form-control cpf" value="{{ old('cpf', isset($cliente) ? $cliente->cpf : '') }}" maxlength="11">
    </div>
    <div class="form-group col-xs-12 col-sm-12 col-md-4 col-lg-4">
        <label >E-mail <span style="color: #f00;">*</span></label>
        <input type="email" name="email" class="form-control"  value="{{ old('email', isset($cliente) ? $cliente->email : '') }}" maxlength="10">
    </div>
</div>
<hr />
<div class="row" >
    <div class="col-12" style="text-align: center;">
        <button type="submit" class="btn btn-primary">Salvar</button>
        <a href="/clientes" type="submit" class="btn btn-secondary">Cancelar</a>
    </div>
</div>
