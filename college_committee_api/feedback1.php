<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .feedback-form {
            position: relative;
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    width: 300px;
        }


        .close-btn {
    position: absolute;
    top: 10px;
    right: 10px;
    background: none;
    border: none;
    font-size: 18px;
    cursor: pointer;
    color: #555;
}
.close-btn:hover {
    color: red;
}




        .feedback-form h2 {
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group select, .form-group input, .form-group textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .form-group textarea {
            height: 100px;
            resize: none;
        }
        .form-group .other-category {
            display: none;
        }
        .form-group button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            border: none;
            border-radius: 4px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }
        .form-group button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="feedback-form">
    <button class="close-btn" onclick="goBack()">
    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <line x1="18" y1="6" x2="6" y2="18"></line>
        <line x1="6" y1="6" x2="18" y2="18"></line>
    </svg>
</button>
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
                <input type="text" id="otherCategory" name="otherCategory" class="other-category" placeholder="Please specify">
            </div>
            <div class="form-group">
                <label for="message">Message</label>
                <textarea id="message" name="message" required></textarea>
            </div>
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <button type="submit">Send Feedback</button>
            </div>
        </form>
    </div>

    <script>

        function goBack(){
            window.history.back();
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
            event.preventDefault();
            var category = document.getElementById('category').value;
            var otherCategory = document.getElementById('otherCategory').value;
            var message = document.getElementById('message').value;
            var email = document.getElementById('email').value;

            if (category === 'Other' && otherCategory.trim() === '') {
                alert('Please specify the category.');
                return;
            }

            alert('Feedback submitted successfully!\n\nCategory: ' + (category === 'Other' ? otherCategory : category) + '\nMessage: ' + message + '\nEmail: ' + email);
            
            this.reset();

            document.getElementById('otherCategory').style.display='none';
        });
    </script>
</body>
</html>