<div class="offcanvas-body">
    <div id="cart-content">
        <?php
        session_start();
        include 'connection.php';
        
        $total_price = 0;
        
        if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
            foreach ($_SESSION['cart'] as $key => $cart_item) {
                $query3 = "SELECT * FROM products WHERE id = " . intval($cart_item['id']);
                $result3 = mysqli_query($conn, $query3);
                
                if ($result3 && mysqli_num_rows($result3) > 0) {
                    $product = mysqli_fetch_assoc($result3);
                    
                    $item_total_price = $cart_item['quantity'] * $product['price'];
                    $total_price += $item_total_price;
                    
                    $max_reached = $cart_item['quantity'] >= $product['quantity'];
                    
                    echo '<li class="list-group-item d-flex justify-content-between align-items-center">
                        <div class="outer-div">
                            <div class="inner-div">
                                <img src="' . htmlspecialchars($cart_item['image']) . '" alt="" style="width: 50px;">
                            </div>
                            <div class="inner-div notranslate">
                                ' . htmlspecialchars($cart_item['name']) . ' - $' . htmlspecialchars(number_format($cart_item['price'], 2)) . '
                                ' . ($max_reached ? '<span class="text-danger">Max</span>' : '') . '
                            </div>
                        </div>
                        <div>
                            <button data-key="' . $key . '" data-action="decrement" class="btn btn-sm btn-secondary cart-update">-</button>
                            <span>' . htmlspecialchars($cart_item['quantity']) . '</span>
                            <button data-key="' . $key . '" data-action="increment" class="btn btn-sm btn-secondary cart-update" ' . ($max_reached ? 'disabled' : '') . '>+</button>
                            <div class="space2"></div>
                            <button data-key="' . $key . '" data-action="remove" class="btn btn-sm btn-danger cart-update">Remove</button>
                        </div>
                    </li>';
                } else {
                    echo '<li class="list-group-item">Product not found.</li>';
                }
            }
            echo '<p class="mt-3" style="font-size: 1.5em;"><strong>Total Price: $' . number_format($total_price, 2) . '</strong></p>';
        } else {
            echo '<p>Your cart is empty.</p>';
        }
        ?>
        <button id="clear-cart" class="btn btn-danger mt-3">Clear Cart</button>
    </div>
</div>
