<?php

namespace App\Http\Controllers;

use App\Data_user;
use App\User;
use Illuminate\Http\Request;

class EditUserController extends Controller
{

    private $request;
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function edit($id = null)
    {

        $data = $this->request->only(['name', 'work', 'tel', 'adres']);
        
        // User::find($id)->data_user->update($user_data);

        
        Data_user::edit_user($id, $data);


        $this->request->session()->flash('worning', ['success' => "данные успешно обновлены"]);
        return redirect('/');
    }
}
