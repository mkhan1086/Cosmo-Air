<?php
class Payment {
    private $conn;
    private $table_name = "Payments";

    public $paymentID;
    public $reservationID;
    public $amount;
    public $paymentMethod;
    public $status;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET reservationID=:reservationID, amount=:amount, paymentMethod=:paymentMethod, status=:status";
        $stmt = $this->conn->prepare($query);

        $this->reservationID = htmlspecialchars(strip_tags($this->reservationID));
        $this->amount = htmlspecialchars(strip_tags($this->amount));
        $this->paymentMethod = htmlspecialchars(strip_tags($this->paymentMethod));
        $this->status = htmlspecialchars(strip_tags($this->status));

        $stmt->bindParam(":reservationID", $this->reservationID);
        $stmt->bindParam(":amount", $this->amount);
        $stmt->bindParam(":payment