<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Floating Help Button</title>
    <style>
        /* Floating Help Button Styles */
.floating-help-button {
    position: fixed;
    bottom: 20px; /* Adjust the distance from the bottom */
    right: 20px; /* Adjust the distance from the right */
    z-index: 1000; /* Make sure it's above other elements */
    display: flex;
    justify-content: center;
    align-items: center;
}

/* Floating Button Base Style */
.floating-help-button button {
    background-color: #25D366; /* WhatsApp green background */
    color: white; /* White text color */
    border: none;
    padding: 10px 20px; /* Adjust padding for a rectangular shape */
    border-radius: 12px; /* Rounded corners */
    cursor: pointer;
    font-size: 20px; /* Larger text size for the icon */
    box-shadow: 0 4px 8px rgba(0,0,0,0.2); /* Floating shadow */
    position: relative;
}


/* Icon Style */
.floating-help-button button::before {
    content: "💬"; /* Example icon, use emoji or SVG as needed */
    font-size: 24px; /* Adjust the icon size */
}

/* Hover Effects */
.floating-help-button button:hover {
    background-color: #128C7E; /* Darker green on hover */
    box-shadow: 0 6px 12px rgba(0,0,0,0.3); /* Increase shadow on hover */
}

/* Add a pulsating animation */
.floating-help-button button:after {
    content: "";
    position: absolute;
    top: -10px;
    left: -10px;
    width: 100%;
    height: 100%;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.3);
    transform: scale(1);
    opacity: 0;
    transition: transform 0.6s, opacity 0.6s;
}

/* Contact Panel Styles */
.contact-panel {
    display: none; /* Hidden by default */
    position: fixed;
    bottom: 80px; /* Adjust to position above the floating button */
    right: 20px;
    background-color: #f1f1f1;
    border: 1px solid #ccc;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    padding: 20px;
    z-index: 1000;
    width: 300px; /* Adjust width as needed */
}

.contact-panel h3 {
    margin-top: 0;
    font-size: 18px;
    font-weight: bold;
}

.contact-option {
    margin-bottom: 20px;
}

.contact-option h4 {
    font-size: 16px;
    margin-bottom: 10px;
}

.whatsapp-link {
    display: block;
    background-color: #25D366; /* WhatsApp green background */
    color: white; /* White text color */
    text-align: center;
    padding: 10px;
    border-radius: 5px;
    text-decoration: none;
    font-size: 16px;
}

.whatsapp-link:hover {
    background-color: #128C7E; /* Darker green on hover */
}

/* Form Styles */
#contactForm {
    display: flex;
    flex-direction: column;
}

#contactForm label {
    margin-top: 10px;
    font-weight: bold;
}

#contactForm input, #contactForm textarea {
    margin-bottom: 10px;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

#contactForm button {
    background-color: #007bff; /* Blue background color */
    color: white; /* White text color */
    border: none;
    padding: 10px;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}

#contactForm button:hover {
    background-color: #0056b3; /* Darker blue on hover */
}
.close-btn {
  background-color: #f5f5f5; /* Light gray background */
  border: none; /* Remove default border */
  border-radius: 50%; 
  width: 30px; /* Width of the button */
  height: 30px; /* Height of the button */
  display: flex; /* Center the icon */
  align-items: center;
  justify-content: center;
  cursor: pointer; /* Pointer cursor on hover */
  font-size: 24px; /* Font size for the icon */
  color: #333; /* Dark gray color for the icon */
  transition: background-color 0.3s ease, color 0.3s ease; /* Smooth transition */
  margin-right: 20px;
}

.close-btn:hover {
  background-color: #e0e0e0; /* Slightly darker gray on hover */
  color: #000; /* Black color for the icon on hover */
}

.close-icon {
  margin: 0; /* Remove default margin */
  padding: 0; /* Remove default padding */
  margin-bottom: 5px;
}

    </style>
</head>
<body>

    <!-- Your content here -->

    <!-- Floating Help Button -->
    <div class="floating-help-button" id="floatingHelpButton">
        <button onclick="toggleHelpPanel()">Need Help?</button>
    </div>

    <!-- Contact Panel -->
    <div class="contact-panel" id="contactPanel">
        <button class="close-btn" onclick="toggleHelpPanel()">
  <span class="close-icon">&times;</span>
</button>
<br>

        <h3>Contact Us</h3>
        <div class="contact-option">
            <h4>Contact Us with WhatsApp</h4>
            <a href="https://wa.me/96103701403" target="_blank" class="whatsapp-link">Chat with us on WhatsApp</a>
        </div>
        
        <div class="contact-option">
            <h4>Or Email Us</h4>
            <form id="contactForm" action="send_email.php" method="post">
                <label for="userEmail">Your Email:</label>
                <input type="email" id="userEmail" name="userEmail" required>
                <label for="userMessage">Your Message:</label>
                <textarea id="userMessage" name="userMessage" rows="4" required></textarea>
                <button type="submit">Send Email</button>
            </form>
        </div>
    </div>

    <script>
        function toggleHelpPanel() {
            var panel = document.getElementById('contactPanel');
            if (panel.style.display === 'block') {
                panel.style.display = 'none';
            } else {
                panel.style.display = 'block';
            }
        }
    </script>
</body>
</html>
