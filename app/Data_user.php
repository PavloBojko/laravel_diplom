<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Data_user extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'avatar',
        'work',
        'tel',
        'adres',
        'status_id',
        'role_id'
    ];


    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function role()
    {
        return $this->belongsTo('App\Roles');
    }

    public function status()
    {
        return $this->belongsTo('App\Statuses');
    }
    public static function add_data_user($data)
    {
        Data_user::create([
            'user_id' => User::register($data),
            'name' => !empty($data['name']) ? $data['name'] : '',
            'avatar' => !empty($data['avatar']) ? $data['avatar'] : '',
            'work' => !empty($data['work']) ? $data['work'] : '',
            'tel' => !empty($data['tel']) ? $data['tel'] : '',
            'adres' => !empty($data['adres']) ? $data['adres'] : '',
            'role_id' => !empty($data['role_id']) ? $data['role_id'] : '1',
            'status_id' => !empty($data['status_id']) ? $data['status_id'] : '1'
        ]);
    }
    public static function edit_user($id, $data)
    {
        User::find($id)->data_user->update($data);
        // Data_user::find($id)->update($data);
    }
}
