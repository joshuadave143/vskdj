<?php

namespace voting_system;

use Illuminate\Database\Eloquent\Model;

class votesModel extends Model
{
    public $timestamps = false;
    public $table = "votes";
    protected $primaryKey = 'vote_id';
    protected $fillable = ['candidate_id', 'voter_id'];

    public function candidates(){
        return $this->belongsTo('voting_system\candidatesModel', 'candidate_id', 'candidate_id');
    }

    public function voters(){
        return $this->belongsTo('voting_system\votersModel', 'voter_id', 'voter_id');
    }
}
