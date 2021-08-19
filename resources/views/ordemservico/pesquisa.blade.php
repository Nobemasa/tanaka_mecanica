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

        <div class="col-12 mb-3">
        <div class="card">
            <div class="card-header">
                Resultado da Pesquisa 
            </div>

            <div class="card-body">

                <div class="row font-weight-bold">
                    <div class="col col-1 text-center">OS Nº</div>
                    <div class="col col-1">Data</div>
                    <div class="col col-4">Cliente</div>
                    <div class="col col-2">Veículo</div>
                    <div class="col col-4"></div>
                </div>
                <hr class="m-1">
                @foreach ($ordemservicos as $key => $ordemservico )
                    <div class="row">
                        <div class="col-1 text-right">{{$ordemservico->id}}</div>
                        <div class="col-1 p-0">{{date( 'd/m/Y' , strtotime($ordemservico->created_at))}}</div>
                        <div class="col-4">{{$ordemservico->nome}}</div>
                        <div class="col-2">{{$ordemservico->veiModelo }}</div>
                        <div class="col-4 text-right">
                            <div class="row">
                                <div class="col-4" style="padding-left: 1px !important; padding-rigth: 1px !important;">
                                    <a class="btn btn-primary btn-sm btn-block" href=" {{ route('imprimir_pdf', ['id' => $ordemservico->id]) }}" target="_blank">Imprimir</a>
                                </div>
                                <div class="col-4" style="padding-left: 1px !important; padding-rigth: 1px !important;">
                                    <form method="post" action="{{ route('ordemservico.destroy', ['ordemservico' => $ordemservico] )}}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm btn-block">Excluir</button>
                                    </form>
                                </div>
                                <div class="col-4" style="padding-left: 1px !important; padding-rigth: 1px !important;">
                                    <a class="btn btn-warning btn-sm btn-block" href="{{ route('ordemservico.edit', ['ordemservico' => $ordemservico->id] )}}">Alterar</a>
                                </div>
                            </div>
                        </div>                       
                    </div>   
                    <hr class="m-1">
                @endforeach 
            </div>
        </div>        
        </div>

        <div class="col text-center">
            <a class="btn btn-primary" href="{{ route('ordemservico.index')}}">Voltar</a>
        </div>

    </div>    
@endsection