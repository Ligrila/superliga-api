<?php
require __DIR__ . '/vendor/autoload.php';

use \Curl\Curl;

$curl = new Curl();



$curl->post('http://localhost:8080/api/users/login',[
        'email'=>'lopezlean@gmail.com',
        'password'=>'asdasd'
]);

var_dump($curl->response);
