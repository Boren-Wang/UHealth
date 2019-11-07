<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once '../db.php';
 
// get posted data
$data = json_decode(file_get_contents("php://input"));
 
// make sure data is not empty
if(
    !empty($data->epoch) &&
    !empty($data->t) &&
    !empty($data->elapsed) &&
    !empty($data->x) && 
    !empty($data->y) &&
    !empty($data->z) &&
    !empty($data->patient_id) 
){
    $epoch = $data->epoch;
    $t = $data->t;
    $elapsed = $data->elapsed;
    $x = $data->x;
    $y = $data->y;
    $z = $data->z;
    $patient_id = $data->patient_id;

    // query to insert record
    $query = "INSERT INTO accelerometer_data(epoch, t, elapsed, x, y, z, patient_id) values(:epoch, :t, :elapsed, :x, :y, :z, :patient_id)";
    // prepare query
    $stmt = $connection->prepare($query);
    // bind values
    $stmt->bindParam(":epoch", $epoch);
    $stmt->bindParam(":t", $t);
    $stmt->bindParam(":elapsed", $elapsed);
    $stmt->bindParam(":x", $x);
    $stmt->bindParam(":y", $y);
    $stmt->bindParam(":z", $z);
    $stmt->bindParam(":patient_id", $patient_id);

    if($stmt->execute()){
        // set response code - 201 created
        http_response_code(201);
 
        // tell the user
        echo json_encode(array("message" => "data was inserted."));
    } else {
        // set response code - 503 service unavailable
        http_response_code(503);
 
        // tell the user
        echo json_encode(array("message" => "Unable to insert data."));
    }
}else{ // tell the user data is incomplete
 
    // set response code - 400 bad request
    http_response_code(400);
 
    // tell the user
    echo json_encode(array("message" => "Unable to insert accelerometer data. Data is incomplete."));
}