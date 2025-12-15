<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Floating Back Button</title>
    <style>
        /* General styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
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
    </style>
</head>
<body>

    <!-- Back Button -->
    <a href="../mainpage.php" class="back-button">Back</a>

</body>
</html>