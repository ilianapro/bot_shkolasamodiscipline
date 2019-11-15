<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\group;
use App\participant;
use App\report;

class GroupController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $data['title'] = "Группы";
        $data['groups'] = group::all();
        return view('groups.index',['data'=>$data]);
    }
    public function create(){
        $data['title'] = "Создание группы";
        return view('groups.create',['data' => $data]);
    }
    public function store(Request $request, group $group){
        group::create(Request(['name']));
        return redirect ('admin/groups');
    }
    public static function groupInActive(){
        return group::where('status',false)->get(['id'])->toArray();
    }

    public static function groupParticipantsActive($group_id){
        return participant::where('group_id',$group_id)->where('status',true)->get()->count();
    }
    public static function groupParticipantsInActive($group_id){
        return participant::where('group_id',$group_id)->where('status',false)->OrWhere('status',Null)->get()->count();
    }

    public function edit(group $group){
        $data['title'] = 'Редактирование группы: '.$group->name;
        $data['group'] = $group;
        return view('groups.edit',['data'=>$data]);
    }
    public function update(Request $request, group $group){

        $group->update(Request(['name','status']));
        report::where('dt',date('Y-m-d'))->where('group',$request->name)->update(['status' => $request->status]);
        return redirect('/admin/groups');
    }
    public function destroy(group $group){
        $group->delete();
        return redirect('/admin/groups');
    }
    public function show(){

    }
    public static function get_money_max($date){
        $result['date'] = $date;
        $money = report::where('dt',$date)->groupBy('group')->selectRaw('*, sum(report3_money) as sum')->orderBy('sum','desc')->get();
        if($money->count() > 0){
            $result['name']     = $money[0]->group;
            $result['date']     = $date;
            $result['sum']      = $money[0]->sum;
            $result['status']   = 'ok';
        }
        else {
            $result['status']   = 'bad';
        }
        return (object)$result;
    }
    public static function get_money_max_days($date,$days){
        $date_end = $date;
        $date_start = Carbon::parse($date)->subDays($days)->format('Y-m-d');
        $result['date_start'] = $date_start;
        $result['date_end'] = $date_end;
        $money = report::whereBetween('dt',[$date_start,$date_end])->groupBy('group')->selectRaw('*, sum(report3_money) as sum')->orderBy('sum','desc')->first();
        if($money){
            $result['name'] = $money->group;
            $result['date_start']   = $date_start;
            $result['date_end']     = $date_end;
            $result['sum']          = $money->sum;
            $result['status']       = 'ok';
        }
        else {
            $result['status'] = 'bad';
        }
        return (object)$result;

    }
    public static function get_discipline($date){
        $result['date'] = $date;
        $groups = report::where('dt',$date)->groupBy('group')->get();
            if($groups->count() > 0){
            foreach ($groups as $row) {
                $group_names[] = $row->group;
            }
            $group_discipline = $group_names;
            $groups_check = report::where('dt',$date)->get();
            //dd($date);
            foreach ($groups_check as $group_check) {
                if(!$group_check->report1_dt || !$group_check->report2_dt || !$group_check->report3_dt){
                    if (($key = array_search($group_check->group, $group_discipline)) !== false) {
                        unset($group_discipline[$key]);
                    }
                    //$group_discipline = array_diff($group_discipline, [$group_check->group]);
                }
            }
            $result['discipline'] = (object)$group_discipline;
            (array)$result['discipline'] ? $result['status'] = 'ok' : $result['status'] = 'bad';
        }
        else{
            $result['status'] = 'bad';
        }
        return (object)$result;
    }
    public static function get_discipline_days($date,$days){
        $date_end   = $date;
        $date_start = Carbon::parse($date)->subDays($days)->format('Y-m-d');
        $result['date_start'] = $date_start;
        $result['date_end'] = $date_end;
        $groups = report::whereBetween('dt',[$date_start,$date_end])->groupBy('group')->get();
        if($groups->count() > 0){
            foreach ($groups as $row) {
                $group_names[] = $row->group;
            }
            $group_discipline = $group_names;
            $groups_check = report::whereBetween('dt',[$date_start,$date_end])->get();
            foreach ($groups_check as $group_check) {
                if(!$group_check->report1_dt || !$group_check->report2_dt || !$group_check->report3_dt){
                    if (($key = array_search($group_check->group, $group_discipline)) !== false) {
                        unset($group_discipline[$key]);
                    }
                    //$group_discipline = array_diff($group_discipline, [$group_check->group]);
                }
            }
            $result['discipline'] = $group_discipline;
            $result['status']     = 'ok';
        }
        else{
            $result['status'] = 'bad';
        }
        return (object)$result;
    }
}