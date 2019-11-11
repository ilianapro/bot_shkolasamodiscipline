<?php
use App\Http\Controllers\BotManController;
use BotMan\Drivers\Telegram\Extensions\Keyboard;
use BotMan\Drivers\Telegram\Extensions\KeyboardButton;
use App\Middleware\ReceivedMiddleware;
use Botman\BotMan\BotMan;
use App\participant;
use App\report;
use App\motivator;
use App\Conversations\report1Conversation;
use App\Conversations\report2Conversation;
use App\Conversations\report3Conversation;
use App\Conversations\addMotivationConversation;
use App\Conversations\changeFirstName;
use App\Conversations\changeLastName;
use App\Conversations\changePhone;
use App\Conversations\updateAvatar;
use Carbon\Carbon;
use Carbon\CarbonPeriod;


/* =====================================
SAMPLE OF AUTH CODE

$active = $bot->getMessage()->getExtras('activeparticipant');
if($active)
    {
    }
else { gotoRegistration($bot); }
===================================== */





$botman = resolve('botman');
$receivedmiddleware = new ReceivedMiddleware();
$botman->middleware->received($receivedmiddleware);

/* FUNCTIONS */

function gotoRegistration($bot){
    if(isRegistered($bot))
    {
        $participant = participant::where('user_id',$bot->getUser()->getId())->first();
        $keyboard = Keyboard::create()->type(Keyboard::TYPE_KEYBOARD)->
        addRow(
            KeyboardButton::create('START')->callbackData('START')
        )->toArray();
        return $bot->reply("*ВЫ УЖЕ ЗАРЕГИСТРИРОВАНЫ*\n\nВы были зарегистрированы: ".$participant->created_at."\n\nДождитесь активации вашего профиля менеджером школы-самодисциплины. После активации можете начать работу с системой автоматизированной сдачи отчетов.",array_merge($keyboard,['parse_mode'=>'markdown']));
        }
    else 
    {
        $keyboard = Keyboard::create()->type(Keyboard::TYPE_KEYBOARD)->
        addRow(
            KeyboardButton::create('ПОДАТЬ ЗАЯВКУ')->callbackData('ПОДАТЬ ЗАЯВКУ')
        )->toArray();
        return $bot->reply("*ВЫ НЕ ЗАРЕГИСТРИРОВАНЫ*\n\nДля того чтобы продолжить вам необходимо пройти регистрацию в автоматизированной системе сдачи отчетов школы самодисциплины.\n\nДля этого вам необходимо подать заявку на регистрацию.",array_merge($keyboard,['parse_mode'=>'markdown']));
    }
}

        function isRegistered($bot){
    $participants = participant::get();
    $user_id = $bot->getMessage()->getExtras('user_id');
    $user = $bot->getUser();
    if(in_array($user_id, $participants->pluck('user_id')->toArray())){
        return true;
    }
    else {
        return false;

    }
}

/* FALLBACK */
$botman->fallback(function($bot){
    $active = $bot->getMessage()->getExtras('activeparticipant');
    if($active)
        {

        }
    else 
        {
            gotoRegistration($bot);
        }
});

/* START */
$botman->hears('/start|start|ГЛАВНОЕ МЕНЮ', function (BotMan $bot) {
    $active = $bot->getMessage()->getExtras('activeparticipant');
    if($active){
        $keyboard = Keyboard::create()->type(Keyboard::TYPE_KEYBOARD)
        ->addRow(
            KeyboardButton::create('О БОТЕ')->callbackData('О БОТЕ'),
            KeyboardButton::create('ПРАВИЛА')->callbackData('ПРАВИЛА'))
        ->addRow(
            KeyboardButton::create('МОЯ ГРУППА')->callbackData('МОЯ ГРУППА'),
            KeyboardButton::create('ВСЕ УЧАСТНИКИ')->callbackData('ВСЕ УЧАСТНИКИ'))
        ->addRow(
            KeyboardButton::create('СДАТЬ ОТЧЕТ')->callbackData('СДАТЬ ОТЧЕТ'),
            KeyboardButton::create('МОТИВАЦИЯ')->callbackData('МОТИВАЦИЯ'))
        ->addRow(
            KeyboardButton::create('МОЙ ПРОФИЛЬ')->callbackData('МОЙ ПРОФИЛЬ'))
        ->toArray();
        $bot->reply("Добро пожаловать ".$bot->getUser()->getFirstName().", \nВы находитесь в главном меню автоматизированной системы сдачи отчетов Школы самодисциплины.\nВыберите один из пунктов меню:",$keyboard);
    }
    else {
        gotoRegistration($bot);
    }
});

