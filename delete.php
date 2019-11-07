<?php
    require 'db.php';
    $id = $_GET['id'];
    $sql = 'DELETE FROM patients WHERE patient_id=:id';
    $stmt=$connection->prepare($sql);

    if($stmt->execute([':id'=>$id])){
       header("location: /"); 
    }
?>