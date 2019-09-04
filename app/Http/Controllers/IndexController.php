<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Crypt;
use App\Activity;
use Illuminate\Support\Facades\Mail;

class IndexController extends Controller
{
    //
    public function index(){
        $activitys = Activity::where('is_over','=',0)->orderBy('id','desc')->get();
        return view('index.index.index',[
            'title' =>  '爱心社-川信职院',
            'activitys' =>$activitys
        ]);
    }
    public function register(){
        return view('index.index.register', [
                'title' =>  '爱心社-注册'
            ]);
    }
    public function login(Request $request){
     $url = $request->get('url');
        return view('index.index.login', [
            'title' =>  '爱心社-登陆',
    	     'url'   =>  $url
        ]);
    }
    public function cheregister(Request $request){
        $data = $request->all();
        if($this->che($data)){
            return $this->che($data);
        }
        $email = $data['email'];
        $school_number = $data['school_number'];
        $password =  $data['password'];
        //执行入库操作
        $user = new User();
        $user->emal = $email;
        $user->school_number = $school_number;
	$user ->icon_path = '';
        $user->password = Crypt::encrypt($data['password']);
        $info = $user->save();
        if($info){
            $state = [
                'error' => 1,
                'msg'=> '注册成功'
            ];
            return json_encode($state);
        }

    }
    public function che($data){
        $email = $data['email'];
        $school_number = $data['school_number'];
        $password =  $data['password'];
        $password2 = $data['password2'];
        $checkmail="/\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/";//定义正则表达式
        $checksch = "/^\d{8}\b/";
        $checpass= "/^\w{6,16}$/";
        if($email == '' || !preg_match($checkmail,$email)){
            $state = [
                'error' => 0,
                'msg'=> '邮箱格式不正确'
            ];
            return json_encode($state);
        }
        if($school_number == '' || !preg_match($checksch,$school_number)){
            $state = [
                'error' => 0,
                'msg'=> '学号格式不正确'
            ];
            return json_encode($state);
        }
        if($password == '' || !preg_match($checpass,$password) || $password != $password2){
            $state = [
                'error' => 0,
                'msg'=> '密码格式不对哦'
            ];
            return json_encode($state);
        }

        $is_email = count(User::where('emal', $email)->get());
        if($is_email !== 0){
            $state = [
                'error' => 0,
                'msg'=> '邮箱已经注册啦'
            ];
            return json_encode($state);
        }
        $is_school_number = count(User::where('school_number', $school_number)->get());
        if($is_school_number !== 0){
            $state = [
                'error' => 0,
                'msg'=> '学号已经注册啦'
            ];
            return json_encode($state);
        }
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
                'msg'=> '学号没有注册'
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

       session(['user'=>$user[0]]);
        if($user[0]['is_serious'] == 0){
           $state = [
               'error' => 2,
               'msg'=> '第一次登陆进入激活页面'
           ];
           return json_encode($state);
       }
        $state = [
            'error' => 1,
            'msg'=> '登陆成功',
            'url'   => $data['url'] == null ? '/':$data['url']
        ];
        return json_encode($state);
    }
    public function action(){
        $activityRow = Activity::where('is_over','=',1)->orderBy('id','desc')->get();
        return view('index.index.action', [
            'title' =>  '爱心社-往期活动',
            'activityRow'   =>$activityRow
        ]);
    }
    public function activatecheInfo($id){
    if(session('user')){
            $user = session('user');
            if($user['is_serious'] == 0) {
                return redirect('user/activate');
            }
        }
        $url = url('/action/'.$id);
        $id = intval($id);
        $activity = Activity::find($id);
        if($activity == null){
            return redirect('/');
        }
        $activity = $activity->toArray();
        return view('index.index.action-info', [
            'title' =>  '爱心社-'.$activity['activity_name'].'活动详情',
            'activity' =>$activity,
     'url'     => $url
        ]);
    }



    // 找回密码
    public function retrieve(){
        return view('index.index.retrieve', [
            'title'    =>  '爱心社-找回密码',
        ]);
    }
    public function cheretrieve(Request $request){
        $data = $request->post();
        $user = User::where('school_number',$data['school_number'])->get();
        $count = $user->toArray();
        if(count($count) == 0){
            $state = [
                'error' => -1,
                'msg'=> '输入的信息错误'
            ];
            return json_encode($state);
        }
        if($data['email']!=$count[0]['emal']){
            $state = [
                'error' => -1,
                'msg'=> '输入的信息错误'
            ];
            return json_encode($state);
        }
        if($data['user_name']!=$count[0]['user_name']){
            $state = [
                'error' => -1,
                'msg'=> '输入的信息错误'
            ];
            return json_encode($state);
        }
        if($data['class']!=$count[0]['class']){
            $state = [
                'error' => -1,
                'msg'=> '输入的信息错误'
            ];
            return json_encode($state);
        }
        if($data['department']!=$count[0]['department']){
            $state = [
                'error' => -1,
                'msg'=> '输入的信息错误'
            ];
            return json_encode($state);
        }
        $password = decrypt($count[0]['password']);
        $m = $count[0]['emal'];
        session(['mall'=>$m]);
        $flag = Mail::send('emails.ces',['passwrd'=>$password],function($message){
            $to = session('mall');
            $message ->to($to)->subject('爱心社-找回密码');
        });
        if(!$flag){
            $state = [
                'error' => 1,
                'msg'=> '密码已经发送到邮箱中'
            ];
            return json_encode($state);

        }else{
            $state = [
                'error' => -1,
                'msg'=> '发生失败'
            ];
            return json_encode($state);

        }

    }
}
