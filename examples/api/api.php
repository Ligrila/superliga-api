<?php
require __DIR__ . '/vendor/autoload.php';

use \Curl\Curl;
use \Firebase\JWT\JWT;


function refreshToken($user_id){
    $salt = 'ae417422d3346733b8d7a2b66b2dbe9cf471fec9fd00251ed760f2c322b0e356';
    $token = JWT::encode([
        'sub' => $user_id,
        'exp' =>  $expire
    ],
    $salt);

    return $token;
}

$curl = new Curl();
/*$curl->post('http://php/superliga/users/add',[
        'email'=>'test@mocla.us',
        'password'=>'asdasd'
]);*/

$curl->post('http://localhost:8080/api/users/login',[
        'email'=>'test@mocla.us',
        'password'=>'asdasd'
]);

if ($curl->error) {
    echo 'Error: ' . $curl->errorCode . ': ' . $curl->errorMessage . "\n";
    var_dump($curl->response);
} else {
    echo 'Response:' . "\n";
    //var_dump($curl->response);
}



$user_id = $curl->response->data->user->id;
$token = ($curl->response->data->access_token);
$refresh_token = ($curl->response->data->refresh_token);

$curl->setHeader('Authorization', 'Bearer ' . $token);

$curl->get('http://localhost:8080/api/trivias/next');
var_dump($curl->response);

/*


if ($curl->error) {
    echo 'Error: ' . $curl->errorCode . ': ' . $curl->errorMessage . "\n";
    var_dump($curl->response);
} else {
    echo 'Response:' . "\n";
    var_dump($curl->response);
}

$curl->post('http://localhost:8080/users/token',[
    'refresh_token'=>$refresh_token,
]);

var_dump($curl->response);
var_dump('---- END TEST EXPIRED ---');


$curl->setHeader('Authorization', 'Bearer ' . $curl->response->data->access_token);
$curl->get('http://localhost:8080/trivias/next');

var_dump($curl->response);
*/
