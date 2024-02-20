<?php
namespace App\Command;

use Cake\Console\Arguments;
use Cake\Console\Command;
use Cake\Console\ConsoleIo;
use Cake\Console\ConsoleOptionParser;
use Cake\Datasource\ConnectionManager;

class ReloadLivesCommand extends Command
{

    public function execute(Arguments $args, ConsoleIo $io)
    {

        $connection = ConnectionManager::get('default');
        $this->loadModel('Lives');
        $users = $connection->query("select life.user_id,life.lives from life left join infinite_lives ON life.user_id = infinite_lives.user_id AND until >= now() where lives < 70 and until is NULL ")->fetchAll();
        foreach($users as $user){
            $extraLives = 70 - $user[1];
            if($extraLives<=0){
                debug("error");
                continue;
            }
            $lives = $this->Lives->newEmptyEntity();
            $lives->user_id = $user[0];
            $lives->lives = $extraLives;
            $lives->comments = "BONUS";
            $this->Lives->save($lives);

        }
        $connection->query("REFRESH MATERIALIZED VIEW CONCURRENTLY life;")->execute();
        //select * from life left join infinite_lives ON life.user_id = infinite_lives.user_id AND until >= now() where lives < 70 and until is NULl
    }
}
