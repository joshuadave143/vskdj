<?php

namespace voting_system\Http\Controllers;

use Illuminate\Http\Request;
use voting_system\Http\Requests;
use voting_system\Http\Resources\votesResources;

use voting_system\votesModel;

class votesController extends Controller
{
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return view('admin/votes');
        return $votes = votesModel::with('candidates.positions')->with('voters')->get();
    }
    
    public function deleteAll(){
        return json_encode(votesModel::truncate()? "ok":"not");
    }
}