$botman->hears('ПОДАТЬ ЗАЯВКУ', function($bot){
    if(isRegistered($bot)){
        $keyboard = Keyboard::create()->type(Keyboard::TYPE_KEYBOARD)->
        addRow(
            KeyboardButton::create('START')->callbackData('START')
        )->toArray();
        $bot->reply(isRegistered($bot)."*ВЫ УЖЕ ЗАРЕГИСТРИРОВАНЫ В СИСТЕМЕ*\n\nДождитесь активации вашего профиля менеджером школы самодициплины.\n\n_Либо вы можете связаться напрямую \n@admin_samodiscipline_manager_",array_merge($keyboard,['parse_mode'=>'markdown']));
        }
    else
        {
            $keyboard = Keyboard::create()->type(Keyboard::TYPE_KEYBOARD)->
            addRow(
                KeyboardButton::create('START')->callbackData('START')
            )->toArray();
            $user = $bot->getUser();
            participant::create([
                'user_id'       => $user->getId(),
                'username'      => $user->getUsername(),
                'first_name'    => $user->getFirstName(),
                'last_name'     => $user->getLastName(),
                'status'        => 0,
                'group_id'      => 1
            ]);
            $bot->reply("*ВАША ЗАЯВКА УСПЕШНО ОТПРАВЛЕНА*\n\nДождитесь активации вашего профиля менеджером школы самодициплины.\n\n_Либо вы можете связаться напрямую\n@admin_samodiscipline_manager_",array_merge($keyboard,['parse_mode' => 'Markdown']));
        }
});


$botman->hears('О БОТЕ', function($bot){
    $active = $bot->getMessage()->getExtras('activeparticipant');
    if($active)
        {
            $bot->reply("*О БОТЕ*\nБот самодисциплины, помогает участникам школы самодисциплины, сдавать отчеты в онлайн режиме.",['parse_mode' => 'Markdown']);
        }
    else { gotoRegistration($bot); }
});

$botman->hears('ПРАВИЛА', function($bot){

    $active = $bot->getMessage()->getExtras('activeparticipant');
    if($active)
    {
        $bot->reply("*ПРАВИЛА*\nСамое главное правило - это мотивация и стремление становится лучше. День ото дня вы будете улучшать себя и помогать другим становиться лучше и лучше.\n\nВам надо ежедневно и вовремя сдавать отчеты и получать за это рейтинговые балы. \n\nВСЕГО БУДЕТ ТРИ ТИПА ОТЧЕТОВ:\n\n *1. УТРЕННИЙ ОТЧЕТ*\nОтправить фото отчет в виде cелфи\n_Время сдачи отчета: с ".env("REPORT1_FROM").":00 до ".env("REPORT1_TO").":00_\n\n*2.СДЕЛАННЫЕ ДЕЛА*\nотправлять список выполненных дел в течении дня\n_Время сдачи отчета: с ".env("REPORT2_FROM").":00 до ".env("REPORT2_TO").":00_\n\n*3.ЗАРАБОТАННЫЕ ДЕНЬГИ*\nВ конце дня вам необходимо отправить сумму денег, которую вы заработали в течении дня.\n_Время сдачи отчета: с ".env("REPORT3_FROM").":00 до ".env("REPORT3_TO").":00_\n\nЖелаем успехов в трансформации самого себя!",['parse_mode' => 'Markdown']);
    }
    else { gotoRegistration($bot); }
});

