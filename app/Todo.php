<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model  //modelを継承しているのでDB操作が行える
{
    protected $fillable = [  //fillとセット
        'title',
        'user_id'
    ];

    public function getByUserId($id)
    {
        return $this->where('user_id', $id)->get();
    }

}
