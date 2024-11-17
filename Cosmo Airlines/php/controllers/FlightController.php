<?php
include_once '../config/database.php';
include_once '../models/Flight.php';

$database = new Database();
$db = $database->getConnection();

$flight = new Flight($db);

$data = json_decode(file_get_contents("php://input"));

if(!empty($data->flightNumber) && !empty($data->origin) && !empty($data->destination) && !empty($data->date) && !empty($data->time)) {
    $flight->flightNumber = $data->flightNumber;
    $flight->origin = $data->origin;
    $flight->destination = $data->destination;
    $flight->date = $data->date;
    $flight->time = $data->time;

    if($flight->create()) {
        http_response_code(201);
        echo json_encode(array("message" => "Flight was created."));
    } else {
        http_response_code(503);
        echo json_encode(array("message" => "Unable to create flight."));
    }
} else {
    http_response_code(400);
    echo json_encode(array("message" => "Unable to create flight. Data is incomplete."));
}
?>
