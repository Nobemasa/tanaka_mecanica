@extends('layouts.main')

@section('title', 'Ordem de serviços - Tanaka')

@section('content')
    <div class='container mt-3 mb-5'>

        <h1>Ordem de Serviço Nº {{ $ordemservico->id }}</h1>
        <hr>

        {{-- menu de navegação --}}
        @component('ordemservico.menu')
        @endcomponent


        @if ($msg ?? '')
            <div class="text-center alert alert-primary"> {{ $msg }}</div>
        @endif

        <div class="col col-12">
        <div class="row">
            <div class="col col-6">
                <div class="card-header">
                    Dados do Cliente
                </div>

                <div class="card-body">
                    <h4>{{ $ordemservico->nome }}</h4>
                </div>

            </div>

            <div class="col col-6">
                <div class="card-header">
                    Dados do Veículo
                </div>
                <div class="card-body">
                    <div class="row">
                        <h4 class="col-12">{{ $ordemservico->veiModelo}} - Placa: {{ $ordemservico->veiPlaca }}</h4>
                    </div>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col col-6">
                <div class="card-header">
                    Cadastrar Peças / Serviços
                </div>
                <div class="card-body">
                <div class="row">
                    <form  class="form-inline" method="post" action="{{ route('produto.store', ['ordemservico' => $ordemservico]) }}">
                        @csrf
                        <input type="text" name="quantidade" class="col-2 form-control" value='{{ old('quantidade') }}' placeholder="Qtde">
                        <input type="text" name="descricao" class="col-6 ml-2 form-control" value='{{ old('descricao') }}' placeholder="Descrição">
                        <input type="text" name="valor" class="col-3 ml-2 form-control" value='{{ old('valor') }}' placeholder="Valor">
                        <button type="submit" class="btn btn-primary mb-2 mt-2 btn-block">Inserir peça / serviço</button>
                    </form>
                </div>
                </div>

                <div class="card-header">
                    Mão de Obra 
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-7">
                            <div class="row">
                                <form  class="form-inline" method="post" action=" {{ route('ordemservico.update', ['ordemservico' => $ordemservico]) }}">
                                @csrf
                                @method('PATCH')
                                   
                                    <input type="text" name="valor_mo" class="col-6 form-control">
                                    <button type="submit" class="col-5 ml-2 btn btn-primary">Alterar</button>
                                </form>
                            </div>
                        </div>    
                                
                        <div class="col-5 text-right font-weight-bold" style="padding-top: 4px !important; padding-bottom: 4px !important;">
                            <h3 class="text-end mr-0">{{ 'R$ '.number_format($ordemservico->valor_mo, 2, ',', '.') }}</h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col col-6">
                <div class="card-header">
                    Descrição de Peças / Serviços
                </div>
                <div class="card-body">
                    <div class="row mt-n1 mb-1">
                        <div class="col-1">Qtde</div>
                        <div class="col-7">Descrição</div>
                        <div class="col-3">Valor</div>
                    </div>

                    @if (isset($produto))
                        @foreach ($produto as $key => $produtos )
                        <div class="row mt-1">
                            <div class="col-1">{{ $produtos->quantidade }}</div>
                            <div class="col-7">{{ $produtos->descricao }}</div>
                            <div class="col-3 text-right">{{ 'R$ '.number_format($produtos->valor, 2, ',', '.') }}</div>
                            <div class="col-1 text-right">
                                <form method="post" action="{{ route('exclui_produto', ['ordemservico' => $ordemservico]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <input type="text" name="produto_id" hidden value="{{ $produtos->id }}">
                                    <button class="btn bg-transparent" title="Excluir" type="submit"><i class="far fa-trash-alt "></i></button>
                                </form>
                            </div>
                        </div>
                        <hr class="m-0">
                        @endforeach    
                    
                    <div class="row mt-1">
                        <div class="col-1 text-left font-weight-bold">SubTotal </div>
                        <div class="col-10 text-right font-weight-bold"><h3>{{ 'R$ '.number_format($total_produtos, 2, ',', '.') }}</h3></div>
                        <div class="col-1 text-right"></div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <form method="post" action="{{ route('store', ['ordemservico' => $ordemservico]) }}">
        @csrf

        <div class="row">
            <div class="col col-6">
                <div class="card-header">
                    Mecânico / Km
                </div>
                <div class="card-body">
                    <div class="col-12 form-group">
                        <div class="row">
                            <select class="col-6 form-control" name="mecanico_id">
                                @if ($ordemservico->mecanico != '')
                                    <option value="">Alterar mecânico...</option>
                                @else
                                    <option value="">Selecione um mecânico...</option>
                                @endif
                                @foreach ($mecanicos as $mecanico )
                                    <option value="{{ $mecanico->id }}">{{ $mecanico->nome }}</option>     
                                @endforeach
                            </select>
                            <h4 class="col-6 text-right">{{ $ordemservico->mecanico ?? old('') }}</h4>
                        </div>    
                    </div>
                    <div class="row"> 
                        <input type="text" name="km" class="col-6 form-control" value='{{ $ordemservico->km ?? old('km') }}' placeholder="Informe o KM do Veículo">      
                    </div>
                </div>
            </div>

            <div class="col col-6">
                <div class="card-header">
                    Observações
                </div>
                <div class="card-body">
                    <textarea class="form-control" name="obs" id="obs" rows="3">{{ $ordemservico->obs ?? old('obs') }}</textarea>
                </div>
            </div>
        </div>
        

        <div class="row">
            <div class="col col-12">
                <div class="card-header text-center">
                    TOTAL
                </div>
                <div class="card-body text-center">
                    <div class="font-weight-bold" style="padding-top: 4px !important; padding-bottom: 4px !important;">
                        <h2 class="text-end">{{ 'R$ '.number_format($ordemservico->total, 2, ',', '.') }}</h2>
                        <button class="btn btn-primary btn-block" type="submit">Salvar Ordem de Serviço</button>
                    </div>     
                </div>
            </div>
        </div>
        </form>

    </div>

@endsection