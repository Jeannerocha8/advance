<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Receita extends Model
{
    public $timestamps = false;
    use HasFactory;

    public function Totalreceitas ($user, $mesc, $ano){
        $receitas = DB::table('receitas')->select('valor')->where('usuario','=',$user)->whereMonth('datareceita',$mesc)->whereYear('datareceita', $ano)->get();
        $receitas  = $receitas->sum('valor');
        return $receitas;
    }

    public function ListaDespesas($user, $mesc, $ano){
        $lista = DB::table('receitas')->select('*')->where('usuario','=',$user)->whereMonth('datapagamento',$mesc)->whereYear('datapagamento', $ano)->get();
        return $lista;
    }


}
