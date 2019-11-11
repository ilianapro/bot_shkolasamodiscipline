<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\participantsController;
use App\report;
use Log;

class participantsUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'participants:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update participants';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $participants = participantsController::participantsActiveObj();
        //dd($participants);
        $reports = report::where('dt',date('Y-m-d'))->get();
        //dd($reports);
        if(@$reports[0]->user_id == null){
            Log::info('New participants adding to report table for date: '.date('Y-m-d'));
            $this->line('New participants exist for '.date('Y-m-d'));
            foreach ($participants as $participant) {
                report::create([
                    "dt"        =>  date('Y-m-d'),
                    "user_id"   =>  $participant->user_id,
                    "status"   =>  $participant->status,
                    "username"  =>  $participant->username,
                    "name"      =>  $participant->last_name.' '.$participant->first_name,
                    "phone"     =>  $participant->phone,
                    "avatar"     =>  $participant->avatar,
                    "leader"    =>  $participant->leader,
                    "group"     =>  $participant->group->name
                ]);
                Log::info($participant->username);
            }
            Log::info('Adding new users for '.date('Y-m-d').' is Completed');
        }
        else {
            $this->line('There is already have data in database for date: '.date('Y-m-d'));
            $this->line('Analyze new participants by comaparison...');
            //dd($reportsByUsername);
            foreach ($participants as $participant) {
                if(!in_array($participant->user_id, $reports->pluck('user_id')->toArray())){
                    $this->line('===================================================');
                    $this->line('Following participants is new and not in report table');
                    $this->line('===================================================');
                    $this->line($participant->username.' <= Added to database');
                    Log::info($participant->username.' <= New participant added to database');
                    report::create([
                        "dt"        =>  date('Y-m-d'),
                        "user_id"   =>  $participant->user_id,
                        "status"   =>  $participant->status,
                        "username"  =>  $participant->username,
                        "name"      =>  $participant->last_name.' '.$participant->first_name,
                        "phone"     =>  $participant->phone,
                        "leader"    =>  @$participant->leader,
                        "group"     =>  $participant->group->name
                        ]);
                    }
                }
        }
    }
}
