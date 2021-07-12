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

    public function ObterdadosTotalReceitas($user, $mesc, $ano){
        $receitas = DB::table('receitas')->select('valor')->where('usuario','=',$user)->whereMonth('datareceita',$mesc)->whereYear('datareceita', $ano)->get();                 
        $receitas  = $receitas->sum('valor');

        $data = [];
        if($receitas){
            $result=[];
            $data['descricao'][]='Total de Receitas';
            $data['valor'][]=$receitas;
            $result['resultado'] = json_encode($data);
            return  $result;
        }else{
            $result['resultado'] = 0;
            return $result;
        }
    }

    public function ListaDespesas($user, $mesc, $ano){
        $lista = DB::table('receitas')->select('*')->where('usuario','=',$user)->whereMonth('datapagamento',$mesc)->whereYear('datapagamento', $ano)->get();
        return $lista;
    }
}
