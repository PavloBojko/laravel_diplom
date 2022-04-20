<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DellController extends Controller
{
    public function dell(Request $request, $id = null)
    {
        // dd(User::find($id)->data_user->delete());

        if (User::find(Auth::user()->id)->data_user->role->role == 'admin' || Auth::user()->id == $id) {

            Storage::delete(User::find($id)->data_user->avatar);
            User::find($id)->data_user->delete();
            User::find($id)->delete();
            return redirect('/');
            
        }
        $request->session()->flash('worning', ['danger' => "У вас нет прав редактировать ети данные"]);
        return redirect('/');
    }
}
