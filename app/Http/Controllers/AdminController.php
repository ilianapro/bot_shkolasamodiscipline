<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\participant;
use App\report;
use App\motivator;
use App\Http\Controllers\participantsController;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groupInActive = GroupController::groupInActive();
        $data['title']                  = 'Главная';
        //  PARTICIPANTS INFO
        $data['participantsAll']        = participant::get()->count();
        $data['participantsActive']     = participantsController::participantsActiveObj()->count();
        $data['participantsInActive']   = participantsController::participantsInActiveObj()->count();

        // REPORTS DETAILS
        $data['report1']                = report::where('dt',date('Y-m-d'))->whereNotNull('report1_dt')->get()->count();
        $data['report2']                = report::where('dt',date('Y-m-d'))->whereNotNull('report2_dt')->get()->count();
        $data['report3']                = report::where('dt',date('Y-m-d'))->whereNotNull('report3_dt')->get()->count();
        $data['motivators']             = motivator::get();
        return view('dashboard', ["data" => $data]);
    }
    public function inactiveParticipants(){
        $inactiveParticipants = participant::where('status',false)->get();
        dd($inactiveParticipants);
        return view('inactiveParticipants',['inactiveParticipants' => $inactiveParticipants]);
    }
}
