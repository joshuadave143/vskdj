<?php

namespace voting_system\Http\Controllers;

use Illuminate\Http\Request;

use voting_system\positionsModel;
use voting_system\candidatesModel;
use voting_system\votesModel;
use voting_system\votersModel;

use voting_system\Http\Resources\candidatesResources;
use voting_system\Http\Requests;
use Request as Req;
use View;

use Auth;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    private $tempID = [];
    private $tempCount = [];

    public function index()
    {
        if(Auth::check()){
            return View::make('admin/dashboard')->with('data', json_decode(DashboardController::get_all_data(), true));
        }
        return redirect('login');
    }



    public function slugify($string){
        $preps = array('in', 'at', 'on', 'by', 'into', 'off', 'onto', 'from', 'to', 'with', 'a', 'an', 'the', 'using', 'for');
        $pattern = '/\b(?:' . join('|', $preps) . ')\b/i';
        $string = preg_replace($pattern, '', $string);
        $string = preg_replace('~[^\\pL\d]+~u', '-', $string);
        $string = trim($string, '-');
        $string = iconv('utf-8', 'us-ascii//TRANSLIT', $string);
        $string = strtolower($string);
        $string = preg_replace('~[^-\w]+~', '', $string);
        
        return $string;
    }

    public function slugify2($string){
        $preps = array('in', 'at', 'on', 'by', 'into', 'off', 'onto', 'from', 'to', 'with', 'a', 'an', 'the', 'using', 'for');
        $pattern = '/\b(?:' . join('|', $preps) . ')\b/i';
        $string = preg_replace($pattern, '', $string);
        $string = preg_replace('~[^\\pL\d]+~u', '_', $string);
        $string = trim($string, '_');
        $string = iconv('utf-8', 'us-ascii//TRANSLIT', $string);
        $string = strtolower($string);
        $string = preg_replace('~[^-\w]+~', '', $string);
        
        return $string;
    }

    public function countvotes(){
        if( Req::ajax()){
            $ids = Req::all()["data"];
            // return json_decode($ids);
            $votes = array();
            for( $i = 0; $i < count($ids); $i++ ){
                array_push($votes,votesModel::select('voter_id')
                ->where('candidate_id',$ids[$i])
                ->get()
                ->count());
            }
            return $votes;
        }
        
    }

    public function setArray_of_votes($candiList){
        $this->tempID = [];
        $this->tempCount = [];
        foreach($candiList as $candidate){
            array_push( $this->tempID, $candidate['candidate_id'] );
            array_push( $this->tempCount, count($candidate['votes']) );
        }
    }

    public function getWinner(){
        $temp = 0;
        $winner = 0;
        for( $i = 0; $i < count($this->tempID); $i++ ){
            if( $temp < $this->tempCount[$i] ){
                $temp = $this->tempCount[$i];
                $winner = $this->tempID[$i];
            }
        }
        return $winner;
    }


    public function get_total_PCVV(){
        $data = [
            'pos' => DashboardController::countPositions(),
            'cand' => DashboardController::countCandidates(),
            'voters' => DashboardController::countvoters(),
            'votes' => DashboardController::countvoters_voted(),
        ];
        return $data;
    }

    public function countPositions(){
        return positionsModel::all()
                                ->count();
    }

    public function countCandidates(){
        return candidatesModel::all()
                                ->count();
    }

    public function countvoters_voted(){
        return votesModel::select('voter_id')
                                ->groupBy('votes.voter_id')
                                ->get()
                                ->count();
    }

    public function countvoters(){
        return votersModel::all()
                            ->count();
    }

    public function get_all_data(){

        $positions = positionsModel::with('candidates.votes')->orderBy('priority', 'ASC')->get();
        return json_encode($positions);

        
    }

}
