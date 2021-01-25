<?php

namespace voting_system;

use Illuminate\Database\Eloquent\Model;

class votersModel extends Model
{
    public $timestamps = false;
    public $table = "voters";
    protected $primaryKey = 'voter_id';
    protected $fillable = ['student_id', 'name', 'course'];
    public function votes(){
        return $this->hasMany('voting_system\votesModel');
    }
}
