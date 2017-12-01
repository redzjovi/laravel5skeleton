<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Options extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'value',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    public function validate($input, $scenario = 'create')
    {
        $rules = [
            'id' => ['required', 'integer', 'digits_between:1,10'],
            'name' => ['required', 'between:0,191'],
            'guard_name' => ['required'],
        ];

        if ($scenario == 'create') {
            $rules = [
                'name' => ['required', 'between:0,191', 'unique:options,name'],
            ];
        } else if ($scenario == 'update') {
            $rules = [
                'id' => ['required', 'integer', 'digits_between:1,10'],
                'name' => ['required', 'between:0,191', 'unique:options,name,'.$this->id],
            ];
        }

        return Validator::make($input, $rules);
    }

    public function scopeSearch($query, $params)
    {
        isset($params['name']) ? $query->where('name', 'like', '%'.$params['name'].'%') : '';
        isset($params['value']) ? $query->where('value', 'like', '%'.$params['value'].'%') : '';
        if (isset($params['sort']) && $sort = explode(',', $params['sort'])) {
            count($sort) == 2 ? $query->orderBy($sort[0], $sort[1]) : '';
        }

        return $query;
    }
}
