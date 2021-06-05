<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\despesa;
use App\Models\usuario;
use DB;

class DespesaController extends Controller{
    
    public function insert(Request $request){
      
        //definição das regras
        $rules = [
            'valor' => ['required','numeric'],
            'categoria' => 'required',
            'datapagamento' => 'required|min:10',
            'status' => 'required|min:3',
            
        ];
        
        // Definição de mensagens
        $messages = [
            'valor.required' => 'Parece que você se esqueceu de inserir o valor.',
            'valor.numeric' => 'Inválido, por favor insira um valor numérico.',
            'categoria.required' => 'informe a categoria da despesa.',
            'datapagamento.required' => 'Informe uma data.',
            'datapagamento.min' => 'Data incorreta.',
            'status.min' => 'Status de pagamento invalido',
            'status.required' => 'Informe o estatus do pagamento.',
        ];
        
        //inserção de dados
        if($request ->validate ($rules, $messages)){
            $despesa = new Despesa();
            $despesa->usuario = session()->get('user');
            $despesa->valor = $request->valor;
            $despesa->descricao = $request->descricao;
            $despesa->categoria = $request->categoria;
            $despesa->datapagamento = $request->datapagamento;
            $despesa->status = $request->status;
            $despesa->save();
          
            $result ['message'] = 'Despesa cadastrada com sucesso';
            echo json_encode($result);
            return;
            
        } else {
            $result ['message'] = 'Erro ao Cadastrar despesa';
            echo json_encode($result);
            return;
        }             
    }
    
    public function delete (Despesa $despesas){
        $despesas->delete();
        return response()->json(Array($despesas));
    }
    
    public function show ($id){
        $despesa = despesa::find($id);
        return response()->json($despesa);
    }   


    public function edit (Request $request, Despesa $despesa){

         //definição das regras
         $rules = [
             'valor' => ['required','numeric'],
             'categoria' => 'required',
             'datapagamento' => 'required|min:10',
             'status' => 'required|min:3',
         ];
         
         // Definição de mensagens
         $messages = [
             'valor.required' => 'Parece que você se esqueceu de inserir o valor.',
             'valor.numeric' => 'Inválido, por favor insira um valor numérico.',
             'categoria.required' => 'informe a categoria da despesa.',
             'datapagamento.required' => 'Informe uma data.',
             'datapagamento.min' => 'Data incorreta.',
             'status.min' => 'Status de pagamento invalido',
             'status.required' => 'Informe o estatus do pagamento.',
         ];
         

         //atualizar  dados
         if($request ->validate ($rules, $messages)){
             $despesa->id = $despesa -> id;
             $despesa->usuario =$request->session()->get('user');
             $despesa->valor = $request->valor;
             $despesa->descricao = $request->descricao;
             $despesa->categoria = $request->categoria;
             $despesa->datapagamento = $request->datapagamento;
             $despesa->status = $request->status;
             $despesa->update();
             
             $result ['message'] = 'Despesa alterada com sucesso';
             echo json_encode($result);
             return;
         } else {
            $result ['message, erro'] = 'erro ao alterar despesa';
            echo json_encode($result);
            return;
        }             
    }
}
