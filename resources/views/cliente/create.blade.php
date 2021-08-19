@extends('layouts.main')

@section('title', 'Cadastro de Cliente - Tanaka')

@section('content')
    <div class='container mt-3'>

        <h1>Clientes</h1>
        <hr>

        {{-- menu de navegação --}}
        @component('cliente.menu')
        @endcomponent


        @if ($msg ?? '')
            <div class="text-center alert alert-primary"> {{ $msg }}</div>
        @endif
        <div class="card" style="width: 30%; margin-left:auto; margin-right:auto;">
            <div class="card-header">
                Cadastro de Cliente
            </div>
            <div class="card-body">
                <form method="post" action="{{route('cliente.store')}}">
                    @csrf
                    <input type="text" name="nome" class="form-control" value='{{ old('nome') }}' placeholder="Nome completo">
                    <small class="form-text text-muted">{{ $errors->has('nome') ? $errors->first('nome') : ''}}</small>
                 
                    <input type="text" name="cpf" class="mt-2 form-control" value='{{ old('cpf') }}' placeholder="Cpf">
                    <small class="form-text text-muted">{{ $errors->has('cpf') ? $errors->first('cpf') : ''}}</small>
                
                    <input type="text" name="celular1" class="mt-2 form-control" value='{{ old('celular1') }}' placeholder="Celular">
                    <small class="form-text text-muted">{{ $errors->has('celular1') ? $errors->first('celular1') : ''}}</small>
               
                    <input type="text" name="celular2" class="mt-2 form-control" value='{{ old('celular2') }}' placeholder="Celular">
                    <small class="form-text text-muted">{{ $errors->has('celular2') ? $errors->first('celular2') : ''}}</small>

                    <input type="text" name="endereco" class="mt-2 form-control" value='{{ old('endereco') }}' placeholder="Endereço completo">
                    <small class="form-text text-muted">{{ $errors->has('endereco') ? $errors->first('endereco') : ''}}</small>

                    <input type="text" name="obs" class="mt-2 form-control" value='{{ old('obs') }}' placeholder="Observações">
                    <small class="form-text text-muted">{{ $errors->has('obs') ? $errors->first('obs') : ''}}</small>

                    <button type="submit" class="btn btn-primary mb-2 mt-2 btn-block">Cadastrar</button>
                </form>
            </div>

        </div>
    </div>

@endsection