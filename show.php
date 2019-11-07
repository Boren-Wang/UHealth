<?php
    require 'db.php';
    $id = $_GET['id'];
    $sql = 'SELECT * FROM patients WHERE patient_id=:id';
    $stmt = $connection->prepare($sql);
    $stmt->execute([':id'=>$id]);
    $patient = $stmt->fetch(PDO::FETCH_OBJ);
    // if(isset($_POST['name'])&&isset($_POST["email"])) {
    //     $name = $_POST['name'];
    //     $email = $_POST['email'];
    //     $sql = 'UPDATE people SET name=:name, email=:email WHERE id=:id';
    //     $stmt = $connection->prepare($sql);
    //     if ($stmt->execute([':name'=>$name, ':email'=>$email, ':id'=>$id])){
    //         header("location: /");
    //     }
    // }
?>

<?php require 'header.php';?>
    <div class="container">
        <div class="card mt-5">
            <div class="card-header">
                <h2><?=$patient->name?>'s Information</h2>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Height</th>
                        <th>Weight</th>
                        <th>Gender</th>
                    </tr>
                    
                    <tr>
                        <td><?=$patient->patient_id;?></td>
                        <td><?=$patient->name;?></td>
                        <td><?=$patient->age;?></td>
                        <td><?=$patient->height;?></td>
                        <td><?=$patient->weight;?></td>
                        <td><?=$patient->gender;?></td>
                    </tr> 

                </table>
                <div class="mb-1">
                    <a href="/accelerometer_data/show.php?id=<?=$patient->patient_id?>" class="btn btn-info">Accelerometer Data</a>
                </div>
                <a href="/" class="btn btn-info">Back</a>
                
            </div>
        </div>
    </div>
<?php require 'footer.php';?>