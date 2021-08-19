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


        @if ($msg != '')
            <div class="text-center alert alert-primary"> {{ $msg }}</div>
        
        @endif
        <div class="card" style="width: 50%; margin-left:auto; margin-right:auto;">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th scope="col">Código</th>
                        <th scope="col">Nome</th>
                        <th scope="col">%</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mecanicos as $mecanico )
                        <tr>
                            <th scope="row">{{$mecanico->id}}</th>
                            <th scope="row">{{$mecanico->nome}}</th>
                            <th scope="row">{{$mecanico->porcentagem}}</th>
                            <th scope="row"><a class="btn btn-danger btn-block btn-sm" href="{{ route('exclui_mecanico', $mecanico->id)}}">Excluir</a></th>
                            <th scope="row"><a class="btn btn-success btn-block btn-sm" href="{{route('altera_mecanico', $mecanico->id)}}">Alterar</a></th>
                        </tr>
                    @endforeach 
                </tbody>
                </table>
                
        </div>
        <div class="text-center" style="width: 50%; margin-left:auto; margin-right:auto;"> 
          {{ $mecanicos->links() }}  
        </div>
    </div>

@endsection