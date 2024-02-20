
<?php
function gen_uuid() {
    return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        // 32 bits for "time_low"
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),

        // 16 bits for "time_mid"
        mt_rand( 0, 0xffff ),

        // 16 bits for "time_hi_and_version",
        // four most significant bits holds version number 4
        mt_rand( 0, 0x0fff ) | 0x4000,

        // 16 bits, 8 bits for "clk_seq_hi_res",
        // 8 bits for "clk_seq_low",
        // two most significant bits holds zero and one for variant DCE1.1
        mt_rand( 0, 0x3fff ) | 0x8000,

        // 48 bits for "node"
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
    );
}

// chequea que todo data de la forma key => value no tenga ningun valor empty
function data_check($data){
    foreach($data as $dataIndex=>$dataCheck){
        if(empty($dataCheck)){
            echo json_encode(
                [
                    'success'=>false,
                    'data'=> $data,
                    'error'=> "$dataIndex cannot be empty"
                ]
            );
            exit;
        }
    }
}

function read_post_value($value){
    return empty($_POST[$value]) ? null : $_POST[$value];
}