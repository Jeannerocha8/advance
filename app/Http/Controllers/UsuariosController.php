<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\usuario;
use Illuminate\Support\Facades\DB;


class UsuariosController extends Controller
{

    public function __invoke(){
        return view('createuser');
    }

    public function index(){
        return view('login');
    }

    public function insert (Request $request){

        //definição das regras
        $rules = [
            'nome' => 'required|min:3',
            'email' => 'required|email',
            'senha' => 'required|min:6',
        ];

        // Definição de mensagens
        $messages = [
            'nome.required' => 'Parece que você se esqueceu de digitar seu nome.',
            'nome.min' => 'Nome inválido, Tente novamente com seu nome real.',
            'email.required' => 'informe seu e-mail.',
            'email.email' => 'Informe um e-mail válido.',
            'senha.required' => 'Informe sua senha.',
            'senha.min' => 'A senha deve conter no minimo 6 digitos.'
        ];

        $user= DB:: table('usuarios')->select('email')->where('email','=',$request->email) ->value('email');
        // dump($user);
        //die();

        if($user!=null){
            $messages = 'Email Já cadastrado.';
            return redirect()->back()->with('error', $messages);

        }elseif($request ->validate ($rules, $messages)){
            $usuario = new Usuario();
            $usuario->nome = $request->nome;
            $usuario->email = $request->email;
            $usuario->senha = $request->senha;
            $usuario->save();
            
            return redirect()->route('login');
        } else {
            return redirect()->back()->with('error', $messages);
        }             
    }

    public function Login(Request $request){

         //definição das regras
         $rules = [
            'email' => 'required|email',
            'senha' => 'required|min:6',
        ];

        // Definição de mensagens
        $messages = [
            'email.required' => 'Informe seu e-mail.',
            'email.email' => 'E-mail inválido, tente novamente.',
            'senha.required' => 'Informe sua senha.',
            'senha.min' => 'Sua senha cadastrada tem no minimo 6 digitos.'
        ];

        //validação da Request
        if($request ->validate ($rules, $messages)){
            $email = $request->email;
            $senha = $request->senha; 
            $usuarios = usuario::where('email', '=', $email)->where('senha', '=', $senha)->first();
            
            if(@$usuarios->id != null){
                $request->session()->put('user', $usuarios->id);
                return redirect()->route('dashboard');

            } else {
                return redirect()->back()->with('error', 'Email ou senha incorreta');
            }   
        }
    }

    public function logout(Request $request){
        // Deletando todas as sessões:
        $request->session()->flush();
        return view('login');
    }

    
}
