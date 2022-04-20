<?php

namespace App\Http\Controllers;

use App\Data_user;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class LogicController extends Controller
{
    private $request;
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function status($id = null)
    {

        $status = $this->request->only('status_id');
        if (User::find(Auth::user()->id)->data_user->role->role == 'admin' || Auth::user()->id == $id) {
            User::find($id)->data_user->update($status);
            $this->request->session()->flash('worning', ['success' => "данные успешно обновлены"]);
            return redirect('/');
        }
        $this->request->session()->flash('worning', ['danger' => "У вас нет прав редактировать ети данные"]);
        return redirect('/');
    }
    public function media($id = null)
    {
        // dd($this->request->src);
        if (User::find(Auth::user()->id)->data_user->role->role == 'admin' || Auth::user()->id == $id) {

            if ($this->request->avatar) {
                Storage::delete($this->request->src);
                // $fileName = $this->request->avatar->getClientOriginalName();
                $fileType = $this->request->avatar->getClientOriginalExtension();
                $fileName = $id . '_avatar.' . $fileType;
                // dd($fileName);
                $avatar = $this->request->avatar->storeAs('uploads', $fileName);

                User::find($id)->data_user->update(['avatar' => $avatar]);
                $this->request->session()->flash('worning', ['success' => "данные успешно обновлены"]);
                return redirect('/');
            }
        }
        $this->request->session()->flash('worning', ['danger' => "У вас нет прав редактировать ети данные"]);
        return redirect('/');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->intended('/');
    }

    public function faker()
    {
        factory(Data_user::class, 5)->create();
        return redirect('/');
    }
}
