<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\report;

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
    public function index(){
        $data['title']          = "Самодисциплина за ".date('Y-m-d');
        $data['reporters']      = report::where('dt',date('Y-m-d'))->get();
        $data['report1_count']  = report::where('dt',date('Y-m-d'))->whereNotNull('report1_dt')->get()->count();
        $data['report2_count']  = report::where('dt',date('Y-m-d'))->whereNotNull('report2_dt')->get()->count();
        $data['report3_count']  = report::where('dt',date('Y-m-d'))->whereNotNull('report3_dt')->get()->count();
        return view('layouts/frontpage', ['data' => $data]);
    }
}
