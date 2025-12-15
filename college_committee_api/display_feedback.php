<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Data - Mulund College of Commerce</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
            color: #333;
        }

        h2 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        table, th, td {
            border: 1px solid #ccc;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f5f5f5;
        }

        .delete-btn {
            background-color: #ff0000;
            color: #fff;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 4px;
        }

        .delete-btn:hover {
            background-color: #cc0000;
        }
    </style>
</head>
<body>

<?php
// Handle delete functionality from delete_feedback.php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    include 'api/db.php';

    $id = $_POST['id'];

    $stmt = $conn->prepare("DELETE FROM feedback WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "<script>alert('Feedback deleted successfully!');</script>";
    } else {
        echo "<script>alert('An error occurred while deleting the feedback. Please try again.');</script>";
    }

    $stmt->close();
    $conn->close();
}
?>

<h2>Feedback Data</h2>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Category</th>
            <th>Message</th>
            <th>Email</th>
            <th>Created At</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        include 'api/db.php';

        $result = $conn->query("SELECT * FROM feedback");

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['category']}</td>
                        <td>{$row['message']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['created_at']}</td>
                        <td><button class='delete-btn' onclick='deleteFeedback({$row['id']})'>Delete</button></td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No feedback found</td></tr>";
        }

        $conn->close();
        ?>
    </tbody>
</table>

<script>
    function deleteFeedback(id) {
        if (confirm('Are you sure you want to delete this feedback?')) {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'display_feedback.php', true); // Now pointing to the same file
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function() {
                if (xhr.status === 200) {
                    location.reload(); // Reload the page to reflect deletion
                } else {
                    alert('An error occurred while deleting the feedback. Please try again.');
                }
            };

            xhr.send('id=' + id);
        }
    }
</script>

</body>
</html>