$botman->hears('ВСЕ УЧАСТНИКИ', function($bot){
    $active = $bot->getMessage()->getExtras('activeparticipant');
    if($active)
        {
            $reports = report::where('dt',date('Y-m-d'))->get();
            foreach($reports as $report){
                $bot->reply("*".$report->name."*\nТелефон: ".$report->phone."\nГруппа: ".$report->group, ['parse_mode' => 'markdown']);
            }
        }
    else { gotoRegistration($bot); }
    
});

$botman->hears("МОЯ ГРУППА", function($bot){
    $active = $bot->getMessage()->getExtras('activeparticipant');
    if($active)
    {
        $groupname = report::where('user_id',$bot->getUser()->getId())->first()->group;
        $mygroup = report::where('group',$groupname)->where('dt',date('Y-m-d'))->get();
        $output = "*ГРУППА:* ".$groupname."\n\n";
        foreach ($mygroup as $group) {
            if($group->leader){$leader = "⭐️";}
            $output .= @$leader." *".$group->name."* ".@$leader."\nТелефон: ".$group->phone."\n\n";
            unset($leader);
        }
        $bot->reply($output,['parse_mode'=>'markdown']);
    }
    else { gotoRegistration($bot); }
});

$botman->hears("СДАТЬ ОТЧЕТ", function($bot){
    $active = $bot->getMessage()->getExtras('activeparticipant');
    if($active)
        {
            $keyboard = Keyboard::create()->type(Keyboard::TYPE_KEYBOARD)
            ->addRow(
                KeyboardButton::create('ОТЧЕТ 1')->callbackData('ОТЧЕТ 1'),
                KeyboardButton::create('ОТЧЕТ 2')->callbackData('ОТЧЕТ 2'),
                KeyboardButton::create('ОТЧЕТ 3')->callbackData('ОТЧЕТ 3'))
            ->addRow(
                KeyboardButton::create('ГЛАВНОЕ МЕНЮ')->callbackData('ГЛАВНОЕ МЕНЮ'))
            ->toArray();
            $bot->reply('Выберите действие',$keyboard);
       
        }
    else { gotoRegistration($bot); }
});

$botman->hears("МОТИВАЦИЯ", function($bot){
    $active = $bot->getMessage()->getExtras('activeparticipant');
    if($active)
        {
            $motivation = motivator::inRandomOrder()->first();
            $keyboard = Keyboard::create()->type(Keyboard::TYPE_KEYBOARD)
            ->addRow(
                KeyboardButton::create('ПОЛУЧИТЬ ЕЩЕ МОТИВАЦИЮ')->callbackData('ПОЛУЧИТЬ ЕЩЕ МОТИВАЦИЮ'))
            ->addRow(
                KeyboardButton::create('ПРЕДЛОЖИТЬ СВОЮ МОТИВАЦИЮ')->callbackData('ДОБАВИТЬ СВОЮ МОТИВАЦИЮ'))
            ->addRow(
                KeyboardButton::create('ГЛАВНОЕ МЕНЮ')->callbackData('ГЛАВНОЕ МЕНЮ'))
            ->toArray();
            $bot->reply("*МОТИВАШКА ДЛЯ ВАС*\n".$motivation->motivation."\n\n_".$motivation->participant."_",array_merge(["parse_mode" => "markdown"],$keyboard));
       
        }
    else { gotoRegistration($bot); }
});

$botman->hears("ПОЛУЧИТЬ ЕЩЕ МОТИВАЦИЮ", function($bot){
    $active = $bot->getMessage()->getExtras('activeparticipant');
    if($active)
        {
            $motivation = motivator::inRandomOrder()->first();
            $bot->reply("*МОТИВАШКА ДЛЯ ВАС*\n".$motivation->motivation."\n\n_".$motivation->participant."_",["parse_mode" => "markdown"]);
       
        }
    else { gotoRegistration($bot); }
});

$botman->hears('ПРЕДЛОЖИТЬ СВОЮ МОТИВАЦИЮ', function($bot){
    $active = $bot->getMessage()->getExtras('activeparticipant');
    if($active)
        {
            $bot->startConversation(new addMotivationConversation);
        }
    else { gotoRegistration($bot); }
});



