<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthenticationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function newUser(Request $request){
        $data = $request->all();
        $data['password'] = \Hash::make($data['password']);
        $model = \App\User::create($data);

        return response()->json($model, 201);
    }

    public function login(Request $request){
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $email = $request->get('email');
        $password = $request->get('password');
        $user = \App\User::where('email', '=', $email)->first();
        if(!$user || !\Hash::check($password, $user->password)){
            return response()->json(['message' => 'invalid credentials'], 400);
        }

        $expiration = new \Carbon\Carbon();
        $expiration->addHour(2); // token valido por 2 horas
        $user->api_token = sha1(str_random(32)) . '.' . sha1(str_random(32));

        $user->api_token_expiration = $expiration->format('Y-m-d H:i:s');
        $user->save();

        return [
            'api_token' => $user->api_token,
            'api_token_expiration' => $user->api_token_expiration
        ];
    }

    public function userAuth(Request $request){
        return $request->user();
    }

    public function refreshToken(){
        $user = \Auth::user();
        $expiration = new \Carbon\Carbon();
        $expiration->addHour(2); // token valido por 2 horas
        $user->api_token = sha1(str_random(32)) . '.' . sha1(str_random(32));

        $user->api_token_expiration = $expiration->format('Y-m-d H:i:s');
        $user->save();

        return [
            'api_token' => $user->api_token,
            'api_token_expiration' => $user->api_token_expiration
        ];
    }
}
