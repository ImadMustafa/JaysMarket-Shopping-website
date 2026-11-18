<?php
session_start();

// Function to initialize the cart if it does not exist
function initializeCart() {
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
}

// Function to add a product to the cart
function addToCart($product_id, $product_name, $product_price, $product_image) {
    initializeCart();
    
    // Check if the product already exists in the cart
    $product_key = array_search($product_id, array_column($_SESSION['cart'], 'id'));
    
    if ($product_key !== false) {
        // If the product exists, increment the quantity
        $_SESSION['cart'][$product_key]['quantity']++;
    } else {
        // If the product does not exist, add it with quantity 1
        $_SESSION['cart'][] = [
            'id' => $product_id,
            'name' => $product_name,
            'price' => $product_price,
            'image' => $product_image,
            'quantity' => 1
        ];
    }
}

// Check if POST data is received
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = isset($_POST['product_id']) ? htmlspecialchars($_POST['product_id']) : '';
    $product_name = isset($_POST['product_name']) ? htmlspecialchars($_POST['product_name']) : '';
    $product_price = isset($_POST['product_price']) ? htmlspecialchars($_POST['product_price']) : '';
    $product_image = isset($_POST['product_image']) ? htmlspecialchars($_POST['product_image']) : '';

    if ($product_id && $product_name && $product_price && $product_image) {
        addToCart($product_id, $product_name, $product_price, $product_image);
        
        // Return JSON response
        echo json_encode([
            'status' => 'success',
            'message' => 'Product added to cart',
            'total_items' => count($_SESSION['cart'])
        ]);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Invalid product data'
        ]);
    }
} else {
    // Handle the case where the request is not POST
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid request method'
    ]);
}
?>
