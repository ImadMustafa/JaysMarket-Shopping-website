<?php
// PHP header to set content type
header('Content-Type: text/html; charset=utf-8');

// Redirect to index.php after 5 seconds
header('Refresh: 5; url=index.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Successful</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8ff;
            color: #333;
            text-align: center;
            margin: 0;
            padding: 0;
        }
        .container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .message {
            background-color: #4CAF50;
            color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .redirect-info {
            margin-top: 20px;
            font-size: 16px;
            color: #666;
        }
        .redirect-info a {
            color: #4CAF50;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="message">
            <h1>Order Successful!</h1>
            <p>Thank you for your order. We are processing it and will get back to you soon.</p>
        </div>
        <div class="redirect-info">
            You will be redirected to the <a href="index.php">home page</a> in a few seconds...
        </div>
    </div>
</body>
</html>
