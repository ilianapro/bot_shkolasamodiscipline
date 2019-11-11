<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
}
