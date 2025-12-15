<?php
// Include database connection
include 'api/db.php';

// Initialize variables
$formSubmitted = false;

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);
    
    // Insert data into database
    $sql = "INSERT INTO contact_messages (name, email, subject, message) VALUES ('$name', '$email', '$subject', '$message')";
    
    if (mysqli_query($conn, $sql)) {
        $formSubmitted = true;
    } else {
        $errorMsg = "Error: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us | Mulund College of Commerce</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
        }

        /* Contact Us Container */
        .container {
            width: 80%;
            margin: 50px auto;
            padding: 20px;
            background: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .container h2 {
            text-align: center;
            color: #004080; /* MCC's primary color */
            margin-bottom: 20px;
        }

        .contact-info {
            text-align: center;
            margin-bottom: 30px;
        }

        .contact-info p {
            margin: 5px 0;
            font-size: 16px;
            color: #555;
        }

        .contact-info a {
            color: #004080;
            text-decoration: none;
        }

        .contact-info a:hover {
            text-decoration: underline;
        }

        .contact-form {
            width: 60%;
            margin: auto;
        }

        .contact-form h3 {
            text-align: center;
            color: #004080;
            margin-bottom: 20px;
        }

        .contact-form input, .contact-form textarea {
            width: 100%;
            padding: 15px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        .contact-form button {
            width: 100%;
            padding: 15px;
            background: #004080; /* MCC's primary color */
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .contact-form button:hover {
            background: #003366; /* Darker shade for hover effect */
        }

        .error-message {
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            text-align: center;
        }


        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 300px;
            text-align: center;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .close-modal {
            width: 100%;
            padding: 10px;
            background: #004080;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 15px;
        }
        
        .close-modal:hover {
            background: #003366;
        }
    </style>
</head>
<body>
    <!-- Contact Us Container -->
    <div class="container">
        <h2>Contact Us</h2>
        <div class="contact-info">
            <p><strong>Mulund College of Commerce (Autonomous)</strong></p>
            <p>Address: Mulund Vanijya Mahavidyalaya Marg, Mulund (West), Mumbai, Maharashtra - 400080</p>
            <p>Phone: <a href="tel:+918097345311">+91 80973 45311</a></p>
            <p>Email: <a href="mailto:mccmulund@gmail.com">mccmulund@gmail.com</a></p>
        </div>

        <div class="contact-form">
            <h3>Send us a message</h3>
            
            <?php if (!empty($errorMsg)): ?>
                <div class="error-message"><?php echo $errorMsg; ?></div>
            <?php endif; ?>
            
            <form id="contactForm" method="POST">
                <input type="text" name="name" placeholder="Your Name" required>
                <input type="email" name="email" placeholder="Your Email" required>
                <input type="text" name="subject" placeholder="Subject" required>
                <textarea rows="5" name="message" placeholder="Your Message" required></textarea>
                <button type="submit">Send Message</button>
            </form>
        </div>
        
        <!-- <div class="admin-link">
            <a href="view_messages.php">Admin: View Messages</a>
        </div> -->
    </div>
    
    <!-- Success Modal -->
    <div id="successModal" class="modal">
        <div class="modal-content">
            <p>Message sent successfully!</p>
            <button class="close-modal" id="closeModal">OK</button>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('contactForm');
            const modal = document.getElementById('successModal');
            const closeBtn = document.getElementById('closeModal');
            
            <?php if ($formSubmitted): ?>
                // Show success modal if form was submitted successfully
                modal.style.display = "block";
            <?php endif; ?>
            
            // Close modal and redirect when OK button is clicked
            closeBtn.onclick = function() {
                modal.style.display = "none";
                window.location.href = 'contactus.php'; // Redirect to prevent form resubmission
            }
            
            // Close modal if user clicks outside of it
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                    window.location.href = 'contactus.php';
                }
            }
            
            // Optional: Add client-side validation if needed
            form.addEventListener('submit', function(event) {
                // You can add additional client-side validation here if needed
            });
        });
    </script>
</body>
</html>