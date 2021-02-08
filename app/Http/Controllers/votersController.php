<?php

namespace voting_system\Http\Controllers;

use Illuminate\Http\Request;
use voting_system\Http\Requests;
use voting_system\votersModel;
use voting_system\votesModel;
use voting_system\positionsModel;
use voting_system\candidatesModel;
use voting_system\CsvData;
use voting_system\Http\Requests\CsvImportRequest;
use voting_system\Http\Resources\Voter as VoterResource;
use Maatwebsite\Excel\Facades\Excel;

class votersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get voters
        $voters = votersModel::paginate(15);

        // Return collection of voter  as a resource
        return VoterResource::collection($voters);
    }

    public function search(Request $request){
        $search = $request->input('search');
        // return $search ;
        $voter = votersModel::where('name', 'like', '%'. $search .'%')->paginate(15);
        return VoterResource::collection($voter);
    }

    public function getImport(){
        return view('admin/import');
    }
    // composer require "maatwebsite/excel:~2.1.0"
    public function parseImport(CsvImportRequest $request){
        $path = $request->file('csv_file')->getRealPath();
        $csv_header_fields =[];
        if ($request->has('header')) {
            $data = Excel::load($path, function($reader) {})->get()->toArray();
        } else {
            
            $data = Excel::load($path, function($reader) {})->get()->toArray();
            // $data = array_map('str_getcsv', file($path));
            
        }
        // var_dump( $data );
        //     return $path;
        if (count($data) > 0) {
            if ($request->has('header')) {
                
                foreach ($data[0] as $key => $value) {
                    $csv_header_fields[] = $key;
                }
            }
            $csv_data = array_slice($data, 0, 2);
    
            $csv_data_file = CsvData::create([
                'csv_filename' => $request->file('csv_file')->getClientOriginalName(),
                'csv_header' => $request->has('header'),
                'csv_data' => json_encode($data)
            ]);
        } else {
            return redirect()->back();
        }
    
        return view('admin/import_fields', compact( 'csv_header_fields', 'csv_data', 'csv_data_file'));
    }

    public function processImport(Request $request){
        $data = CsvData::find($request->csv_data_file_id);
        $csv_data = json_decode($data->csv_data, true);
        foreach ($csv_data as $row) {
            $contact = new votersModel();
            foreach (config('app.db_fields') as $index => $field) {
                if ($data->csv_header) {
                    $contact->$field = $row[$request->fields[$field]];
                } else {
                    $contact->$field = $row[$request->fields[$index]];
                }
            }
            $contact->save();
        }

        return redirect('admin/voters');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $voter = $request->isMethod('put') ? votersModel::findOrFail($request->voter_id) : new votersModel;
        $voter->voter_id = $request->input('voter_id');
        $voter->student_id = $request->input('student_id');
        $voter->name = $request->input('name');
        $voter->course = $request->input('course');
        $voter->passcode = $request->input('passcode');

        if($voter->save()){
            return new VoterResource($voter);
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
        // Get Voter
        $list = votersModel::findOrFail($id);

        // Return  voter as a resource
        return new VoterResource($list);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Get Voter
        $list = votersModel::findOrFail($id);

        if( $list->delete() ){
            return new VoterResource($list);

        }
    }
// ===================== VOTERS PAGE ======================== //
    public function getDetials($id,$passcode){
        $voter = votersModel::where('student_id',$id)->where('passcode',$passcode)->first();
        if( $voter == "" ){
            return ["msg" => "Voter does not exist!"];
        }
        $vote = votesModel::where('voter_id',$voter->voter_id)->get();
        if( count($vote) > 0 ){
            return ["msg" => "You have already voted for this election."];
        }
        
        return new VoterResource($voter);
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

    public function votesprev(Request $request){
        $output = array('error'=>false,'list'=>'');
        
        // return $search ;
        $positions = positionsModel::all();
        foreach($positions as $value){
            $position = $value['description'];
            if( isset( $request[$position] ) ){
                if( $value['max_vote'] > 1 ){
                    if( count( $request[$position] ) > $value['max_vote'] ){
                        $output['error'] = true;
                        $output['message'][] = 'You can only choose '.$value['max_vote'].' candidates for '.$value['description'];
                    }
                    else{
                        foreach( $request[$position] as $key => $values ){
                            $candidates = candidatesModel::where('candidate_id', $values)->first();
                            $output['list'] .= "
                                <div class='row votelist'>
                                    <span class='col-sm-4'><span class='pull-right'><b>".$position." :</b></span></span> 
                                    <span class='col-sm-8'>".$candidates->lastname.", ".$candidates->firstname."</span>
                                </div>
                            ";
                        }
                    }
                }
                else{
                    $candidate = $request[$position];
                    $candidates = candidatesModel::where('candidate_id', $candidate)->first();
                    $output['list'] .= "
                        <div class='row votelist'>
                            <span class='col-sm-4'><span class='pull-right'><b>".$position." :</b></span></span> 
                            <span class='col-sm-8'>".$candidates->lastname.", ".$candidates->firstname."</span>
                        </div>
                    ";
                }
            }
        }
        return json_encode($output);
        // return VoterResource::collection($output);
    }

    public function submitvotes(Request $request){
        $votes;
        $positions = positionsModel::all();
        foreach($positions as $value){
            $position = $value['description'];
            if( isset( $request[$position] ) ){
                if( $value['max_vote'] > 1 ){
                    if( count( $request[$position] ) > $value['max_vote'] ){
                        $output['error'] = true;
                        $output['message'][] = 'You can only choose '.$value['max_vote'].' candidates for '.$value['description'];
                        return json_encode($output);
                    }
                    else{
                        foreach( $request[$position] as $key => $values ){
                            $votes[] =[
                                'voter_id' =>  $request->input('voter_id'),
                                'candidate_id' => $values
                            ];

                        }
                    }
                }
                else{
                    $candidate = $request[$position];
                    $votes[] =[
                        'voter_id' =>  $request->input('voter_id'),
                        'candidate_id' => $candidate
                    ];
                }
            }
        }
        
        if(votesModel::insert($votes)){
            return json_encode(['error'=>false]);
        }else{
            return json_encode(['error'=>true]);
        }
        
        // return VoterResource::collection($output);
    }
}
