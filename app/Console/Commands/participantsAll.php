<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\participant;
use App\group;


class participantsAll extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'participants:all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Show all Participants';

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
        $participants = participant::get();
        $this->error('All Participants '.$participants->count());
        $headers = ['user_id','Username','Last Name','First Name','Group','Status'];
        foreach($participants as $participant){
            $data[$participant['id']]['User ID']    = $participant->user_id;
            $data[$participant['id']]['Username']   = $participant->username;
            $data[$participant['id']]['Last Name']  = $participant->last_name;
            $data[$participant['id']]['First Name'] = $participant->first_name;
            $data[$participant['id']]['Group']      = $participant->group->name;
            $data[$participant['id']]['Status']     = $participant->status;
        }
        $this->table($headers, $data);
    }
}
