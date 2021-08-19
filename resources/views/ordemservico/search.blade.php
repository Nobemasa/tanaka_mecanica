@extends('layouts.main')

@section('title', 'Ordem de serviços - Tanaka')

@section('content')
    <div class='container mt-3'>

        <h1>Ordem de Serviços</h1>
        <hr>

        {{-- menu de navegação --}}
        @component('ordemservico.menu')
        @endcomponent


        @if ($msg ?? '')
            <div class="text-center alert alert-primary"> {{ $msg }}</div>
        @endif
        <div class="card" style="width: 30%; margin-left:auto; margin-right:auto;">
            <div class="card-header">
                Gerar Nova Ordem de Serviço
            </div>
            <div class="card-body">
                <form method="post" action="{{route('os_validar')}}">
                    @csrf
                    <input type="text" name="veiPlaca" class="form-control" value='{{ old('veiPlaca') }}' placeholder="Placa do veículo">
                    <small class="form-text text-muted">{{ $errors->has('veiPlaca') ? $errors->first('veiPlaca') : ''}}</small>      
              
                    <button type="submit" class="btn btn-primary mb-2 mt-2 btn-block">Criar OS</button>
                </form>
            </div>

        </div>
    </div>

@endsection