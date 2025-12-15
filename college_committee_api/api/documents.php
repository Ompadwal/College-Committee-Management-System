

<?php
header("Content-Type: application/json");
require 'db.php';

$method = $_SERVER['REQUEST_METHOD'];

if ($method == "GET") {
    if (isset($_GET['committee_id'])) {
        $committee_id = $_GET['committee_id'];
        $result = $conn->query("SELECT * FROM documents WHERE committee_id = $committee_id");
    } else {
        $result = $conn->query("SELECT * FROM documents");
    }
    $documents = [];
    while ($row = $result->fetch_assoc()) {
        $documents[] = $row;
    }
    echo json_encode($documents);
} elseif ($method == "POST") {
    if (!isset($_FILES['file']) || !isset($_POST['committee_id'])) {
        echo json_encode(["message" => "Invalid request"]);
        exit;
    }

    $committee_id = $_POST['committee_id'];
    $file = $_FILES['file'];
    $file_name = basename($file["name"]);
    $file_path = "uploads/" . $file_name;

    if (move_uploaded_file($file["tmp_name"], "../" . $file_path)) {
        if ($conn->query("INSERT INTO documents (committee_id, file_name, file_path) VALUES ($committee_id, '$file_name', '$file_path')")) {
            echo json_encode(["message" => "Document uploaded successfully"]);
        } else {
            echo json_encode(["message" => "Database error"]);
        }
    } else {
        echo json_encode(["message" => "File upload failed"]);
    }
} elseif ($method == "DELETE") {
    $data = json_decode(file_get_contents("php://input"), true);
    $id = $data['id'];

    $result = $conn->query("SELECT file_path FROM documents WHERE id = $id");
    if ($row = $result->fetch_assoc()) {
        unlink("../" . $row['file_path']);
    }

    if ($conn->query("DELETE FROM documents WHERE id = $id")) {
        echo json_encode(["message" => "Document deleted successfully"]);
    } else {
        echo json_encode(["message" => "Error deleting document"]);
    }
} else {
    echo json_encode(["message" => "Invalid Request"]);
}
?>







