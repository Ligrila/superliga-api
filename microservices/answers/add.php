<?php

// simplemente añadir la pregunta a la bd y retornar respuesta
header('Content-Type: application/json');

require('../database.php');
require('../functions.php');


$id = gen_uuid();
$user_id = read_post_value('user_id');
$question_id = read_post_value('question_id');
$selected_option = read_post_value('selected_option');


$data = compact('id','user_id','question_id','selected_option');

data_check($data);

$validateSql = "SELECT lives,infinite_lives.until from life LEFT JOIN infinite_lives ON life.user_id = infinite_lives.user_id AND infinite_lives.until>=now() where life.user_id='$user_id' limit 1";

$validateStmt = $database->prepare($validateSql);


$isOk = $validateStmt->execute();
$validateQueryResult = $validateStmt->fetch(PDO::FETCH_OBJ);

$hasInfiniteLives = false;
$userLives = 0;

if($validateQueryResult){
    $hasInfiniteLives = !empty($validateQueryResult->until);
    $userLives = empty($validateQueryResult->lives) ? 0 : $validateQueryResult->lives;
}


if($userLives<=0 && !$hasInfiniteLives){
    echo json_encode(
        [
            'success'=>false,
            'data'=> $data,
            'error'=> 'No puedes responder sin vidas'
        ]
    );
    exit;
}
$lives = 1;
if($hasInfiniteLives){
    $lives = 0;
}

$data['lives'] = $lives;

$values = ':id, :user_id, :question_id, :selected_option, current_timestamp,:lives';
$fields = 'id,user_id,question_id,selected_option,created,lives';

$sql = "INSERT INTO answers ($fields) VALUES ($values)";

$stmt = $database->prepare($sql);


$saved = $stmt->execute($data);



echo json_encode(
    [
        'success'=>$saved,
        'data'=> $data,
        'error'=> $saved ? false : $stmt->errorInfo()
    ]
);


