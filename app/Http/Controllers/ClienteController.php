<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClienteRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\models\Cliente;

class ClienteController extends Controller
{

    /**
     * @var \App\Models\Cliente
    */
    protected $cliente;


    public function __construct(Cliente $cliente)
    {
        $this->url = 'clientes';
        $this->cliente = $cliente;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = $this->cliente::all();
        return view($this->url.'.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->url.'.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\ClienteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClienteRequest $request)
    {
        try {
            // Limpa os campos
            $request['cpf'] =  preg_replace('/[^0-9]/', '', $request['cpf']); 

            $cliente = new Cliente();
            $cliente->fill($request->all());
            $cliente->save();

            return redirect()->route($this->url.'.index')->with('successMsg', 'Cliente cadastrado com sucesso!');
        } catch(\Exception $e) {
            return redirect()->route($this->url.'.index')->withErrors('Não foi possível cadastrar o cliente');
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
        try {
            $cliente = $this->cliente->findOrFail($id);
            return view($this->url.'.show', compact('cliente'));

        } catch(\Exception $e) {
            return redirect()->route($this->url.'.index')->withErrors('Cliente não encontrado');
        }
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
            $cliente = $this->cliente->findOrFail($id);
            return view($this->url.'.edit', compact('cliente'));
        } catch(\Exception $e) {
            return redirect()->route($this->url.'.index')->withErrors('Cliente não encontrado');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\ClienteRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ClienteRequest $request, $id)
    {
        try{
            $cliente = $this->cliente->findOrFail($id);
            $cliente->fill($request->all());
            $cliente->save();
            return redirect()->route($this->url.'.index')->with('successMsg', 'Cliente atualizado com sucesso!');
        } catch(\Exception $e) {
            return redirect()->route($this->url.'.index')->withErrors('Não foi possível atualizar o cliente');
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
            $cliente = $this->cliente->findOrFail($id);
            $cliente->delete();

            return redirect()->route($this->url.'.index')->with('successMsg', 'Cliente '.$cliente->nome.' excluido com sucesso!');

        } catch(\Exception $e) {
            if(preg_match('/Foreign key violation/', $e->getMessage()))
                return redirect()->route($this->url.'.index')->withErrors('O cliente'.$cliente->nome.' não pode ser excluído, pois já tem vinculo com pedido');
            else
                return redirect()->route($this->url.'.index')->withErrors('Não foi possível excluir o cliente');
        }
    }

    public function destroyAll(Request $request){

        // Pega apenas o ID do cliente
        $arrIds = [];
        foreach($request->all() as $v) {
            array_push($arrIds, str_replace('checkCliente_', '', $v) );
        }

        // Inicia trasação para exclusão multipla
        DB::beginTransaction();

            // Faz a exclusão dos clientes
            foreach($arrIds as $id) {
                try{
                    $cliente = (new Cliente)->findOrFail($id);
                    // Exclui a colection
                    foreach ($cliente as $cliente) {
                        $cliente->delete();
                    }
                } catch(\Exception $e) {
                    DB::rollback();
                    // dd($e->getMessage());
                    if(preg_match('/Foreign key violation/', $e->getMessage()))
                        return ['error' => true, 'msg' => 'O cliente '.$cliente->nome.' não pode ser excluído, pois já tem vinculo com pedido'];
                    else
                        return ['error' => true, 'msg' => 'Ocorreu um problema ao excluir algum dos clientes selecionados'];
                }
            }
        // Se todas as exclusões deram certo então da o commit
        DB::commit();
        return ['error' => false, 'msg' => 'Todos os clientes selecionados foram excluidos com sucesso'];
    }
}
