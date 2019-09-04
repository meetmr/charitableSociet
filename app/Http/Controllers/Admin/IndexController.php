<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Crypt;
use App\Activity;
use App\Word;
class IndexController extends BaseController
{
    public function index(){

        return view('admin.index.index');
    }
    public function welcome(){
       $userCount = User::all()->count(); //成员总数
        $aCount = Activity::all()->count();
        $wordCount = Word::all()->count();
        return view('admin.index.welcome',[
            'userCount'    => $userCount,
            'aCount'       => $aCount,
            'wordCount'   => $wordCount
        ]);    }
    public function login(){
        return view('admin.index.login');
    }
    public function chelogin(Request $request){
        $data = $request->all();
        $school_number = $data['school_number'];
        $password =  $data['password'];
        $user = User::where('school_number',$school_number)->get();
        $user = $user->toArray();
        if(count($user) == 0){
            $state = [
                'error' => 0,
                'msg'=> '閿欒'
            ];
            return json_encode($state);
        }
        if(Crypt::decrypt($user[0]['password']) !== $password){
            $state = [
                'error' => 0,
                'msg'=> '瀵嗙爜閿欒'
            ];
            return json_encode($state);
        }
        if($user[0]['admin'] !== 1){
            $state = [
                'error' => 0,
                'msg'=> '瀵嗙爜閿欒'
            ];
            return json_encode($state);
        }
        session(['admin'=>$user[0]]);
        $state = [
            'error' => 1,
            'msg'=> '鐧婚檰鎴愬姛'
        ];
        return json_encode($state);
    }
}
