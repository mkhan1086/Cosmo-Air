<?php
include_once '../config/database.php';
include_once '../models/Reservation.php';

$database = new Database();
$db = $database->getConnection();

$reservation = new Reservation($db);

$data = json_decode(file_get_contents("php://input"));

if(!empty($data->userID) && !empty($data->flightID) && !empty($data->seatNumber) && !empty($data->status)) {
    $reservation->userID = $data->userID;
    $reservation->flightID = $data->flightID;
    $reservation->seatNumber = $data->seatNumber;
    $reservation->status = $data->status;

    if($reservation->create()) {
        http_response_code(201);
        echo json_encode(array("message" => "Reservation was created."));
    } else {
        http_response_code(503);
        echo json_encode(array("message" => "Unable to create reservation."));
    }
} else {
    http_response_code(400);
    echo json_encode(array("message" => "Unable to create reservation. Data is incomplete."));
}
?>
