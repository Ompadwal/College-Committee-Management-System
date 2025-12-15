

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mulund College of Commerce</title>
    <style>
        
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

.main-section {
    display: flex;
    justify-content: space-around;
    margin: 20px;
}

.card1 {
    position: relative; /* Position relative to allow absolute positioning of the pseudo-element */
    width: 100%;
    height: 600px;
    color: black;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 70px;
    font-weight: bold;
    text-decoration-thickness: 50px;
    text-align: center;
    border: 1px solid #ddd;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
    overflow: hidden; /* Ensure the pseudo-element does not overflow */
}

.card1::before {
    content: ""; /* Required for pseudo-elements */
    position: absolute; /* Position it absolutely within the card */
    top: 0; /* Align to the top */
    left: 0; /* Align to the left */
    right: 0; /* Stretch to the right */
    bottom: 0; /* Stretch to the bottom */
    background-image: url('images/college.jpeg'); /* Add your image path */
    background-size: 100% 100%; /* Cover the entire card */
    background-position: center; /* Center the image */
    background-repeat: no-repeat; /* Do not repeat the image */
    opacity: 0.55; /* Set the opacity of the image (adjust as needed) */
    z-index: 0; /* Place it behind the text */
}

/* Updated card1 navbar styles */
.card1 .navbar {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    z-index: 1;
    margin-top: 0; /* Add this property to move the navbar down */
    background-color: transparent;
}

.card1 .navbar ul {
    display: inline-block;
    justify-content: center;
    list-style: none;
    padding: 0;
    margin: 0px 100px 0px 250px;
    background-color: transparent;
}

.card1 .navbar ul li {
    display: inline-block;
    text-align: center;
    padding: 14px 16px;
    font-size: 14px;
    text-decoration: none;
    color: #111;
    cursor: pointer;
    background-color: white;
}

.card1 .navbar ul li:hover {
    background-color: #e1cbcb;
}

.card1:hover {
    transform: scale(1.02);
}


.Facility{
    text-align: center;
    color: #a40000;
}



.slideshow-container {
    position: relative;
    max-width: 1000px;
    width: 100%;
    margin: 0 auto;
    padding: 20px;
}

.slides-wrapper {
    display: flex;
    overflow: hidden;
    position: relative;
    height: 380px; /* Height for image + label */
}

.slide {
    position: absolute;
    width: 48%;
    text-align: center;
    transition: transform 0.5s ease, opacity 0.5s ease;
}

