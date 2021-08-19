@extends('layouts.main')

@section('title', 'Admin - Tanaka')

@section('content')
    <div class='container mt-3 mb-5'>

        <h1>Área Administrativa</h1>
        <hr>

        <div class='row justify-content-between'>
            <div class="col col-6">
                <div class='col-12'>
                    <div class="card-header">
                        Dados Estatísticos
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <h4>{{ $clientes }} </h4> <h5 class="ml-2 mt-1">clientes cadastrados</h5>
                        </div>
                        <div class="row">
                            <h4>{{ $veiculos }} </h4> <h5 class="ml-2 mt-1">veiculos cadastrados</h5>
                        </div> 
                    </div>
                </div>
                <div class='col-12'>
                    <div class="card-header">
                        Pesquisa Rápida
                    </div>

                    <div class="card-body">
                        <form method="post" action="{{ route('listar_veiculo') }}">
                        @csrf
                            <div class="row">
                                <div class="col">
                                    <input id="inputPlaca" name="inputPlaca" type="text" class="form-control" placeholder="Placa do Veículo" pattern="[a-zA-Z0-9]+">
                                    <small class="form-text text-muted">Digite apenas letras e números</small>
                                </div>
                                <div class="col">
                                    <button type="submit" class="form-control btn btn-primary">Pesquisar</button>
                                </div>
                            </div> 
                        </form>
                    </div>   
                </div>
            </div>

            <div class="col col-6">
                <div class='col-12'>
                    <div class="card-header">
                            Valores da Mão de Obra - Ano base: {{ $dados_os['anoAtual'] }}
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <h4 class="col-12">
                                {{-- GRÁFICO --}}
                                <canvas id="myChart" width="400" height="200"></canvas>
                            </h4>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="card-header">
                        Valores da Mão de Obra - Ano base: {{ $dados_os['anoAnterior'] }}
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <h4 class="col-12">
                                {{-- GRÁFICO --}}
                                <canvas id="myChart2" width="400" height="200"></canvas>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
            datasets: [{
                label: 'Valores em reais R$',

                data: [ {{ $dados_os['dadosAtual'] }} ],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });


    var ctx = document.getElementById('myChart2').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
            datasets: [{
                label: 'Valores em reais R$',

                data: [ {{ $dados_os['dadosAnterior'] }} ],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    </script>
@endsection