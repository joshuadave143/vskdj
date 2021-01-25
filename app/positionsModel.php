<?php

namespace voting_system;

use Illuminate\Database\Eloquent\Model;

class positionsModel extends Model
{
    public $timestamps = false;
    public $table = "positions";
    protected $primaryKey = 'position_id';
    protected $fillable = ['description', 'priority', 'max_vote'];

    public function candidates(){
        return $this->hasMany('voting_system\candidatesModel', 'position_id', 'position_id');
    }
}
