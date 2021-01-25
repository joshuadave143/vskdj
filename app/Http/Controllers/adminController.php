<?php

namespace voting_system\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class adminController extends Controller
{
    public function election_config(Request $request){
        // File::put('public/config.txt','John Doe');
        Storage::put('Election_config.txt',$request->name);
        return ["success"];
    }

    public function getconfig(){
        return [Storage::get('Election_config.txt')];
        // Storage::get('Election_config.txt')
    }
}
