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
    <title>Admin Panel - College Committee Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
        }
        .sidebar {
            width: 250px;
            height: 100vh;
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

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input, .form-group select {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }

        .form-group button {
            background-color: #4CAF50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .form-group button:hover {
            background-color: #3e8e41;
        }

        .admin-table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        .admin-table th, .admin-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }

        .admin-table th {
            background-color: #f0f0f0;
        }

        .admin-actions button {
            background-color: #007BFF;
            color: #fff;
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-right: 5px;
        }

        .admin-actions button:hover {
            background-color: #0056b3;
        }

        .admin-actions .delete-button {
            background-color: #dc3545;
        }

        .admin-actions .delete-button:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>

    <!-- Sidebar with Committees -->
    <div class="sidebar">
        <h3>Admin Panel</h3>
        <ul id="committeeList">
            <?php if ($committees): ?>
                <?php foreach ($committees as $committee): ?>
                    <li onclick="loadCommittee(<?= $committee['id'] ?>)"><?= $committee['name'] ?></li>
                <?php endforeach; ?>
            <?php else: ?>
                <li>No committees found.</li>
            <?php endif; ?>
        </ul>
    </div>

    <!-- Main Content Area -->
    <div class="content">
        <h2>Manage Committees</h2>
        <div class="form-group">
            <label for="committeeName">Committee Name</label>
            <input type="text" id="committeeName">
        </div>
        <div class="form-group">
            <button onclick="addCommittee()">Add Committee</button>
        </div>

        <h2>Manage Documents</h2>
        <div class="form-group">
            <label for="committeeSelect">Select Committee</label>
            <select id="committeeSelect">
                <?php if ($committees): ?>
                    <?php foreach ($committees as $committee): ?>
                        <option value="<?= $committee['id'] ?>"><?= $committee['name'] ?></option>
                    <?php endforeach; ?>
                <?php else: ?>
                    <option value="">No committees found.</option>
                <?php endif; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="documentFile">Upload Document</label>
            <input type="file" id="documentFile">
        </div>
        <div class="form-group">
            <button onclick="uploadDocument()">Upload Document</button>
        </div>

        <h2>Committees and Documents</h2>
        <div id="adminTable">
            <p>Select a committee to view documents.</p>
        </div>
    </div>

    <script>
        function addCommittee() {
            const name = document.getElementById('committeeName').value;
            fetch('api/committees.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ name })
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message);
                location.reload();
            })
            .catch(error => console.error('Error adding committee:', error));
        }

        function uploadDocument() {
            const committeeId = document.getElementById('committeeSelect').value;
            const file = document.getElementById('documentFile').files[0];
            const formData = new FormData();
            formData.append('committee_id', committeeId);
            formData.append('file', file);

            fetch('api/documents.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message);
                location.reload();
            })
            .catch(error => console.error('Error uploading document:', error));
        }

        function loadCommittee(committeeId) {
            fetch(api/documents.php?committee_id=${committeeId})
                .then(response => response.json())
                .then(data => {
                    let adminTable = document.getElementById("adminTable");
                    adminTable.innerHTML = <h3>Committee ID: ${committeeId}</h3>;
                    
                    if (data.length === 0) {
                        adminTable.innerHTML += "<p>No documents found.</p>";
                    } else {
                        let tableHtml = `
                            <table class="admin-table">
                                <tr>
                                    <th>Document Name</th>
                                    <th>Actions</th>
                                </tr>
                        `;
                        data.forEach(doc => {
                            tableHtml += `
                                <tr>
                                    <td>${doc.file_name}</td>
                                    <td class="admin-actions">
                                        <button onclick="renameDocument(${doc.id})">Rename</button>
                                        <button class="delete-button" onclick="deleteDocument(${doc.id})">Delete</button>
                                    </td>
                                </tr>
                            `;
                        });
                        tableHtml += `
                            </table>
                        `;
                        adminTable.innerHTML += tableHtml;
                    }
                })
                .catch(error => console.error("Error loading documents:", error));
        }

        function renameDocument(documentId) {
            const newName = prompt("Enter new name for the document:");
            if (newName) {
                fetch('api/documents.php', {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ id: documentId, name: newName })
                })
                .then(response => response.json())
                .then(data => {
                    alert(data.message);
                    location.reload();
                })
                .catch(error => console.error('Error renaming document:', error));
            }
        }

        function deleteDocument(documentId) {
            fetch('api/documents.php', {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ id: documentId })
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message);
                location.reload();
            })
            .catch(error => console.error('Error deleting document:', error));
        }
    </script>

</body>
</html>