<?php

namespace voting_system\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class candidatesResources extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
