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

<?php
include 'connection.php';

// Get the product ID from the URL and sanitize it
$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($product_id > 0) {
    // Fetch the main image path and additional images from the products table
    $stmt = $conn->prepare("SELECT imagemain, additional_images FROM products WHERE id = ?");
    $stmt->bind_param('i', $product_id);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($imagemain, $additional_images_json);
        $stmt->fetch();

        // Decode additional images from JSON
        $additional_images = json_decode($additional_images_json, true);

        // Define the upload directory path
        $upload_dir = 'images/products/product' . $product_id . '/';

        // Delete main image
        if (!empty($imagemain) && file_exists($imagemain)) {
            unlink($imagemain);
        }

        // Delete additional images
        foreach ($additional_images as $img_path) {
            if (file_exists($img_path)) {
                unlink($img_path);
            }
        }

        // Delete the directory if empty
        if (file_exists($upload_dir) && count(glob($upload_dir . "*")) === 0) {
            rmdir($upload_dir);
        }

        // Delete the product record from the database
        $delete_stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
        $delete_stmt->bind_param('i', $product_id);
        $delete_stmt->execute();
        $delete_stmt->close();

        // Redirect to the admin page
        header("Location: adminPage.php");
    } else {
        echo "Product not found.";
    }

    $stmt->close();
} else {
    echo "Invalid product ID.";
}

$conn->close();
?>
