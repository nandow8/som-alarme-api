<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller;
use App\Http\Controllers\ApiGenericCrudTrait;
use App\Models\Cliente;
use Illuminate\Http\Request;

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

    public function storeImage(Request $request){
        $cliente = new Cliente;

        $cliente->nome = $request->nome;
        $cliente->telefone = $request->telefone;
        
        if ($request->hasFile('image')) {
            
            $image = $request->file('image');
            $name = $image->getClientOriginalName();
            $destinationPath = storage_path('public');
            $image->move($destinationPath, $name);
            
            $cliente->image = storage_path('public') . '/' . $name;
            // echo $cliente->image ;die;
        }
        $cliente->save();
    }
 
}