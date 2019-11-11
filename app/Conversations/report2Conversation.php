<?php

namespace App\Conversations;

use BotMan\BotMan\Messages\Conversations\Conversation;
use Carbon\Carbon;
use App\report;
use BotMan\Drivers\Telegram\Extensions\Keyboard;
use BotMan\Drivers\Telegram\Extensions\KeyboardButton;


class report2Conversation extends Conversation
{
    /**
     * Start the conversation.
     *
     * @return mixed
     */
    public function run()
    {
        $user_id = $this->bot->getUser()->getId();
        $currentTime = Carbon::now();
        $report2_from = Carbon::create($currentTime->year, $currentTime->month, $currentTime->day, env("REPORT2_FROM"),0,0);
        $report2_to = Carbon::create($currentTime->year, $currentTime->month, $currentTime->day, env("REPORT2_TO"),0,0);
        if($currentTime->between($report2_from,$report2_to,true)){

        $this->ask("Напишите имя выполненной задачи для ОТЧЕТА №2. \n\nЕсли у вас несколько задач, то каждое наименование задачи напишите с новой строки.", function($answer, $conversation){
            $value = $answer->getText();
            $tasks = report::where('dt',date('Y-m-d'))->where('user_id',$this->bot->getUser()->getId())->first()->report2_tasks;
            if($tasks){
                report::where('dt',date('Y-m-d'))->where('user_id',$this->bot->getUser()->getId())->update(['report2_dt' => date('Y-m-d H:i:s'),'report2_tasks' => $tasks."\n".$value]);
            }
            else {
                report::where('dt',date('Y-m-d'))->where('user_id',$this->bot->getUser()->getId())->update(['report2_dt' => date('Y-m-d H:i:s'),'report2_tasks' => $value]);
            }
            
            $this->say("*ОТЧЕТА №2 успешно сохранён*",["parse_mode"=>"markdown"]);
        });
    }
    else {
        $this->say("*Сейчас не время сдавать ОТЧЕТ №2* \n\n _Более подробно можете ознакомиться в разделе ПРАВИЛА_",["parse_mode"=>"markdown"]);
    }
    }
}
