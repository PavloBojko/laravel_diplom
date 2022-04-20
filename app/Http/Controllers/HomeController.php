<?php

namespace App\Http\Controllers;

use App\Data_user;
use App\Statuses;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function users()
    {
        $data = [];
        // dd($this->request->session()->all());
        // dd(get_class_methods(Auth::user()));
        //    dd(Auth::user()->email);

        $data['flash'] = $this->request->session()->get('worning');
        // $data['authorized_user'] = Auth::user()->email;
        $data['users'] = User::paginate(5);
        // dd(User::find(Auth::user()->id)->data_user);
        User::find(Auth::user()->id)->data_user->role->role == 'admin' ? $data['role'] = 'admin' : $data['role'] = 'guest';
        // dd($data['users']->find(Auth::user()->id)->data_user->status->color);
        // dd(User::find(Auth::user()->id)->data_user->role->role);

        // $userid = User::find(Auth::user()->id)->data_user->user_id;
        // dd($userid);
        // dd(Data_user::find(User::find(Auth::user()->id)->data_user->id)->role->role);
        return view('users', ['data' => $data]);
    }

    public function edit($id = null)
    {
        if (User::find(Auth::user()->id)->data_user->role->role == 'admin' || Auth::user()->id == $id) {
            $data['flash'] = $this->request->session()->get('worning');
            $data['users'] = User::find($id);
            return view('edit', ['data' => $data]);
        }
        // dd($data['users']->data_user->name);
        // $data['authorized_user'] = Auth::user()->email;

        // $status = Statuses::first();
        // dd($status->data_useres);

        // $data_User =  Data_User::find(4);
        // dd($data_User->status->status);
        $this->request->session()->flash('worning', ['danger' => "У вас нет прав редактировать ети данные"]);
        return redirect('/');
    }

    public function security($id = null)
    {
        if (User::find(Auth::user()->id)->data_user->role->role == 'admin' || Auth::user()->id == $id) {
            $data['flash'] = $this->request->session()->get('worning');
            $data['users'] = User::find($id);

            return view('security', ['data' => $data]);
        }

        $this->request->session()->flash('worning', ['danger' => "У вас нет прав редактировать ети данные"]);
        return redirect('/');
    }

    public function status($id = null)
    {
        if (User::find(Auth::user()->id)->data_user->role->role == 'admin' || Auth::user()->id == $id) {
            $data['flash'] = $this->request->session()->get('worning');
            $data['users'] = User::find($id);
            $data['staus'] = Statuses::all();

            return view('status', ['data' => $data]);
        }

        $this->request->session()->flash('worning', ['danger' => "У вас нет прав редактировать ети данные"]);
        return redirect('/');
    }

    public function media($id = null)
    {
        if (User::find(Auth::user()->id)->data_user->role->role == 'admin' || Auth::user()->id == $id) {
            $data['flash'] = $this->request->session()->get('worning');
            $data['users'] = User::find($id);
            return view('media', ['data' => $data]);
        }

        $this->request->session()->flash('worning', ['danger' => "У вас нет прав редактировать ети данные"]);
        return redirect('/');
    }

    public function register()
    {
        $flash = $this->request->session()->get('worning');

        return view('register', ['flash' => $flash]);
    }

    public function login()
    {
        $flash = $this->request->session()->get('worning');

        return view('login', ['flash' => $flash]);
    }
    public function create_user()
    {

        $data['flash'] = $this->request->session()->get('worning');
        $data['status'] = Statuses::all();
        // dd($data);
        return view('create_user', ['data' => $data]);
    }
}
