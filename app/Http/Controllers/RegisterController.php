<?php

namespace App\Http\Controllers;

use App\Data_user;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    private $request;
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function register($data = null)
    {
        $user = $this->request->only(['email', 'password']);
        $user['password'] = Hash::make($user['password']);

        if (!empty(User::where('email', $user['email'])->first())) {
            $this->request->session()->flash('worning', ['danger' => "Этот эл. адрес уже занят другим пользователем."]);
            return redirect('/register');
        }
        Data_user::add_data_user($data?$data:$user);
        $this->request->session()->flash('worning', ['success' => 'Пользователь  успешно зарегистрирован.']);
        return redirect('/login');
    }
}
