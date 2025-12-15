<?php
require 'api/db.php';

$message = '';
$messageType = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $hasError = false;
    
    // Name validation - only letters and no empty space
    $name = trim($_POST['name']);
    if (empty($name) || !preg_match('/^[a-zA-Z ]+$/', $name)) {
        $message = "Name should contain only letters and no empty spaces";
        $messageType = "error";
        $hasError = true;
    }
    
    // Email validation
    $email = trim($_POST['email']);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Please enter a valid email address";
        $messageType = "error";
        $hasError = true;
    } else {
        // Check if email already exists
        $emailCheck = $conn->prepare("SELECT id FROM committee_members WHERE email = ?");
        $emailCheck->bind_param("s", $email);
        $emailCheck->execute();
        $emailResult = $emailCheck->get_result();
        
        if ($emailResult->num_rows > 0) {
            $message = "This email is already registered. Please use a different email";
            $messageType = "error";
            $hasError = true;
        }
    }
    
    // Password validation
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    
    // Check password requirements (same as resetpassword.php)
    $length_valid = (strlen($password) >= 6 && strlen($password) <= 20);
    $has_number = preg_match('/[0-9]/', $password);
    $has_letter = preg_match('/[a-zA-Z]/', $password);
    $has_special = preg_match('/[!$@%]/', $password);
    
    if (!$length_valid || !$has_number || !$has_letter || !$has_special) {
        $message = "Create a Strong password<br>Your password must be at least 6 characters and should include a combination of numbers, letters and special characters(!$@%)";
        $messageType = "error";
        $hasError = true;
    } elseif ($password !== $confirm_password) {
        $message = "Passwords do not match";
        $messageType = "error";
        $hasError = true;
    }
    
    // Mobile number validation - 10 digits, only numbers, no spaces
    $mobile_no = trim($_POST['mobile_no']);
    if (!preg_match('/^[0-9]{10}$/', $mobile_no)) {
        $message = "Mobile number should be 10 digits with no spaces or special characters";
        $messageType = "error";
        $hasError = true;
    }
    
    // Committee ID validation
    $committee_id = trim($_POST['committee_id']);
    if (!is_numeric($committee_id)) {
        $message = "Committee ID should be a number";
        $messageType = "error";
        $hasError = true;
    } else {
        // Check if Committee ID is valid
        $committeeCheck = $conn->prepare("SELECT id FROM committees WHERE id = ?");
        $committeeCheck->bind_param("i", $committee_id);
        $committeeCheck->execute();
        $result = $committeeCheck->get_result();
        
        if ($result->num_rows == 0) {
            $message = "Invalid Committee ID!";
            $messageType = "error";
            $hasError = true;
        }
    }
    
    // If all validations pass, proceed with registration
    if (!$hasError) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        // Insert into committee_members table with default is_approved = 0
        $stmt = $conn->prepare("INSERT INTO committee_members (name, email, password, mobile_no, committee_id) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssi", $name, $email, $hashed_password, $mobile_no, $committee_id);
        
        if ($stmt->execute()) {
            $message = "Registration successful! Wait for admin approval.";
            $messageType = "success";
        } else {
            $message = "Error registering!";
            $messageType = "error";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Registration</title>
    <style>
        :root {
            --primary-color: #2563eb;
            --primary-dark: #1d4ed8;
            --secondary-color: #475569;
            --light-color: #f8fafc;
            --danger-color: #ef4444;
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
        
        .message.success {
            background-color: #d1fae5;
            color: var(--success-color);
            border: 1px solid #6ee7b7;
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
            <h1>Member Registration</h1>
            <p>Create an account to join the committee</p>
        </div>
        
        <?php if ($message): ?>
            <div class="message <?= $messageType ?>">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label for="name" class="form-label">Name</label>
                <input type="text" id="name" name="name" class="form-input" value="<?= isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '' ?>" required>
            </div>
            
            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" class="form-input" value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>" required>
            </div>
            
            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" name="password" class="form-input" required>
                <button type="button" class="toggle-password" onclick="togglePassword('password')">
                    <svg viewBox="0 0 24 24">
                        <path d="M12 4.5C7.30558 4.5 3.375 7.42496 1.5 12C3.375 16.575 7.30556 19.5 12 19.5C16.6944 19.5 20.625 16.575 22.5 12C20.625 7.42496 16.6944 4.5 12 4.5ZM12 17.5C8.96243 17.5 6.5 15.0376 6.5 12C6.5 8.96243 8.96243 6.5 12 6.5C15.0376 6.5 17.5 8.96243 17.5 12C17.5 15.0376 15.0376 17.5 12 17.5ZM12 9.5C10.6193 9.5 9.5 10.6193 9.5 12C9.5 13.3807 10.6193 14.5 12 14.5C13.3807 14.5 14.5 13.3807 14.5 12C14.5 10.6193 13.3807 9.5 12 9.5Z"/>
                    </svg>
                </button>
            </div>
            
            <div class="form-group">
                <label for="confirm_password" class="form-label">Confirm Password</label>
                <input type="password" id="confirm_password" name="confirm_password" class="form-input" required>
                <button type="button" class="toggle-password" onclick="togglePassword('confirm_password')">
                    <svg viewBox="0 0 24 24">
                        <path d="M12 4.5C7.30558 4.5 3.375 7.42496 1.5 12C3.375 16.575 7.30556 19.5 12 19.5C16.6944 19.5 20.625 16.575 22.5 12C20.625 7.42496 16.6944 4.5 12 4.5ZM12 17.5C8.96243 17.5 6.5 15.0376 6.5 12C6.5 8.96243 8.96243 6.5 12 6.5C15.0376 6.5 17.5 8.96243 17.5 12C17.5 15.0376 15.0376 17.5 12 17.5ZM12 9.5C10.6193 9.5 9.5 10.6193 9.5 12C9.5 13.3807 10.6193 14.5 12 14.5C13.3807 14.5 14.5 13.3807 14.5 12C14.5 10.6193 13.3807 9.5 12 9.5Z"/>
                    </svg>
                </button>
            </div>
            
            <div class="form-group">
                <label for="mobile_no" class="form-label">Mobile No</label>
                <input type="text" id="mobile_no" name="mobile_no" class="form-input" value="<?= isset($_POST['mobile_no']) ? htmlspecialchars($_POST['mobile_no']) : '' ?>" required>
            </div>
            
            <div class="form-group">
                <label for="committee_id" class="form-label">Committee ID</label>
                <input type="text" id="committee_id" name="committee_id" class="form-input" value="<?= isset($_POST['committee_id']) ? htmlspecialchars($_POST['committee_id']) : '' ?>" required>
            </div>
            
            <button type="submit" class="btn btn-primary">Register</button>
        </form>
        
        <div class="footer">
            <p>Already a member? <a href="memberlogin.php">Member login</a></p>
        </div>
    </div>
    
    <!-- Back Button -->
    <a href="memberlogin.php" class="back-button">Back</a>

    <script>
        function togglePassword(fieldId) {
            const passwordField = document.getElementById(fieldId);
            const passwordToggle = passwordField.nextElementSibling.querySelector('svg');
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