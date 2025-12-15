<?php
$host = "localhost";
$user = "root"; 
$pass = "root";
$port="3306"; 
$dbname = "college_committee_db";

$conn = new mysqli($host, $user, $pass, $dbname,$port);

if ($conn->connect_error) {
    die(json_encode(["error" => "Database Connection Failed: " . $conn->connect_error]));
}
?>
