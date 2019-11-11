<?php

namespace App\Conversations;

use BotMan\BotMan\Messages\Conversations\Conversation;
use Carbon\Carbon;
use App\report;

class report3Conversation extends Conversation
{
    /**
     * Start the conversation.
     *
     * @return mixed
     */
    public function run()
    {
        $currentTime = Carbon::now();
        $report3_from = Carbon::create($currentTime->year, $currentTime->month, $currentTime->day, env("REPORT3_FROM"),0,0);
        $report3_to = Carbon::create($currentTime->year, $currentTime->month, $currentTime->day, env("REPORT3_TO"),0,0);
        if($currentTime->between($report3_from,$report3_to,true)){
            $this->ask("Напишите сумму своего заработка за сегодняшний день. \n\n!!! Напишите только цифрами без пробелов и запятых.", function($answer, $conversation){
                $user_id = $this->bot->getUser()->getId();
                $value = $answer->getText();
                if(is_numeric($value)){
                    report::where('dt',date('Y-m-d'))->where("user_id",$user_id)->update(['report3_dt' => date('Y-m-d'), 'report3_money' => $value]);
                    $output = "Изменения успешно сохранены для ОТЧЕТ 3";
                }
                else {
                    $output = "Изменения не были созранены так как вы неправильно ввели данные.";
                }
                $this->say($output." >> ".is_numeric($value));
            });
        }
        else{
            $this->say("*Сейчас не время сдавать ОТЧЕТ №3* \n\n _Более подробно можете ознакомиться в разделе ПРАВИЛА_",["parse_mode"=>"markdown"]);
        }
    }
}
