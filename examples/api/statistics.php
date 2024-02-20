<?php
require __DIR__ . '/vendor/autoload.php';

use \Curl\Curl;

$endPoint = 'https://www.jugadasuperliga.com/api';
//$endPoint = 'http://stage.jugadasuperliga.mocla.us/api';



$i = $argv[1];

try{



$curl = new Curl();
/*$curl->post($endPoint.'/users/add',[
        'email'=>'test@mocla.us',
        'password'=>'asdasd'
]);*/

$curl->post($endPoint.'/users/login?r='.$i,[
        'email'=>'test@mocla.us',
        'password'=>'asdasd'
]);


$user_id = $curl->response->data->user->id;
$token = ($curl->response->data->access_token);
$refresh_token = ($curl->response->data->refresh_token);

$curl->setHeader('Authorization', 'Bearer ' . $token);

/*
$curl->post($endPoint.'/answers/add',[
    'question_id' =>  "a5cd72f8-91d2-11e8-b1e3-fc97003613b9",
    'selected_option'=>"option_2"
]);
var_dump($curl->response);
exit;
*/
$curl->post($endPoint.'/answers/add?r='.$i,[
    'question_id' =>  "573b16b3-8fb0-46a3-97f7-d16864ec3505/option_1",
    'selected_option'=>"option_3"
]);
var_dump($curl->response);


$curl->get($endPoint.'/users/trivia-statistics/8d02e47c-fb9f-4675-ba1e-4124067851a3?r='.$i);
//var_dump($curl->response);
$curl->get($endPoint.'/users/me');
//var_dump($curl->response);

$curl->get($endPoint.'/users/trivia-statistics/034f7ebf-9c33-47ac-bf93-24972d6c0517?r='.$i);
var_dump($curl->response);

    echo "$i success \n";
}
catch (\Exception $e){
    echo "$i fail \n";
}
