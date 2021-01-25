<?php

namespace voting_system\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use voting_system\Http\Requests;
use voting_system\candidatesModel;
use voting_system\Http\Resources\candidatesResources;

class candidatesController extends Controller
{
    private $image_ext = ['jpg', 'jpeg', 'png', 'gif'];

    // public function __construct(){
    //     $this->middleware('auth');
    // }

    public function index(){
        // $candidates = candidatesModel::get()->paginate(15)

        $candidates = candidatesModel::with('positions')->paginate(15);
        return candidatesResources::collection($candidates);
    }

    public function store(Request $request){

        if( $request->isMethod('put')){
            $candidate = candidatesModel::findOrFail($request->candidate_id);
           
            if( $request->input('photo') != null ){
                $photo = explode('/',$candidate->photo);
                if(Storage::delete( 'public/' . $photo[2])){
                    
                    $candidate->photo = '../storage/'.$request->input('photo');
                }
            }

            $candidate->candidate_id = $request->input('candidate_id');
            $candidate->firstname = $request->input('firstname');
            $candidate->lastname = $request->input('lastname');
            $candidate->MI = $request->input('MI');
            $candidate->platform = $request->input('platform');
            $candidate->position_id = $request->input('position_id');
            
            if($candidate->save()){
                
                return new candidatesResources($candidate);
                
            }
        }
       
        if( $request->isMethod('post')){
            $candidate = new candidatesModel;
            $candidate->candidate_id = $request->input('candidate_id');
            $candidate->firstname = $request->input('firstname');
            $candidate->lastname = $request->input('lastname');
            $candidate->MI = $request->input('MI');
            $candidate->photo = '../storage/'.$request->input('photo');
            $candidate->platform = $request->input('platform');
            $candidate->position_id = $request->input('position_id');
            if($candidate->save()){
                return new candidatesResources($candidate);
            }
            return "error";
        }
    }

    public function uploadImage(Request $request){
        if($request->hasFile('image')){
            $imagename = $request->image->getClientOriginalName();
            $request->image->storeAs('public',$imagename);
        }
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Get candidate
        $list = candidatesModel::findOrFail($id);
        $photo = explode('/',$list->photo);
        // return 'public/' . $photo[2];
        if( $list->delete() ){
            if(Storage::delete( 'public/' . $photo[2])){
                return new candidatesResources($list);
            }
            
        }
    }
}
