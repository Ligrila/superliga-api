<?php
namespace App\Command;

use Cake\Console\Arguments;
use Cake\Console\Command;
use Cake\Console\ConsoleIo;

class NextSoonTriviaCommand extends Command
{
    public function execute(Arguments $args, ConsoleIo $io)
    {
        $this->loadModel('Trivias');
        $trivia = $this->Trivias->getNextSoonTrivia();
        $notified1 = true;
        $notified2 = false;
        if(!$trivia){
            $trivia = $this->Trivias->getAboutToStartTrivia();
            $notified2 = true;

        }

        if(!$trivia){
            return;
        }

        $trivia->notified = true;
        if($notified2){
            $trivia->notified2 = true;
        }
        $this->Trivias->save($trivia);
        $title = "{$trivia->local_team->name} VS {$trivia->visit_team->name}";
        $body  = "El partido comenzará pronto.";
        if(!empty($trivia->award)){
            $body = $body . ' Jugas por ' . $trivia->award . '.';
        }
        if($trivia->type=='trivia'){
            $timeTxt = $trivia->start_datetime->i18nFormat('HH:mm','America/Argentina/Buenos_Aires');
            $title = $trivia->title1 . ' ' . $trivia->title2 . ' ' . $timeTxt . '.';
            $body = 'Toca aquí para poder jugar.';
            if(!empty($trivia->award)){
                $body = $trivia->award;
            }
        }
        if($trivia->points_multiplier>1){
            if($trivia->points_multiplier==2){
                $body .= ' ¡Los puntos valen el doble!';
            }
        }

        $this->loadModel('PushNotifications')->send($title,$body,$trivia->toArray(),null,null,null,10 * 60);
    }
}
