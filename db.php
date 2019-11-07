<?php
$dsn = 'mysql:host=127.0.0.1;dbname=uhealth';
$user = 'root';
$pass = 'mhw1015sz15,.';
$options = [];
$connection = new PDO($dsn, $user, $pass, $options);

try {
    $connection = new PDO($dsn, $user, $pass, $options);
} catch(PDOException $e) {

}
?>