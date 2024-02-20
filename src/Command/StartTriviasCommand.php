<?php
namespace App\Command;

use Cake\Console\Arguments;
use Cake\Console\Command;
use Cake\Console\ConsoleIo;

class StartTriviasCommand extends Command
{
    public function execute(Arguments $args, ConsoleIo $io)
    {
        $this->loadModel('Trivias');
        // solo las normales
        $data = $this->Trivias->startTimedOutTrivia('normal');
        if($data['saved']){
            $trivia = $data['trivia'];
            $title = "{$trivia->local_team->name} VS {$trivia->visit_team->name}";
            $body  = "El partido comenzó. Empezá a jugar ya.";
    
            $this->loadModel('PushNotifications')->send($title,$body,$trivia);
        }

    }
}