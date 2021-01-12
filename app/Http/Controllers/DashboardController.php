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
        $receitas = DB::table('receitas')->select('valor')->get();
        $despesas = DB::table('despesas')->select('valor')->get();
        $receita  = $receitas->sum('valor');
        $despesa  = $despesas->sum('valor');
        $saldo = $receita - $despesa;

        //pegando data atual
        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');
        $mes= strftime('%B', strtotime('today'));

        //retornando a view e passando variaveis como parametros 
        return view ('dashboard', compact('totaldespesa','totalreceita','saldo', 'mes'));
    }


}
