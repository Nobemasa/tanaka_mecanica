@extends('layouts.main')

@section('title', 'Alteração de Cliente - Tanaka')

@section('content')
    <div class='container mt-3 mb-3'>

        <h1>Clientes</h1>
        <hr>

        {{-- menu de navegação --}}
        @component('cliente.menu')
        @endcomponent


        @if ($msg ?? '')
            <div class="text-center alert alert-primary"> {{ $msg }}</div>
        @endif

        {{-- Dados do cliente --}}
        <div class="card" style="width: 100%; margin-left:auto; margin-right:auto;">
            <div class="card-header">
                Alteração de Cadastro do Cliente
            </div>
            <div class="card-body">
                <form method="post" action="{{route('cliente.update', ['cliente' => $cliente->id])}}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{ $cliente->id ?? ''}}">
                    <div class="form-row">
                        <div class="form-group col-md-7">
                            <label for="nome">Nome</label>
                            <input type="text"  name="nome" class="form-control" value='{{ $cliente->nome ?? old('nome') }}' placeholder="Nome completo">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="celular1">Celular</label>
                            <input type="text" name="celular1" class="form-control" value='{{ $cliente->celular1 ?? old('celular1') }}' placeholder="Celular">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="celular2">Telefone</label>
                            <input type="text" name="celular2" class="form-control" value='{{ $cliente->celular2 ?? old('celular2') }}' placeholder="Celular">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="endereco">Endereço</label>
                        <input type="text" name="endereco" class="form-control" value='{{ $cliente->endereco ?? old('endereco') }}' placeholder="Endereço completo">
                    </div>

                    <div class="form-group">
                        <label for="obs">Observações</label>
                        <input type="text" name="obs" class="mt-2 form-control" value='{{ $cliente->obs ?? old('obs') }}' placeholder="Observações">
                    </div>
                    <div class="row p-2">
                    <a href="{{route('cliente.index')}}" class="col-1 btn btn-primary">Voltar</a> 
                    <button type="submit" class="col-2 btn btn-success ml-2">Alterar</button>
                    </div>
                </form>
            </div>

        </div>
    </div>

@endsection