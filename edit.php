<?php
    require 'db.php';
    $id = $_GET['id'];
    $sql = 'SELECT * FROM patients WHERE patient_id=:id';
    $stmt = $connection->prepare($sql);
    $stmt->execute([':id'=>$id]);
    $patient = $stmt->fetch(PDO::FETCH_OBJ);

    if(isset($_POST['name'])&&isset($_POST["age"])&&isset($_POST["height"])&&isset($_POST["weight"])&&isset($_POST["gender"])) {
        $name = $_POST['name'];
        $age = $_POST['age'];
        $height = $_POST['height'];
        $weight = $_POST['weight'];
        $gender = $_POST['gender'];
        $sql = 'UPDATE patients SET name=:name, age=:age, height=:height, weight=:weight, gender=:gender where patient_id=:id';
        $stmt = $connection->prepare($sql);
        if ($stmt->execute([':name'=>$name, ':age'=>$age, ':height'=>$height, ':weight'=>$weight, ':gender'=>$gender, ':id'=>$id])) {
            header("location: /");
        }
    }
?>
<?php require 'header.php';?>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h2>Update a patient</h2>
            </div>
            <div class="card-body">

                <?php if(!empty($message)): ?>
                    <div class="alert alert-success">
                        <?=$message;?>
                    </div>
                <?php endif; ?> 

                <form method="post" action="">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="<?=$patient->name?>">
                    </div>
                    <div class="form-group">
                        <label for="age">Age</label>
                        <input type="number" name="age" id="age" class="form-control" min="0" max="100" value="<?=$patient->age?>">
                    </div>
                    <div class="form-group">
                        <label for="height">Height(cm)</label>
                        <input type="number" name="height" id="height" class="form-control" min="0" max="200" value="<?=$patient->height?>"> 
                    </div>
                    <div class="form-group">
                        <label for="weight">Weight(kg)</label>
                        <input type="number" name="weight" id="weight" class="form-control" min="0" max="100" value="<?=$patient->weight?>"> 
                    </div>
                    
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="male" value="Male" checked>
                        <label class="form-check-label" for="male">
                            Male
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="female" value="Female">
                        <label class="form-check-label" for="female">
                            Female
                        </label>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-info">Update a patient</button>
                    </div>
                </form>
                <a href="/" class="btn btn-info">Back</a>
            </div>

        </div>
    </div>
<?php require 'footer.php';?>