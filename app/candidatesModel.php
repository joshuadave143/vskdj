<?php

namespace voting_system;

use Illuminate\Database\Eloquent\Model;
// use voting_system\positionsModel;

class candidatesModel extends Model
{
    public $timestamps = false;
    public $table = "candidates";
    protected $primaryKey = 'candidate_id';
    protected $fillable = ['firstname', 'lastname', 'MI', 'photo', 'platform', 'position_id'];

    public function positions(){
        return $this->belongsTo('voting_system\positionsModel', 'position_id', 'position_id');
    }

    public function votes(){
        return $this->hasMany('voting_system\votesModel','candidate_id', 'candidate_id');
    }
}
