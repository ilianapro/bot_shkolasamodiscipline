<?php

use Illuminate\Database\Seeder;
use App\report;
use App\participant;
use Carbon\Carbon;

class ReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

     private function randTime($date1,$date2){
        return Carbon::createFromTimestamp(rand(Carbon::parse($date2)->timestamp, Carbon::parse($date1)->timestamp))->format('Y-m-d H:i:s');
     }
     private function getText(){
            $client = new \GuzzleHttp\Client();
            $request = $client->get('https://fish-text.ru/get');
            $response = $request->getBody();
            return json_decode($response,true)['text'];
     }
     public function generateReporters($date){
        $participants = participant::where('status',true)->get();
        foreach ($participants as $participant){
            DB::table('reports')->insert([
                'dt'        => $date,
                'user_id'   => $participant->user_id,
                'status'    => $participant->status,
                'username'  => $participant->username,
                'avatar'    => $participant->avatar,
                'name'      => $participant->last_name.' '.$participant->first_name,
                'phone'     => $participant->phone,
                'leader'    => $participant->leader,
                'group'             => $participant->group->name,
                'report1_dt'        => $this->randTime($date.' '.env("REPORT1_FROM").':00:00',$date.' '.env("REPORT1_TO").':00:00'),
                'report2_dt'        => $this->randTime($date.' '.env("REPORT2_FROM").':00:00',$date.' '.env("REPORT2_TO").':00:00'),
                'report3_dt'        => $this->randTime($date.' '.env("REPORT3_FROM").':00:00',$date.' '.env("REPORT3_TO").':00:00'),
                'report1_photo_url' => "http://randomuser.ru/images/men/".rand(1,83).".jpg",
                'report2_tasks' => $this->getText(),
                'report3_money' => rand(100,20000),
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s')
            ]);
        }
     }

    public function run()
    {
        $this->generateReporters(Carbon::now()->subDays(0)->format('Y-m-d'));
        $this->generateReporters(Carbon::now()->subDays(1)->format('Y-m-d'));
        $this->generateReporters(Carbon::now()->subDays(2)->format('Y-m-d'));
        $this->generateReporters(Carbon::now()->subDays(3)->format('Y-m-d'));
        $this->generateReporters(Carbon::now()->subDays(4)->format('Y-m-d'));
        $this->generateReporters(Carbon::now()->subDays(5)->format('Y-m-d'));
        $this->generateReporters(Carbon::now()->subDays(6)->format('Y-m-d'));
        $this->generateReporters(Carbon::now()->subDays(7)->format('Y-m-d'));
        $this->generateReporters(Carbon::now()->subDays(8)->format('Y-m-d'));
        $this->generateReporters(Carbon::now()->subDays(9)->format('Y-m-d'));
    }
}
