<?php

namespace App\Conversations;

use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\Drivers\Telegram\Extensions\Keyboard;
use BotMan\Drivers\Telegram\Extensions\KeyboardButton;

use App\report;
use Carbon\Carbon;

class report1Conversation extends Conversation
{
    /**
     * Start the conversation.
     *
     * @return mixed
     */
    private function keyboard(){
        $keyboard = Keyboard::create()->type(Keyboard::TYPE_KEYBOARD)
        ->addRow(
            KeyboardButton::create('ОТЧЕТ 1')->callbackData('ОТЧЕТ 1'),
            KeyboardButton::create('ОТЧЕТ 2')->callbackData('ОТЧЕТ 2'),
            KeyboardButton::create('ОТЧЕТ 3')->callbackData('ОТЧЕТ 3'))
        ->addRow(
            KeyboardButton::create('ГЛАВНОЕ МЕНЮ')->callbackData('ГЛАВНОЕ МЕНЮ'))
        ->toArray();
        return $keyboard;
    }
    public function askImages()
    {
        $this->say("*ОТЧЕТ 1*\nОтправить фото отчет в виде cелфи", array_merge(['parse_mode'=>"markdown"],$this->keyboard()));
        $this->askForImages("Пожалуйста отправьте свое утреннее селфи.", function($images){
            $user_id = $this->bot->getUser()->getId();
            $filename = $user_id."_".date('Y-m-d_H-i').".jpg";
            file_put_contents("report1/".$filename, file_get_contents($images[0]->getUrl()));
            report::where('dt',date('Y-m-d'))->where('user_id',$user_id)->update(['report1_dt' => date('Y-m-d H:i:s'), 'report1_photo_url' => '/report1/'.$filename]);
            $this->say("*ВАШ УТРЕННИЙ ОТЧЕТ УСПЕШНО ПРИНЯТ 👍* \n\nДата: ".date('Y-m-d H:i:s')."\n\nЖелаю вам хорошего продолжения дня.",['parse_mode'=>'markdown']);
        }, function(){
            $this->say("*ОТЧЕТ НЕ ПРИНЯТ* \n\nК сожалению вы предоставили неверный формат файла. Повторите попытку.",['parse_mode'=>'markdown']);
        });
    }

    public function run()
    {
        $currentTime = Carbon::now();
        $report1_from = Carbon::create($currentTime->year, $currentTime->month, $currentTime->day, env("REPORT1_FROM"),0,0);
        $report1_to = Carbon::create($currentTime->year, $currentTime->month, $currentTime->day, env("REPORT1_TO"),0,0);
        if($currentTime->between($report1_from,$report1_to,true)){
            $this->askImages();
        }
        else {
            $this->say("*Сейчас не время сдавать ОТЧЕТ №1* \n\n _Более подробно можете ознакомиться в разделе ПРАВИЛА_",array_merge(["parse_mode"=>"markdown"],$this->keyboard()));
        }
    }

}
