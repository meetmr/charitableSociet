<?php

namespace App\Http\Controllers;

use App\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function info(){
        $abouts = About::orderBy('id','desc')->get();

        return view('index.about.info',[
            'title'     =>  '爱心社-关于我们',
            'abouts'    =>  $abouts
        ]);
    }
    public function infoList($id){
        $id = intval($id);
        $about = About::find($id);
        if($about == null){
            return redirect('/');
        }
        $about = $about->toArray();
        return view('index.about.list',[
            'title'     =>  '爱心社-'.$about['title'].'相册',
            'abouts'    =>  $about
        ]);
    }
}
