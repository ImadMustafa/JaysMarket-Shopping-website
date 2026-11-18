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


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product Search</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>Search Products</h2>
<form method="GET" action="">
    <label for="search_id">Search by ID:</label>
    <input type="text" id="search_id" name="search_id" value="<?php echo isset($_GET['search_id']) ? htmlspecialchars($_GET['search_id']) : ''; ?>">

    <label for="search_name">Search by Name:</label>
    <input type="text" id="search_name" name="search_name" value="<?php echo isset($_GET['search_name']) ? htmlspecialchars($_GET['search_name']) : ''; ?>">

    <label for="category">Category:</label>
    <select id="category" name="category">
        <option value="">-- All Categories --</option>
        <?php
        // Fetch categories from the database
        $stmt_cat = $conn->prepare("SELECT id, categoryname FROM category");
        $stmt_cat->execute();
        $result_cat = $stmt_cat->get_result();
        while ($row_cat = $result_cat->fetch_assoc()) {
            echo '<option value="' . htmlspecialchars($row_cat['id']) . '"';
            if (isset($_GET['category']) && $_GET['category'] == $row_cat['id']) {
                echo ' selected';
            }
            echo '>' . htmlspecialchars($row_cat['categoryname']) . '</option>';
        }
        $stmt_cat->close();
        ?>
    </select>

    <label for="store">Store:</label>
    <select id="store" name="store">
        <option value="">-- All Stores --</option>
        <?php
        // Fetch stores from the database
        $stmt_store = $conn->prepare("SELECT id, storename FROM stores");
        $stmt_store->execute();
        $result_store = $stmt_store->get_result();
        while ($row_store = $result_store->fetch_assoc()) {
            echo '<option value="' . htmlspecialchars($row_store['id']) . '"';
            if (isset($_GET['store']) && $_GET['store'] == $row_store['id']) {
                echo ' selected';
            }
            echo '>' . htmlspecialchars($row_store['storename']) . '</option>';
        }
        $stmt_store->close();
        ?>
    </select>

    <input type="submit" value="Search">
</form>

<?php
include 'connection.php';

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Retrieve search parameters
$search_id = isset($_GET['search_id']) ? trim($_GET['search_id']) : '';
$search_name = isset($_GET['search_name']) ? trim($_GET['search_name']) : '';
$category_id = isset($_GET['category']) ? trim($_GET['category']) : '';
$store_id = isset($_GET['store']) ? trim($_GET['store']) : '';

// Construct the SQL query
$query = "SELECT * FROM products WHERE 1=1";
$param_types = '';
$params = [];
if (!empty($search_id)) {
    $query .= " AND id = ?";
    $param_types .= 'i';
    $params[] = $search_id;
}
if (!empty($search_name)) {
    $query .= " AND productname LIKE ?";
    $param_types .= 's';
    $params[] = "%$search_name%";
}
if (!empty($category_id)) {
    $query .= " AND categoryid = ?";
    $param_types .= 'i';
    $params[] = $category_id;
}
if (!empty($store_id)) {
    $query .= " AND storeid = ?";
    $param_types .= 'i';
    $params[] = $store_id;
}

// Prepare and execute the query
$stmt = $conn->prepare($query);

if ($param_types) {
    $stmt->bind_param($param_types, ...$params);
}

$stmt->execute();
$result = $stmt->get_result();

echo "<h2>Products</h2>";

if ($result) {
    echo '<table border="1">';
    echo '<thead>';
    echo '<tr><th>ID</th><th>Image</th><th>Name</th><th>Category</th><th>Store</th><th>Description</th><th>Quantity</th><th>Edit</th><th>Delete</th></tr>';
    echo '</thead>';
    echo '<tbody>';

    // Fetch and display each row
    while ($product_row = $result->fetch_assoc()) {
        if ($product_row['id'] != 0) {

            // Fetch category name
            $catid = $product_row['categoryid'];
            $stmt1 = $conn->prepare("SELECT categoryname FROM category WHERE id = ?");
            $stmt1->bind_param('i', $catid);
            $stmt1->execute();
            $result1 = $stmt1->get_result();

            if ($result1 && $result1->num_rows > 0) {
                $category_row = $result1->fetch_assoc();
                $catname = $category_row['categoryname'];
            } else {
                $catname = "Unknown";
            }
            $stmt1->close();

            // Fetch store name
            $storeid = $product_row['storeid'];
            $stmt2 = $conn->prepare("SELECT storename FROM stores WHERE id = ?");
            $stmt2->bind_param('i', $storeid);
            $stmt2->execute();
            $result2 = $stmt2->get_result();

            if ($result2 && $result2->num_rows > 0) {
                $store_row = $result2->fetch_assoc();
                $storename = $store_row['storename'];
            } else {
                $storename = "Unknown";
            }
            $stmt2->close();

            // Display product
            echo '<tr>';
            echo '<td>' . htmlspecialchars($product_row['id']) . '</td>';
            echo '<td><img src="' . htmlspecialchars($product_row['imagemain']) . '" alt="" width="80px"></td>';
            echo '<td>' . htmlspecialchars($product_row['productname']) . '</td>';
            echo '<td>' . htmlspecialchars($catname) . '</td>';
            echo '<td>' . htmlspecialchars($storename) . '</td>';
            echo '<td>' . htmlspecialchars($product_row['description']) . '</td>';
            echo '<td>' . htmlspecialchars($product_row['quantity']) . '</td>';
            echo "<td><a href='editProduct.php?id=" . htmlspecialchars($product_row['id']) . "'><img src='images/site/edit.jpg' width='40px' alt='edit'/></a></td>";
            echo "<td><a href='deleteProduct.php?id=" . htmlspecialchars($product_row['id']) . "'><img src='images/site/delete.jpg' width='40px' alt='delete'/></a></td>";
            echo '</tr>';
        }
    }

    echo '</tbody>';
    echo '</table>';
} else {
    // Handle the case where the query was not successful
    echo "Error in query: " . mysqli_error($conn);
}
?>
</body>
</html>
