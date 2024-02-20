<?php
require __DIR__ . '/vendor/autoload.php';

use \Curl\Curl;

//$endPoint = 'http://stageprod.jugadasuperliga.mocla.us';
//$endPoint = 'http://php/superliga';
$endPoint = 'https://www.jugadasuperliga.com';

$curl = new Curl();
/*$curl->post('http://stageprod.jugadasuperliga.mocla.us/superliga/users/add',[
        'email'=>'test@mocla.us',
        'password'=>'asdasd'
]);*/

/*$curl->post($endPoint.'/api/users/login',[
        'email'=>'test_user_91264001@testuser.com',
        'password'=>'asdasd'
]);*/

$curl->post($endPoint.'/api/users/login',[
        'email'=>'Lopezlean@gmail.com',
        'password'=>'asdasd'
]);


$user_id = $curl->response->data->user->id;
$token = ($curl->response->data->access_token);
$refresh_token = ($curl->response->data->refresh_token);

$curl->setHeader('Authorization', 'Bearer ' . $token);

/*
$curl->post('http://stageprod.jugadasuperliga.mocla.us/superliga/answers/add',[
    'question_id' =>  "a5cd72f8-91d2-11e8-b1e3-fc97003613b9",
    'selected_option'=>"option_2"
]);
var_dump($curl->response);

*/
$curl->get($endPoint.'/api/payments/buy/3');
var_dump($curl->response);
var_dump($user_id);
//var_dump($curl->response->data->errors);