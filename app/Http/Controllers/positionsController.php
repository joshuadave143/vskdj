<?php

namespace voting_system\Http\Controllers;

use Illuminate\Http\Request;
use voting_system\Http\Requests;
use voting_system\positionsModel;
use voting_system\candidatesModel;
use voting_system\Http\Resources\PositionsResource;

class positionsController extends Controller
{
    public function index()
    {
        // get position
        $positions = positionsModel::paginate(15);

        // Return collection of pistion  as a resource
        return PositionsResource::collection($positions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $position = $request->isMethod('put') ? positionsModel::findOrFail($request->position_id) : new positionsModel;
        $position->position_id = $request->input('position_id');
        $position->description = $request->input('description');
        $position->max_vote = $request->input('max_vote');
        $position->priority = 1;

        if($position->save()){
            return new PositionsResource($position);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Get postion
        $list = positionsModel::findOrFail($id);

        // Return  position as a resource
        return new PositionsResource($list);
    }

    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Get position
        $list = positionsModel::findOrFail($id);

        if( $list->delete() ){
            return new PositionsResource($list);
        }
    }
}
