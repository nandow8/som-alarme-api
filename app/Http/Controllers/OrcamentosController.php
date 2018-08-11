<?php

namespace App\Http\Controllers;

use App\Models\Orcamento;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class OrcamentosController extends Controller {

    public function index(){
        $orcamentos = 
            DB::table('orcamentos')
            ->join('clientes', 'orcamentos.clientes_id', '=', 'clientes.id')  
            ->select(
                DB::raw('distinct orcamentos.id_orcamento'),
                'clientes.nome',
                'clientes.telefone'
            )
            ->get();
       
        return $orcamentos;
    }

    public function orcamentoDetail($id){
        $orcamentos = 
            DB::table('orcamentos')
            ->join('clientes', 'orcamentos.clientes_id', '=', 'clientes.id')  
            ->join('produtos', 'orcamentos.produtos_id', '=', 'produtos.id')
            ->select(
                    'orcamentos.id_orcamento',
                    'clientes.nome', 
                    'clientes.telefone', 
                    'produtos.nome AS produto_nome',
                    'produtos.marca AS marca',
                    'produtos.preco AS preco',
                    'produtos.quantidade AS quantidade_estoque',
                    'orcamentos.quantidade',
                DB::raw('orcamentos.updated_at')

            
            ) 
            ->where('orcamentos.id_orcamento', '=', $id)           
            ->get();
       
        return $orcamentos;
    }

    

    public function store(Request $request){

        $this->validate($request, [
            'id_orcamento' => 'required',
            'quantidade' => 'required',
            'produtos_id' => 'required',
            'produtos_id' => 'required',
            'clientes_id' => 'required'
        ]);

        $orcamento = new Orcamento;

        $orcamento->id_orcamento = $request->id_orcamento;
        $orcamento->quantidade = $request->quantidade;
        $orcamento->produtos_id = $request->produtos_id;
        $orcamento->produtos_id = $request->produtos_id;
        $orcamento->clientes_id = $request->clientes_id;

        $orcamento->updated_at = date("Y-m-d H:i:s"); ;
        $orcamento->created_at = date("Y-m-d H:i:s"); ;

        $orcamento->save();
    }

}