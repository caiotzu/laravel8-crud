@extends('layouts.app')

@section('content')
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="card">
            <div class="card-header">
                <h1>Cadastro de Cliente</h1>
            </div>
            <div class="card-body">
                <form action="{{ route('clientes.store') }}" method="post">
                    @include('clientes._partial.form')
                </form>
            </div>
        </div>
    </div>
@endsection