<?php
require __DIR__ . '/vendor/autoload.php';

use \Curl\Curl;

$curl = new Curl();
/*$curl->post('http://php/superliga/users/add',[
        'email'=>'test@mocla.us',
        'password'=>'asdasd'
]);*/

$curl->post('http://php/superliga/users/login',[
        'email'=>'test@mocla.us',
        'password'=>'asdasd'
]);

/*if ($curl->error) {
    echo 'Error: ' . $curl->errorCode . ': ' . $curl->errorMessage . "\n";
} else {
    echo 'Response:' . "\n";
    var_dump($curl->response);
}*/


$user_id = $curl->response->data->user->id;
$token = ($curl->response->data->access_token);
$refresh_token = ($curl->response->data->refresh_token);

$curl->setHeader('Authorization', 'Bearer ' . $token);


$question_id = "009bb2ad-94fa-4b5c-8a55-9c36fb78a759";

$curl->post('http://php/superliga/answers/add',[
    'question_id'=>$question_id,
    'user_id'=>$user_id,
    'selected_option'=> 'option_1'
]);

var_dump($curl->response);
