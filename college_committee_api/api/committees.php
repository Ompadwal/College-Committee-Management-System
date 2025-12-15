<?php
header("Content-Type: application/json");
require 'db.php';

$method = $_SERVER['REQUEST_METHOD'];

if ($method == "GET") {
    $result = $conn->query("SELECT * FROM committees");
    $committees = [];
    while ($row = $result->fetch_assoc()) {
        $committees[] = $row;
    }
    echo json_encode($committees);
} elseif ($method == "POST") {
    $data = json_decode(file_get_contents("php://input"), true);
    $name = $data['name'];

    if ($conn->query("INSERT INTO committees (name) VALUES ('$name')")) {
        echo json_encode(["message" => "Committee added successfully"]);
    } else {
        echo json_encode(["message" => "Error adding committee"]);
    }
} elseif ($method == "PUT") {
    $data = json_decode(file_get_contents("php://input"), true);
    $id = $data['id'];
    $name = $data['name'];

    if ($conn->query("UPDATE committees SET name='$name' WHERE id=$id")) {
        echo json_encode(["message" => "Committee updated successfully"]);
    } else {
        echo json_encode(["message" => "Error updating committee"]);
    }
} elseif ($method == "DELETE") {
    $data = json_decode(file_get_contents("php://input"), true);
    $id = $data['id'];

    if ($conn->query("DELETE FROM committees WHERE id=$id")) {
        echo json_encode(["message" => "Committee deleted successfully"]);
    } else {
        echo json_encode(["message" => "Error deleting committee"]);
    }
} else {
    echo json_encode(["message" => "Invalid Request"]);
}
?>
