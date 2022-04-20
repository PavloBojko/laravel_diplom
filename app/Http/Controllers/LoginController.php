<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    private $request;
    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    public function login()
    {
        $this->request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $credentials = $this->request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $this->request->session()->flash('worning', ['success' => 'Пользователь авторизирован']);

            return redirect()->intended('/');
        }
        $this->request->session()->flash('worning', ['danger' => 'Пользователь  с такими авторизацыонними данными ненайден']);

        return redirect('/login');
    }
}
