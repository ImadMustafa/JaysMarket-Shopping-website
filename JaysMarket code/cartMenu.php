<style>
.outer-div {
    display: flex;
    align-items: center; /* Optional: centers items vertically within the outer div */
    max-width: 200px; /* Set your desired maximum width here */
    width: 100%;
}

.inner-div {
    margin-right: 10px; /* Optional: adds space between the inner divs */
}
.space2 {
    height: 8px; /* Adjust height as needed */
    width: 100%; /* Full width */
}

</style>
<div class="offcanvas-body">
    <div id="cart-content">
      <?php
      // Ensure the session is started
      session_start();
      
      // Ensure the database connection is established
      // Assuming $conn is your mysqli connection

      // Initialize total price
      $total_price = 0;

      // Display cart contents
      if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
          echo '<ul class="list-group">';
          foreach ($_SESSION['cart'] as $key => $cart_item) {
              // Fetch product details from the database
              $query3 = "SELECT * FROM products WHERE id = " . intval($cart_item['id']);
              $result3 = mysqli_query($conn, $query3);
              
              if ($result3 && mysqli_num_rows($result3) > 0) {
                  $product = mysqli_fetch_assoc($result3);
                  
                  // Determine if the cart quantity is at the max
                  $max_reached = $cart_item['quantity'] >= $product['quantity'];
                  
                  // Calculate price for this cart item
                  $item_total_price = $cart_item['quantity'] * $product['price'];
                  
                  // Add to total price
                  $total_price += $item_total_price;
                  
                  // Display the cart item
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
                  // Handle the case where product data is not found
                  echo '<li class="list-group-item">Product not found.</li>';
              }
          }
          echo '</ul>';
          
          // Display total price with increased font size
          echo '<p class="mt-3" style="font-size: 1.5em;"><strong>Total Price: $' . number_format($total_price, 2) . '</strong></p>';
      } else {
          echo '<p>Your cart is empty.</p>';
      }
      ?>
      <!-- Clear Cart Button -->
      <button id="clear-cart" class="btn btn-danger mt-3" style="background-color: red; border-color: red; padding: 0.5em 1em; font-size: 1em;">Clear Cart</button>
      
      <!-- Spacer -->
      <br><br>
      
      <!-- Check Out Button -->
      <a href="checkoutPage.php">
      <button class="btn btn-danger mt-3" style="font-size: 1.25em; padding: 0.5em 1.0em;">Check Out</button>
      </a>
    </div>
</div>
