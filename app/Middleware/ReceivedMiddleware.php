<?php

namespace App\Middleware;

use BotMan\BotMan\BotMan;
use BotMan\BotMan\Interfaces\Middleware\Received;
use BotMan\BotMan\Messages\Incoming\IncomingMessage;
use App\report;


class ReceivedMiddleware implements Received
{
    public function received(IncomingMessage $message, $next, BotMan $bot){
        $user_id = $message->getSender();        
        $message->addExtras('user_id',$user_id);
        $participant = report::where('user_id',$user_id)->where('status',true)->where('dt',date('Y-m-d'))->first();
        if($participant !== null){
            $message->addExtras('activeparticipant', true);
        }
        else {
            $message->addExtras('activeparticipant', false);
        }
        return $next($message);
    }
}