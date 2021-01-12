<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\despesa;
use App\Models\usuario;

class DespesaController extends Controller
{
    
    public function insert(Request $request){
        //iniciando a sessão
        session_start();

        //definição das regras
        $rules = [
            'valor' => 'required',
            'categoria' => 'required',
            'datapagamento' => 'required|min:10',
            'status' => 'required|min:3',

        ];

        // Definição de mensagens
        $messages = [
            'valor.required' => 'Parece que você se esqueceu de inserir o valor.',
            'categoria.required' => 'informe a categoria da despesa.',
            'datapagamento.required' => 'Informe uma data.',
            'datapagamento.min' => 'Data incorreta.',
            'status.min' => 'Status de pagamento invalido',
            'status.required' => 'Informe o estatus do pagamento.',
        ];

        //inserção de dados
        if($request ->validate ($rules, $messages)){
            $despesa = new Despesa();
            $despesa->usuario =$_SESSION['id_usuario'];
            $despesa->valor = $request->valor;
            $despesa->descricao = $request->descricao;
            $despesa->categoria = $request->categoria;
            $despesa->datapagamento = $request->datapagamento;
            $despesa->status = $request->status;
            $despesa->save();
            
            return redirect()->route('dashboard');

        } else {
            return redirect() -> back() -> with('error', $messages);
        }             
    }
    
}
