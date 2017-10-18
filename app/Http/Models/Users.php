<?php

namespace App\Http\Models;

use Illuminate\Support\Facades\Validator;

class Users extends \App\User
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function validate($input, $scenario = 'create')
    {
        if ($scenario == 'create') {
            $rules = [
                'name' => ['required'],
                'email' => ['required', 'email'],
                'password' => ['required', 'min:5'],
            ];
        }

        return Validator::make($input, $rules);
    }

    public function scopeSearch($query, $params)
    {
        isset($params['name']) ? $query->where('name', 'like', '%'.$params['name'].'%') : '';
        isset($params['email']) ? $query->where('email', 'like', '%'.$params['email'].'%') : '';
        if (isset($params['sort']) && $sort = explode(',', $params['sort'])) {
            count($sort) == 2 ? $query->orderBy($sort[0], $sort[1]) : '';
        }

        return $query;
    }
}
