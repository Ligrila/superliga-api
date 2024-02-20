<?php

require('../database.php');
require('../functions.php');


$id = gen_uuid();
$user_id = '9d49c872-6362-4cba-95a8-06bc79987448'; // ambos
$user_id = '8efeea30-859a-44b2-9d0f-61b07a67a72f'; // vidas
$user_id = 'f3e2d89a-2e55-49e9-b568-fc11bdd7f029'; // vencida infinita


$data = compact('id','user_id');

data_check($data);


$validateSql = "SELECT lives,infinite_lives.until from life LEFT JOIN infinite_lives ON life.user_id = infinite_lives.user_id AND infinite_lives.until>=now() where life.user_id='$user_id' limit 1";

$validateStmt = $database->prepare($validateSql);


$isOk = $validateStmt->execute();
$validateQueryResult = $validateStmt->fetch(PDO::FETCH_OBJ);

$hasInfiniteLives = false;
$lives = 0;

if($validateQueryResult){
    $hasInfiniteLives = !empty($validateQueryResult->until);
    $lives = empty($validateQueryResult->lives) ? 0 : $validateQueryResult->lives;
}

var_dump(compact('validateQueryResult','lives','hasInfiniteLives'));