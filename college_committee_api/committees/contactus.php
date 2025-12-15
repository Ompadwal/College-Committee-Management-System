<?php
// Include database connection
include '../api/db.php';

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
    <title>About Us - College Committee</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
        }

        /* Top Banners */
        .top-banner1 {
            background-color: #811313;
            color: white;
            text-align: center;
            padding: 0;
            font-size: 14px;
        }

        .top-banner2 {
            background-color: #ad1212;
            color: white;
            text-align: center;
            padding: 2px 0;
            font-size: 14px;
        }

        /* Header Section */
        header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: white;
            padding: 10px 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        header .logo img {
            width: 60px;
            margin: 0 0 0 215px;
        }

        header .college-name h1 {
            font-size: 18px;
            margin: 0 566px 0 0; 
            color: #333;
        }

        header .college-name p {
            font-size: 13px;
            margin: 0;
            color: #333;
        }

        .admission-button button {
            background-color: #a40000;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
            position: relative;
            left: -200px;
        }

        .admission-button button:hover {
            background-color: #800000;
        }

        /* Navigation Bar Styles */
        .navbar {
            background-color: #f9f9f9;
            padding: 10px 0;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar ul {
            display: inline-block;
            justify-content: center;
            list-style: none;
            padding: 0;
            margin: 0 100px 0 250px;
            background-color: #f9f9f9;
        }

        .navbar ul li {
            display: inline-block;
            text-align: center;
            padding: 14px 16px;
            font-size: 14px;
            text-decoration: none;
            color: #111;
            cursor: pointer;
            background-color: white;
        }

        .navbar ul li:hover {
            background-color: #e1cbcb;
        }

        .navbar ul li a, .dropbtn {
            display: inline-block;
            color: black;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        .navbar ul li a:hover, .dropdown:hover .dropbtn {
            background-color: white;
        }

        .navbar ul li.dropdown {
            display: inline-block;
        }

        .navbar ul .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .navbar ul .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            text-align: left;
        }

        .navbar ul .dropdown-content a:hover {
            background-color: #f1f1f1;
        }

        .navbar ul .dropdown:hover .dropdown-content {
            display: block;
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

        .map {
            text-align: center;
            margin: 30px 0;
        }

        .map h3 {
            color: #004080;
            margin-bottom: 20px;
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




        

.feedback-button {
    position: fixed;
    right: 0;
    top: 50%;
    transform: translateY(-50%) rotate(180deg);
    background-color:rgb(13, 102, 235); /* Dark Red */
    color: white;
    padding: 10px 15px;
    font-size: 16px;
    font-weight: bold;
    border: none;
    border-radius: 5px 0 0 5px;
    cursor: pointer;
    writing-mode: vertical-rl; /* Makes the text vertical */
    text-align: center;
    text-decoration: none;
}

.feedback-button:hover {
    background-color:rgb(13, 4, 114);
}




/* Feedback Modal */
.feedback-modal {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 350px;
            background-color: #fff;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            padding: 20px;
            z-index: 1001;
        }

        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1000;
        }

        .feedback-modal h2 {
            text-align: center;
            margin-bottom: 15px;
        }

        .form-group {
            margin-bottom: 10px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-group select,
        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form-group textarea {
            height: 80px;
            resize: none;
        }

        .submit-btn {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            border: none;
            border-radius: 4px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }

        .submit-btn:hover {
            background-color: #0056b3;
        }

        .close-btn {
            position: absolute;
            top: 10px;
            right: 15px;
            font-size: 20px;
            cursor: pointer;
            color: #555;
        }

        .close-btn:hover{
            color: red;
        }

        
.login-button {
    position: fixed;
    right: 0;
    top: 67%;
    transform: translateY(-50%) rotate(180deg);
    background-color: rgb(13, 102, 235); /* Dark Red */
    color: white;
    padding: 10px 15px;
    font-size: 16px;
    font-weight: bold;
    border: none;
    border-radius: 5px 0 0 5px;
    cursor: pointer;
    writing-mode: vertical-rl; /* Makes the text vertical */
    text-align: center;
    text-decoration: none;
}

.login-button:hover {
    background-color: rgb(13, 4, 114);
}


        /* Floating back button styles */
        .back-button {
            position: fixed;
            top: 94px;
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

        /* Footer Section */
        footer {
            background-color: #900;
            color: white;
            padding: 30px 10%;
        }

        footer .footer-container {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        footer .column {
            flex: 1;
            min-width: 200px;
            margin: 10px;
        }

        footer h3 {
            border-bottom: 2px solid white;
            padding-bottom: 5px;
            margin-bottom: 10px;
            font-size: 1.2rem;
            color: white; /* Added: Making all footer h3 elements white */
        }

        footer p, footer ul {
            font-size: 0.9rem;
            line-height: 1.6;
        }

        footer ul {
            list-style: none;
            padding: 0;
        }

        footer ul li {
            margin-bottom: 5px;
        }

        footer ul li a {
            color: white;
            text-decoration: none;
        }

        footer ul li a:hover {
            text-decoration: underline;
        }

        footer .contact-info p {
            margin: 5px 0;
            color: white;
            text-align: left;
        }

        /* Footer Bottom Section */
        .footer-bottom {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid #700;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    
<!--Top Banner-->
<div class="top-banner1">
    <marquee><p>Mulund College has been conferred with Autonomous Status from academic year 2021-22, NEP implemented from 2023-24</p></marquee>
</div>
<div class="top-banner2">
    <p>Call Us! 8097345311/8097876255/9082101135/9082164576 | Email: mccmulund@gmail.com</p>
</div>

<!--Header Section--> 
<header>
    <div class="logo">
        <img src="../images/MCClogo.png" alt="College Logo">
    </div>
    <div class="college-name">
        <p>Parle Tilak Vidyalaya Association's</p>
        <h1>MULUND COLLEGE OF COMMERCE (AUTONOMOUS)</h1>
        <p>NAAC "A" GRADE RE-ACCREDITED (III Cycle) 2016 – 2026</p>
    </div>
    <div class="admission-button">
        <button id="admission_button">ADMISSION PORTAL</button>
    </div>
</header>

<!--Sticky Navigation Bar--> 
<nav class="navbar">
        <ul>
            <li><a href="mainpage.php">Home</a></li>
            <li><a href="../committees/aboutus.php">About Us</a></li>
            <!--<li>Departments</li>-->
            <li><a href="../committees/disp_members.php">Committee Members</a></li>
            <li><a href="../index.php">Committees</a></li>
            <li><a href="contactus.php">Contact Us</a></li>

            <!--
            <li class="dropdown">
                <a href="index.php" class="dropbtn">Committees</a>  //javascript:void(0)
            </li>-->
        </ul>
    </nav>

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

    

    <div class="map">
        <h3>Find Us Here</h3>
        <iframe 
            src="https://maps.google.com/maps?q=Mulund%20College%20of%20Commerce&t=&z=13&ie=UTF8&iwloc=&output=embed"
            width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy">
        </iframe>
    </div>
</div>




    <!-- Back Button -->
    <a href="../mainpage.php" class="back-button">Back</a>

    


<!-- Feedback Button -->
<button class="feedback-button" onclick="openFeedback()">Feedback</button>

<!-- Member Login Button -->
<button class="login-button" onclick="openLogin()">Member Login</button>


<!-- Feedback Modal -->
<div class="modal-overlay" onclick="closeFeedback()"></div>
<div class="feedback-modal">
    <span class="close-btn" onclick="closeFeedback()">
    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <line x1="18" y1="6" x2="6" y2="18"></line>
        <line x1="6" y1="6" x2="18" y2="18"></line>
    </svg>



    </span>
    <h2>Feedback Form</h2>
    <form id="feedbackForm">
        <div class="form-group">
            <label for="category">Feedback Category</label>
            <select id="category" name="category" required>
                <option value="User Experience">User Experience</option>
                <option value="Design & Layout">Design & Layout</option>
                <option value="Compliment & Appreciation">Compliment & Appreciation</option>
                <option value="Technical Issues">Technical Issues</option>
                <option value="Suggestions For Improvement">Suggestions For Improvement</option>
                <option value="Other">Other</option>
            </select>
            <input type="text" id="otherCategory" name="otherCategory" class="other-category" placeholder="Please specify" style="display:none;">
        </div>
        <div class="form-group">
            <label for="message">Message</label>
            <textarea id="message" name="message" required></textarea>
        </div>
        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" required>
        </div>
        <button type="submit" class="submit-btn">Send Feedback</button>
    </form>
</div>









<!-- Footer Section -->
<footer>
    <div class="footer-container">
        <!-- Contact Information -->
        <div class="column contact-info">
            <h3>GET IN TOUCH WITH US!</h3>
            <p>
                Mulund Vanijya Mahavidyalaya Marg<br>
                Mulund West, Mumbai 400080
            </p>
            <p>Phone: 8097345311 / 8097876255 / 9082101135 / 9082164576</p>
            <p>Email: Mccmulund@Gmail.Com</p>
        </div>

        <!-- Useful Links -->
        <div class="column useful-links">
            <h3>USEFUL LINKS</h3>
            <ul>
                <li><a href="../footerparts/principal.php">From The Principal's Desk</a></li>
                <li><a href="https://mccmulund.ac.in/newweb/library/">Library</a></li>
                <li><a href="../footerparts/admission.php">Admission Guidelines</a></li>
                <li><a href="../footerparts/management.php">About Management</a></li>
                <li><a href="../footerparts/location.php">Location</a></li>
            </ul>
        </div>

        <!-- Recent News -->
        <div class="column recent-news">
            <h3>RECENT NEWS</h3>
            <ul>
                <li>FYBCom Sem 1 NEP Results January 2024</li>
                <li>PHOTOCOPY / REVALUATION B.COM/BCAF/BCBI/BCFM/BMS/BAMMC/BBA/M.COM</li>
                <li>PHOTOCOPY / REVALUATION B.SC.CS, BSCIT, BCA, BSC DS & MSC FINANCE</li>
                <li>REVALUATION & PHOTOCOPY-M.COM SEM-1 (NEP STUDENTS) 2023-24</li>
            </ul>
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; 2024 MCC (MULUND COLLEGE OF COMMERCE)</p>
    </div>
</footer>
<script>
    document.getElementById("admission_button").addEventListener("click",function () {
            window.location.href="https://enrollonline.co.in/Registration/Apply/MCC"
        });




        function openFeedback() {
            document.querySelector('.modal-overlay').style.display = 'block';
            document.querySelector('.feedback-modal').style.display = 'block';
        }

        function closeFeedback() {
            document.querySelector('.modal-overlay').style.display = 'none';
            document.querySelector('.feedback-modal').style.display = 'none';
        }
        
        // Function to navigate to member login page
        function openLogin() {
            window.location.href = "../memberlogin.php";
        }

        document.getElementById('category').addEventListener('change', function() {
            var otherCategory = document.getElementById('otherCategory');
            if (this.value === 'Other') {
                otherCategory.style.display = 'block';
                otherCategory.required = true;
            } else {
                otherCategory.style.display = 'none';
                otherCategory.required = false;
            }
        });

        document.getElementById('feedbackForm').addEventListener('submit', function(event) {
        var form = this;
        event.preventDefault();

        var xhr = new XMLHttpRequest();
        xhr.open('POST', form.action, true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onload = function() {
            if (xhr.status === 200) {
                alert('Feedback submitted successfully!');
                form.reset();
                closeFeedback();
            } else {
                alert('An error occurred while submitting your feedback. Please try again.');
            }
        };

        var formData = new FormData(form);
        var encodedData = new URLSearchParams(formData).toString();
        xhr.send(encodedData);
    });
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

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '../api/db.php';

    $category = $_POST['category'];
    if ($category == 'Other') {
        $category = $_POST['otherCategory'];
    }
    $message = $_POST['message'];
    $email = $_POST['email'];

    $stmt = $conn->prepare("INSERT INTO feedback (category, message, email) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $category, $message, $email);

    if ($stmt->execute()) {
        echo "<script>alert('Feedback submitted successfully!');</script>";
    } else {
        echo "<script>alert('An error occurred while submitting your feedback. Please try again.');</script>";
    }

    $stmt->close();
    $conn->close();
}
?>

</body>
</html>