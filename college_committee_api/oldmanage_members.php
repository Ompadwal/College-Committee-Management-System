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
    </style>
</head>
<body>

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

    <script>
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

                        tableHtml += `</table>`;
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
                loadMembers(committeeId);
            });
        });

        // Edit Member
        function editMember(id, currentName, currentDesignation) {
            let row = document.getElementById(`member_${id}`);
            row.innerHTML = `
                <td><input type="text" id="edit_name_${id}" value="${currentName}"></td>
                <td><input type="text" id="edit_designation_${id}" value="${currentDesignation}"></td>
                <td class="action-buttons">
                    <button class="edit-button" onclick="saveEdit(${id})">Save</button>
                    <button class="delete-button" onclick="loadMembers(${document.getElementById('committee_id').value})">Cancel</button>
                </td>`;
        }

        function saveEdit(id) {
            const newName = document.getElementById(`edit_name_${id}`).value;
            const newDesignation = document.getElementById(`edit_designation_${id}`).value;

            fetch('api/members.php', {
                method: 'PUT',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ id: id, member_name: newName, designation: newDesignation })
            })
            .then(response => response.json())
            .then(() => {
                alert('Member updated successfully!');
                loadMembers(document.getElementById('committee_id').value);
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
    </script>

</body>
</html>