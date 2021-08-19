@extends('layouts.main')

@section('title', 'Alteração de Veículo - Tanaka')

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
                Alteração de Veículo
            </div>
            <div class="card-body">
                <form method="post" action="{{route('veiculo.update', ['veiculo' => $veiculo->id])}}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{ $veiculo->id ?? ''}}">
                    <input type="text" name="veiPlaca" class="form-control" value='{{ $veiculo->veiPlaca ?? old('veiPlaca') }}' placeholder="placa do veículo">
                    <small class="form-text text-muted">{{ $errors->has('veiPlaca') ? $errors->first('veiPlaca') : ''}}</small>
                 
                    <input type="text" name="veiModelo" class="mt-2 form-control" value='{{ $veiculo->veiModelo ?? old('veiModelo') }}' placeholder="modelo do veículo">
                    <small class="form-text text-muted">{{ $errors->has('veiModelo') ? $errors->first('veiModelo') : ''}}</small>
                
                    <input type="text" name="veiMarca" class="mt-2 form-control" value='{{ $veiculo->veiMarca ?? old('veiMarca') }}' placeholder="marca do veículo">
                    <small class="form-text text-muted">{{ $errors->has('veiMarca') ? $errors->first('veiMarca') : ''}}</small>
               
                    <a href="{{route('veiculo.index')}}" class="btn btn-primary mt-1 btn-block">Voltar</a>
                    <button type="submit" class="btn btn-success mt-1 btn-block">Alterar</button>
                </form>
            </div>

        </div>
    </div>

@endsection