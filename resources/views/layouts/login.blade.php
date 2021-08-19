@extends('layouts.main')

@section('content')
  
  <div class="container mt-5 mb-5" style="width: 30%; margin-left:auto; margin-right:auto;">
        <div class="modal-content">
        <div class="modal-header display-2 text-center">
            <div class="container align-center">
                <i class="fas fa-user-check"></i>
                <h5 class="modal-title" id="exampleModalLongTitle">Login - área restrita</h5>
            </div>
        </div>
            <form method="post" action="{{ route('login')}}">
            @csrf
                <div class="row justify-content-center">
                <div class="col align-self-center p-3">
                            <div class="input-group input-group-lg p-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-lg">E-mail</span>
                                </div>
                                <input name="usuario" value="{{ old('usuario') }}" autocomplete="off" type="text" autofocus class="form-control" aria-label="Exemplo do tamanho do input" aria-describedby="inputGroup-sizing-lg" value="">  
                            </div>
                            <div class="ml-5">
                                {{ $errors->has('usuario') ? $errors->first('usuario') : '' }}
                            </div>
                            <div class="input-group input-group-lg p-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-lg">Senha</span>
                                </div>
                                <input name="senha" value="{{ old('senha') }}" autocomplete="off" type="password" class="form-control" aria-label="Exemplo do tamanho do input" aria-describedby="inputGroup-sizing-lg" value="">
                            </div>
                            <div class="ml-5">
                                {{ $errors->has('senha') ? $errors->first('senha') : '' }}
                            </div>
                            <div class="input-group input-group-lg p-2">
                                <div class="g-recaptcha" data-sitekey="6LeN_gAVAAAAAAh2ajCXXKufpSBAmYDVnT5d03Sk"></div>
                            </div>		
                        </div>	
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Logar</button>
                </div>
            </form>	
            
                @if(isset($erro) && ($erro != ''))
                <div class="alert alert-danger text-center m-1" role="alert">
                    {{ $erro }}
                </div>
                @endif
            
        </div>
    </div>
 
@endsection