<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\report;
use App\Http\Controllers\ReportersController;
use App\Http\Controllers\GroupController;
use Carbon\Carbon;

class frontpageController extends Controller
{
    public static function taskList($tasks){
        $tasks_array = explode("\n", $tasks);
        $output = "";
        $num = 1;
        foreach ($tasks_array as $task) {
            $output .= $num.". ".$task."\n";
            $num++;
        }
        return $output;
    }



    public function leadersData($dateIn){
        /* One day back */
        $date = Carbon::parse($dateIn)->subDays(1)->format('Y-m-d');
        $result['date']                         = $date;
        /* R E P O R T E R S */
        $result['reporter_money_max']           = ReportersController::get_money_max($date);
        $result['reporter_money_max_7days']     = ReportersController::get_money_max_days($date,7);
        $result['reporter_discipline']          = ReportersController::get_discipline_reporter($date);
        $result['reporters_discipline_7days']   = ReportersController::get_discipline_reporter_days($date,7);
        /* G R O U P S */
        $result['group_money_max']              = GroupController::get_money_max($date);
        $result['group_money_max_7days']        = GroupController::get_money_max_days($date,7);
        $result['groups_discipline']            = GroupController::get_discipline($date);
        $result['groups_discipline_7days']      = GroupController::get_discipline_days($date,7);
        return (object)$result;
    }

    public function testik(){
        
        
        dd(GroupController::get_discipline(date('Y-m-d')));

        
    }

    public function reportDate($date){
        $result['date'] = Carbon::parse($date)->format('d.m.Y');
        $result['reporters']      = report::where('dt',$date)->get();
        $result['report1_count']  = report::where('dt',$date)->whereNotNull('report1_dt')->get()->count();
        $result['report2_count']  = report::where('dt',$date)->whereNotNull('report2_dt')->get()->count();
        $result['report3_count']  = report::where('dt',$date)->whereNotNull('report3_dt')->get()->count();
        return $result;
    }

    public function index(){
        $date               = date('Y-m-d');
        $data['title']      = "Самодисциплина за ".$date;
        $data['app_url']    = env('APP_URL');
        $data['details']    = $this->reportDate($date);
        $data['leaders']    = $this->leadersData($date);
        return view('layouts/frontpage', ['data' => $data]);
    }
    public function indexdate($date){
        $data['title']      = "Самодисциплина за ".$date;
        $data['app_url']    = env('APP_URL');
        $data['details']    = $this->reportDate($date);
        $data['leaders']    = $this->leadersData($date);
        return view('layouts/frontpage', ['data' => $data]);
    }
}
