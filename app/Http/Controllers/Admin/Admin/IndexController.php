<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Crypt;

class IndexController extends BaseController
{
    public function index(){

        return view('admin.index.index');
    }
    public function welcome(){
        return view('admin.index.welcome');
    }
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
                'msg'=> '错误'
            ];
            return json_encode($state);
        }
        if(Crypt::decrypt($user[0]['password']) !== $password){
            $state = [
                'error' => 0,
                'msg'=> '密码错误'
            ];
            return json_encode($state);
        }
        if($user[0]['admin'] !== 1){
            $state = [
                'error' => 0,
                'msg'=> '密码错误'
            ];
            return json_encode($state);
        }
        session(['admin'=>$user[0]]);
        $state = [
            'error' => 1,
            'msg'=> '登陆成功'
        ];
        return json_encode($state);
    }
}
