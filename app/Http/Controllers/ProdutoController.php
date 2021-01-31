<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProdutoRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\models\Produto;


class ProdutoController extends Controller
{

    /**
     * @var \App\Models\Produto
    */
    protected $produto;


    public function __construct(Produto $produto)
    {
        $this->url = 'produtos';
        $this->produto = $produto;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produtos = $this->produto::all();
        return view($this->url.'.index', compact('produtos'));
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
     * @param  \Illuminate\Http\ProdutoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProdutoRequest $request)
    {
        try {
            $produto = new Produto();
            $produto->fill($request->all());
            $produto->save();

            return redirect()->route($this->url.'.index')->with('successMsg', 'Produto cadastrado com sucesso!');
        } catch(\Exception $e) {
            return redirect()->route($this->url.'.index')->withErrors('Não foi possível cadastrar o produto');
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
            $produto = $this->produto->findOrFail($id);
            return view($this->url.'.show', compact('produto'));

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
            $produto = $this->produto->findOrFail($id);
            return view($this->url.'.edit', compact('produto'));
        } catch(\Exception $e) {
            return redirect()->route($this->url.'.index')->withErrors('Produto não encontrado');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\ProdutoRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProdutoRequest $request, $id)
    {
        try{
            $produto = $this->produto->findOrFail($id);
            $produto->fill($request->all());
            $produto->save();
            return redirect()->route($this->url.'.index')->with('successMsg', 'Produto atualizado com sucesso!');
        } catch(\Exception $e) {
            return redirect()->route($this->url.'.index')->withErrors('Não foi possível atualizar o produto');
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
            $produto = $this->produto->findOrFail($id);
            $produto->delete();

            return redirect()->route($this->url.'.index')->with('successMsg', 'O produto: '.$produto->descricao.' foi excluido com sucesso!');;

        } catch(\Exception $e) {
            return redirect()->route($this->url.'.index')->withErrors('Não foi possível excluir o produto');
        }
    }

    public function destroyAll(Request $request){

        // Pega apenas o ID do produto
        $arrIds = [];
        foreach($request->all() as $v) {
            array_push($arrIds, str_replace('checkProduto_', '', $v) );
        }

        // Inicia trasação para exclusão multipla
        DB::beginTransaction();

            // Faz a exclusão dos produto
            foreach($arrIds as $id) {
                try{
                    $produto = (new Produto)->findOrFail($id);
                    // Exclui a colection
                    foreach ($produto as $produto) {
                        $produto->delete();
                    }
                } catch(\Exception $e) {
                    DB::rollback();
                    // dd($e->getMessage());
                    if(preg_match('/Foreign key violation/', $e->getMessage()))
                        return ['error' => true, 'msg' => 'O produto '.$produto->descricao.' não pode ser excluído, pois já tem vinculo com pedido'];
                    else
                        return ['error' => true, 'msg' => 'Ocorreu um problema ao excluir algum dos produtos selecionados'];
                }
            }
        // Se todas as exclusões deram certo então da o commit
        DB::commit();
        return ['error' => false, 'msg' => 'Todos os produtos selecionados foram excluidos com sucesso'];
    }
}
