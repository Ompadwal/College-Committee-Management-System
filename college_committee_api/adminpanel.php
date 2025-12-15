<?php
require 'api/db.php';
session_start();

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: adminlogin.php");
    exit();
}

// Approve Member
if (isset($_POST['approve'])) {
    $member_id = $_POST['member_id'];
    $conn->query("UPDATE committee_members SET is_approved = 1 WHERE id = $member_id");
}

// Fetch Pending Members
$result = $conn->query("SELECT * FROM committee_members WHERE is_approved = 0");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <style>
        :root {
            --primary-color: #2563eb;
            --primary-dark: #1d4ed8;
            --secondary-color: #475569;
            --light-color: #f8fafc;
            --danger-color: #ef4444;
            --border-radius: 6px;
            --box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: #f1f5f9;
            color: #1e293b;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        
        .container {
            width: 100%;
            max-width: 800px;
            padding: 2rem;
            background-color: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
        }
        
        .header {
            text-align: center;
            margin-bottom: 2rem;
        }
        
        .header h1 {
            color: var(--primary-color);
            font-size: 1.8rem;
            margin-bottom: 0.5rem;
        }
        
        .header p {
            color: var(--secondary-color);
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 1.5rem;
        }
        
        th, td {
            padding: 0.75rem;
            border: 1px solid #cbd5e1;
            text-align: left;
        }
        
        th {
            background-color: var(--primary-color);
            color: white;
        }
        
        td {
            background-color: var(--light-color);
        }
        
        .btn {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: var(--border-radius);
            font-size: 1rem;
            cursor: pointer;
            text-align: center;
            transition: background-color 0.2s ease, transform 0.1s ease;
        }
        
        .btn:hover {
            transform: translateY(-1px);
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            color: white;
            font-weight: 500;
        }
        
        .btn-primary:hover {
            background-color: var(--primary-dark);
        }
        
        /* Floating back button styles */
        .back-button {
            position: fixed;
            top: 20px;
            left: 20px;
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 16px;
            font-weight: bold;
            display: flex;
            align-items: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }

        .back-button:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }

        /* Arrow icon */
        .back-button::before {
            content: "←";
            margin-right: 8px;
            font-size: 18px;
        }
        
        .footer {
            margin-top: 1.5rem;
            text-align: center;
            color: var(--secondary-color);
            font-size: 1.3rem;
        }
        
        .footer a {
            color: var(--primary-color);
            text-decoration: none;
        }
        
        .footer a:hover {
            text-decoration: underline;
        }
        
        .icon {
            text-align: center;
            margin-bottom: 1.5rem;
        }
        
        .icon svg {
            width: 64px;
            height: 64px;
            color: var(--primary-color);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 10-8 0v4H5a2 2 0 00-2 2v6a2 2 0 002 2h14a2 2 0 002-2v-6a2 2 0 00-2-2h-3V7z" />
                </svg>
            </div>
            <h1>Admin Panel</h1>
            <p>Manage pending member approvals</p>
        </div>

        <h2>Pending Member Approvals</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Committee ID</th>
                <th>Approve</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['name'] ?></td>
                    <td><?= $row['email'] ?></td>
                    <td><?= $row['mobile_no'] ?></td>
                    <td><?= $row['committee_id'] ?></td>
                    <td>
                        <form method="POST">
                            <input type="hidden" name="member_id" value="<?= $row['id'] ?>">
                            <button type="submit" name="approve" class="btn btn-primary">Approve</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </table>

        <div class="footer">
            <p><a href="logout.php">Logout</a></p>
        </div>
    </div>
    
    <!-- Back Button -->
    <a href="memberlogin.php" class="back-button">Back</a>


</body>
</html>