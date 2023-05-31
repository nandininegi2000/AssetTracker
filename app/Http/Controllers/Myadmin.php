<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AssetType;
use App\Models\Asset;
use App\Models\Image;
use Illuminate\Support\Facades\DB;
class Myadmin extends Controller
{
    function show(){
        $data= AssetType::latest()->paginate(2);
        return view('admin.assettypelist',compact('data'));
    }
    function delete($id){
        $data=AssetType::find($id);
        $dataasset=Asset::where('type',$data->type)->get();
        foreach($dataasset as $da){
            $da->delete();
        }
        $data->delete();
        return redirect('list');
    }
    function showData($id){
        $data=AssetType::find($id);
        return view('admin.updatetype',['data'=>$data]);
    }
    function update(Request $req){
        $data=AssetType::find($req->id);
        $oldType=$data->type;
        $data->type=$req->type;
        $data->description=$req->description;
        if($data->save()){
        $asset=Asset::where('type',$oldType)->get();
        foreach($asset as $as){
            $as->type=$data->type;
            $as->save();
        }
        return redirect('list');
        }
    }
    function insert(Request $req){
        $val=$req->validate(['type'=>'required|unique:asset_types,type','description'=>'max:500']);
        if($val){
        $data=new AssetType();
        $data->type=$req->type;
        $data->description=$req->description;
        $data->save();
        return redirect('list');
        }

    }
    public function showasset(){
        $data= Asset::latest()->paginate(2);
        return view('admin.listasset',['data'=>$data]);
    }
    public function addasset(){
        $data=AssetType::all();
        return view('admin.createasset',['data'=>$data]);
    }
    function insertasset(Request $req){
        $val=$req->validate([
            'name'=>'required',
            'code'=>'required',
            'type'=>'required',
            'isactive'=>'required',
            'filenames'=>'required',
            'filenames.*'=>'mimes:jpeg,png,jpg,gif'
        ]);
        if($val){
        $dataas=new Asset();
        $dataas->name=$req->name;
        $dataas->code=$req->code;
        $dataas->type=$req->type;
        $dataas->isactive=$req->isactive;
        $dataas->save();
        if($req->hasfile('filenames'))
         {  define('id',$dataas->id);

            foreach($req->file('filenames') as $f)
            {
                $name = rand().time().'.'.$f->extension();
                $f->move(public_path().'/files/', $name);  
                $file= new Image();
                $file->asset_id=id;
                $file->image=$name;
                $file->save();
            }

            return redirect('assetlist');
         }



         
        }

    }
    function deleteasset($id){
        $data=Asset::find($id);
        $data->delete();
        return redirect('assetlist');
    }
    function showassetData($id){
        $typedata=AssetType::all();
        $data=Asset::find($id);
        $astimage=Image::where('asset_id',$id)->get();
        return view('admin.updateasset',['dt'=>$data,'data'=>$typedata,'astimg'=>$astimage]);
    }
    function updateasset(Request $req){
        $data=Asset::find($req->id);
        $data->name=$req->name;
        $data->type=$req->type;
        $data->isActive=$req->isactive;
        $data->save();
        if($req->hasfile('filenames'))
        {  define('id',$data->id);
            $oldimg=Image::where('asset_id',$req->id)->get();
            foreach($oldimg as $oi){
                $oi->delete();
            }
           foreach($req->file('filenames') as $f)
           {
               $name = rand().time().'.'.$f->extension();
               $f->move(public_path().'/files/', $name);  
               $file= new Image();
               $file->asset_id=id;
               $file->image=$name;
               $file->save();
           }
        }
        return redirect('assetlist');
    }
    function showimg($id){
        $imgdata=Image::where('asset_id',$id)->get();
        return view('admin.showimage',['img'=>$imgdata]);
    }
    function dashboard(){
        return redirect("assetlist");
    }
    function piechart(){
    $result=DB::select(DB::raw("select count(*) as total_asset,type from assets group by type"));
    $chartDt="";
    foreach($result as $list){
        $chartDt.="['".$list->type."',".$list->total_asset."],";
    }
    $arr['chartDt']=rtrim($chartDt,",");
    return view('admin.dashboard',$arr);
    }
    function barchart(){
        $result=AssetType::all();
        $chartDt="";
        foreach($result as $list){
            $active=count(Asset::where(['type'=>$list->type,'isActive'=>'true'])->get());
            $deactive=count(Asset::where(['type'=>$list->type,'isActive'=>'false'])->get());
            $chartDt.="['".$list->type."',$active,$deactive],";
        }
        $arr['chartDt']=rtrim($chartDt,",");
            
        return view('admin.barchart',$arr);
    }
    public function exportCsv(Request $request)
    {
   $fileName = 'asset.csv';
   $tasks = Asset::all();

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Id', 'Name', 'Code', 'Type', 'Is_Active','created_at','updated_at');

        $callback = function() use($tasks, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($tasks as $task) {
                $row['Id']  = $task->id;
                $row['Name']    = $task->name;
                $row['Code']    = $task->code;
                $row['Type']  = $task->type;
                $row['Is_active']  = $task->isActive;
                $row['created_at']=$task->created_at;
                $row['updated_at']=$task->updated_at;
                

                fputcsv($file, array($row['Id'], $row['Name'], $row['Code'], $row['Type'], $row['Is_active'],$row['created_at'],$row['updated_at']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

  
}