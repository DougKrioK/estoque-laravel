<?php

namespace estoque\Http\Controllers;

use Auth;
use Request;

class LoginController extends Controller
{
    public function login()
    {   
        $email = Request::input('email');
        $password = Request::input('password');
        $credenciais = [
            'email' => $email,
            'password' => $password
        ];

        if(Auth::attempt($credenciais)) {
            return "Usuário NOME logado com sucesso";
        }

        return "As credencias não são válidas";
    }
}
