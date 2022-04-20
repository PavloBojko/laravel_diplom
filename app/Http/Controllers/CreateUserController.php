<?php

namespace App\Http\Controllers;

use App\Data_user;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CreateUserController extends Controller
{
    private $request;
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function create_user()
    {
        // dd(get_class_methods($this->request->avatar));
        $this->request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = $this->request->only(['email', 'password', 'name', 'work', 'tel', 'adres', 'status_id']);
        $user['password'] = Hash::make($user['password']);

        if (!empty(User::where('email', $user['email'])->first())) {
            $this->request->session()->flash('worning', ['danger' => "Этот пользователь уже зарегистрирован."]);
            return redirect('/create_user');
        }

        if ($this->request->avatar) {
            $fileType = $this->request->avatar->getClientOriginalExtension();
            $fileName = $user['email'] . '_avatar.' . $fileType;
            $avatar = $this->request->avatar->storeAs('uploads', $fileName);
        } else {
            $avatar = '';
        }

        $user['avatar'] = $avatar;

        Data_user::add_data_user($user);

        $this->request->session()->flash('worning', ['success' => "пользователь успешно добавлен"]);
        return redirect('/');
    }
}
