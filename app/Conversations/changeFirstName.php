<?php

namespace App\Conversations;

use BotMan\BotMan\Messages\Conversations\Conversation;
use App\participant;
use App\report;

class changeFirstName extends Conversation
{
    /**
     * Start the conversation.
     *
     * @return mixed
     */
    public function run()
    {
        $this->ask("Напишите свое Имя", function($answer, $conversation){
            $user_id = $this->bot->getUser()->getId();
            $value = $answer->getText();
            $participant = participant::where('user_id',$user_id)->first();
            participant::where('user_id',$user_id)->update(['first_name' => $value]);
            report::where('user_id',$user_id)->where('dt',date('Y-m-d'))->update(['name' => $participant->last_name." ".$value]);
            $this->say("Ваше имя успешно обновлено!");
        });
    }
}
