<?php
class db{
protected $connection;
function __construct() {
    $this->setConnection();
}

function setConnection() {
    try {
        $this->connection = new PDO("mysql:host=localhost;dbname=library_management", "root", "");
        echo "Connection established successfully";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        die();
    }
}
}