.slide img {
    width: 100%;
    height: 300px;
    object-fit: cover;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.slide-label {
    margin-top: 10px;
    font-size: 18px;
    font-weight: bold;
    color: #333;
}

.slide.left {
    transform: translateX(0);
    left: 0;
}

.slide.right {
    transform: translateX(0);
    right: 0;
}

.prev, .next {
    position: absolute;
    top: 40%;
    transform: translateY(-50%);
    width: 50px;
    height: 50px;
    background-color: rgba(0, 0, 0, 0.5);
    color: white;
    font-size: 24px;
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 50%;
    cursor: pointer;
    transition: background-color 0.3s;
    z-index: 10;
}

.prev:hover, .next:hover {
    background-color: rgba(0, 0, 0, 0.8);
}

.prev {
    left: 10px;
}

.next {
    right: 10px;
}

.indicators {
    display: flex;
    justify-content: center;
    margin-top: 20px;
}

.indicator {
    width: 12px;
    height: 12px;
    background-color: #bbb;
    border-radius: 50%;
    margin: 0 5px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.indicator.active {
    background-color: #555;
}

/* Only including relevant styles for the slideshow */
/* .slideshow-container {
    position: relative;
    width: 100%;
    max-width: 1200px;
    margin: 0 auto;
    overflow: hidden;
    height: auto;
}

.slideshow-track {
    display: flex;
    transition: transform 0.5s ease-in-out;
    gap: 20px;
    padding: 20px 0;
}

.slide {
    flex: 0 0 calc(33.333% - 20px);
    position: relative;
    transition: all 0.3s ease-in-out;
}

.slide img {
    width: 100%;
    height: 300px;
    object-fit: contain;
    border-radius: 8px;
    transition: transform 0.3s ease;
}

.slide.center {
    transform: scale(1.1);
    z-index: 2;
}

.slide.center:hover {
    transform: scale(1.2);
}

.navigation-dots {
    display: flex;
    justify-content: center;
    margin-top: 20px;
    gap: 10px;
}

.dot {
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background-color: #ccc;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.dot.active {
    background-color: #811313;
} */

/* Header Section */
header1 {
    text-align: center;
    padding: 50px;
}

header1 h1 {
    font-size: 2rem;
    color: #333;
}

header1 hr {
    width: 5px;
    border: 1px solid #900;
    margin: 10px auto;
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
            <img src="images/MCClogo.png" alt="College Logo">
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
            <li><a href="parts/aboutus.php">About Us</a></li>
            <li><a href="parts/programs.php">Programs Offered</a></li>
            <li><a href="parts/contactus.php">Contact Us</a></li>
            <li><a href="committees/mainpage.php">Committees</a></li>

            <!--
            <li class="dropdown">
                <a href="index.php" class="dropbtn">Committees</a>  //javascript:void(0)
            </li>-->
        </ul>
    </nav>

    <!--Main Section--> 
    <div class="main-section">
        <div class="card1">
            <span id="typewriter"></span>
        </div>
    </div>

    <div class="Facility">
        
    <h2>Campus Life & Facilities</h2>

    </div>



    <div class="slideshow-container">
    <div class="slides-wrapper">
        <div class="slide left" data-index="0">
            <img src="images/library.jpeg" alt="Image 1">
            <div class="slide-label">Library</div>
        </div>
        <div class="slide right" data-index="1">
            <img src="images/canteen.jpeg" alt="Image 2">
            <div class="slide-label">Canteen</div>
        </div>
        <div class="slide" data-index="2" style="transform: translateX(100%); right: 0;">
            <img src="images/turf.jpeg" alt="Image 3">
            <div class="slide-label">Turf</div>
        </div>
        <div class="slide" data-index="3" style="transform: translateX(100%); right: 0;">
            <img src="images/carrom.jpeg" alt="Image 4">
            <div class="slide-label">Gymkhana - Carrom Boards</div>
        </div>
        <div class="slide" data-index="3" style="transform: translateX(100%); right: 0;">
            <img src="images/tabletennis.jpeg" alt="Image 4">
            <div class="slide-label">Gymkhana - Table Tennis</div>
        </div>
    </div>

    <div class="prev">&#10094;</div>
    <div class="next">&#10095;</div>

    <div class="indicators">
        <div class="indicator active" data-index="0"></div>
        <div class="indicator" data-index="1"></div>
        <div class="indicator" data-index="2"></div>
        <div class="indicator" data-index="3"></div>
        <div class="indicator" data-index="4"></div>
    </div>
</div>

    <!-- Replace your row div with this new slideshow container -->
    <!-- <div class="slideshow-container">
        <div class="slideshow-track">
            <div class="slide"><img src="images/library.jpeg" alt="Slide 1"></div>
            <div class="slide"><img src="images/canteen.jpeg" alt="Slide 2"></div>
            <div class="slide"><img src="images/turf.jpeg" alt="Slide 3"></div>
            <div class="slide"><img src="images/badminton.jpeg" alt="Slide 4"></div>
            <div class="slide"><img src="images/carrom.jpeg" alt="Slide 5"></div>
        </div>
        <div class="navigation-dots"></div>
    </div> -->

    <header1>
        <h1>WELCOME TO MULUND COLLEGE OF COMMERCE</h1>
        <hr>
    </header1>




    


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
                    <li><a href="footerparts/principal.php">From The Principal's Desk</a></li>
                    <li><a href="https://mccmulund.ac.in/newweb/library/">Library</a></li>
                    <li><a href="footerparts/admission.php">Admission Guidelines</a></li>
                    <li><a href="footerparts/management.php">About Management</a></li>
                    <li><a href="footerparts/location.php">Location</a></li>
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

        document.addEventListener("DOMContentLoaded", function () {
            const texts = ["Welcome", "To", "Mulund College Of Commerce"]; // List of words to type
            let textIndex = 0; // Track which word is being typed
            let charIndex = 0; // Track character position
            const speed = 100; // Typing speed
            const delayAfterComplete = 800; // Delay after full word is typed
            const typewriterElement = document.getElementById("typewriter");
        
            function typeEffect() {
                if (charIndex < texts[textIndex].length) {
                    typewriterElement.textContent += texts[textIndex].charAt(charIndex);
                    charIndex++;
                    setTimeout(typeEffect, speed);
                } else {
                    setTimeout(() => {
                        typewriterElement.textContent = ""; // Clear text
                        charIndex = 0; // Reset character index
                        textIndex = (textIndex + 1) % texts.length; // Move to next word in list
                        typeEffect(); // Restart typing effect
                    }, delayAfterComplete);
                }
            }
        
            typeEffect(); // Start the typing effect
        });


        document.addEventListener('DOMContentLoaded', function() {
    const slides = document.querySelectorAll('.slide');
    const prevButton = document.querySelector('.prev');
    const nextButton = document.querySelector('.next');
    const indicators = document.querySelectorAll('.indicator');

    const totalSlides = slides.length;
    let leftIndex = 0;
    let rightIndex = 1;
    let slideshowInterval;
    const autoSlideInterval = 1900; // Change slides every 1.9 seconds

    // Start automatic slideshow
    startSlideshow();

    function startSlideshow() {
        clearInterval(slideshowInterval);
        slideshowInterval = setInterval(() => {
            slideNext();
        }, autoSlideInterval);
    }

    function slideNext() {
        leftIndex = rightIndex;
        rightIndex = (rightIndex + 1) % totalSlides;
        updateSlides();
    }

    function slidePrev() {
        leftIndex = (leftIndex - 1 + totalSlides) % totalSlides;
        rightIndex = leftIndex;
        rightIndex = (rightIndex + 1) % totalSlides;
        updateSlides();
    }

    function updateSlides() {
        slides.forEach((slide, index) => {
            if (index === leftIndex) {
                slide.className = "slide left";
                slide.style.transform = "translateX(0)";
            } else if (index === rightIndex) {
                slide.className = "slide right";
                slide.style.transform = "translateX(0)";
            } else {
                slide.className = "slide";
                slide.style.transform = "translateX(100%)";
                slide.style.right = "0";
            }
        });

        updateIndicators();
    }

    function updateIndicators() {
        indicators.forEach((indicator, index) => {
            indicator.classList.toggle('active', index === leftIndex);
        });
    }

    prevButton.addEventListener('click', () => {
        slidePrev();
        startSlideshow();
    });

    nextButton.addEventListener('click', () => {
        slideNext();
        startSlideshow();
    });

    indicators.forEach((indicator) => {
        indicator.addEventListener('click', () => {
            const clickedIndex = parseInt(indicator.getAttribute('data-index'));
            leftIndex = clickedIndex;
            rightIndex = (leftIndex + 1) % totalSlides;
            updateSlides();
            startSlideshow();
        });
    });

    const slideshowContainer = document.querySelector('.slideshow-container');
    slideshowContainer.addEventListener('mouseenter', () => {
        clearInterval(slideshowInterval);
    });

    slideshowContainer.addEventListener('mouseleave', () => {
        startSlideshow();
    });
});

        // document.addEventListener('DOMContentLoaded', function() {
        //     const track = document.querySelector('.slideshow-track');
        //     const slides = document.querySelectorAll('.slide');
        //     const dotsContainer = document.querySelector('.navigation-dots');
        //     let currentIndex = 0;
            
        //     // Create navigation dots
        //     slides.forEach((_, index) => {
        //         const dot = document.createElement('div');
        //         dot.classList.add('dot');
        //         if (index === 0) dot.classList.add('active');
        //         dot.addEventListener('click', () => goToSlide(index));
        //         dotsContainer.appendChild(dot);
        //     });

        //     // Update slides positions and classes
        //     function updateSlides() {
        //         slides.forEach((slide, index) => {
        //             slide.classList.remove('center');
        //             if (index === currentIndex) {
        //                 slide.classList.add('center');
        //             }
        //         });

        //         // Update dots
        //         document.querySelectorAll('.dot').forEach((dot, index) => {
        //             dot.classList.toggle('active', index === currentIndex);
        //         });

        //         // Calculate transform value
        //         const translateX = -currentIndex * (100 / 3);
        //         track.style.transform =`translateX(${translateX}%)`;
        //     }

        //     function goToSlide(index) {
        //         currentIndex = index;
        //         updateSlides();
        //     }

        //     function nextSlide() {
        //         currentIndex = (currentIndex + 1) % slides.length;
        //         updateSlides();
        //     }

        //     // Auto advance slides every 3 seconds
        //     setInterval(nextSlide, 3000);

        //     // Initial setup
        //     updateSlides();
        // });




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
    include 'api/db.php';

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



