<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\About;
class AboutController extends BaseController
{
    public function listInfo(){
        return view('admin.about.info');
    }
    public function add(){
        return view('admin.about.add');
    }


    public function upload(Request $request){
        $file = $request->file('file');
        if ($file->isValid()) {
            $path = $file->store(date('ymd'), 'public');
            return json_encode([
                'code' =>1,
                'url' =>asset('/storage/' . $path)
            ]);
        }
    }
    

    public function cheadd(Request $request){
        $data = $request->post();
        $about = new About();
        $about->title = $data['title'];
        $about->icon = $data['icon'];
        $about->coantent = $data['coantent'];
        $about->time = $data['start_time'].'--'.$data['end_time'];
        $info = $about->save();
        if($info){
            $state = [
                'error' => 1,
                'msg'=> '添加成功'
            ];
            return json_encode($state);
        }else{
            $state = [
                'error' => 0,
                'msg'=> '添加失败'
            ];
            return json_encode($state);
        }

    }
}
