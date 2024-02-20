<?php
require __DIR__ . '/vendor/autoload.php';

use \Curl\Curl;

$curl = new Curl();
//$curl->setHeader('Content-Type','application/json');
$curl->setHeader('Accept', 'application/json');
$email = "lopezlean@gmail.com";
sha1( 'wt1U5MACWJFTXGenFoZoiLwQGrLgdbHA' . strtoupper($email) . 'wt1U5MACWJFTXGenFoZoiLwQGrLgdbHA');
$curl->post('http://afa-loadbalancer-1800168112.sa-east-1.elb.amazonaws.com/api/users/add', [
        "first_name" => "Ariel",
        "last_name" => "Lopez",
        "email" => $email,
        "password" => "asdasd",
        "referral_username" => "",
        "hash" => sha1( 'wt1U5MACWJFTXGenFoZoiLwQGrLgdbHA' . strtoupper($email) . 'wt1U5MACWJFTXGenFoZoiLwQGrLgdbHA'),
        "document" => null,
        "mobile_number" => "3435163446"
]);



var_dump($curl->response);

/*$user_id = $curl->response->data->user->id;
$token = ($curl->response->data->access_token);
$refresh_token = ($curl->response->data->refresh_token);


$curl->get('http://jugadasuperliga.com/api/users/me');
var_dump($curl->response);
*/
