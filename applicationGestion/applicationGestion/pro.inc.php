<?php
$db_host="localhost";
$db_name="gestionapp";
$db_user="root";
$db_pass="";

#ici la connexion à la BDD
// $civilite=array('Masculin'=>'M. ', 'Féminin'=>'Mme. ');
try {
    $db = "mysql:host=$db_host;dbname=$db_name;charset=utf8mb4;Port:3360";
    $pdo = new PDO($db, $db_user, $db_pass);

    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // echo "Connected successfully";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>