<?php

namespace App\Http\Controllers;

use App\Http\Resources\TaskCollection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\AssetType;
class Taskapi extends Controller
{
    public function index(){
        $data=AssetType::latest()->get();
        return response()->json($data);
    }
    public function addtask(Request $req){
        $validator=Validator::make($req->all(),[
            'type'=>'required',
            'description'=>'max:500'
        ]);
        if($validator->fails()){
            return response()->json($validator->errors());
        }else{
            $data=new AssetType();
            $data->type=$req->type;
            $data->description=$req->description;
            if($data->save()){
                return response()->json(['tasks'=>new TaskCollection($data),'msg'=>'api added']);
            }else{
                return response()->json(['msg'=>'api not added']);
            }
        }

    }
}
