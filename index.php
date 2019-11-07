<?php
    require 'db.php';
    $sql = 'SELECT * FROM patients';
    $stmt = $connection->prepare($sql);
    $stmt->execute(); 
    $patients = $stmt->fetchAll(PDO::FETCH_OBJ);

?>
<?php require 'header.php';?>
    <div class="container">
        <div class="card mt-5">
            <div class="card-header">
                <h2>All patient</h2>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                    <?php foreach($patients as $patient): ?>
                        <tr>
                            <td><?=$patient->patient_id;?></td>
                            <td><?=$patient->name;?></td>
                            <td>
                                <a href="show.php?id=<?=$patient->patient_id?>" class="btn btn-success">Read</a>
                                <a href="edit.php?id=<?=$patient->patient_id?>" class="btn btn-info">Edit</a>
                                <a onclick="return confirm('Are you sure you want to delete this entry?')" href="delete.php?id=<?=$patient->patient_id?>" class="btn btn-danger">Delete</a>
                            </td>
                        </tr> 
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>
<?php require 'footer.php';?>