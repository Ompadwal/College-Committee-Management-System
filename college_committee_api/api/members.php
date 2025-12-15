<?php
header("Content-Type: application/json");
require 'db.php';

$method = $_SERVER['REQUEST_METHOD'];

if ($method == "GET") {
    $stmt = $conn->prepare("SELECT * FROM members WHERE committee_id = ?");
    if (isset($_GET['committee_id'])) {
        $stmt->bind_param("i", $_GET['committee_id']);
    } else {
        $stmt = $conn->prepare("SELECT * FROM members");
    }
    $stmt->execute();
    $result = $stmt->get_result();
    $members = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode($members);
}

elseif ($method == "POST") {
    $data = json_decode(file_get_contents("php://input"), true);
    if (!isset($data['committee_id'], $data['member_name'], $data['designation'])) {
        echo json_encode(["message" => "Invalid request"]);
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO members (committee_id, member_name, designation) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $data['committee_id'], $data['member_name'], $data['designation']);
    
    if ($stmt->execute()) {
        echo json_encode(["message" => "Member added successfully"]);
    } else {
        echo json_encode(["message" => "Database error"]);
    }
}

elseif ($method == "PUT") {
    $data = json_decode(file_get_contents("php://input"), true);
    if (!isset($data['id'], $data['member_name'], $data['designation'])) {
        echo json_encode(["message" => "Invalid request"]);
        exit;
    }

    $stmt = $conn->prepare("UPDATE members SET member_name = ?, designation = ? WHERE id = ?");
    $stmt->bind_param("ssi", $data['member_name'], $data['designation'], $data['id']);
    
    if ($stmt->execute()) {
        echo json_encode(["message" => "Member updated successfully"]);
    } else {
        echo json_encode(["message" => "Database error"]);
    }
}

elseif ($method == "DELETE") {
    $data = json_decode(file_get_contents("php://input"), true);
    if (!isset($data['id'])) {
        echo json_encode(["message" => "Invalid request"]);
        exit;
    }

    $stmt = $conn->prepare("DELETE FROM members WHERE id = ?");
    $stmt->bind_param("i", $data['id']);

    if ($stmt->execute()) {
        echo json_encode(["message" => "Member deleted successfully"]);
    } else {
        echo json_encode(["message" => "Error deleting member"]);
    }
}

else {
    echo json_encode(["message" => "Invalid Request"]);
}
?>