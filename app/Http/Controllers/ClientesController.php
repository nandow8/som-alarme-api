<?php

namespace App\Http\Controllers;

use App\Models\Cliente;

use Illuminate\Http\Request;

class ClientesController extends Controller {

    public function index(){
        $clientes = Cliente::all();
        return $clientes;
    }

    public function store(Request $request){
        $cliente = new Cliente;

        $cliente->nome = $request->nome;
        $cliente->telefone = $request->telefone;

        $cliente->save();
    }

    public function details($id){
        $cliente = Cliente::find($id);
        $clienteArray[] = $cliente; //ionic só permite arrays
        return $clienteArray;
    }

    public function update($id, Request $request){
        $cliente = Cliente::find($id);

        $cliente->nome = $request->nome;
        $cliente->telefone = $request->telefone;

        $cliente->save();
    }

}