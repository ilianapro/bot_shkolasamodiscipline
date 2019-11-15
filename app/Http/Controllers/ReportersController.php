<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\report;
use App\group;

class ReportersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public static function get_money_max($date){
        $result['date'] = $date;
        $reporter = report::where('dt', $date)->orderBy('report3_money','desc')->first();
        if($reporter){
            $result['name'] = $reporter->name;
            $result['avatar'] = $reporter->avatar;
            $result['sum'] = $reporter->report3_money;
            $result['status'] = 'ok';
        }
        else {
            $result['status'] = 'bad';
        }
        return (object)$result;
    }

    public static function get_money_max_days($date,$days){
        $date_end = $date;
        $date_start = Carbon::parse($date_end)->subDays($days)->format('Y-m-d');
        $result['date_start'] = $date_start;
        $result['date_end'] = $date_end;
        $reporters = report::whereBetween('dt',[$date_start, $date_end])->groupBy('name')->get();
        if($reporters){
            $money = report::whereBetween('dt',[$date_start,$date_end])->groupBy('user_id')->selectRaw('*, sum(report3_money) as sum')->orderBy('sum','desc')->get()->first();
            if($money){
                $result['name']         = $money->name;
                $result['sum']          = (int)$money->sum;
                $result['date_start']   = $date_start;
                $result['date_end']     = $date_end;
                $result['avatar']       = $money->avatar;
                $result['status']       = 'ok';
            }
            else {
                $result['status']       = 'bad';
            }
        }
        else {
            $result['status'] = 'bad';
        }
        return (object)$result;
    }

    public static function get_discipline_reporter($date){
        $result['date'] = $date;
        $reporter = report::where('dt',$date)->whereNotNull('report1_dt')->whereNotNull('report2_dt')->whereNotNull('report3_dt')->orderBy('report1_dt','asc')->first();
        if($reporter){
            $result['name'] = $reporter->name;
            $result['report1_dt'] = $reporter->report1_dt;
            $result['avatar'] = $reporter->avatar;
            $result['status'] = 'ok';
        }
        else {
            $result['status'] = 'bad';
        }
        return (object)$result;
    }

    public static function get_discipline_reporter_days($date,$days){
        $date_end = $date;
        $date_start = Carbon::parse($date_end)->subDays($days)->format('Y-m-d');
        $result['date_start'] = $date_start;
        $result['date_end'] = $date_end;
        $reporter_all = report::whereBetween('dt',[$date_start,$date_end])->groupBy('name')->get();
        if($reporter_all->count() > 0){
            $reporter_bad_list = report::whereBetween('dt',[$date_start,$date_end])->WhereNull('report1_dt')->orwhereNull('report2_dt')->orwhereNull('report3_dt')->groupBy('name')->get(['name']);
            // Clear from bad reporters )))
            $reporter_good_list = $reporter_all;
            foreach ($reporter_all as $key1 => $reporter) {
                foreach ($reporter_bad_list as $key2 => $reporter_bad) {
                    if($reporter->name == $reporter_bad->name){
                        $reporter_good_list->forget($key1);
                    }
                }
            }
            $result['reporter_good_list'] = $reporter_good_list;
            $result['status'] = 'ok';
        }
        else {
            $result['status'] = 'bad';
        }
        return (object)$result;
    }
    public function index()
    {
        $data['title']     = 'Отчетники на дату '.date('Y-m-d').env('locale');
        $data['reporters'] = report::where('dt',date('Y-m-d'))->get();
        return view('reporters',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['reporter'] = report::findOrFail($id);
        $data['groups'] = group::get();
        $data['title'] = 'Редактирование участника '.$data['reporter']->name;
        return view('reporters_edit',['data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, report $reporter)
    {
        $reporter->update(Request(['name','phone','group','leader','status']));
        return redirect('/admin/reporters');
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
