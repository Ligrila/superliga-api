<?php
require __DIR__ . '/vendor/autoload.php';

use \Curl\Curl;

$curl = new Curl();
/*$curl->post('http://localhost:8080/api/users/add',[
        'email'=>'test@mocla.us',
        'password'=>'asdasd'
]);*/

$curl->post('http://localhost:8080/api/users/login',[
        'email'=>'test@mocla.us',
        'password'=>'asdasd'
]);


$user_id = $curl->response->data->user->id;
$token = ($curl->response->data->access_token);
$refresh_token = ($curl->response->data->refresh_token);

$curl->setHeader('Authorization', 'Bearer ' . $token);

/*
$curl->post('http://localhost:8080/api/answers/add',[
    'question_id' =>  "a5cd72f8-91d2-11e8-b1e3-fc97003613b9",
    'selected_option'=>"option_2"
]);
var_dump($curl->response);

*/
$curl->post('http://localhost:8080/api/answers/add',[
    'question_id' =>  "4503959f-239b-4a51-a072-4df97d4554c3",
    'selected_option'=>"option_3"
]);
var_dump($curl->response);
var_dump($curl->response->data->errors);
