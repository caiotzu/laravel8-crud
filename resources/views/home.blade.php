@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="text-align: center; font-size: 30px;">{{ __('Dashboard Pedidos') }}</div>

                <div class="card-body"> 
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row" style="text-align: center;">
                        <div class="col-xs-12 col-sm-12 col-md-12    col-lg-4">
                            <div class="card text-white bg-info mb-3" style="max-width: 18rem;">
                                <div class="card-header">Pedidos Realizados Hoje</div>
                                <div class="card-body">
                                    <h5 class="card-title">{{ $arrData['pedidos_dia'] }}</h5>
                                </div>
                            </div>
                        </div>
                         <div class="col-xs-12 col-sm-12 col-md-12   col-lg-4">
                            <div class="card text-white bg-warning mb-3" style="max-width: 18rem;">
                                <div class="card-header">Pedidos Realizados na Semana</div>
                                <div class="card-body">
                                    <h5 class="card-title">{{ $arrData['pedidos_semana'] }}</h5>
                                </div>
                            </div>
                        </div>
                         <div class="col-xs-12 col-sm-12 col-md-12   col-lg-4">
                            <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                                <div class="card-header">Pedidos Realizados no Mês</div>
                                <div class="card-body">
                                    <h5 class="card-title">{{ $arrData['pedidos_mes'] }}</h5>
                                </div>
                            </div>
                        </div>                  
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
