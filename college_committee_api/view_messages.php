<?php
// Start session to store messages temporarily
session_start();

// Include database connection
include 'api/db.php';

// Handle delete action
if (isset($_GET['delete'])) {
    $id = mysqli_real_escape_string($conn, $_GET['delete']);
    $delete_sql = "DELETE FROM contact_messages WHERE id = $id";
    
    if (mysqli_query($conn, $delete_sql)) {
        // Store success message in session
        $_SESSION['deleteMsg'] = "Message deleted successfully!";
    } else {
        $_SESSION['deleteErrorMsg'] = "Error deleting message: " . mysqli_error($conn);
    }
    
    // Redirect to clean URL to prevent resubmission on refresh
    header("Location: view_messages.php");
    exit();
}

// Get messages from session and clear them
$deleteMsg = "";
$deleteErrorMsg = "";

if (isset($_SESSION['deleteMsg'])) {
    $deleteMsg = $_SESSION['deleteMsg'];
    unset($_SESSION['deleteMsg']);
}

if (isset($_SESSION['deleteErrorMsg'])) {
    $deleteErrorMsg = $_SESSION['deleteErrorMsg'];
    unset($_SESSION['deleteErrorMsg']);
}

// Fetch all messages from database
$sql = "SELECT * FROM contact_messages ORDER BY submission_date DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Messages | Mulund College of Commerce</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
        }

        .container {
            width: 90%;
            margin: 50px auto;
            padding: 20px;
            background: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        h2 {
            text-align: center;
            color: #004080;
            margin-bottom: 20px;
        }

        .message-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .message-table th, .message-table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .message-table th {
            background-color: #004080;
            color: white;
        }

        .message-table tr:hover {
            background-color: #f5f5f5;
        }

        .delete-btn {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .delete-btn:hover {
            background-color: #c82333;
        }

        .back-link {
            display: inline-block;
            margin-bottom: 20px;
            color: #004080;
            text-decoration: none;
        }

        .back-link:hover {
            text-decoration: underline;
        }

        .error-message {
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            text-align: center;
        }

        .no-messages {
            text-align: center;
            color: #666;
            padding: 20px;
        }

        /* Popup Dialog Styles */
        .popup-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
        }

        .popup-dialog {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            z-index: 1001;
            text-align: center;
            min-width: 300px;
        }

        .popup-message {
            color: #155724;
            margin-bottom: 20px;
            font-size: 16px;
        }

        .popup-button {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }

        .popup-button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="contactus.php" class="back-link">← Back to Contact Form</a>
        <h2>Contact Form Submissions</h2>
        
        <?php if (isset($deleteErrorMsg) && $deleteErrorMsg != ""): ?>
            <div class="error-message"><?php echo $deleteErrorMsg; ?></div>
        <?php endif; ?>
        
        <?php if (mysqli_num_rows($result) > 0): ?>
            <table class="message-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Subject</th>
                        <th>Message</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                            <td><?php echo htmlspecialchars($row['email']); ?></td>
                            <td><?php echo htmlspecialchars($row['subject']); ?></td>
                            <td><?php echo htmlspecialchars($row['message']); ?></td>
                            <td><?php echo date('M d, Y H:i', strtotime($row['submission_date'])); ?></td>
                            <td>
                                <a href="javascript:void(0);" 
                                   onclick="confirmDelete(<?php echo $row['id']; ?>);" 
                                   class="delete-btn">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="no-messages">No messages found.</div>
        <?php endif; ?>
    </div>

    <!-- Popup Dialog -->
    <div class="popup-overlay" id="popupOverlay"></div>
    <div class="popup-dialog" id="popupDialog">
        <div class="popup-message" id="popupMessage"></div>
        <button class="popup-button" onclick="closePopup()">OK</button>
    </div>

    <script>
        // Show popup with message
        function showPopup(message) {
            document.getElementById('popupMessage').innerText = message;
            document.getElementById('popupOverlay').style.display = 'block';
            document.getElementById('popupDialog').style.display = 'block';
        }
        
        // Close popup
        function closePopup() {
            document.getElementById('popupOverlay').style.display = 'none';
            document.getElementById('popupDialog').style.display = 'none';
        }
        
        // Confirm delete
        function confirmDelete(id) {
            if (confirm('Are you sure you want to delete this message?')) {
                window.location.href = 'view_messages.php?delete=' + id;
            }
        }
        
        <?php if (isset($deleteMsg) && $deleteMsg != ""): ?>
            // Show success message in popup when page loads
            window.onload = function() {
                showPopup("<?php echo $deleteMsg; ?>");
            };
        <?php endif; ?>
    </script>
</body>
</html>