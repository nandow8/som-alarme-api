<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller;
use App\Http\Controllers\ApiGenericCrudTrait;
use App\Models\Cliente;

class ClientesController extends Controller {

    use ApiGenericCrudTrait;

    protected $model;
    protected $rules = [
        'nome' => 'required|min:3',
        'telefone' => 'required',
    ];
    
    protected $messages = [
        'required' => ':attribute é obrigatório',
        'min' => ':attribute precisa de pelo menos :min caracteres',

    ];

    public function __construct(Cliente $model){
        $this->model = $model;
    }

   
    public function details($id){
        $cliente = Cliente::find($id);
        $clienteArray[] = $cliente; //ionic só permite arrays
        return $clienteArray;
    }
 
}