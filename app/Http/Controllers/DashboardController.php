<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Log;
use App\Models\Dashboard;
use Illuminate\Support\Facades\Auth;
use App\Models\despesa;
use App\Models\Receita;

class DashboardController extends Controller
{
    public function home() {
        return view('home');
    }

    public function index (Request $request, Despesa $despesa, Receita $receita){
        
         setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
         date_default_timezone_set('America/Sao_Paulo');
         $mes= strftime('%m' ,strtotime('today'));
         $ano= strftime('%Y' ,strtotime('today'));
        
         
        // Verifica se existe a sessão
        if ($request->session()->has('user')) {
            
            //variavel valor do usuario
            $user = $request->session()->get('user');

            //retorno das consultas ao bando de dados
            $receitas = $receita->Totalreceitas($user, $mes, $ano);
            $despesas = $despesa->TotalDespesas($user, $mes, $ano);
            $list = $despesa->ListaDespesas($user, $mes, $ano);
            $saldo = $receitas - $despesas;
            $despesaApagar = $despesa->Despesaspagar($user, $mes, $ano);
            $buscas = $despesa->Obterdados($user, $mes, $ano);
            //dd($buscas);
            //retornando a view e passando variaveis como parametros 
            return view ('dashboard', compact('despesas','receitas','saldo', 'mes','list', 'despesaApagar','buscas'));
        }else{
            return view ('login');
        }
    }
    
    public function verifica(Request $request, Despesa $despesa, Receita $receita)
    {   
        $user = $request->session()->get('user');
        $mes = $request->date;
        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');
        $ano= strftime('%Y' ,strtotime('today'));
        
        //consulta ao bando de dados
        $receitas = $receita->Totalreceitas($user, $mes, $ano);
        $despesas = $despesa->TotalDespesas($user, $mes, $ano);
        $list = $despesa->ListaDespesas($user, $mes, $ano);
        $saldo = $receitas - $despesas;
        $despesaApagar = $despesa->Despesaspagar($user, $mes, $ano);
        $buscas = $despesa->Obterdados($user, $mes, $ano);

        //array de resultado
        $result['despesas']=$despesas;
        $result['receitas']=$receitas;
        $result['saldo']=$saldo;
        $result['list']=$list;
        $result['buscas']=$buscas;
        //dd( $result['buscas']);
        echo json_encode($result);
    }



}
