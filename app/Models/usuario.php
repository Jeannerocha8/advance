<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;


class Usuario extends Model
{
    public $timestamps = false;
    use HasFactory;


    public function Login ($email,$senha){
        $usuarios = usuario::where('email', '=', $email)->where('senha', '=', $senha)->first();
        return $usuarios;
    }

    public function VerificaEmail ($email){
        $user= DB:: table('usuarios')->select('email')->where('email','=',$email) ->value('email');
        return $user;
    }

    public function Cadastro($request){
        $usuario = new Usuario();
        $usuario->nome = $request->nome;
        $usuario->email = $request->email;
        $usuario->senha = $request->senha;
        $usuario->save();
        return $usuario;
    }

}