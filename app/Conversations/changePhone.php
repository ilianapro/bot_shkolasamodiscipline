<?php

namespace App\Conversations;

use BotMan\BotMan\Messages\Conversations\Conversation;
use App\participant;

class changePhone extends Conversation
{
    /**
     * Start the conversation.
     *
     * @return mixed
     */
    public function run()
    {
        $this->ask("Напишите номер своего телефона", function($answer, $conversation){
            $user_id = $this->bot->getUser()->getId();
            $value = $answer->getText();
            participant::where('user_id',$user_id)->update(['phone' => $value]);
            $this->say("Ваш номер телефона успешно обновлен!");
        });
    }
}
