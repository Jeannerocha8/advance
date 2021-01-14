<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Dashboard extends Model
{
    use HasFactory;

    public static function ValorTotalDespesas(){
        $despesa = DB::select('select sum(valor) from despesas where usuario = :usuario', ['usuario' =>$_SESSION['id_usuario']]);
        return $despesa[0];
    }

    public static function Despesas(){
        $despesa = DB::select('select * from despesas where usuario = :usuario', ['usuario' =>$_SESSION['id_usuario']]);
        return $despesa[0];
    }


    public static function ValorTotalReceitas(){
        $receita = DB::select('select sum(valor) from receitas where usuario = :usuario', ['usuario' =>$_SESSION['id_usuario']]);
        return $receita[0];
    }




}
