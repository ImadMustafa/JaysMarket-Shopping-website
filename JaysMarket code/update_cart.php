<?php
session_start();

if (isset($_POST['product_key']) && isset($_POST['action'])) {
    $product_key = $_POST['product_key'];

    if ($_POST['action'] === 'increment') {
        $_SESSION['cart'][$product_key]['quantity']++;
    } elseif ($_POST['action'] === 'decrement') {
        if ($_SESSION['cart'][$product_key]['quantity'] > 1) {
            $_SESSION['cart'][$product_key]['quantity']--;
        } else {
            unset($_SESSION['cart'][$product_key]);
        }
    } elseif ($_POST['action'] === 'remove') {
        unset($_SESSION['cart'][$product_key]);
    }
}

// Return the updated cart count as a response
echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;

?>
