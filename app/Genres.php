<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Work;

class Genres extends Model
{
    public function works()
    {
        return $this->hasMany('App\Work');
    }
}
