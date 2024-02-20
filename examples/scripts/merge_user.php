<?php
class MergeUser{

    static function merge($email,$pdo){
        try{
            $email = strtolower($email);
            $sql = "SELECT users.id as user_id,P.points,username,email,first_name,last_name,created 
                from users 
                LEFT JOIN points P ON users.id = P.user_id 
                where LOWER(email) = '$email';";

            $stmt = $pdo->prepare($sql); 
            if(!$stmt->execute()){
                print_r($pdo->errorInfo());
            }
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $user = [];
            if(count($users)<2){
                var_dump($users);
                exit;
                return;
            }
            $userWithPoints = false;
            foreach($users as $index => $user){
                if($user['points']>0){
                    $userWithPoints [] = $user;
                    unset($users[$index]);
                    
                }
            }
            if($userWithPoints){
                if(count($userWithPoints)>1){
                    $allPoints = [];
                    foreach($userWithPoints as $p){
                        $allPoints[] = $p['points'];
                    }
                    $maxIndex =  array_keys($allPoints, max($allPoints))[0];
                    $tmp1 = $userWithPoints;
                    $userWithPoints = [$tmp1[$maxIndex]];
                    unset($tmp1[$maxIndex]);
                    foreach($userWithPoints as $p){
                        $users [] = $p;
                    }

                }

                $user = $userWithPoints;
                //var_dump($userWithPoints);
                // var_dump($users);

            } else{
                $usersWithToken = [];
                foreach($users as $index => $user){
                    $user_id = $user['user_id'];
                    $sql2 = "SELECT * from auth_token where user_id = '$user_id' order by created DESC limit 1;";
                    $stmt2 = $pdo->prepare($sql2); 
                    $stmt2->execute();
                    $was = $stmt2->fetchAll(PDO::FETCH_ASSOC);
                    if(!empty($was[0]["id"])){
                        $user['token'] = $was[0]['created'];
                        $usersWithToken[] = $user;
                        unset($users[$index]);
                    }
                    

                }
                if(count($usersWithToken)>1){
                    $allValues = [];
                    foreach($usersWithToken as $index => $token){
                        $allValues[$index] = strtotime($token['token']);
                    }
                    $maxIndex =  array_keys($allValues, max($allValues))[0];
                    $tmp = $usersWithToken;
                    $usersWithToken = [$tmp[$maxIndex]];
                    unset($tmp[$maxIndex]);
                    foreach($tmp as $a){
                        $users[] = $a;
                    }
                    

                }
                if(count($usersWithToken)>1){
                    var_dump($usersWithToken);
                    throw new Exception("El usuario $email tiene varios tokens");
                    

                } else{
                    if(empty($usersWithToken)){
                        //throw new Exception("El usuario $email no tiene puntos, necesita chequeo manual");
                        // nunca se logeo sacamos dejamos el primero.
                        $userWithPoints = $users[0];
                        unset($users[0]);
                        $user = $userWithPoints;
                    } else{
                        $user = $usersWithToken;
                    }
                }
                


            }
            
            //echo "# usuario " . json_encode($user) . "\r\n";
            foreach($users as $toConvert){
                $email = uniqid("superliga") . "superliga_" . $toConvert['email'];
                $username = trim($toConvert['username']).'-'.uniqid();
                $id = $toConvert['user_id'];
                echo "UPDATE users SET email = '$email', username = '$username' WHERE id = '$id';" . "\r\n";
                
            }
            

        } catch(Exception $e){
            var_dump($e->getMessage());

        }


    }
}