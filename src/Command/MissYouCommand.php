<?php
namespace App\Command;

use Cake\Console\Arguments;
use Cake\Console\Command;
use Cake\Console\ConsoleIo;
use Cake\Console\ConsoleOptionParser;
use Cake\Datasource\ConnectionManager;

class MissYouCommand extends Command
{

    public function execute(Arguments $args, ConsoleIo $io)
    {

        $connection = ConnectionManager::get('default');
        $this->loadModel('PushNotifications');
        $users = $connection->query("SELECT users.id from users where id not in(
            SELECT DISTINCT(user_id) from answers where created >= NOW() - INTERVAL '3 DAY' group by user_id ) and created <= NOW() - INTERVAL '3 DAY'")->fetchAll();

        $usersIds = [];
        foreach($users as $user){
            $usersIds[] = $user[0];

        }

        $preselected = $this->PushNotifications->find('list',[
            'keyField' => 'token',
            'valueField' => 'token'
        ])->where(['user_id IN'=>$usersIds])
        ->where(['enabled'=>true]);

        $title = 'Te extrañamos, volvé campeón 🏆';
        $body = 'Esta fecha entregamos premios todos los partidos y más puntos. Además,  Banfield-River tendrá un trofeo bomba 💣💣';


        $this->PushNotifications->send($title,$body,[],$preselected);


        //select * from life left join infinite_lives ON life.user_id = infinite_lives.user_id AND until >= now() where lives < 70 and until is NULl 
    }
}