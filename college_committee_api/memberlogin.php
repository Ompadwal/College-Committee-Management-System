<?php
require 'api/db.php';
session_start();

$message = "";
$messageType = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Fetch user data
    $stmt = $conn->prepare("SELECT id, password, is_approved FROM committee_members WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $hashed_password, $is_approved);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            if ($is_approved == 1) {
                $_SESSION['member_id'] = $id;
                header("Location: committeemanagement.php");
                exit();
            } else {
                $message = "Your account is pending approval. Please wait for admin confirmation.";
                $messageType = "warning";
            }
        } else {
            $message = "Invalid email or password!";
            $messageType = "error";
        }
    } else {
        $message = "User not found!";
        $messageType = "error";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Login</title>
    <style>
        :root {
            --primary-color: #2563eb;
            --primary-dark: #1d4ed8;
            --secondary-color: #475569;
            --light-color: #f8fafc;
            --danger-color: #ef4444;
            --warning-color: #f59e0b;
            --success-color: #10b981;
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
        
        .message.warning {
            background-color: #fef3c7;
            color: var(--warning-color);
            border: 1px solid #fde68a;
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
        
        .btn-secondary {
            background-color: transparent;
            color: var(--primary-color);
            border: 1px solid var(--primary-color);
            width: 100%;
            margin-top: 0.75rem;
            font-weight: 500;
        }
        
        .btn-secondary:hover {
            background-color: rgba(37, 99, 235, 0.05);
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
            <h1>Member Login</h1>
            <p>Sign in to access your committee dashboard</p>
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
            
            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" name="password" class="form-input" required>
                <button type="button" class="toggle-password" onclick="togglePassword()">
                    <svg viewBox="0 0 24 24">
                        <path d="M12 4.5C7.30558 4.5 3.375 7.42496 1.5 12C3.375 16.575 7.30556 19.5 12 19.5C16.6944 19.5 20.625 16.575 22.5 12C20.625 7.42496 16.6944 4.5 12 4.5ZM12 17.5C8.96243 17.5 6.5 15.0376 6.5 12C6.5 8.96243 8.96243 6.5 12 6.5C15.0376 6.5 17.5 8.96243 17.5 12C17.5 15.0376 15.0376 17.5 12 17.5ZM12 9.5C10.6193 9.5 9.5 10.6193 9.5 12C9.5 13.3807 10.6193 14.5 12 14.5C13.3807 14.5 14.5 13.3807 14.5 12C14.5 10.6193 13.3807 9.5 12 9.5Z"/>
                    </svg>
                </button>
            </div>
            
            <button type="submit" class="btn btn-primary">Sign In</button>
            <a href="memberregister.php" class="btn btn-secondary">Create Account</a>
        </form>
        
        <div class="footer">
            <p>Forgot your password? <a href="forgotpassword.php">Reset here</a></p>
            <p>Admin access? <a href="adminlogin.php">Login here</a></p>
        </div>
    </div>
    
    <!-- Back Button -->
    <a href="committees/mainpage.php" class="back-button">Back</a>

    <script>
        function togglePassword() {
            const passwordField = document.getElementById('password');
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