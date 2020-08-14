<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    // 関連するモデルの紐付け
    public function tasks()
    {
        return $this->hasMany('App\Task');
    }
}
