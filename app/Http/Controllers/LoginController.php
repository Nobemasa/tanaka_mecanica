<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class LoginController extends Controller
{
    public function index(Request $request){

        $erro = '';
        
        if($request->get('erro') == 1){
            $erro = 'Usuário e/ou senha não existe!';
        }
        if($request->get('erro') == 2){
            $erro = 'Necessário estar logado para acessar a página!';
        }

        return view('layouts.login', ['titulo' => 'Login', 'erro' => $erro]);
    }

    public function autenticar(Request $request){
        
        // regras de validação
        $regras = [
            'usuario' => 'required',
            'senha' => 'required'
        ];

        // msgs de feedback de validação
        $feedback = [
            'usuario.required' => 'O campo login é obrigatório!',
            'senha.required' => 'O campo senha é obrigatório!'
        ];

        // validando os campos
        $request->validate($regras, $feedback);

        // recuperando os dados do fomulário
        $email = $request->get('usuario');
        $password = $request->get('senha');

        // iniciar o Model User
        $user = new User();
        $usuario = $user->where('email', $email)->where('password', $password)->get()->first();
        
        if(isset($usuario->name)){
            session_start();  
            $_SESSION['name'] = $usuario->name;
            $_SESSION['email'] = $usuario->email;

            return redirect()->route('admin', ['erro' => 2]); 
        }else{
            return redirect()->route('login', ['erro' => 1]); 
        }
    }

    public function sair(){
        session_start();
        session_destroy();
        return redirect()->route('welcome');
    }
}
