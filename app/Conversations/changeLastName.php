<?php

namespace App\Conversations;

use BotMan\BotMan\Messages\Conversations\Conversation;
use App\participant;
use App\report;

class changeLastName extends Conversation
{
    /**
     * Start the conversation.
     *
     * @return mixed
     */
    public function run()
    {
        $this->ask("Напишите свою Фамилию", function($answer, $conversation){
            $user_id = $this->bot->getUser()->getId();
            $value = $answer->getText();
            $participant = participant::where('user_id',$user_id)->first();
            participant::where('user_id',$user_id)->update(['last_name' => $value]);
            report::where('user_id',$user_id)->where('dt',date('Y-m-d'))->update(['name' => $value." ".$participant->first_name]);
            $this->say("Ваша фаммилия успешно обновлена!");
        });
    }
}
