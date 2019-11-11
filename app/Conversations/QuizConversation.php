<?php

namespace App\Conversations;

use BotMan\BotMan\Messages\Conversations\Conversation;
use App\Question;

class QuizConversation extends Conversation
{
    protected $quizQuestions;
    protected $userPoints = 0;
    protected $userCorrectAnswers = 0;
    protected $questionCount = 0;
    protected $currentQuestion = 1;    
    
    public function run()
    {
        //$this->quizQuestions = Question::all()->shuffle();
        //$this->questionCount = $this->quizQuestions->count();
        //$this->quizQuestions = $this->quizQuestions->keyBy('id');
        $this->showInfo();
    }

    private function showInfo()
    {
        $this->say('You will be showen '.$this->questionCount.' questions about Laravel. Every correct answer will reward you with a certain amount of points. Please keep it fair, and don\'t use any help. All the best! 🍀');
        //$this->checkForNextQuestion();
    }

    


}