<?php
require __DIR__ . '/vendor/autoload.php';

use \Curl\Curl;

$curl = new Curl();
/*$curl->post('http://jugadasuperliga.com/users/add',[
        'email'=>'test@mocla.us',
        'password'=>'asdasd'
]);*/

$curl->post('http://localhost:8080/api/users/login',[
        'email'=>'lopezlean@gmail.com',
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
$curl->get('http://jugadasuperliga.com/api/users/me');
var_dump($curl->response);
