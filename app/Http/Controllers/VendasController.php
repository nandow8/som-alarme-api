<?php

namespace App\Http\Controllers;

use App\Models\Venda;
use Illuminate\Http\Request;

class VendasController extends Controller {

    public function index(){
        $vendas = Venda::all();
        return $vendas;
    }

    public function store(Request $request){
        $venda = new Venda;

        $venda->orcamentos_id = $request->orcamentos_id;
        $venda->updated_at = date("Y-m-d H:i:s"); ;
        $venda->created_at = date("Y-m-d H:i:s"); ;

        $venda->save();
    }

}