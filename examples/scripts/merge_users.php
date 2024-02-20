
<?php 
require ('merge_user.php');

/* Conectar a una base de datos de MySQL invocando al controlador */
$dsn = "pgsql:dbname=superliga_online;host=localhost";
$usuario = 'lopezlean';
$contraseña = '';

$dsn = "pgsql:dbname=superliga;host=superliga.postgre;port=5433";
$usuario = 'superliga';
$contraseña = 'm11cla';


try {
    $pdo = new PDO($dsn, $usuario, $contraseña);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 




    $sql = '
    SELECT DISTINCT LOWER(email) as email from users
    group by LOWER(email)
    HAVING COUNT(*) > 1
    ;
    ';
    $stmt = $pdo->prepare($sql); 
    if(!$stmt->execute()){
        print_r($pdo->errorInfo());

    }
    $users = $stmt->fetchAll();    
    foreach($users as $user){
        MergeUser::merge($user['email'],$pdo);
    }

    //var_dump($users);
} catch (\Exception $e) {
    echo 'Falló la conexión: ' . $e->getMessage();
}



