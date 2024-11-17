<?php
class Flight {
    private $conn;
    private $table_name = "Flights";

    public $flightID;
    public $flightNumber;
    public $origin;
    public $destination;
    public $date;
    public $time;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET flightNumber=:flightNumber, origin=:origin, destination=:destination, date=:date, time=:time";
        $stmt = $this->conn->prepare($query);

        $this->flightNumber = htmlspecialchars(strip_tags($this->flightNumber));
        $this->origin = htmlspecialchars(strip_tags($this->origin));
        $this->destination = htmlspecialchars(strip_tags($this->destination));
        $this->date = htmlspecialchars(strip_tags($this->date));
        $this->time = htmlspecialchars(strip_tags($this->time));

        $stmt->bindParam(":flightNumber", $this->flightNumber);
        $stmt->bindParam(":origin", $this->origin);
        $stmt->bindParam(":destination", $this->destination);
        $stmt->bindParam(":date", $this->date);
        $stmt->bindParam(":time", $this->time);

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
