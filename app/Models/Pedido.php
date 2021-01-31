<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;
    protected $table = 'tbl_pedido';
    protected $fillable = ['cliente_id', 'produto_id', 'status', 'quantidade_produto', 'desconto', 'valor_desconto'];

    public function Cliente(){
        // Model que esta referenciando / id do this model(chave estrangeira) / id da tabela referenciada (chave primaria)
        return $this->belongsTo(Cliente::class, 'cliente_id', 'id');
    }

    public function Produto(){
        // Model que esta referenciando / id do this model(chave estrangeira) / id da tabela referenciada (chave primaria)
        return $this->belongsTo(Produto::class, 'produto_id', 'id');
    }
}
