<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">

                <h4 class="mt-2">TANAKA AUTO MECÂNICA</h4>
        
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                            @if (isset($_SESSION['email']) && $_SESSION['email'] != '')
                  
                         
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('admin') }}">{{ __('Início') }}</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('ordemservico.index') }}">{{ __('Ordem de Serviços') }}</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('cliente.index') }}">{{ __('Clientes') }}</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('veiculo.index') }}">{{ __('Veículos') }}</a>
                                    </li>
                       

                                @if (Route::has('mecanico'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('mecanico') }}">{{ __('Mecânicos') }}</a>
                                    </li>
                                @endif

                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('sair') }}">{{ __('Sair') }}</a>
                                </li>
                            @else
                                 @if (Route::has('login'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('login') }}">{{ __('Entrar') }}</a>
                                    </li>
                                @endif
                            @endif
                    </ul>
                </div>
            </div>
        </nav>