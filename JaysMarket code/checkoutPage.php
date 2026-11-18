


<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="style.css">
    <title>JAY'S Checkout</title>
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .checkout-container {
            max-width: 900px;
            margin: 50px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .form-control {
            margin-bottom: 15px;
        }
        .cart-menu-container {
            padding-left: 20px;
        }
        @media (max-width: 768px) {
            .cart-menu-container {
                padding-left: 0;
                margin-top: 20px;
            }
        }
        
        input[type="submit"] {
    background-color: #007bff; /* Blue background */
    color: white; /* White text */
    border: none; /* No border */
    padding: 12px 20px; /* Padding for a good size */
    border-radius: 5px; /* Rounded corners */
    font-size: 16px; /* Font size */
    font-weight: bold; /* Bold text */
    cursor: pointer; /* Pointer cursor on hover */
    transition: background-color 0.3s ease; /* Smooth hover transition */
  }

  input[type="submit"]:hover {
    background-color: #0056b3; /* Darker blue on hover */
  }

  input[type="submit"]:active {
    background-color: #004494; /* Even darker blue when pressed */
  }
    </style>
</head>
<body>
<?php 
ob_start();
include 'navbar2.php'; 
?>
<br><br>
<?php

include 'connection.php';

if (isset($_POST["fname"]) && !empty($_POST["fname"]) && 
    isset($_POST["lname"]) && !empty($_POST["lname"]) && 
    isset($_POST["address"]) && !empty($_POST["address"]) && 
    isset($_POST["apartment"]) && !empty($_POST["apartment"]) && 
    isset($_POST["city"]) && !empty($_POST["city"]) && 
    isset($_POST["phone"]) && !empty($_POST["phone"])) {
    
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $address = $_POST["address"];
    $apartment = $_POST["apartment"];
    $city = $_POST["city"];
    $phone = $_POST["phone"];

    // Check if cart exists in session
    if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
        // Prepare cart data for insertion
        $cartData = [];
        foreach ($_SESSION['cart'] as $cart_item) {
            $productId = $cart_item['id'];
            $quantity = $cart_item['quantity'];
            $cartData[] = "($productId, $quantity)";
        }
        $cartDataString = implode(', ', $cartData);

        // Insert the shipping information
        $query = "INSERT INTO orders (fname, lname, address, apartment, city, phone) VALUES ('$fname', '$lname', '$address', '$apartment', '$city', '$phone')";
        if (mysqli_query($conn, $query)) {
            // Get the last inserted order ID
            $orderId = mysqli_insert_id($conn);

            // Insert the cart items
            $query2 = "INSERT INTO order_items (order_id, product_id, quantity) VALUES ";
            $query2 .= implode(', ', array_map(function($item) use ($orderId) {
                list($productId, $quantity) = explode(', ', trim($item, '()'));
                return "($orderId, $productId, $quantity)";
            }, $cartData));

            if (mysqli_query($conn, $query2)) {
                // Update product quantities
                foreach ($_SESSION['cart'] as $cart_item) {
                    $productId = $cart_item['id'];
                    $quantity = $cart_item['quantity'];
                    $updateQuery = "UPDATE products SET quantity = quantity - $quantity WHERE id = $productId";
                    if (!mysqli_query($conn, $updateQuery)) {
                        echo "Error updating product quantity: " . mysqli_error($conn);
                    }
                }

                // Clear the cart after successful insertion
                unset($_SESSION['cart']);
                header("Location:purchaseSuccess.php");
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "Cart is empty.";
    }
}

ob_end_flush();
?>




    <div class="checkout-container">
        <div class="row">
            <div class="col-lg-6 col-12">
                <h3 class="mb-4">Shipping Information</h3>
                <form action="" method="POST" enctype="multipart/form-data">
                <input type="text" class="form-control" placeholder="First name" name="fname" required>
                <input type="text" class="form-control" placeholder="Last name" name="lname" required>
                <input type="text" class="form-control" placeholder="Address" name="address" required>
                <input type="text" class="form-control" placeholder="Apartment, suite, etc." name="apartment" required>
                <input type="text" class="form-control" placeholder="City" name="city" required>
                <input type="number" class="form-control" placeholder="Phone number" name="phone" required>
                <input type="submit" value="Order">
                </form>
            </div>
        
            

            <div class="col-lg-6 col-12 cart-menu-container">
                <!-- Offcanvas cart -->
                
                  <div class="offcanvas-header">
                    
                  </div>
                  <?php include 'cartmenu2.php'; ?>
                
            </div>
        </div>
    </div>

    <script>
    function updateCartDisplay() {
    fetch('cartmenu2.php')
        .then(response => response.text())
        .then(html => {
            console.log('Fetched HTML:', html); // Log fetched HTML
            document.querySelector('#cart-content').innerHTML = html;

            // Reattach event listeners to updated content
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
            .then(() => {
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
            updateCartDisplay();
        })
        .catch(error => console.error('Error:', error));
    });
}
document.addEventListener('DOMContentLoaded', function() {
    updateCartDisplay(); // Initial call to populate the cart content
});

</script>

<script src="cartmenu.js"></script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
