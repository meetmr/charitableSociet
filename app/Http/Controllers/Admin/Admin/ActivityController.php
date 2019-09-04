<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;

use App\Activity;
use App\Participate;
use Maatwebsite\Excel\Facades\Excel;
class ActivityController extends BaseController
{
    public function index(){
        $activits = Activity::orderBy('id','desc')->paginate(15);
        return view('admin.activity.acti-Info',[
            'activits'  =>  $activits
        ]);
    }
    public function add(){
        return view('admin.activity.add');
    }
    public function cheAdd(Request $request){
        $data = $request->all();
        $activity = new Activity();
        $activity->activity_name = $data['activity_name'];
        $activity->start_time = $data['start_time'];
        $activity->number = $data['number'];
        $activity->activity_type = $data['activity_type'];
        $activity->participant = $data['participant'];
        $activity->place = $data['place'];
        $activity->activity_content = $data['activity_content'];
        $info = $activity->save();
        $state = [
            'error' => 1,
            'msg'=> '添加成功'
        ];
        if($info){
            return json_encode($state);
        }else{
            $state = [
                'error' => 0,
                'msg'=> '添加失败'
            ];
            return json_encode($state);
        }
    }
    function info($id){
        $id = intval($id);
        $participateInfo  = Participate::where('ac_id','=',$id)->get();
        $count = countCheenroll($id);
        return view('admin.activity.info',[
            'participateInfo'  =>  $participateInfo,
            'count'    =>  $count,
            'id'    =>$id
        ]);
    }
    public function edit($id){
        $id = intval($id);
        $activityRow = Activity::find($id)->toArray();
        return view('admin.activity.edit',[
            'activityRow'  =>  $activityRow,
        ]);
    }
    public function cheedit(Request $request){
        $data = $request->all();
        $id = $data['id'];
        $activity= Activity::find($id);
        $activity->activity_name = $data['activity_name'];
        $activity->start_time = $data['start_time'];
        $activity->number = $data['number'];
        $activity->activity_type = $data['activity_type'];
        $activity->participant = $data['participant'];
        $activity->place = $data['place'];
        $activity->activity_content = $data['activity_content'];
        $activity->summary = $data['summary'];
        $info = $activity->save();
        $state = [
            'error' => 1,
            'msg'=> '修改成功'
        ];
        if($info){
            return json_encode($state);
        }else{
            $state = [
                'error' => 0,
                'msg'=> '修改失败'
            ];
            return json_encode($state);
        }
    }
    public function delete(Request $request){
        $id = intval($request->post('id'));
        $info = Activity::destroy($id);
        $state = [
            'error' => 1,
            'msg'=> '删除成功'
        ];
        if($info){
            Participate::where('ac_id','=',$id)->delete();
            return json_encode($state);
        }else{
            $state = [
                'error' => 0,
                'msg'=> '删除失败'
            ];
            return json_encode($state);
        }
    }
    public function over(Request $request){
        $id = intval($request->post('id'));
        $over = intval($request->post('s'));
        $activity= Activity::find($id);
        $activity->is_over = $over;
        $info = $activity->save();
        $state = [
            'error' => 1,
            'msg'=> '设置成功'
        ];
        if($info){
            return json_encode($state);
        }else{
            $state = [
                'error' => 0,
                'msg'=> '设置失败'
            ];
            return json_encode($state);
        }
    }
    public function deleteA(Request $request){
        $id = intval($request->post('id'));
        $info = Participate::destroy($id);
        $state = [
            'error' => 1,
            'msg'=> '删除成功'
        ];
        if($info){
            return json_encode($state);
        }else{
            $state = [
                'error' => 0,
                'msg'=> '删除失败'
            ];
            return json_encode($state);
        }
    }
    public function export($id){
        $id = intval($id);
        $activityRow = Activity::find($id)->toArray();
        $titlename = $activityRow['activity_name'].'签到表';
        $info = Participate::where('ac_id','=',$id)->select('school_number', 'name','class','department')->get()->toArray();
        $aname = "项目名称：".$activityRow['activity_name']."   项目时间： ".$activityRow['start_time']."   项目地点:  ".$activityRow['place'];
        $array = [['四川信息职业技术学院'],[$aname],['序号','学号','姓名','班级','系部','备注'],];
        $i = 3;
        $j = 1;
        foreach ($info as $item){
            $array[$i][] = $j++;
            $array[$i][] = $item['school_number'];
            $array[$i][] = $item['name'];
            $array[$i][] = $item['class'];
            $array[$i][] = $item['department'];
            $array[$i][] = '';
            $i++;
        }

          Excel::create($titlename,function($excel) use ($array){
           $excel->sheet('score', function($sheet) use ($array){
               $tot = count($array) ;
               $sheet->setWidth(array(
                   'A'     =>  10,
                   'B'     =>  10,
                   'C'     =>  10,
                   'D'     =>  10,
                   'E'     =>  10,
                   'F'     =>  10,
               ))->rows($array)->setFontSize(12);
           });
       })->store('xls')->export('xls');

        return redirect('/admin/index');
    }
}
