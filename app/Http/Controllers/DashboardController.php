<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dashboard;
use DB;

class DashboardController extends Controller
{
    public function index (){
        session_start(); //inicia sessão

       
        //consulta ao bando de dados

        $receitas = DB::table('receitas')->select('valor')->where('usuario','=',$_SESSION['id_usuario'])->get();
        $receitas  = $receitas->sum('valor');

        $despesas = DB::table('despesas')->select('valor')->where('usuario','=',$_SESSION['id_usuario'])->get();
        $despesas  = $despesas->sum('valor');

        $list = DB::table('despesas')->select('*')->where('usuario','=',$_SESSION['id_usuario'])->get();

        //calculo de saldo disponivel
        $saldo = $receitas - $despesas;

        //pegando data atual
        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');
        $mes= strftime('%B', strtotime('today'));

        //retornando a view e passando variaveis como parametros 
        return view ('dashboard', compact('despesas','receitas','saldo', 'mes', 'list'));
    }


}
