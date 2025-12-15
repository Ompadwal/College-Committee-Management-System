<?php
require 'api/db.php';
session_start();

$message = "";
$messageType = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $admin_user = $_POST['admin_user'];
    $admin_pass = $_POST['admin_pass'];

    if ($admin_user == "admin" && $admin_pass == "admin123") {
        $_SESSION['admin_logged_in'] = true;
        header("Location: adminpanel.php");
        exit();
    } else {
        $message = "Invalid admin credentials!";
        $messageType = "error";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
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
            position: relative;
        }
        
        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--secondary-color);
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
        
        .lock-icon {
            text-align: center;
            margin-bottom: 1.5rem;
        }
        
        .lock-icon svg {
            width: 64px;
            height: 64px;
            color: var(--primary-color);
        }

        .toggle-password {
            position: absolute;
            top: 70%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
            background: none;
            border: none;
            outline: none;
        }

        .toggle-password svg {
            width: 24px;
            height: 24px;
            fill: var(--secondary-color);
        }

        .toggle-password:hover svg {
            fill: var(--primary-color);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="lock-icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
            </div>
            <h1>Admin Login</h1>
            <p>Sign in to access the admin dashboard</p>
        </div>

        <?php if ($message !== ""): ?>
            <div class="message <?= $messageType ?>">
                <?= $message ?>
            </div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label for="admin_user" class="form-label">Admin Username</label>
                <input type="text" id="admin_user" name="admin_user" class="form-input" required>
            </div>
            
            <div class="form-group">
                <label for="admin_pass" class="form-label">Password</label>
                <input type="password" id="admin_pass" name="admin_pass" class="form-input" required>
                <button type="button" class="toggle-password" onclick="togglePassword()">
                    <svg viewBox="0 0 24 24">
                        <path d="M12 4.5C7.30558 4.5 3.375 7.42496 1.5 12C3.375 16.575 7.30556 19.5 12 19.5C16.6944 19.5 20.625 16.575 22.5 12C20.625 7.42496 16.6944 4.5 12 4.5ZM12 17.5C8.96243 17.5 6.5 15.0376 6.5 12C6.5 8.96243 8.96243 6.5 12 6.5C15.0376 6.5 17.5 8.96243 17.5 12C17.5 15.0376 15.0376 17.5 12 17.5ZM12 9.5C10.6193 9.5 9.5 10.6193 9.5 12C9.5 13.3807 10.6193 14.5 12 14.5C13.3807 14.5 14.5 13.3807 14.5 12C14.5 10.6193 13.3807 9.5 12 9.5Z"/>
                    </svg>
                </button>
            </div>
            
            <button type="submit" class="btn btn-primary">Sign In</button>
        </form>
        
        <div class="footer">
            <p>Not an admin? <a href="memberlogin.php">Member login</a></p>
        </div>
    </div>
    
    <!-- Back Button -->
    <a href="memberlogin.php" class="back-button">Back</a>

    <script>
        function togglePassword() {
            const passwordField = document.getElementById('admin_pass');
            const passwordToggle = document.querySelector('.toggle-password svg');
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                passwordToggle.innerHTML = '<path d="M12 4.5C7.30558 4.5 3.375 7.42496 1.5 12C3.375 16.575 7.30556 19.5 12 19.5C16.6944 19.5 20.625 16.575 22.5 12C20.625 7.42496 16.6944 4.5 12 4.5ZM12 17.5C8.96243 17.5 6.5 15.0376 6.5 12C6.5 8.96243 8.96243 6.5 12 6.5C15.0376 6.5 17.5 8.96243 17.5 12C17.5 15.0376 15.0376 17.5 12 17.5ZM12 9.5C10.6193 9.5 9.5 10.6193 9.5 12C9.5 13.3807 10.6193 14.5 12 14.5C13.3807 14.5 14.5 13.3807 14.5 12C14.5 10.6193 13.3807 9.5 12 9.5Z"/>';
            } else {
                passwordField.type = 'password';
                passwordToggle.innerHTML = '<path d="M12 4.5C7.30558 4.5 3.375 7.42496 1.5 12C3.375 16.575 7.30556 19.5 12 19.5C16.6944 19.5 20.625 16.575 22.5 12C20.625 7.42496 16.6944 4.5 12 4.5ZM12 17.5C8.96243 17.5 6.5 15.0376 6.5 12C6.5 8.96243 8.96243 6.5 12 6.5C15.0376 6.5 17.5 8.96243 17.5 12C17.5 15.0376 15.0376 17.5 12 17.5ZM12 9.5C10.6193 9.5 9.5 10.6193 9.5 12C9.5 13.3807 10.6193 14.5 12 14.5C13.3807 14.5 14.5 13.3807 14.5 12C14.5 10.6193 13.3807 9.5 12 9.5Z"/>';
            }
        }
    </script>
</body>
</html>