$botman->hears('ОТЧЕТ 1', function($bot){
    $active = $bot->getMessage()->getExtras('activeparticipant');
    if($active)
        {
            $bot->startConversation(new report1Conversation);
        }
    else { gotoRegistration($bot); }
});
$botman->hears('ИЗМЕНИТЬ АВАТАР', function($bot){
    $active = $bot->getMessage()->getExtras('activeparticipant');
    if($active)
        {
            $bot->startConversation(new updateAvatar);
        }
    else { gotoRegistration($bot); }
});

$botman->hears('ОТЧЕТ 2', function($bot){
    $active = $bot->getMessage()->getExtras('activeparticipant');
    if($active)
        {
                $user_id = $bot->getUser()->getId();
                $keyboard = Keyboard::create()->type(Keyboard::TYPE_KEYBOARD)
                ->addRow(
                    KeyboardButton::create('ДОБАВИТЬ ЗАДАЧУ В ОТЧЕТ 2')->callbackData('ДОБАВИТЬ ЗАДАЧУ В ОТЧЕТ 2'))
                ->addRow(
                    KeyboardButton::create('ОТЧЕТ 1')->callbackData('ОТЧЕТ 1'),
                    KeyboardButton::create('ОТЧЕТ 2')->callbackData('ОТЧЕТ 2'),
                    KeyboardButton::create('ОТЧЕТ 3')->callbackData('ОТЧЕТ 3'))
                ->addRow(
                    KeyboardButton::create('ГЛАВНОЕ МЕНЮ')->callbackData('ГЛАВНОЕ МЕНЮ'))
                ->toArray();
    
                $tasks = report::where('dt', date('Y-m-d'))->where('user_id',$user_id)->first();
                if($tasks->report2_tasks !== null){
                    $tasks_array = explode("\n", $tasks->report2_tasks);
                    $output = "*СПИСОК ВАШИХ ДЕЛ*\n";
                    $num = 1;
                    foreach ($tasks_array as $task) {
                        $output .= $num.". ".$task."\n";
                        $num++;
                    }
                }
                else {
                    $output = "*ВАШ ПИСОК ВЫПОЛНЕННЫХ ЗАДАЧ ПУСТ*\n\nДобавьте выполненную задачу";
                }
                $bot->reply($output, array_merge(['parse_mode'=>"markdown"],$keyboard));

        }
        else { gotoRegistration($bot); }
    });
    
$botman->hears("ДОБАВИТЬ ЗАДАЧУ В ОТЧЕТ 2", function($bot){
    $active = $bot->getMessage()->getExtras('activeparticipant');
    if($active)
        {
            $bot->startConversation(new report2Conversation);
        }
    else { gotoRegistration($bot); }
});

$botman->hears("ОТЧЕТ 3", function($bot){
    $active = $bot->getMessage()->getExtras('activeparticipant');
    if($active)
        {
            $user_id = $bot->getUser()->getId();
            $currentTime = Carbon::now();
            $report3_from = Carbon::create($currentTime->year, $currentTime->month, $currentTime->day, env("REPORT3_FROM"),0,0);
            $report3_to = Carbon::create($currentTime->year, $currentTime->month, $currentTime->day, env("REPORT3_TO"),0,0);
            if($currentTime->between($report3_from,$report3_to,true)){
    
                $keyboard = Keyboard::create()->type(Keyboard::TYPE_KEYBOARD)
                ->addRow(
                    KeyboardButton::create('СООБЩИТЬ О ЗАРАБОТКЕ')->callbackData('СООБЩИТЬ О ЗАРАБОТКЕ'))
                ->addRow(
                    KeyboardButton::create('ОТЧЕТ 1')->callbackData('ОТЧЕТ 1'),
                    KeyboardButton::create('ОТЧЕТ 2')->callbackData('ОТЧЕТ 2'),
                    KeyboardButton::create('ОТЧЕТ 3')->callbackData('ОТЧЕТ 3'))
                ->addRow(
                    KeyboardButton::create('ГЛАВНОЕ МЕНЮ')->callbackData('ГЛАВНОЕ МЕНЮ'))
                ->toArray();
                $report = report::where('dt',date('Y-m-d'))->where('user_id',$user_id)->first();
                if($report->report3_money == null){
                    $output = "Вы еще не предоставляли информацию о заработке за сегодняшний день для ОТЧЕТ №3\n\nНажмите на кнопку *СООБЩИТЬ О ЗАРАБОТКЕ* для того чтобы передать информацию о сегодняшнем заработке";
                }
                else{
                    $output = "Вы уже сдали информацию о заработке на сегодняшний день для ОТЧЕТ 3.\n\nВаш заработок на сегодня: ".$report->report3_money." KGS\n\nЕсли вы хотите изменить информацию о заработке нажмите на кнопку *СООБЩИТЬ О ЗАРАБОТКЕ*";
                }
                $bot->reply($output, array_merge(['parse_mode'=>"markdown"],$keyboard));
            }
            else {
                $bot->reply("*Сейчас не время сдавать ОТЧЕТ №3* \n\n _Более подробно можете ознакомиться в разделе ПРАВИЛА_",["parse_mode"=>"markdown"]);
            }
        }
        else { gotoRegistration($bot); }
});

