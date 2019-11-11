<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\participant;
use App\group;
use App\Http\Controllers\GroupController;

class participantsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title']     = 'Все участники';
        $data['participants'] = participant::get();
        return view('participants',['data'=>$data]);
    }
    public static function participantsActiveObj(){
        return  participant::where('status',true)->whereNotIn('group_id',GroupController::groupInActive())->get();
    }
    public static function participantsInActiveObj(){
        return  participant::where('status',false)->orWhereIn('group_id',GroupController::groupInActive())->get();
    }
    public function participantsActive(){
        $data['title']     = 'Активные участники';
        $data['participants'] = $this->participantsActiveObj();
        return view('participants',['data'=>$data]);
    }
    public function participantsInactive(){
        $data['title']     = 'Неактивные участники';
        $data['participants'] = $this->participantsInActiveObj();
        return view('participants',['data'=>$data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['participant'] = participant::findOrFail($id);
        $data['groups'] = group::get();
        $data['title'] = 'Редактирование участника '.$data['participant']->name;
        return view('participants_edit',['data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, participant $participant)
    {
        $participant->update(Request(['first_name','last_name','phone','group_id','leader','status']));
        return redirect('/admin/participantsActive');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
