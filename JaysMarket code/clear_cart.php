<?php
session_start();

// Clear the cart
unset($_SESSION['cart']);

// Redirect back to the previous page or wherever you want
header('Location: ' . $_SERVER['HTTP_REFERER']);
exit();
?>
