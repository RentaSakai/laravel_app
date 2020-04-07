<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Todo extends Model  //modelを継承しているのでDB操作が行える
{
    use SoftDeletes;
    protected $fillable = [  //fillとセット
        'title',
        'user_id'
    ];

    public function getByUserId($id)
    {
        return $this->where('user_id', $id)->get();
    }
    protected $dates = ['deleted_at'];
}
