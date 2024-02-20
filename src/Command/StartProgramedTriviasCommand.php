<?php
namespace App\Command;

use Cake\Console\Arguments;
use Cake\Console\Command;
use Cake\Console\ConsoleIo;
use Psr\Log\LogLevel;


class StartProgramedTriviasCommand extends Command
{
    public function execute(Arguments $args, ConsoleIo $io)
    {
        $this->loadModel('Trivias');
        // solo las normales
        $data = $this->Trivias->startTimedOutTrivia('trivia');
        //$trivia = $this->Trivias->find()->where(['type'=>'trivia'])->first();
        //$saved = true;
        //$data = compact('trivia','saved');
        if($data['saved']){
            $trivia = $data['trivia'];
            $title = 'La trivia comenzó';
            $body  = " Empezá a jugar ahora.";

            //$this->loadModel('PushNotifications')->send($title,$body,$trivia);

            $genericQuestions = \Cake\ORM\TableRegistry::get('GenericQuestions')->find()->where(['trivia_id'=>$trivia->id]);
            sleep(15);
            foreach($genericQuestions as $genericQuestion){
                $this->log("Enviando pregunta...",LogLevel::INFO);

                $saved = \Cake\ORM\TableRegistry::get('Questions')->addGeneric($trivia->id,0,$genericQuestion->id);
                if(!$saved){
                    $this->log("Guardando pregunta fallo.. esperando 15 segundos",LogLevel::ERROR);
                    sleep(15);
                    continue;
                }
                $this->log("Esperando respuesta 15 segundos...",LogLevel::INFO);
                sleep(14); // app 15
                $this->log("Enviando respuesta correcta...",LogLevel::INFO);
                $question = null;
                $saved = \Cake\ORM\TableRegistry::get('Questions')->setCorrectOption($saved->id,$genericQuestion->correct_option,$question);
                $this->log("Esperando 10 segundos a que se muestre dialogo...",LogLevel::INFO);
                sleep(10); // app 6
                if(!empty($question->publicity_campaign)){
                    if(!empty($question->publicity_campaign)&&!empty($question->publicity_campaign->banner)){
                        $data = $question->publicity_campaign->banner;
                        $bannerUri = 'http://www.jugadasuperliga.com'.$data->banner;
                        $bannerType = 'image';
                        $trivia_id = $question->trivia_id;

                        $this->Trivias->showBanner(compact('trivia_id','bannerUri','bannerType','data'));
                        $this->log("La pregunta tiene publicidad agregando 7 segundos",LogLevel::INFO);
                        sleep(7); // TODO: 8s alex
                    }
                    $data = $question->public_campaign->banner;
                }

            }

            $saved = $this->Trivias->finish($trivia->id);

            $this->log("Terminando trivia...",LogLevel::INFO);


        }

    }
}
