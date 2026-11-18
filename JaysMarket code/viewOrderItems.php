<?php
session_start();

if (isset($_SESSION['isLoggedIn']) && isset($_SESSION['useremail'])) {
    // $username = $_SESSION['username'];
    $useremail = $_SESSION['useremail'];
} else {
    // User is not signed in, redirect to the desired page
    header("Location: yourDesiredPage.php"); // Replace 'yourDesiredPage.php' with the actual page you want to redirect to
    exit();
}
?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
<style>
        /* General Table Styles */
table {
    width: 100%;
    margin-bottom: 20px;
    border-collapse: collapse;
}

table thead th {
    background-color: #007bff;
    color: white;
    padding: 12px;
    text-align: center;
    font-weight: bold;
    border-bottom: 2px solid #0056b3;
}

table tbody tr {
    background-color: #f8f9fa;
    border-bottom: 1px solid #dee2e6;
    transition: background-color 0.3s ease;
}

table tbody tr:hover {
    background-color: #e2e6ea;
}

table tbody td {
    padding: 8px;
    text-align: center;
}

table tbody td a img {
    transition: transform 0.2s ease;
}

table tbody td a img:hover {
    transform: scale(1.1);
}

/* Scrollable Table for Mobile */
@media (max-width: 768px) {
    .table-wrapper {
        overflow-x: auto; /* Allow horizontal scrolling */
    }

    table {
        width: 1000px; /* Make the table wider than the mobile screen */
    }
}

    </style>


<?php
include 'connection.php';

if (isset($_GET['order_id'])) {
    $order_id = intval($_GET['order_id']); // Sanitize input

    echo "<h2>Order Items for Order ID: $order_id</h2>";

    // Query to join order_items with products to get product details
    $query = "
        SELECT oi.product_id, p.productname, oi.quantity, p.price, p.imagemain
        FROM order_items oi
        JOIN products p ON oi.product_id = p.id
        WHERE oi.order_id = $order_id
    ";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo '<table border="1">';
        echo '<thead>';
        echo '<tr><th>Item ID</th><th>Product Image</th><th>Product Name</th><th>Quantity</th><th>Price</th></tr>';
        echo '</thead>';
        echo '<tbody>';

        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($row['product_id']) . '</td>';
            echo '<td><img src="' . htmlspecialchars($row['imagemain']) . '" alt="" width="80px"></td>';
            echo '<td>' . htmlspecialchars($row['productname']) . '</td>';
            echo '<td>' . htmlspecialchars($row['quantity']) . '</td>';
            echo '<td>' . htmlspecialchars($row['price']) . '</td>';
            echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';
    } else {
        echo "Error in query: " . mysqli_error($conn);
    }
} else {
    echo "No order ID specified.";
}
?>
