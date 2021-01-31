<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_pedido', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cliente_id')->unsigned();
            $table->foreign('cliente_id')
                ->references('id')
                ->on('tbl_cliente');
            $table->bigInteger('produto_id')->unsigned();
            $table->foreign('produto_id')
                ->references('id')
                ->on('tbl_produto');
            $table->enum('status', ['Em Aberto', 'Pago', 'Cancelado']);
            $table->integer('quantidade_produto');
            $table->boolean('desconto');
            $table->decimal('valor_desconto', 9, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_pedido');
    }
}
