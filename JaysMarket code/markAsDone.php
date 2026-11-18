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

if (isset($_GET['id'])) {
    $order_id = intval($_GET['id']);

    // Update the order's "done" status to true (1)
    $query = "UPDATE orders SET done = 1 WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $order_id);

    if ($stmt->execute()) {
        header("Location: showOrdersPage.php"); // Replace with the actual order page
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>
