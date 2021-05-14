<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\despesa;
use App\Models\usuario;
use DB;

class DespesaController extends Controller{
    
    public function insert(Request $request){
        
        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');
        $mes= strftime('%b' ,strtotime('today'));
           

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
            $despesa->usuario = session()->has('user');
            $despesa->valor = $request->valor;
            $despesa->descricao = $request->descricao;
            $despesa->categoria = $request->categoria;
            $despesa->datapagamento = $request->datapagamento;
            $despesa->status = $request->status;
            $despesa->save();

            $returnHTML = view('dashboard')->with('mes', $mes)->render();
            return response()->json(array('success' => true, 'html'=>$returnHTML));
            //return response()->json(['view'=>'dashboard']);
            //return redirect()->route('dashboard');
            
        } else {
            return response()->json(Array('error', $messages));
            //return redirect() -> back() -> with('error', $messages);
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
         
         //inserção de dados
         if($request ->validate ($rules, $messages)){
             $despesa->usuario =$request->session()->has('user');
             $despesa->valor = $request->valor;
             $despesa->descricao = $request->descricao;
             $despesa->categoria = $request->categoria;
             $despesa->datapagamento = $request->datapagamento;
             $despesa->status = $request->status;
             $despesa->save();
             
             return response()->json(['view'=> 'dashboard']);
             
         } else {
            return redirect() -> back() -> with('error', $messages);
         }             
    }
}
