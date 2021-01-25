<?php

namespace voting_system\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class ballotResources extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        $data = [
            'position_id' => $this->position_id,
            'description' => $this->description,
            'priority'  =>  $this->priority,
            'max_vote'  =>  $this->max_vote,
            'candiList'  =>  ''
        ];
        return $data;
    }
}
