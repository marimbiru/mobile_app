<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $primaryKey = 'player_id';
    public function team()
    {
        return $this->belongsTo('App\Team', 'current_team_id');
    }
}
