<?php

namespace App\Conversations;

use BotMan\BotMan\Messages\Conversations\Conversation;
use App\participant;
use App\report;

class updateAvatar extends Conversation
{
    /**
     * Start the conversation.
     *
     * @return mixed
     */
    public function askImages()
    {
        $this->askForImages("Отправьте фото вашего профиля (АВАТАР).", function($images){
            $user_id = $this->bot->getUser()->getId();
            $filename = $user_id."_".date('Y-m-d_H-i').".jpg";
            file_put_contents("avatars/".$filename, file_get_contents($images[0]->getUrl()));
            participant::where('user_id',$user_id)->update(['avatar' => '/avatars/'.$filename]);
            report::where('dt',date('Y-m-d'))->where('user_id',$user_id)->update(['avatar' => '/avatars/'.$filename]);
            $this->say("*ВАШЕ ФОТО ПРОФИЛЯ УСПЕШНО ОБНОВЛЕНО 👍*",["parse_mode" => "markdown"]);
        }, function(){
            $this->say("*ФОТО ПРОФИЛЯ НЕ ОБНОВЛЕНО* \n\nК сожалению вы предоставили неверный формат файла. Повторите попытку.",['parse_mode'=>'markdown']);
        });
    }

    public function run()
    {
            $this->askImages();
    }
}
