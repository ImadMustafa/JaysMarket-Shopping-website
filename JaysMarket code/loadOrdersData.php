<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Search</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>Search Orders</h2>
<form method="GET" action="">
    <label for="search_id">Search by ID:</label>
    <input type="text" id="search_id" name="search_id" value="<?php echo isset($_GET['search_id']) ? htmlspecialchars($_GET['search_id']) : ''; ?>">

    <label for="search_name">Search by Customer Name:</label>
    <input type="text" id="search_name" name="search_name" value="<?php echo isset($_GET['search_name']) ? htmlspecialchars($_GET['search_name']) : ''; ?>">

    <input type="submit" value="Search">
</form>

<br>

<?php
session_start();

if (isset($_SESSION['isLoggedIn']) && isset($_SESSION['useremail'])) {
    $useremail = $_SESSION['useremail'];
} else {
    header("Location: yourDesiredPage.php");
    exit();
}

include 'connection.php';

// Retrieve search parameters
$search_id = isset($_GET['search_id']) ? trim($_GET['search_id']) : '';
$search_name = isset($_GET['search_name']) ? trim($_GET['search_name']) : '';
$show_done = isset($_GET['show_done']) && $_GET['show_done'] == '1';

// Construct the base SQL query for not done or done orders
$query = "SELECT o.*, (SELECT SUM(oi.quantity * p.price) 
                        FROM order_items oi 
                        JOIN products p ON oi.product_id = p.id 
                        WHERE oi.order_id = o.id) AS total_price 
          FROM orders o WHERE o.done = " . ($show_done ? 1 : 0);
$param_types = '';
$params = [];

if (!empty($search_id)) {
    $query .= " AND o.id = ?";
    $param_types .= 'i';
    $params[] = $search_id;
}
if (!empty($search_name)) {
    $query .= " AND (o.fname LIKE ? OR o.lname LIKE ?)";
    $param_types .= 'ss';
    $params[] = "%$search_name%";
    $params[] = "%$search_name%";
}

// Prepare and execute the query
$stmt = $conn->prepare($query);

if ($param_types) {
    $stmt->bind_param($param_types, ...$params);
}

$stmt->execute();
$result = $stmt->get_result();

// Calculate total price for all done orders if showing done orders
if ($show_done) {
    $total_done_price_query = "SELECT SUM(oi.quantity * p.price) AS total_done_price
                               FROM order_items oi 
                               JOIN products p ON oi.product_id = p.id 
                               JOIN orders o ON oi.order_id = o.id
                               WHERE o.done = 1";
    $total_done_result = mysqli_query($conn, $total_done_price_query);
    $total_done_row = mysqli_fetch_assoc($total_done_result);
    $total_done_price = $total_done_row['total_done_price'] ? number_format($total_done_row['total_done_price'], 2) : '0.00';

    echo "<h2>Total Price of All Done Orders: $$total_done_price</h2>";
}

echo "<br>";

// Toggle button to show done orders
echo '<form method="GET" action="">
        <input type="hidden" name="show_done" value="' . ($show_done ? '0' : '1') . '">
        <input type="submit" value="' . ($show_done ? 'Show Not Done Orders' : 'Show Done Orders') . '">
    </form>';
    
echo "<br>";

echo "<h2>" . ($show_done ? "Done" : "Not Done") . " Orders</h2>";

if ($result) {
    echo '<table border="1">';
    echo '<thead>';
    echo '<tr><th>ID</th><th>Customer Name</th><th>Products Ordered</th><th>Phone</th><th>Order Date</th><th>Address</th><th>Apartment</th><th>City</th><th>Total Price</th><th>Actions</th></tr>';
    echo '</thead>';
    echo '<tbody>';

    while ($row = $result->fetch_assoc()) {
        if ($row['id'] != 0) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($row['id']) . '</td>';
            echo '<td>' . htmlspecialchars($row['fname']) . ' ' . htmlspecialchars($row['lname']) . '</td>';
            echo '<td><a href="viewOrderItems.php?order_id=' . htmlspecialchars($row['id']) . '">View Items</a></td>';
            echo '<td>' . htmlspecialchars($row['phone']) . '</td>';
            echo '<td>' . htmlspecialchars($row['created_at']) . '</td>';
            echo '<td>' . htmlspecialchars($row['address']) . '</td>';
            echo '<td>' . htmlspecialchars($row['apartment']) . '</td>';
            echo '<td>' . htmlspecialchars($row['city']) . '</td>';
            echo '<td>$' . number_format($row['total_price'], 2) . '</td>';

            // Add a button to convert "not done" orders to "done"
            if (!$show_done) {
                echo "<td><a href='markAsDone.php?id=" . htmlspecialchars($row['id']) . "'><button>Mark as Done</button></a></td>";
            } else {
                echo "<td><a href='deleteOrder.php?id=" . htmlspecialchars($row['id']) . "'><img src='images/site/delete.jpg' width='40px' alt='delete'/></a></td>";
            }
            echo '</tr>';
        }
    }

    echo '</tbody>';
    echo '</table>';
} else {
    echo "Error in query: " . mysqli_error($conn);
}
?>

</body>
</html>
