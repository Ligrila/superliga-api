<?php
namespace App\Command;

use Cake\Console\Arguments;
use Cake\Console\Command;
use Cake\Console\ConsoleIo;
use Cake\Datasource\ConnectionManager;

// actualiza las vistas
class ChampionshipTasksCommand extends Command
{
    public function execute(Arguments $args, ConsoleIo $io)
    {

        
        $connection = ConnectionManager::get('default');
        try{

            $connection->query("REFRESH MATERIALIZED VIEW championships_users_points")->execute();
            $connection->query("REFRESH MATERIALIZED VIEW championships_users_points_sums")->execute();
            $connection->query("REFRESH MATERIALIZED VIEW championships_points;")->execute();
            $connection->query("REFRESH MATERIALIZED VIEW championships_rankings;")->execute();
            $connection->query("REFRESH MATERIALIZED VIEW championships_users_points_trivias")->execute();
            $connection->query("REFRESH MATERIALIZED VIEW championships_users_points_trivias_sums")->execute();
            
        } catch(\Exception $e){
            debug($e);
        }

    }
}