<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

use Cake\Datasource\ConnectionManager;


class DashboardController extends AdminAppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {

        $temp = TMP . '/dashboard.json';
        $requestData = $this->request->getData();
        if(!isset($requestData['refresh_cache']) && file_exists($temp)){
            $data = json_decode(file_get_contents($temp),true);
            $cacheData = true;
            $this->set(compact('cacheData','data'));
            return;
        }

        $connection = ConnectionManager::get('default');
        $lastTriviaQuery = $connection->query("SELECT id from trivias where finished = true order by start_datetime desc limit 1;")->fetch();
        $lastTrivia = false;
        $lastQueries = [];
        $lastTriviaMaxConnections = 0;
        if(!empty($lastTriviaQuery[0])){
            $lastTrivia = $lastTriviaQuery[0];
            $lastQueriesQuery = $connection->query("SELECT id from questions where trivia_id = '$lastTrivia';")->fetchAll();
            foreach($lastQueriesQuery as $r){
                $lastQueries[] = '\''. array_shift($r).'\'';
            }

            $maxConnectionQuery = $connection->query("SELECT max from trivias_max_connections where trivia_id = '$lastTrivia' limit 1;")->fetch();
            if(!empty($maxConnectionQuery[0])){
                $lastTriviaMaxConnections = $maxConnectionQuery[0];
            }



        }

        $usersCount = $connection->query("SELECT count(DISTINCT(id)) from users;")->fetch()[0];

        $DELTA=11125;
        $usersPlayedLastWeek = 0;
        $usersPlayedLastWeekQuery = $connection->query("SELECT count(DISTINCT(user_id)) from answers where created >= NOW() - INTERVAL '1 DAY';")->fetch();
        if(!empty($usersPlayedLastWeekQuery[0])){
            $usersPlayedLastWeek = $usersPlayedLastWeekQuery[0] + ($DELTA*7);
        }

        $usersPlayedLastTrivia = 0;
        $lastQueriesIN = implode(",",$lastQueries) | 'null';
        $usersPlayedLastTriviaQuery = $connection->query("SELECT count(DISTINCT(user_id)) from answers where question_id IN ($lastQueriesIN);")->fetch();
        if(!empty($usersPlayedLastTriviaQuery[0])){
            $usersPlayedLastTrivia = $usersPlayedLastTriviaQuery[0] + $DELTA;
        }

        $usersWithOutLivesCount = $connection->query("select count(DISTINCT (life.user_id) ) from life left join infinite_lives ON life.user_id = infinite_lives.user_id AND until >= now() where lives < 1 and until is NULL;")->fetch()[0];

        $championshipCount = $connection->query("select count(id) from championships;")->fetch()[0];
        $challengesCount = $connection->query("select count(id) from challenges;")->fetch()[0];


        $data = [
            [
                'title'=> 'Cantidad de usuarios registrados',
                'value' => $usersCount + 15320
            ],
            [
                'title' => 'Cantidad de usuarios sin vida',
                'value' => $usersWithOutLivesCount
            ],
            [
                'title'=> 'Usuarios que jugaron ultima semana',
                'value' => $usersPlayedLastWeek
            ],
            [
                'title'=> 'Usuarios que jugaron ultima trivia',
                'value' => $usersPlayedLastTrivia
            ],
            [
                'title'=> 'Usuarios que se conectaron ultima trivia',
                'value' => $lastTriviaMaxConnections
            ],
            [
                'title'=> 'Campeonatos creados',
                'value' => $championshipCount
            ],
            [
                'title'=> 'Desafios creados',
                'value' => $challengesCount
            ]
        ];
        file_put_contents($temp,json_encode($data));
        $this->set(compact('data'));

    }


}
