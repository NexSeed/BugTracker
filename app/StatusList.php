<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatusList extends Model
{
    public function articles() {
	    $this->hasMany('App\Article');
    }


}
