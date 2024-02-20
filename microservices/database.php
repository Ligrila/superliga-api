<?php
require('config.php');


try {
    $database = new PDO(DSN); 
} catch (PDOException $e) {
    $response = [
        'success' => false,
        'data' => [
            'error' => $e->getMessage()
        ]
    ];
    echo json_encode($response);
    die();
}

