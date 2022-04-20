<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UpdateUserController extends Controller
{
    private $request;
    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    public function security($id = null)
    {
        // $this->request->validate([
        //     'email' => 'required',
        //     'password' => 'required',
        // ]);
        $this->request->validate([
            'email' => 'required',
            'password' => ['required', 'confirmed'],
            'password_confirmation' => 'required'
        ]);

        $user = $this->request->only('email', 'password');
        $user['password'] = Hash::make($user['password']);
        // $user1 = User::where('email', $user['email'])->first();
        // if (!empty($user1)) {
        //     $this->request->session()->flash('worning', ['danger' => "Этот эл. адрес уже занят другим пользователем."]);
        //     return redirect("/security/$id");
        // }
        // dd(User::find(Auth::user()->id)->data_user->role->role);
        if (User::find(Auth::user()->id)->data_user->role->role == 'admin' || Auth::user()->id == $id) {
            User::find($id)->update($user);
            $this->request->session()->flash('worning', ['success' => "данные успешно обновлены"]);
            return redirect('/');
        }
        $this->request->session()->flash('worning', ['danger' => "У вас нет прав редактировать ети данные"]);
        return redirect('/');
    }
}
