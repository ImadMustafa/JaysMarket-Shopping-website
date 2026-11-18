<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userEmail = filter_var($_POST["userEmail"], FILTER_SANITIZE_EMAIL);
    $userMessage = htmlspecialchars($_POST["userMessage"]);

    // Validate email
    if (!filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format");
    }

    $to = "Jihadmostafa4@gmail.com"; // Replace with your email address
    $subject = "Contact Form Submission";
    $message = "You have received a new message from your website contact form.\n\n".
               "Email: $userEmail\n".
               "Message:\n$userMessage";
    $headers = "From: $userEmail";

    if (mail($to, $subject, $message, $headers)) {
        echo "Email sent successfully.";
    } else {
        echo "Failed to send email.";
    }
}
?>
