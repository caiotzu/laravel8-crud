<?php

namespace App\Http\Controllers;

use App\Http\Requests\PedidoRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\models\Cliente;
use App\models\Produto;
use App\models\Pedido;


class PedidoController extends Controller
{

    /**
     * @var \App\Models\Pedido
     * @var \App\Models\Cliente
     * @var \App\Models\Produto
    */
    protected $pedido, $cliente, $produto;


    public function __construct(Pedido $pedido, Cliente $cliente, Produto $produto)
    {
        $this->url = 'pedidos';
        $this->pedido = $pedido;
        $this->cliente = $cliente;
        $this->produto = $produto;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pedidos = $this->pedido->with('Cliente', 'Produto')->get();
        return view($this->url.'.index', compact('pedidos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clientes = $this->cliente::all();
        $produtos = $this->produto::all();

        return view($this->url.'.create', compact('clientes', 'produtos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\PedidoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PedidoRequest $request)
    {
        try {
            // Ajuste de campos
            $request['desconto'] = isset($request['desconto']) ? true : false;
            $request['valor_desconto'] = ($request['valor_desconto'] == null || $request['valor_desconto'] == '') ? 0 : ( $request['desconto'] ? $request['valor_desconto'] : 0 );
            
            $pedido = new Pedido();
            $pedido->fill($request->all());
            $pedido->save();

            return redirect()->route($this->url.'.index')->with('successMsg', 'Pedido cadastrado com sucesso!');
            
        } catch(\Exception $e) {
            return redirect()->route($this->url.'.index')->withErrors('Não foi possível cadastrar o pedido');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $clientes = $this->cliente::all();
            $produtos = $this->produto::all();
            $pedido   = $this->pedido->findOrFail($id);

            return view($this->url.'.edit', compact('clientes', 'produtos', 'pedido'));
        } catch(\Exception $e) {
            return redirect()->route($this->url.'.index')->withErrors('Pedido não encontrado');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\PedidoRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PedidoRequest $request, $id)
    {
        try {
            // Ajuste de campos
            $request['desconto'] = isset($request['desconto']) ? true : false;
            $request['valor_desconto'] = ($request['valor_desconto'] == null || $request['valor_desconto'] == '') ? 0 : ( $request['desconto'] ? $request['valor_desconto'] : 0 );

            $pedido = $this->pedido->findOrFail($id);
            $pedido->fill($request->all());
            $pedido->save();
            return redirect()->route($this->url.'.index')->with('successMsg', 'Pedido atualizado com sucesso!');

        } catch(\Exception $e) {
            return redirect()->route($this->url.'.index')->withErrors('Não foi possível atualizar o pedido');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $pedido = $this->pedido->findOrFail($id);
            $pedido->delete();

            return redirect()->route($this->url.'.index')->with('successMsg', 'Pedido excluido com sucesso!');;

        } catch(\Exception $e) {
            return redirect()->route($this->url.'.index')->withErrors('Não foi possível excluir o pedido');
        }
    }


    public function destroyAll(Request $request){

        // Pega apenas o ID do pedido
        $arrIds = [];
        foreach($request->all() as $v) {
            array_push($arrIds, str_replace('checkPedido_', '', $v) );
        }

        // Inicia trasação para exclusão multipla
        DB::beginTransaction();

            // Faz a exclusão dos pedidos
            foreach($arrIds as $id) {
                try{
                    $pedido = (new Pedido)->findOrFail($id);
                    // Exclui a colection
                    foreach ($pedido as $pedido) {
                        $pedido->delete();
                    }
                } catch(\Exception $e) {
                    DB::rollback();
                    // dd($e->getMessage());
                    if(preg_match('/Foreign key violation/', $e->getMessage()))
                        return ['error' => true, 'msg' => 'O pedido não pode ser excluído, pois já tem vinculo com algum registro'];
                    else
                        return ['error' => true, 'msg' => 'Ocorreu um problema ao excluir algum dos pedidos selecionados'];
                }
            }
        // Se todas as exclusões deram certo então da o commit
        DB::commit();
        return ['error' => false, 'msg' => 'Todos os pedidos selecionados foram excluidos com sucesso'];
    }
}
