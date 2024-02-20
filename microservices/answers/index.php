<?php

header('Content-Type: application/json');

echo json_encode(
    [
        'saved'=>true,
        'title' => 'Answers microservice.',
        'methods'=>[
            'add' => [
                'title' => 'Save answer',
                'type' => 'POST',
                'params' => [
                    'user_id',
                    'question_id',
                    'selected_option'
                ]
            ]
            
        ]

    ]
);