<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <title>JAY'S - Contact Us</title>
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.3/font/bootstrap-icons.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="style.css">


    <style>

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

.box1 {
    border: 1px solid #ddd; /* Light border */
    border-radius: 8px;     /* Rounded corners */
    padding: 20px;          /* Space inside the box */
    margin: 20px auto;      /* Center the box with margin */
    max-width: 800px;       /* Max width for larger screens */
    background-color: #f9f9f9; /* Background color */
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Subtle shadow */
}

/* Style for headings and links */
.box1 h3 {
    font-size: 1.5em; /* Larger font size for the main heading */
    margin-bottom: 10px; /* Space below the heading */
}

.box1 h4 {
    font-size: 1.2em; /* Slightly larger font for subheadings */
    margin: 10px 0;   /* Space above and below subheadings */
}

.box1 a {
    text-decoration: none; /* Remove underline */
}

.box1 a:hover {
    text-decoration: underline; /* Underline on hover */
}

/* Style for the form elements */
.box1 form {
    display: flex;
    flex-direction: column; /* Stack form elements vertically */
}

.box1 label {
    margin: 5px 0; /* Space above and below labels */
}

.box1 input,
.box1 textarea {
    padding: 10px; /* Padding inside input and textarea */
    border: 1px solid #ccc; /* Light border for input and textarea */
    border-radius: 4px; /* Rounded corners for inputs */
    font-size: 1em; /* Consistent font size */
}

.box1 button {
    padding: 10px 20px; /* Padding inside the button */
    border: none; /* Remove default border */
    border-radius: 4px; /* Rounded corners */
    background-color: #007bff; /* Background color */
    font-size: 1em; /* Font size for button text */
    cursor: pointer; /* Pointer cursor on hover */
    margin-top: 10px; /* Space above the button */
}

.box1 button:hover {
    background-color: #0056b3; /* Darker background on hover */
}

/* Responsive styles */
@media (max-width: 768px) {
    .box1 {
        padding: 15px; /* Less padding on smaller screens */
        margin: 10px;  /* Less margin on smaller screens */
    }

    .box1 h3 {
        font-size: 1.2em; /* Slightly smaller heading on smaller screens */
    }

    .box1 h4 {
        font-size: 1em; /* Slightly smaller subheading on smaller screens */
    }

    .box1 input,
    .box1 textarea {
        font-size: 0.9em; /* Smaller font size for inputs */
    }

    .box1 button {
        font-size: 0.9em; /* Smaller button text */
    }
}

    </style>

</head>
<body>
<?php
include 'navbar.php'; // Includes connection.php as well
?>

<br><br>
<div style="height: 60px;"></div>
<br><br>

<!-- Contact Panel -->
        <div class="box1">
            <h3>Contact Us</h3>
<p>If you encounter any issues or need assistance with your order, please reach out to us via WhatsApp or email.</p>
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



<div class="space"></div>

<?php include 'footer.php'; ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.add-to-cart-btn').forEach(function(button) {
        button.addEventListener('click', function() {
            var form = this.closest('.add-to-cart-form');
            var formData = new FormData(form);

            fetch('add_to_cart.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    alert(data.message);
                    // Update the cart display
                    updateCartDisplay();
                } else {
                    alert('Failed to add product to cart');
                }
            })
            .catch(error => console.error('Error:', error));
        });
    });

    function updateCartDisplay() {
        // Fetch the updated cart content from navbar.php
        fetch('navbar.php')
            .then(response => response.text())
            .then(html => {
                // Create a temporary DOM element to extract cart content
                var tempDiv = document.createElement('div');
                tempDiv.innerHTML = html;
                // Extract and update the cart content and badges
                var newCartContent = tempDiv.querySelector('#cart-content').innerHTML;
                var newCartBadge = tempDiv.querySelector('#cart-badge-desktop').textContent;

                document.querySelector('#cart-content').innerHTML = newCartContent;
                document.querySelector('#cart-badge-mobile').textContent = newCartBadge;
                document.querySelector('#cart-badge-desktop').textContent = newCartBadge;

                // Reattach event listeners for cart updates
                attachEventListeners();
            })
            .catch(error => console.error('Error:', error));
    }

    function attachEventListeners() {
        document.querySelectorAll('.cart-update').forEach(function(button) {
            button.addEventListener('click', function() {
                var key = this.dataset.key;
                var action = this.dataset.action;

                fetch('update_cart.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: new URLSearchParams({
                        product_key: key,
                        action: action
                    })
                })
                .then(response => response.text())
                .then(data => {
                    // Reload the cart content and update badges
                    updateCartDisplay();
                })
                .catch(error => console.error('Error:', error));
            });
        });

        document.querySelector('#clear-cart').addEventListener('click', function() {
            fetch('clear_cart.php', {
                method: 'POST'
            })
            .then(() => {
                // Clear the cart content and update badges
                updateCartDisplay();
            })
            .catch(error => console.error('Error:', error));
        });
    }

    // Attach event listeners on document ready
    attachEventListeners();
});
</script>




<script>
    document.addEventListener('DOMContentLoaded', function() {
    const filterButtons = document.querySelectorAll('.filter-buttons .btn');
    
    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            filterButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
        });
    });
});
</script>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>






<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
