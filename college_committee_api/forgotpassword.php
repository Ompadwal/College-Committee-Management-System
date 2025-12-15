<?php
require 'api/db.php';
session_start();  // Ensure session is started

$message = "";
$messageType = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    // Check if email exists and is approved
    $stmt = $conn->prepare("SELECT id FROM committee_members WHERE email = ? AND is_approved = 1");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Email found and is approved
        $_SESSION['reset_email'] = $email;  // Set session variable
        header("Location: resetpassword.php");
        exit();
    } else {
        $message = "Email not found or not approved!";
        $messageType = "error";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
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
            max-width: 420px;
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
        
        .message {
            padding: 0.75rem;
            margin-bottom: 1.5rem;
            border-radius: var(--border-radius);
            text-align: center;
        }
        
        .message.error {
            background-color: #fee2e2;
            color: var(--danger-color);
            border: 1px solid #fecaca;
        }
        
        .form-group {
            margin-bottom: 1.25rem;
        }
        
        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var (--secondary-color);
        }
        
        .form-input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #cbd5e1;
            border-radius: var(--border-radius);
            font-size: 1rem;
            transition: border-color 0.2s ease;
        }
        
        .form-input:focus {
            outline: none;
            border-color: var(--primary-color);
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
            width: 100%;
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
            font-size: 0.9rem;
        }
        
        .footer a {
            color: var(--primary-color);
            text-decoration: none;
        }
        
        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Forgot Password</h1>
            <p>Enter your email to reset your password</p>
        </div>

        <?php if ($message !== ""): ?>
            <div class="message <?= $messageType ?>">
                <?= $message ?>
            </div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" id="email" name="email" class="form-input" required>
            </div>
            
            <button type="submit" class="btn btn-primary">Reset Password</button>
        </form>
        
        <div class="footer">
            <p>Remember your password? <a href="memberlogin.php">Sign in here</a></p>
        </div>
    </div>
    
    <!-- Back Button -->
    <a href="memberlogin.php" class="back-button">Back</a>

</body>
</html>