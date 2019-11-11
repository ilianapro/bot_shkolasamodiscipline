<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\participantsController;

class participantsInactive extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'participants:inactive';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Show all Inactive Participants';

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
        $participants = participantsController::participantsInActiveObj();
        $this->info('Inactive Participants '.$participants->count());
        $headers = ['user_id','Username','Last Name','First Name'];
        foreach($participants as $participant){
            $data[$participant['id']]['User ID'] = $participant['user_id'];
            $data[$participant['id']]['Username'] = $participant['username'];
            $data[$participant['id']]['Last Name'] = $participant['last_name'];
            $data[$participant['id']]['First Name'] = $participant['first_name'];
        }
        $this->table($headers,$data);
    }
}
