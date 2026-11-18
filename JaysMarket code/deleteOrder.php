<?php
session_start();

if (isset($_SESSION['isLoggedIn']) && isset($_SESSION['useremail'])) {
    $useremail = $_SESSION['useremail'];
} else {
    header("Location: adminPage.php"); // Replace 'yourDesiredPage.php' with the actual page you want to redirect to
    exit();
}

include 'connection.php';

// Check if the order ID is provided
if (isset($_GET['id'])) {
    $order_id = intval($_GET['id']); // Sanitize input

    // Start a transaction to ensure both deletions happen together
    $conn->begin_transaction();

    try {
        // Delete the order items associated with this order
        $query = "DELETE FROM order_items WHERE order_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $order_id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            // Delete the order itself after deleting the order items
            $query = "DELETE FROM orders WHERE id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $order_id);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                // Commit the transaction if both deletions were successful
                $conn->commit();
                header("Location: showOrdersPage.php");
            } else {
                // Rollback the transaction if the order couldn't be deleted
                $conn->rollback();
                echo "Error: Failed to delete the order.";
            }
        } else {
            // Rollback the transaction if no order items were deleted
            $conn->rollback();
            echo "Error: No order items found for this order.";
        }
    } catch (Exception $e) {
        // Rollback the transaction in case of an error
        $conn->rollback();
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Error: No order ID provided.";
}
?>
