<?php
// footer.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        html, body {
            height: 100%;
            margin: 0;
            font-family: Arial, sans-serif;
            color: #333;
        }

        body {
            display: flex;
            flex-direction: column;
        }

        .content {
            flex: 1;
        }

        footer {
            color: #ecf0f1; /* Light text color */
            padding: 20px;
            text-align: center;
            border-top: 2px solid #34495e; /* Slightly lighter border for contrast */
            font-size: 14px;
        }

        footer p {
            margin: 5px 0;
        }

        footer a {
            text-decoration: none;
            color: #ecf0f1;
            padding: 5px 10px;
            transition: color 0.3s ease;
        }

        footer a:hover {
            color: #3498db; /* Highlight color on hover */
        }

        footer .footer-links {
            margin-bottom: 10px;
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        footer .social-links {
            margin-top: 10px;
            display: flex;
            justify-content: center;
        }

        footer .social-links a {
            margin: 0 10px;
            color: #ecf0f1;
            font-size: 20px;
            transition: color 0.3s ease;
        }

        footer .social-links a:hover {
            color: #3498db; /* Highlight color on hover */
        }

        /* Adjustments for mobile view */
        @media (max-width: 768px) {
            footer {
                padding: 15px;
                font-size: 13px;
            }

            footer .footer-links {
                flex-direction: row; /* Ensure links are side-by-side */
                flex-wrap: wrap;
            }

            footer .footer-links a {
                margin: 0 5px;
            }

            footer .social-links a {
                font-size: 18px;
            }
        }
    </style>
</head>
<body>
    <div class="content">
        <!-- Content should be here or handled by the main page -->
    </div>
    <footer>
        <div class="footer-links">
            <a href="index.php">Home</a> 
            <a href="contactPage.php">Contact Us</a>
        </div>
        <div class="social-links">
            <a href="https://www.instagram.com/yourprofile" target="_blank" aria-label="Instagram">
                <i class="fab fa-instagram"></i>
            </a>
            <a href="https://www.tiktok.com/@yourprofile" target="_blank" aria-label="TikTok">
                <i class="fab fa-tiktok"></i>
            </a>
        </div>
        <p>&copy; 2024 JAY'S Market. All rights reserved.</p>
    </footer>
</body>
</html>
