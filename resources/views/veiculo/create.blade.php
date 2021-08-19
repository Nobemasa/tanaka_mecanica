@extends('layouts.main')

@section('title', 'Cadastro de Veículos - Tanaka')

@section('content')
    <div class='container mt-3'>

        <h1>Veículos</h1>
        <hr>

        {{-- menu de navegação --}}
        @component('veiculo.menu')
        @endcomponent


        @if ($msg ?? '')
            <div class="text-center alert alert-primary"> {{ $msg }}</div>
        @endif
        <div class="card" style="width: 30%; margin-left:auto; margin-right:auto;">
            <div class="card-header">
                Novo Cadastro
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('veiculo.store')}}">
                    @csrf
                    <input type="hidden" name="id" value="{{ $marca->id ?? ''}}">
                    <input type="text" name="veiPlaca" class="form-control" value='{{ $veiculos->placa ?? old('veiPlaca') }}' placeholder="placa do veículo">
                    <small class="form-text text-muted">{{ $errors->has('veiPlaca') ? $errors->first('veiPlaca') : ''}}</small>
                 
                    <input type="text" name="veiModelo" class="mt-2 form-control" value='{{ $veiculos->modelo ?? old('veiModelo') }}' placeholder="modelo do veículo">
                    <small class="form-text text-muted">{{ $errors->has('veiModelo') ? $errors->first('veiModelo') : ''}}</small>
                
                    <input type="text" name="veiMarca" class="mt-2 form-control" value='{{ $veiculos->marca ?? old('veiMarca') }}' placeholder="marca do veículo">
                    <small class="form-text text-muted">{{ $errors->has('veiMarca') ? $errors->first('marca') : ''}}</small>
               
                    <button type="submit" class="btn btn-primary mb-2 mt-2 btn-block">Cadastrar</button>
                </form>
            </div>

        </div>
    </div>

@endsection