<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class League extends Model
{
    public function official(){
      return  $this->belongsTo('App\User','official_id');
    }

    public function teams(){
        return $this->hasMany('App\Team');
    }

    
}
