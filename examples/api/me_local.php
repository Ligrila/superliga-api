<?php
require __DIR__ . '/vendor/autoload.php';

use \Curl\Curl;

$curl = new Curl();

$curl->post('http://php/superliga/api/users/login',[
        'email'=>'test@mocla.us',
        'password'=>'asdasd'
]);
var_dump($curl->response);
$user_id = $curl->response->data->user->id;
$token = ($curl->response->data->access_token);
$refresh_token = ($curl->response->data->refresh_token);

$curl->setHeader('Authorization', 'Bearer ' . $token);

$curl->get('http://php/superliga/api/users/me');
var_dump($curl->response);
