<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class despesa extends Model
{
    public $timestamps = false;
    use HasFactory;

    public function Obterdados($user, $mes, $ano){
        //consulta sql
        $buscaDesp = DB::table('despesas')
        ->select(DB::raw('SUM(valor) as valor,  categoria'))
        ->where('usuario', '=', $user)
        ->whereMonth('datapagamento',$mes)
        ->groupBy('categoria')
        ->get();
       
        $data = [];
        if($buscaDesp->count()){
            $result=[];
            foreach($buscaDesp as $key => $row) {
                $data['descricao'][] = $row->categoria;
                $data['valor'][] = $row->valor;
            }
            $result['resultado'] = json_encode($data);
            return  $result;
        }else{
            $result['resultado'] = 0;
            return $result;
        }
    }

    public function ObterdadosTotalDespesas($user, $mesc, $ano){
        $despesas = DB::table('despesas')->select('valor')->where('usuario','=',$user)->whereMonth('datapagamento',$mesc)->whereYear('datapagamento', $ano)->get();                 
        $despesas  = $despesas->sum('valor');

        $data = [];
        if($despesas){
            $result=[];
            $data['descricao'][]='Total de despesas';
            $data['valor'][]=$despesas;
            $result['resultado'] = json_encode($data);
            return  $result;
        }else{
            $result['resultado'] = 0;
            return $result;
        }
    }

    public function TotalDespesas($user, $mesc, $ano){
        $despesas = DB::table('despesas')->select('valor')->where('usuario','=',$user)->whereMonth('datapagamento',$mesc)->whereYear('datapagamento', $ano)->get();                 
        $despesas  = $despesas->sum('valor');
        return $despesas;
    }
    public function Despesaspagar($user, $mesc, $ano){
        $despesaApagar = DB::table('despesas')->select('valor')->where('status','=','não') -> where('usuario', '=',$user)->whereYear('datapagamento', $ano)->get();
        $despesaApagar = $despesaApagar->sum('valor');
        return $despesaApagar;
    }

    public function ListaDespesas($user, $mes, $ano){
        $list = DB::table('despesas')->select('*')->where('usuario','=',$user)->whereMonth('datapagamento',$mes)->whereYear('datapagamento', $ano)->get();
        return $list;
        dd($list);
    }
   

}
