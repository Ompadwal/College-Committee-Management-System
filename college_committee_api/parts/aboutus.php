<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us | Mulund College of Commerce</title>
    <style>
        /* General Reset */
        /* * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        } */

        /* Body Styling */
        body {
            margin: 0;
    font-family: Arial, sans-serif;
        }




        .top-banner1 {
    background-color: #811313;
    color: white;
    text-align: center;
    padding: 0px 0px;
    font-size: 14px;
}

.top-banner2 {
    background-color: #ad1212;
    color: white;
    text-align: center;
    padding: 2px 0;
    font-size: 14px;
}

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
    margin: 0px 0px 0px 215px;
}

header .college-name h1 {
    font-size: 18px;
    margin: 0px 566px 0px 0px; 
    color: #333;
}

header .college-name p {
    font-size: 13px;
    margin: 0px 0px 0px 0px;
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

/* Navigation Bar Styles - Updated for sticky effect */
.navbar {
    background-color: #f9f9f9;
    padding: 10px 0;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
    /* Sticky positioning properties */
    position: sticky;
    top: 0;
    z-index: 1000;
}

.navbar ul {
    display: inline-block;
    justify-content: center;
    list-style: none;
    padding: 0;
    margin: 0px 100px 0px 250px;
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















        /* Header */
        .heading {
            background-color: #900;
            color: white;
            padding: 20px;
            text-align: center;
            font-size: 28px;
            font-weight: bold;
        }

        /* Main Container */
        .container {
            width: 80%;
            margin: 40px auto;
            background: white;
            padding: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        /* Section Styling */
        .section {
            margin-bottom: 30px;
        }

        .section h2 {
            color: #002147;
            border-bottom: 3px solid #ffc107;
            display: inline-block;
            padding-bottom: 5px;
            margin-bottom: 15px;
        }

        /* Vision, Mission, Objectives Sections */
        .vision, .mission, .objectives {
            background-color: #e3f2fd;
            padding: 20px;
            border-left: 5px solid #002147;
            margin-bottom: 20px;
            border-radius: 5px;
        }

        .vision h2, .mission h2, .objectives h2 {
            color: #002147;
            border-bottom: 2px solid #ffc107;
            padding-bottom: 5px;
            margin-bottom: 10px;
        }

        /* List Styling */
        .objectives ul {
            list-style: none;
            padding-left: 20px;
        }

        .objectives ul li {
            position: relative;
            padding-left: 30px;
            margin-bottom: 10px;
            font-size: 18px;
        }

        .objectives ul li::before {
            content: "✔";
            position: absolute;
            left: 0;
            color: #28a745;
            font-weight: bold;
        }

        /* Footer */
        /* .foot {
            text-align: center;
            background-color: #002147;
            color: white;
            padding: 15px;
            font-size: 14px;
            margin-top: 40px;
        } */






        


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
}

/* Footer Bottom Section */
.footer-bottom {
    text-align: center;
    padding-top: 20px;
    border-top: 1px solid #700;
    font-size: 0.9rem;
}
















        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                width: 95%;
                padding: 20px;
            }
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
            <li><a href="../mainpage.php">Home</a></li>
            <li><a href="aboutus.php">About Us</a></li>
            <!--<li>Departments</li>-->
            <li><a href="../parts/programs.php">Programs Offered</a></li>
            <li><a href="../parts/contactus.php">Contact Us</a></li>
            <li><a href="../committees/mainpage.php">Committees</a></li>

            <!--
            <li class="dropdown">
                <a href="index.php" class="dropbtn">Committees</a>  //javascript:void(0)
            </li>-->
        </ul>
    </nav>







    <!-- Header -->
    <div class="heading">
        About Us
    </div>

    <!-- Main Container -->
    <div class="container">
        <!-- About Section -->
        <div class="section">
            <h2>About MCC</h2>
            <p>
                Mulund College of Commerce (MCC), established in 1970 by the Parle Tilak Vidyalaya Association (PTVA), is a premier educational institution located in Mulund West, Mumbai. Founded by visionaries Shri Babasaheb Pethe and Shri Baburao Paranjpe, the college has grown into a reputed center of learning, offering high-quality education in Commerce, Science, Management, and Media Studies.
            </p>
            <p>
                Over the past five decades, MCC has nurtured thousands of students, shaping them into responsible professionals and contributing to India's academic and business landscape.
            </p>
        </div>

        <!-- Vision Section -->
        <div class="vision">
            <h2>Vision</h2>
            <p>
                To educate youth to serve the nation with excellence and dedication leading to social, cultural & economic development of India.
            </p>
        </div>

        <!-- Mission Section -->
        <div class="mission">
            <h2>Mission</h2>
            <p>
                To conduct the activities of the College with strict discipline for attaining the goals of intellectual and physical training for moral development and character building of the College.
            </p>
            <p>
                To impart sound, practical and rational education in Commerce, Economics, Business Management, Science, Law, Information Technology, Computer Science, and such allied subjects.
            </p>
            <p>
                To plan and work to meet the perennially changing and growing challenges of a globalized world by introducing specialized training leading to professional capabilities and developing in students different skills for competitive advantage.
            </p>
        </div>

        <!-- Objectives Section -->
        <div class="objectives">
            <h2>Objectives</h2>
            <ul>
                <li>To cultivate such qualities in the younger generation which will help them to be responsible members of the society in their adult life.</li>
                <li>To impart higher education in Commerce in response to the rising demand of industries and organizations.</li>
                <li>To reach great heights in the academic world and to achieve all-round progress of the college with a view to developing Mulund College of Commerce as a first-rate institution.</li>
                <li>To provide opportunities to teachers to enrich themselves professionally.</li>
                <li>To develop relationships between the college and the community around the college and to initiate schemes to provide a learning environment to the students and to achieve social welfare with the cooperation of social and cultural organizations.</li>
                <li>To ceaselessly pursue excellence by acquiring new dimensions of education, working for the welfare of the students and society, providing adequate and modern infrastructural facilities, promoting sports, and carrying out responsibilities towards weaker students.</li>
            </ul>
        </div>

        <!-- Programs Section -->
        <div class="section programs">
            <h2>Programs Offered</h2>
            <ul>
                <li>Bachelor of Commerce (B.Com)</li>
                <li>Bachelor of Management Studies (BMS)</li>
                <li>Bachelor of Science (B.Sc.) in Computer Science</li>
                <li>Master of Commerce (M.Com)</li>
                <li>Master of Science (M.Sc.) in Information Technology</li>
            </ul>
        </div>

        <!-- Achievements Section -->
        <div class="section achievements">
            <h2>Accreditations & Achievements</h2>
            <ul>
                <li>🏆 Autonomous Status granted in 2021, ensuring curriculum innovation.</li>
                <li>🏆 Consistently awarded ‘A’ grade in all three cycles of NAAC accreditation.</li>
                <li>🏆 Honored as the “Best College” by the University of Mumbai (2012–13).</li>
                <li>🏆 Best NSS Unit in urban category by University of Mumbai (2018–19).</li>
            </ul>
        </div>

        <!-- Legacy Section -->
        <div class="section">
            <h2>A Legacy of Excellence</h2>
            <p>
                As part of the Parle Tilak Vidyalaya Association, MCC shares its legacy with multiple prestigious educational institutions, benefiting over 20,000 students from pre-primary to postgraduate levels.
            </p>
            <p>
                The institution focuses not only on academic excellence but also on holistic development, encouraging students to participate in sports, cultural activities, entrepreneurship programs, and social initiatives.
            </p>
        </div>
    </div>

    <!-- Footer -->
    <!-- <div class="foot">
        &copy; 2025 Mulund College of Commerce. All Rights Reserved.
    </div> -->





    

<!-- Feedback Button -->
<button class="feedback-button" onclick="openFeedback()">Feedback</button>

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