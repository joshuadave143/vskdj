<?php

namespace voting_system\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class votesResources extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $data = [
            'vote_id' => $this->vote_id,
            'candidate_id' => $this->candidate_id,
            'voter_id'  =>  $this->voter_id
        ];
        return $data;
        // return parent::toArray($request);
    }
}
