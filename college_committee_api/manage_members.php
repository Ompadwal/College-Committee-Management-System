<?php
require 'api/db.php';

// Fetch all committees
$result = $conn->query("SELECT * FROM committees");
$committees = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Members</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
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


        .main-container {
            display: flex;
        }

        .sidebar {
            width: 250px;
            background: #333;
            color: white;
            padding: 20px;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
        }

        .sidebar li {
            padding: 10px;
            cursor: pointer;
            border-bottom: 1px solid #555;
        }

        .sidebar li:hover {
            background: #555;
        }

        .content {
            flex-grow: 1;
            padding: 20px;
        }

        .content h2 {
            text-align: center;
        }

        .add-member-form {
            margin-bottom: 20px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        .add-member-form select, .add-member-form input {
            padding: 8px;
            margin: 5px;
        }

        .member-table {
            border-collapse: collapse;
            width: 100%;
        }

        .member-table th, .member-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }

        .member-table th {
            background-color: #f0f0f0;
        }

        .action-buttons {
            display: flex;
            gap: 5px;
            justify-content: center;
        }

        .edit-button, .delete-button {
            padding: 5px 10px;
            border: none;
            cursor: pointer;
            color: white;
        }

        .edit-button {
            background-color: #4CAF50;
        }

        .delete-button {
            background-color: #ff4d4d;
        }

        .edit-button:hover {
            background-color: #3e8e41;
        }

        .delete-button:hover {
            background-color: #cc0000;
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
            <li><a href="committeemanagement.php">Home</a></li>
            <li><a href="manage_members.php">Manage Members</a></li>
            <li><a href="manage_committees.php">Manage Committees</a></li>
            <li><a href="manage_documents.php">Manage Documents</a></li>
            <li><a href="committees/contactus.php">Contact Us</a></li>

            <!--
            <li class="dropdown">
                <a href="index.php" class="dropbtn">Committees</a>  //javascript:void(0)
            </li>-->
        </ul>
    </nav>

    <div class="main-container">
        <!-- Sidebar with Committees -->
        <div class="sidebar">
            <h3>Committees</h3>
            <ul id="committeeList">
                <?php foreach ($committees as $committee): ?>
                    <li onclick="loadMembers(<?= $committee['id'] ?>)"><?= $committee['name'] ?></li>
                <?php endforeach; ?>
            </ul>
        </div>

        <!-- Main Content Area -->
        <div class="content">
            <h2>Manage Members</h2>
            
            <!-- Form to Add Member -->
            <div class="add-member-form">
                <h3>Add Member</h3>
                <form id="addMemberForm">
                    <select name="committee_id" id="committee_id" required>
                        <option value="">Select Committee</option>
                        <?php foreach ($committees as $committee) {
                            echo "<option value='{$committee['id']}'>{$committee['name']}</option>";
                        } ?>
                    </select>
                    <input type="text" id="member_name" placeholder="Member Name" required>
                    <input type="text" id="designation" placeholder="Designation" required>
                    <button type="submit">Add Member</button>
                </form>
            </div>
            
            <!-- Members List -->
            <div id="memberList">
                <p>Select a committee to view members.</p>
            </div>
        </div>
    </div>

    

<!-- Feedback Button -->
<button class="feedback-button" onclick="openFeedback()">Feedback</button>

<!-- Member Login Button -->
<button class="login-button" onclick="openLogin()">Member Logout</button>

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
        // Variables to track edit state
        let isEditing = false;
        let editingMemberId = null;
        let originalName = '';
        let originalDesignation = '';
        let clickEventBound = false;

        function loadMembers(committeeId) {
            fetch(`api/members.php?committee_id=${committeeId}`)
                .then(response => response.json())
                .then(data => {
                    let memberList = document.getElementById("memberList");
                    memberList.innerHTML = `<h3>Members:</h3>`;

                    if (data.length === 0) {
                        memberList.innerHTML += "<p>No members found.</p>";
                    } else {
                        let tableHtml = `<table class="member-table">
                                            <tr>
                                                <th>Member Name</th>
                                                <th>Designation</th>
                                                <th>Action</th>
                                            </tr>`;

                        data.forEach(member => {
                            tableHtml += `<tr id="member_${member.id}">
                                            <td>${member.member_name}</td>
                                            <td>${member.designation}</td>
                                            <td class="action-buttons">
                                                <button class="edit-button" onclick="editMember(${member.id}, '${member.member_name}', '${member.designation}')">Edit</button>
                                                <button class="delete-button" onclick="deleteMember(${member.id})">Delete</button>
                                            </td>
                                          </tr>`;
                        });

                        tableHtml +=` </table>`;
                        memberList.innerHTML += tableHtml;
                    }
                })
                .catch(error => console.error("Error loading members:", error));
        }

        // Add Member
        document.getElementById('addMemberForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const committeeId = document.getElementById('committee_id').value;
            const memberName = document.getElementById('member_name').value;
            const designation = document.getElementById('designation').value;

            fetch('api/members.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ committee_id: committeeId, member_name: memberName, designation: designation })
            })
            .then(response => response.json())
            .then(() => {
                alert('Member added successfully!');
                // Clear form fields after successful submission
                document.getElementById('member_name').value = '';
                document.getElementById('designation').value = '';
                loadMembers(committeeId);
            });
        });

        function handleOutsideClick(e) {
            if (!isEditing || !editingMemberId) return;
            
            // Check if the click is outside the editing row
            const editRow = document.getElementById(`member_${editingMemberId}`);
            const clickedEdit = e.target.closest(`#member_${editingMemberId}`);
            
            if (editRow && !clickedEdit) {
                cancelEdit(editingMemberId);
            }
        }

        // Edit Member
        function editMember(id, currentName, currentDesignation) {
            // Already in edit mode, cancel previous edit first
            if (isEditing && editingMemberId) {
                cancelEdit(editingMemberId);
            }
            
            // Set editing flag and store original values
            isEditing = true;
            editingMemberId = id;
            originalName = currentName;
            originalDesignation = currentDesignation;

            let row = document.getElementById(`member_${id}`);
            row.innerHTML = `
                <td><input type="text" id="edit_name_${id}" value="${currentName}"></td>
                <td><input type="text" id="edit_designation_${id}" value="${currentDesignation}"></td>
                <td class="action-buttons">
                    <button class="edit-button" onclick="saveEdit(${id})">Save</button>
                    <button class="delete-button" onclick="cancelEdit(${id})">Cancel</button>
                </td>`;
            
            // Wait until next tick to add event listener to avoid immediate trigger
            setTimeout(() => {
                // Remove previous listener if exists
                if (clickEventBound) {
                    document.removeEventListener('click', handleOutsideClick);
                }
                
                // Add new listener
                document.addEventListener('click', handleOutsideClick);
                clickEventBound = true;
            }, 100);
        }

        function cancelEdit(id) {
            // Remove outside click listener
            if (clickEventBound) {
                document.removeEventListener('click', handleOutsideClick);
                clickEventBound = false;
            }
            
            // Reset editing state
            isEditing = false;
            editingMemberId = null;
            
            // Restore original row without reloading
            const row = document.getElementById(`member_${id}`);
            if (row) {
                row.innerHTML = `
                    <td>${originalName}</td>
                    <td>${originalDesignation}</td>
                    <td class="action-buttons">
                        <button class="edit-button" onclick="editMember(${id}, '${originalName}', '${originalDesignation}')">Edit</button>
                        <button class="delete-button" onclick="deleteMember(${id})">Delete</button>
                    </td>`;
            }
        }

        function saveEdit(id) {
            const newNameInput = document.getElementById(`edit_name_${id}`);
            const newDesignationInput = document.getElementById(`edit_designation_${id}`);
            
            if (!newNameInput || !newDesignationInput) return;
            
            const newName = newNameInput.value;
            const newDesignation = newDesignationInput.value;
            
            // Remove outside click listener
            if (clickEventBound) {
                document.removeEventListener('click', handleOutsideClick);
                clickEventBound = false;
            }
            
            // Check if content has been modified
            if (newName === originalName && newDesignation === originalDesignation) {
                // If no changes, just cancel edit without alert
                cancelEdit(id);
                return;
            }

            // Content has been modified, proceed with update
            fetch('api/members.php', {
                method: 'PUT',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ id: id, member_name: newName, designation: newDesignation })
            })
            .then(response => response.json())
            .then(() => {
                // Reset editing state
                isEditing = false;
                editingMemberId = null;
                
                // Update the row with new data without reloading
                const row = document.getElementById(`member_${id}`);
                if (row) {
                    row.innerHTML = `
                        <td>${newName}</td>
                        <td>${newDesignation}</td>
                        <td class="action-buttons">
                            <button class="edit-button" onclick="editMember(${id}, '${newName}', '${newDesignation}')">Edit</button>
                            <button class="delete-button" onclick="deleteMember(${id})">Delete</button>
                        </td>`;
                }
                
                alert('Member updated successfully!');
            });
        }

        // Delete Member
        function deleteMember(id) {
            if (confirm('Are you sure you want to delete this member?')) {
                fetch('api/members.php', {
                    method: 'DELETE',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ id: id })
                })
                .then(response => response.json())
                .then(() => {
                    alert('Member deleted successfully!');
                    loadMembers(document.getElementById('committee_id').value);
                });
            }
        }

        
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
            window.location.href = "committees/mainpage.php";
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