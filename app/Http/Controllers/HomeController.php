<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Pedido;

class HomeController extends Controller
{
    /**
     * @var \App\Models\Produto
    */
    protected $pedido;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Pedido $pedido)
    {
        $this->middleware('auth');
        $this->pedido = new Pedido;
        $this->url = 'home';
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Dia atual
            $dia_ini = date('Y-m-d').' 00:00:00';
            $dia_fim = date('Y-m-d').' 23:59:59';

        // Semana Atual - Domingo á Domingo
            $dia = date('w');
            $semana_ini = date('Y-m-d', strtotime('-'.$dia.' days')).' 00:00:00';
            $semana_fim = date('Y-m-d', strtotime('+'.(6-$dia).' days')).' 23:59:59';

        // Mês atual
            $mes_ini = date('Y-m-01').' 00:00:00';
            $mes_fim = date('Y-m-t').' 23:59:59';

        // Consulta quantidade de pedidos no período
            $pedidos_dia = $this->pedido->where('created_at', '>=', $dia_ini)->where('created_at', '<=', $dia_fim)->get();
            $pedidos_semana = $this->pedido->where('created_at', '>=', $semana_ini)->where('created_at', '<=', $semana_fim)->get();
            $pedidos_mes = $this->pedido->where('created_at', '>=', $mes_ini)->where('created_at', '<=', $mes_fim)->get();

        // Array de retorno
            $arrData = [
                'pedidos_dia' => count($pedidos_dia),
                'pedidos_semana' => count($pedidos_semana),
                'pedidos_mes' => count($pedidos_mes)
            ];

        return view($this->url, compact('arrData'));
    }
}
