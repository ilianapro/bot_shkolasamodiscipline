<?php

namespace App\Conversations;

use BotMan\BotMan\Messages\Conversations\Conversation;
use App\motivator;
use App\participant;

class addMotivationConversation extends Conversation
{
    /**
     * Start the conversation.
     *
     * @return mixed
     */
    public function run()
    {
        $this->ask("*Напишите текст мотивации.*\nМотивация должна быть короткой - неболее 190 символов.", function($answer, $conversation){
            $user_id = $this->bot->getUser()->getId();
            $value = $answer->getText();
            $participant = participant::where('user_id',$user_id)->first();
            motivator::create(['motivation' => $value, 'participant' => $participant->last_name." ".$participant->first_name]);
            $this->say("Ваша мотивация успешно добавлена в общую базу\nТеперь другие пользователи могут увидеть ваш текст мотивации.\nБлагодарим");
        });
    }
}
