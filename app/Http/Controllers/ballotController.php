<?php

namespace voting_system\Http\Controllers;

use Illuminate\Http\Request;
use voting_system\Http\Requests;

use voting_system\positionsModel;
use voting_system\candidatesModel;
use voting_system\Http\Resources\ballotResources;

class ballotController extends Controller
{
    public function index()
    {
        // get position
        // $positions = positionsModel::paginate(15);

        // // Return collection of pistion  as a resource
        // return PositionsResource::collection($positions);
        // get position
        // $positions = positionsModel::all();orderBy('id', 'DESC')->get();
        $positions = positionsModel::orderBy('priority', 'ASC')->get();
        // $position['data'] = $positions;
        // print_r( $positions);
        // Return collection of pistion  as a resource
        // return $positions;
        return ballotResources::collection($positions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $position = positionsModel::findOrFail($request->position_id);
        // $up = $position->priority -1
        $position->priority = $request->input('priority');
        
        if($position->save()){
            return new ballotResources($position);
        }
    }

    public function move($priority, $pos){
        $priority = positionsModel::where('priority', $priority)->first();
        if( $pos == "down" ){
            $priority->priority += 1;
        }
        elseif( $pos == "up" ){
            $priority->priority -= 1;
        }
        if($priority->save()){
            return $priority;
        }
    }
    
    public function moveup(Request $request)
    {
        $position = positionsModel::findOrFail($request->position_id);
        $up = $position->priority -1;
        // Find the prio and change it
        $id = ballotController::move($up,"down");
        $position->priority = $up;
        if($position->save()){
            return new ballotResources($id);
        }
        
    }
    
    public function movedown(Request $request)
    {
        $position = positionsModel::findOrFail($request->position_id);
        $down = $position->priority +1;
        // Find the prio and change it
        $id = ballotController::move($down,"up");
        $position->priority = $down;
        if($position->save()){
            return new ballotResources($id);
        }
        
    }

    
    public function getCandidates($id){
        // return $id;
        $priority = candidatesModel::where('position_id', $id)->get();
        return $priority;
        
    }
    

}
