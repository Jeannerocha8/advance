<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Receita;

class ReceitaController extends Controller
{
    public function insert(Request $request){
        //iniciando a sessão
        session_start();

        //definição das regras
        $rules = [
            'valor' => ['required','numeric'],
            'categoria' => 'required',

        ];

        // Definição de mensagens
        $messages = [
            'valor.required' => 'Parece que você se esqueceu de inserir o valor.',
            'valor.numeric' => 'Inválido, por favor insira um valor numérico.',
            'categoria.required' => 'informe a categoria da despesa.',
        ];
        
        //inserção de dados
        if($request ->validate ($rules, $messages)){
            $receita = new Receita();
            $receita->usuario =$_SESSION['id_usuario'];
            $receita->valor = $request->valor;
            $receita->descricao = $request->descricao;
            $receita->categoria = $request->categoria;
            $receita->datareceita = $request-> datareceita;
            $receita->save();
            
           // return redirect()->route('dashboard');

        } else {
            return redirect() -> back() -> with('error', $messages);
        }             
    }
}
