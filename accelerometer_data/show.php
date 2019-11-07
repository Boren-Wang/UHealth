<?php
    require '../db.php';
    $id = $_GET['id'];

    $sql = 'SELECT * FROM patients WHERE patient_id=:id';
    $stmt = $connection->prepare($sql);
    $stmt->execute([':id'=>$id]);
    $patient = $stmt->fetch(PDO::FETCH_OBJ);

    $sql = 'SELECT * FROM accelerometer_data WHERE patient_id=:id';
    $stmt = $connection->prepare($sql);
    $stmt->execute([':id'=>$id]);
    $data = $stmt->fetchAll(PDO::FETCH_OBJ);

?>

<?php require '../header.php';?>
    <div class="container">
        <div class="card mt-5">
            <div class="card-header">
                <h2><?=$patient->name?>'s accelerometer data</h2>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>Epoch(ms)</th>
                        <th>Time</th>
                        <th>elapsed(s)</th>
                        <th>X-Axis(g)</th>
                        <th>Y-Axis(g)</th>
                        <th>Z-Axis(g)</th>
                    </tr>
                    
                    <?php foreach($data as $record): ?>
                        <tr>
                            <td><?=$record->epoch;?></td>
                            <td><?=$record->t;?></td>
                            <td><?=$record->elapsed;?></td>
                            <td><?=$record->x;?></td>
                            <td><?=$record->y;?></td>
                            <td><?=$record->z;?></td>
                        </tr> 
                    <?php endforeach; ?>

                </table>
                <a href="../show.php?id=<?=$id?>" class="btn btn-info">Back</a>
                
            </div>
        </div>
    </div>
<?php require '../footer.php';?>
