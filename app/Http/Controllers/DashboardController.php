<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Log;
use App\Models\Dashboard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function home() {
        return view('home');
    }

    
    public function index (Request $request){
        
         $mes = $request->date;
        
        //pegando data atual
        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');
        $mesc= strftime('%m' ,strtotime('today'));
        //$mes= strftime('%b' ,strtotime('today'));
        $ano= strftime('%Y' ,strtotime('today'));
        
        
        // Verifica se existe a sessão
        if ($request->session()->has('user')) {
            

            
            //consulta ao bando de dados
            $receitas = DB::table('receitas')->select('valor')->where('usuario','=',$request->session()->has('user'))->whereMonth('datareceita',$mesc)->whereYear('datareceita', $ano)->get();
            $receitas  = $receitas->sum('valor');
            
            $despesas = DB::table('despesas')->select('valor')->where('usuario','=',$request->session()->has('user'))->whereMonth('datapagamento',$mesc)->whereYear('datapagamento', $ano)->get();
            $despesas  = $despesas->sum('valor');
            
            $list = DB::table('despesas')->select('*')->where('usuario','=',$request->session()->has('user'))->whereMonth('datapagamento',$mesc)->whereYear('datapagamento', $ano)->get();
            
            //calculo de saldo disponivel
            $saldo = $receitas - $despesas;
            
            //pegando despesas a pagar
            $despesaApagar = DB::table('despesas')->select('valor')->where('status','=','não') -> where('usuario', '=',$request->session()->has('user'))->get();
            $despesaApagar = $despesaApagar->sum('valor');
            
            //dump( "usuario: ". session()->get('user'),"despesa: ".$despesas, "receitas: ".$receitas );
 

            //retornando a view e passando variaveis como parametros 
            return view ('dashboard', compact('despesas','receitas','saldo', 'mes','list', 'despesaApagar'));
        }else{
            return view ('login');
        }
    }
    
    
    public function verifica(Request $request)
    {    
        
        $mes = $request->date;
        
        //pegando data atual
        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');
        //$mesc= strftime('%m' ,strtotime('today'));
        // $mes= strftime('%b' ,strtotime('today'));
        $ano= strftime('%Y' ,strtotime('today'));
        
        //consulta ao bando de dados
        $receitas = DB::table('receitas')->select('valor')->where('usuario','=',$request->session()->has('user'))->whereMonth('datareceita',$mes)->whereYear('datareceita', $ano)->get();
        $receitas  = $receitas->sum('valor');
        
        $despesas = DB::table('despesas')->select('valor')->where('usuario','=',$request->session()->has('user'))->whereMonth('datapagamento',$mes)->whereYear('datapagamento', $ano)->get();
        $despesas  = $despesas->sum('valor');
        
        $list = DB::table('despesas')->select('*')->where('usuario','=',$request->session()->has('user'))->whereMonth('datapagamento',$mes)->whereYear('datapagamento', $ano)->get();
        
        //calculo de saldo disponivel
        $saldo = $receitas - $despesas;
        
        //pegando despesas a pagar
        $despesaApagar = DB::table('despesas')->select('valor')->where('status','=','não') -> where('usuario', '=',$request->session()->has('user'))->get();
        $despesaApagar = $despesaApagar->sum('valor');

        //array de resultado
        $result['despesas'] =$despesas;
        $result['receitas']=$receitas;
        $result['saldo']=$saldo;
        $result['list']=$list;

        echo json_encode($result);
    }
    
}
