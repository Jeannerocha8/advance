<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Log;
use App\Models\Dashboard;

use DB;
use Illuminate\Support\Facades\DB as FacadesDB;

class DashboardController extends Controller
{
    public function index (Request $request){
        
        $mes = $request->date;
        session_start(); //inicia sessão
        
        //pegando data atual
        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');
        $mesc= strftime('%m' ,strtotime('today'));
        $mes= strftime('%b' ,strtotime('today'));
        $ano= strftime('%Y' ,strtotime('today'));

        if($_SESSION['id_usuario']){
            //consulta ao bando de dados
            $receitas = DB::table('receitas')->select('valor')->where('usuario','=',$_SESSION['id_usuario'])->whereMonth('datareceita',$mesc)->whereYear('datareceita', $ano)->get();
            $receitas  = $receitas->sum('valor');

            $despesas = DB::table('despesas')->select('valor')->where('usuario','=',$_SESSION['id_usuario'])->whereMonth('datapagamento',$mesc)->whereYear('datapagamento', $ano)->get();
            $despesas  = $despesas->sum('valor');

            $list = DB::table('despesas')->select('*')->where('usuario','=',$_SESSION['id_usuario'])->whereMonth('datapagamento',$mesc)->whereYear('datapagamento', $ano)->get();

            //calculo de saldo disponivel
            $saldo = $receitas - $despesas;

            //pegando despesas a pagar
            $despesaApagar = DB::table('despesas')->select('valor')->where('status','=','não') -> where('usuario', '=',$_SESSION['id_usuario'] )->get();
            $despesaApagar = $despesaApagar->sum('valor');
        

            //retornando a view e passando variaveis como parametros 
            return view ('dashboard', compact('despesas','receitas','saldo', 'mes','list', 'despesaApagar'));
        }
        else{
            return view('login');
        }
    }



    public function verifica(Request $request)
    {
            //data selecionada pelo usuário
            $mes = $request->date;
            session_start(); //inicia sessão
            //pegando data atual
            setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
            date_default_timezone_set('America/Sao_Paulo');

            $ano= strftime('%Y' ,strtotime('today'));
    
        
        if($_SESSION['id_usuario']){
            //consulta ao bando de dados
            $receitas = DB::table('receitas')->select('valor')->where('usuario','=',$_SESSION['id_usuario'])->whereMonth('datareceita',$mesc)->whereYear('datareceita', $ano)->get();
            $receitas  = $receitas->sum('valor');

            $despesas = DB::table('despesas')->select('valor')->where('usuario','=',$_SESSION['id_usuario'])->whereMonth('datapagamento',$mesc)->whereYear('datapagamento', $ano)->get();
            $despesas  = $despesas->sum('valor');

            $list = DB::table('despesas')->select('*')->where('usuario','=',$_SESSION['id_usuario'])->whereMonth('datapagamento',$mesc)->whereYear('datapagamento', $ano)->get();

            //calculo de saldo disponivel
            $saldo = $receitas - $despesas;

            //pegando despesas a pagar
            $despesaApagar = DB::table('despesas')->select('valor')->where('status','=','não') -> where('usuario', '=',$_SESSION['id_usuario'] )->get();
            $despesaApagar = $despesaApagar->sum('valor');
        

            //retornando a view e passando variaveis como parametros 
            return view ('dashboard', compact('despesas','receitas','saldo', 'mes','list', 'despesaApagar'));
        }
        else{
            return view('login');
        }
 
    }
   


}
