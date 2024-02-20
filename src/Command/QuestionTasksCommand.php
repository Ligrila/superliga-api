<?php
namespace App\Command;

use Cake\Console\Arguments;
use Cake\Console\Command;
use Cake\Console\ConsoleIo;
use Cake\Datasource\ConnectionManager;
use Websocket\Lib\Websocket;

// actualiza las vistas
class QuestionTasksCommand extends Command
{
    public function execute(Arguments $args, ConsoleIo $io)
    {

        
        $connection = ConnectionManager::get('default');
        try{

            $connection->query("REFRESH MATERIALIZED VIEW  correct_answers;")->execute();
            $connection->query("REFRESH MATERIALIZED VIEW  wrong_answers;")->execute();
            $connection->query("REFRESH MATERIALIZED VIEW  points;")->execute();
            $connection->query("REFRESH MATERIALIZED VIEW  life;")->execute();

            Websocket::publishEvent('updateUserData', []);        

            
        } catch(\Exception $e){
            debug($e);
        }



    }
}