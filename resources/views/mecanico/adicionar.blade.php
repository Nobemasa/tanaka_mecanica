@extends('layouts.main')

@section('title', 'Mecânico - Tanaka')

@section('content')
    <div class='container mt-3'>

        <h1>Mecânicos</h1>
        <hr>

        <nav class="navbar navbar-expand-md navbar-light bg-white">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('mecanico') }}">Lista</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('add_mecanico') }}">Cadastro</a>
                    </li>
                </ul>
            </div>
        </nav>


        @if ($msg ?? '')
            <div class="text-center alert alert-primary"> {{ $msg }}</div>
        @endif
        <div class="card" style="width: 30%; margin-left:auto; margin-right:auto;">
            <div class="card-header">
                Novo Cadastro
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('add_mecanico')}}">
                    @csrf
                    <input type="hidden" name="id" value="{{ $mecanicos->id ?? ''}}">
                    <input type="text" name="nome" class="form-control" value='{{ $mecanicos->nome ?? old('nome') }}' placeholder="nome do mecânico">
                    <small class="form-text text-muted">{{ $errors->has('nome') ? $errors->first('nome') : ''}}</small>
                    <input type="text" name="porcentagem" class="mt-2 form-control" value='{{ $mecanicos->porcentagem ?? old('porcentagem') }}' placeholder="porcentagem">
                    <small class="form-text text-muted">{{ $errors->has('porcentagem') ? $errors->first('porcentagem') : ''}}</small>
                    <button type="submit" class="btn btn-primary mb-2 mt-2 btn-block">Cadastrar</button>
                </form>
            </div>

        </div>
    </div>

@endsection