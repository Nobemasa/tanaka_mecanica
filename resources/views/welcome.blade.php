@extends('layouts.main')

@section('title', 'Tanaka Auto Mecânica')

@section('content')
        <a href="https://api.whatsapp.com/send?phone=5519996557492&text=Contato pelo site TANAKA AUTO MECÂNICA" target="_blank"><img  class="whatsapp" src="img/chame-no-zap.png" /></a>
        <img  class="col-sm align-items-center" src="{{ asset('img/back.jpg')}}">


        <div class="container">
            <div class="row p-3">
            
                <div class="col col-12 col-sm-12 col-md-4 col-lg-4 p-3 wow slideInLeft" data-wow-delay="0.5s">
                    <div class="shadow p-3 mb-5 bg-white rounded text-center">
                        <i class="fas fa-car"></i>
                        <h3><small class="text-muted text-justify">Atendimento diferenciado, venha tomar um cafezinho!</small></h3>
                    </div>
                </div>
                
                <div class="col col-12 col-sm-12 col-md-4 col-lg-4 p-3 wow slideIn" data-wow-delay="0.5s">
                    <div class="shadow p-3 mb-5 bg-white rounded text-center">
                        <i class="fas fa-car"></i>
                        <h3><small class="text-muted text-justify">Diagnóstico rápido, eficiente e preço justo!</small></h3>
                    </div>
                </div>
                
                <div class="col col-12 col-sm-12 col-md-4 col-lg-4 p-3 wow slideInRight" data-wow-delay="0.5s">
                    <div class="shadow p-3 mb-5 bg-white rounded text-center">
                        <i class="fas fa-car"></i>
                        <h3><small class="text-muted text-justify">Uma oficina limpa, organizada e que respeita seus clientes!</small></h3>
                    </div>
                </div>
            
            </div>
        </div>

        <section class="header-site">
            <div class="container">
            <div class="row p-3 img-fluid">
                <div class="col-12">
                    <h1 class="text-left">Nossa satisfação...</h1>
                    <h3 class="text-left">é que você entre como um Cliente e saia como um AMIGO!</h3>
                </div>
            </div>
            </div>
        </section>

        <div class="container">
            <div class="row p-3">
            
                <div class="col col-12 col-sm-12 col-md-4 col-lg-4 p-3 wow slideInLeft" data-wow-delay="0.5s">
                    <div class="shadow p-3 mb-5 bg-white rounded text-center">
                        <i class="fas fa-car"></i>
                        <h3><small class="text-muted text-justify">Utilize sempre aditivo ao invés de água no reservatório.</small></h3>
                    </div>
                </div>
                
                <div class="col col-12 col-sm-12 col-md-4 col-lg-4 p-3 wow slideIn" data-wow-delay="0.5s">
                    <div class="shadow p-3 mb-5 bg-white rounded text-center">
                        <i class="fas fa-car"></i>
                        <h3><small class="text-muted text-justify">Escolha o óleo como se fosse um vinho.</small></h3>
                    </div>
                </div>
                
                <div class="col col-12 col-sm-12 col-md-4 col-lg-4 p-3 wow slideInRight" data-wow-delay="0.5s">
                    <div class="shadow p-3 mb-5 bg-white rounded text-center">
                        <i class="fas fa-car"></i>
                        <h3><small class="text-muted text-justify">Troque sempre o filtro de ar e óleo.</small></h3>
                    </div>
                </div>
            
            </div>
        </div>

        @include('layouts.footer')
@endsection
