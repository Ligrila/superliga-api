<?php
require __DIR__ . '/vendor/autoload.php';

use \Curl\Curl;

$curl = new Curl();
/*$curl->post('http://jugadasuperliga.com/users/add',[
        'email'=>'test@mocla.us',
        'password'=>'asdasd'
]);*/

$curl->post('https://www.jugadasuperliga.com/api/users/login',[
        'email'=>'Test@mocla.us',
        'password'=>'asdasd'
]);

var_dump($curl->response);

$user_id = $curl->response->data->user->id;
$token = ($curl->response->data->access_token);
$refresh_token = ($curl->response->data->refresh_token);

$curl->setHeader('Authorization', 'Bearer ' . $token);

/*
$curl->post('http://jugadasuperliga.com/answers/add',[
    'question_id' =>  "a5cd72f8-91d2-11e8-b1e3-fc97003613b9",
    'selected_option'=>"option_2"
]);
var_dump($curl->response);

*/
$curl->post('https://jugadasuperliga.com/api/answers/add',[
    'question_id' =>  "ec541a31-42d1-48e0-a23e-526c0a29db5c",
    'selected_option'=>"option_3"
]);
var_dump($curl->response);