$botman->hears("СООБЩИТЬ О ЗАРАБОТКЕ", function($bot){
    $active = $bot->getMessage()->getExtras('activeparticipant');
    if($active)
        {
            $bot->startConversation(new report3Conversation);
        }
    else { gotoRegistration($bot); }
});


$botman->hears("МОЙ ПРОФИЛЬ", function($bot){
    $active = $bot->getMessage()->getExtras('activeparticipant');
    if($active)
        {
            $keyboard = Keyboard::create()->type(Keyboard::TYPE_KEYBOARD)
            ->addRow(
                KeyboardButton::create('ИЗМЕНИТЬ ФАМИЛИЮ')->callbackData('ИЗМЕНИТЬ ФАМИЛИЮ'),
                KeyboardButton::create('ИЗМЕНИТЬ ИМЯ')->callbackData('ИЗМЕНИТЬ ИМЯ'))
            ->addRow(
                KeyboardButton::create('ИЗМЕНИТЬ НОМЕР ТЕЛЕФОНА')->callbackData('ИЗМЕНИТЬ НОМЕР ТЕЛЕФОНА'))
            ->addRow(
                KeyboardButton::create('ИЗМЕНИТЬ АВАТАР')->callbackData('ИЗМЕНИТЬ АВАТАР'))
            ->addRow(
                KeyboardButton::create('ГЛАВНОЕ МЕНЮ')->callbackData('ГЛАВНОЕ МЕНЮ'))
            ->toArray();
        
            $telegram_id = $bot->getUser()->getId();
            $participant = participant::where('user_id',$telegram_id)->first();
            $phone_number = isset($participant->phone) ? $participant->phone : "нету";
            $bot->reply("
                *ИНФОРМАЦИЯ ВАШЕГО ПРОФИЛЯ:*\n===================================\nTelegram ID: ".$telegram_id."\nИмя пользователя: ".$participant->username."\nФамилия: ".$participant->last_name."\nИмя: ".$participant->first_name."\nНомер телефона: ".$phone_number,array_merge($keyboard, ["parse_mode" => "markdown"]));
        }
    else { gotoRegistration($bot); }
});


$botman->hears("ИЗМЕНИТЬ ФАМИЛИЮ", function($bot){
    $active = $bot->getMessage()->getExtras('activeparticipant');
    if($active)
        {
            $bot->startConversation(new changeLastName);
        }
    else { gotoRegistration($bot); }
});
$botman->hears("ИЗМЕНИТЬ ИМЯ", function($bot){
    $active = $bot->getMessage()->getExtras('activeparticipant');
    if($active)
        {
            $bot->startConversation(new changeFirstName);
        }
    else { gotoRegistration($bot); }
});
$botman->hears("ИЗМЕНИТЬ НОМЕР ТЕЛЕФОНА", function($bot){
    $active = $bot->getMessage()->getExtras('activeparticipant');
    if($active)
        {
            $bot->startConversation(new changePhone);
        }
    else { gotoRegistration($bot); }
});
