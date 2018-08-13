<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutosController extends Controller {

    public function index(){
        $produtos = Produto::all();
        return $produtos;
    }

    public function store(Request $request){
        $produtos = new Produto;

        $produtos->nome = $request->nome;
        $produtos->marca = $request->marca;
        $produtos->preco = $request->preco;
        $produtos->quantidade = $request->quantidade;

        $produtos->save();
    }

    public function details($id){
        $produto[] = Produto::find($id);
        
        return $produto;
    }

    public function update($id, Request $request){  
        // store
        $produto = Produto::find($id);
        $produto->nome = $request->nome;
        $produto->preco = $request->preco;
        $produto->marca = $request->marca;
        $produto->quantidade = $request->quantidade;
        $produto->save(); 
        
    }
}
