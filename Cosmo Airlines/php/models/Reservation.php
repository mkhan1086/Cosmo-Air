<?php
class Reservation {
    private $conn;
    private $table_name = "Reservations";

    public $reservationID;
    public $userID;
    public $flightID;
    public $seatNumber;
    public $status;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET userID=:userID, flightID=:flightID, seatNumber=:seatNumber, status=:status";
        $stmt = $this->conn->prepare($query);

        $this->userID = htmlspecialchars(strip_tags($this->userID));
        $this->flightID = htmlspecialchars(strip_tags($this->flightID));
        $this->seatNumber = htmlspecialchars(strip_tags($this->seatNumber));
        $this->status = htmlspecialchars(strip_tags($this->status));

        $stmt->bindParam(":userID", $this->userID);
        $stmt->bindParam(":flightID", $this->flightID);
        $stmt->bindParam(":seatNumber", $this->seatNumber);
        $stmt->bindParam(":status", $this->status);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function read() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}
?>
