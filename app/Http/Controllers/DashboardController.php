<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dashboard;
use DB;

class DashboardController extends Controller
{
    public function index (){
        session_start(); //inicia sessão

        //chamando classe de consulta do modal
        $totaldespesa = Dashboard::ValorTotalDespesas();
        $totalreceita = Dashboard::ValorTotalReceitas();

        
        //calculo de saldo disponivel
        $receitas = DB::table('receitas')->select('valor')->where('usuario','=',$_SESSION['id_usuario'])->get();
        $despesas = DB::table('despesas')->select('valor')->where('usuario','=',$_SESSION['id_usuario'])->get();
        $receitas  = $receitas->sum('valor');
        $despesas  = $despesas->sum('valor');
        $saldo = $receitas - $despesas;

        //pegando data atual
        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');
        $mes= strftime('%B', strtotime('today'));

        //retornando a view e passando variaveis como parametros 
        return view ('dashboard', compact('despesas','receitas','saldo', 'mes'));
    }


}
